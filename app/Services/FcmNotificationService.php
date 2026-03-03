<?php

namespace App\Services;

use App\Models\DeviceToken;
use Google\Auth\Credentials\ServiceAccountCredentials;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

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

    protected function getAccessToken(): string
    {
        $credentials = new ServiceAccountCredentials(
            ['https://www.googleapis.com/auth/firebase.messaging'],
            json_decode(file_get_contents($this->serviceAccountPath), true)
        );

        $token = $credentials->fetchAuthToken();
        return $token['access_token'];
    }

    public function sendToTokens(Collection $tokens, string $title, string $body, array $data = []): array
    {
        $tokens = $tokens->filter()->unique();

        if ($tokens->isEmpty()) {
            return ['sent' => 0, 'failed' => 0, 'errors' => []];
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
                    'data' => $data,
                ]
            ];

            $response = Http::withToken($accessToken)
                ->post($url, $payload);

            if ($response->successful()) {
                $result['sent']++;
            } else {
                $result['failed']++;
                $result['errors'][] = $response->body();
            }
        }

        return $result;
    }

    public function getTokensForUsers(array $userPhones): Collection
    {
        return DeviceToken::whereIn('user_phone_e164', $userPhones)
            ->pluck('token');
    }
}