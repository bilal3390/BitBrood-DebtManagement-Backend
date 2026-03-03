<?php

namespace App\Http\Controllers;

use App\Models\DeviceToken;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DeviceTokenController extends Controller
{
    /**
     * Register or update an FCM device token for push notifications.
     * Call this from the mobile app when the user logs in or when the token is refreshed.
     */
    public function store(Request $request): JsonResponse
    {

        Log::info('Device token request: ' . json_encode($request->all()));

        $data = $request->validate([
            'user_phone_e164' => 'required|exists:users,user_phone_e164',
            'token' => 'required|string|max:500',
            'platform' => 'nullable|string|in:android,ios',
        ]);

        Log::info('Device token data: ' . json_encode($data));

        $platform = $data['platform'] ?? 'android';

        DeviceToken::updateOrCreate(
            [
                'user_phone_e164' => $data['user_phone_e164'],
                'token' => $data['token'],
            ],
            [
                'platform' => $platform,
                'last_used_at' => now(),
            ]
        );

        Log::info('Device token registered for push notifications.');

        return response()->json([
            'status' => true,
            'message' => 'Device token registered for push notifications.',
        ]);
    }
}
