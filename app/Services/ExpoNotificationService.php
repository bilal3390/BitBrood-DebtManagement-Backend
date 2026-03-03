<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExpoNotificationService
{
    private const EXPO_PUSH_ENDPOINT = 'https://exp.host/--/api/v2/push/send';

    /**
     * @param array<int, array{to:string,title?:string,body?:string,data?:array<string,mixed>}> $messages
     * @return array<string, mixed>
     */
    public function sendMessages(array $messages): array
    {
        $messages = array_values(array_filter($messages, function ($m) {
            return is_array($m) && !empty($m['to']) && is_string($m['to']);
        }));

        if (empty($messages)) {
            return ['ok' => true, 'data' => []];
        }

        try {
            $response = Http::acceptJson()
                ->asJson()
                ->timeout(20)
                ->retry(2, 250, throw: false)
                ->post(self::EXPO_PUSH_ENDPOINT, $messages);
        } catch (ConnectionException $e) {
            Log::error('Expo push connection error', ['message' => $e->getMessage()]);
            return ['ok' => false, 'error' => 'connection_error', 'message' => $e->getMessage()];
        }

        if (!$response->successful()) {
            Log::error('Expo push HTTP error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return [
                'ok' => false,
                'error' => 'http_error',
                'status' => $response->status(),
                'body' => $response->json() ?? $response->body(),
            ];
        }

        return $response->json() ?? ['ok' => true];
    }
}

