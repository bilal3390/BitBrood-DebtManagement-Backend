<?php

namespace App\Jobs;

use App\Models\DeviceToken;
use App\Services\ExpoNotificationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendExpoPushNotificationsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Expo recommends sending up to 100 messages per request.
     */
    public int $maxPerRequest = 100;

    /**
     * @param array<int, string> $tokens Expo push tokens
     * @param array<string, mixed> $data
     */
    public function __construct(
        public array $tokens,
        public string $title,
        public string $body,
        public array $data = [],
    ) {
        $this->tokens = array_values(array_unique(array_filter($this->tokens)));
    }

    public function handle(ExpoNotificationService $expo): void
    {
        if (empty($this->tokens)) {
            return;
        }

        $chunks = array_chunk($this->tokens, $this->maxPerRequest);

        foreach ($chunks as $tokensChunk) {
            $messages = array_map(function (string $token) {
                $payload = [
                    'to' => $token,
                    'title' => $this->title,
                    'body' => $this->body,
                ];
                if (!empty($this->data)) {
                    $payload['data'] = $this->data;
                }
                return $payload;
            }, $tokensChunk);

            $result = $expo->sendMessages($messages);

            $data = $result['data'] ?? null;
            if (!is_array($data)) {
                continue;
            }

            foreach ($data as $i => $receipt) {
                if (!is_array($receipt)) {
                    continue;
                }

                $status = $receipt['status'] ?? null;
                if ($status !== 'error') {
                    continue;
                }

                $token = $tokensChunk[$i] ?? null;
                $details = is_array($receipt['details'] ?? null) ? $receipt['details'] : [];
                $errorCode = $details['error'] ?? ($receipt['message'] ?? 'unknown_error');

                Log::warning('Expo push send error', [
                    'token' => $token,
                    'error' => $errorCode,
                    'receipt' => $receipt,
                ]);

                if ($token && in_array($errorCode, ['DeviceNotRegistered', 'InvalidPushToken'], true)) {
                    DeviceToken::where('token', $token)->delete();
                }
            }
        }
    }
}

