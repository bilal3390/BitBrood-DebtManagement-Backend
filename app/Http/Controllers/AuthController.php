<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email',
            'user_phone_e164' => 'required|unique:users,user_phone_e164',
            'currency' => 'required'
        ]);

        $user = User::create($data);

        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $data = $request->validate([
            'user_phone_e164' => 'required|exists:users,user_phone_e164'
        ]);

        User::where('user_phone_e164', $data['user_phone_e164'])
            ->update(['phone_verified_at' => now()]);

        return response()->json([
            'status' => true,
            'message' => 'User verified successfully'
        ]);
    }
}
