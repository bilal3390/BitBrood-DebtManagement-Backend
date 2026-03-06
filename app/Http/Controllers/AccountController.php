<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Debt;
use App\Models\DeviceToken;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AccountController extends Controller
{
    /**
     * Permanently delete the user and all related data (customers, debts/debts as transactions, device_tokens).
     * Body: user_phone_e164 (E.164).
     */
    public function deleteAccount(Request $request): JsonResponse
    {
        $data = $request->validate([
            'user_phone_e164' => 'required|string|regex:/^\+[1-9]\d{6,14}$/|exists:users,user_phone_e164',
        ], [
            'user_phone_e164.exists' => 'No account found with this phone number.',
        ]);

        $userPhone = $data['user_phone_e164'];
        $user = User::where('user_phone_e164', $userPhone)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'No account found with this phone number.',
            ], 404);
        }

        DB::transaction(function () use ($user) {
            $phone = $user->user_phone_e164;
            Debt::where('user_phone_e164', $phone)->delete();
            Customer::where('user_phone_e164', $phone)->delete();
            DeviceToken::where('user_phone_e164', $phone)->delete();
            $user->delete();
        });

        return response()->json([
            'status' => true,
            'message' => 'Account and related data have been permanently deleted.',
        ]);
    }

    /**
     * Change Number: identify user by old_phone_e164, update to new_phone_e164.
     * Body: old_phone_e164, new_phone_e164 (E.164).
     */
    public function changeNumber(Request $request): JsonResponse
    {
        $data = $request->validate([
            'old_phone_e164' => 'required|string|regex:/^\+[1-9]\d{6,14}$/|exists:users,user_phone_e164',
            'new_phone_e164' => 'required|string|regex:/^\+[1-9]\d{6,14}$/|unique:users,user_phone_e164',
        ], [
            'old_phone_e164.exists' => 'No account found with this phone number.',
            'new_phone_e164.unique' => 'This number is already registered.',
        ]);

        $oldPhone = $data['old_phone_e164'];
        $newPhone = $data['new_phone_e164'];

        if ($oldPhone === $newPhone) {
            return response()->json([
                'status' => false,
                'message' => 'New number must be different from current number.',
            ], 422);
        }

        $user = User::where('user_phone_e164', $oldPhone)->first();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'No account found with this phone number.',
            ], 404);
        }

        DB::transaction(function () use ($oldPhone, $newPhone) {
            Schema::disableForeignKeyConstraints();

            Customer::where('user_phone_e164', $oldPhone)->update(['user_phone_e164' => $newPhone]);
            Debt::where('user_phone_e164', $oldPhone)->update(['user_phone_e164' => $newPhone]);
            DeviceToken::where('user_phone_e164', $oldPhone)->update(['user_phone_e164' => $newPhone]);
            User::where('user_phone_e164', $oldPhone)->update(['user_phone_e164' => $newPhone]);

            Schema::enableForeignKeyConstraints();
        });

        return response()->json([
            'status' => true,
            'message' => 'Phone number updated successfully.',
        ]);
    }
}
