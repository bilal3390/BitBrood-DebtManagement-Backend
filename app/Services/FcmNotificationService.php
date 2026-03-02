<?php

namespace App\Services;

use App\Models\DeviceToken;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FcmNotificationService
{
    protected ?string $serverKey;

    protected string $url = 'https://fcm.googleapis.com/fcm/send';

    public function __construct()
    {
        $this->serverKey = config('services.fcm.server_key');
    }

    /**
     * Send push notification to the given device tokens (FCM legacy API).
     * Returns ['sent' => int, 'failed' => int, 'errors' => array].
     */
    public function sendToTokens(Collection $tokens, string $title, string $body, array $data = []): array
    {
        $tokens = $tokens->filter()->unique()->values();
        if ($tokens->isEmpty()) {
            return ['sent' => 0, 'failed' => 0, 'errors' => []];
        }

        if (empty($this->serverKey)) {
            Log::warning('FCM server key not configured. Notification not sent.');
            return ['sent' => 0, 'failed' => $tokens->count(), 'errors' => ['FCM server key not set in .env (FCM_SERVER_KEY)']];
        }

        $result = ['sent' => 0, 'failed' => 0, 'errors' => []];

        // FCM legacy API accepts max 1000 registration_ids per request
        foreach ($tokens->chunk(1000) as $chunk) {
            $payload = [
                'registration_ids' => $chunk->values()->all(),
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                    'sound' => 'default',
                ],
                'data' => $data,
            ];

            $response = Http::withHeaders([
                'Authorization' => 'key=' . $this->serverKey,
                'Content-Type' => 'application/json',
            ])->post($this->url, $payload);

            if ($response->successful()) {
                $json = $response->json();
                $success = $json['success'] ?? 0;
                $failure = $json['failure'] ?? 0;
                $result['sent'] += $success;
                $result['failed'] += $failure;
                if (! empty($json['results'])) {
                    foreach ($json['results'] as $i => $res) {
                        if (isset($res['error'])) {
                            $result['errors'][] = $res['error'];
                        }
                    }
                }
            } else {
                $result['failed'] += $chunk->count();
                $result['errors'][] = $response->body() ?: 'HTTP ' . $response->status();
            }
        }

        return $result;
    }

    /**
     * Get all FCM tokens for the given user phone numbers.
     */
    public function getTokensForUsers(array $userPhones): Collection
    {
        return DeviceToken::query()
            ->whereIn('user_phone_e164', $userPhones)
            ->pluck('token');
    }
}
