<?php

namespace App\Services;

use App\Models\DeviceToken;
use Google\Auth\Credentials\ServiceAccountCredentials;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FcmNotificationService
{
    protected string $projectId;
    protected string $serviceAccountPath;

    public function __construct()
    {
        $this->serviceAccountPath = config('services.fcm.service_account');
        $json = json_decode(file_get_contents($this->serviceAccountPath), true);
        $this->projectId = $json['project_id'];
    }

    /**
     * Get an access token from the service account
     */
    protected function getAccessToken(): string
    {
        $credentials = new ServiceAccountCredentials(
            ['https://www.googleapis.com/auth/firebase.messaging'],
            json_decode(file_get_contents($this->serviceAccountPath), true)
        );

        $token = $credentials->fetchAuthToken();
        return $token['access_token'];
    }

    /**
     * Send push notification to multiple FCM tokens
     */
    public function sendToTokens(Collection $tokens, string $title, string $body, array $data = []): array
    {
        $tokens = $tokens->filter()->unique();
        if ($tokens->isEmpty()) {
            return ['sent' => 0, 'failed' => 0, 'errors' => []];
        }

        // Convert $data into string-keyed map with string values
        $stringData = [];
        foreach ($data as $key => $value) {
            // Convert numeric keys to string
            if (is_int($key)) {
                $key = 'key_' . $key;
            }
            // Convert arrays/objects to JSON
            if (is_array($value) || is_object($value)) {
                $stringData[$key] = json_encode($value);
            } else {
                $stringData[$key] = (string)$value;
            }
        }

        $accessToken = $this->getAccessToken();
        $url = "https://fcm.googleapis.com/v1/projects/{$this->projectId}/messages:send";

        $result = ['sent' => 0, 'failed' => 0, 'errors' => []];

        foreach ($tokens as $token) {
            $payload = [
                'message' => [
                    'token' => $token,
                    'notification' => [
                        'title' => $title,
                        'body' => $body,
                    ],
                    'data' => $stringData,
                ]
            ];

            // Log payload for debugging
            Log::info('FCM Payload', $payload);

            $response = Http::withToken($accessToken)->post($url, $payload);

            if ($response->successful()) {
                $result['sent']++;
            } else {
                $result['failed']++;
                $result['errors'][] = $response->body();
                Log::error('FCM Send Error', [
                    'token' => $token,
                    'response' => $response->body()
                ]);
            }
        }

        return $result;
    }

    /**
     * Get all FCM tokens for the given user phone numbers
     */
    public function getTokensForUsers(array $userPhones): Collection
    {
        return DeviceToken::whereIn('user_phone_e164', $userPhones)
            ->pluck('token');
    }
}