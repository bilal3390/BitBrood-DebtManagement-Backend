<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\VerifyOtpRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function register(RegistrationRequest $request)
    {
        $dataArray = $request->validated();

        $user = User::create([
            'name' => $dataArray['name'],
            'email' => $dataArray['email'],
            'phone_e164' => $dataArray['phone_e164'],
            'currency' => $dataArray['currency']
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }

    public function verifyOtp(VerifyOtpRequest $request)
    {
        $phone = $request->validated()['phone_164'];

        $user = User::where('phone_e164', $phone)->update([
           'phone_verified_at' => now()
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User verified successfully',
            'user' => $user
        ]);
    }
}
