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
     * Soft delete the user and all related data (customers, debts, device_tokens).
     * Payload: user_phone (E164)
     */
    public function deleteAccount(Request $request): JsonResponse
    {
        $data = $request->validate([
            'user_phone_e164' => 'required|string|exists:users,user_phone_e164',
        ]);

        $userPhone = $data['user_phone_e164'];
        $user = User::where('user_phone_e164', $userPhone)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found.',
            ], 404);
        }

        DB::transaction(function () use ($user) {
            Customer::where('user_phone_e164', $user->user_phone_e164)->delete();
            Debt::where('user_phone_e164', $user->user_phone_e164)->delete();
            DeviceToken::where('user_phone_e164', $user->user_phone_e164)->delete();
            $user->delete();
        });

        return response()->json([
            'status' => true,
            'message' => 'Account and related data have been soft deleted and can be recovered later.',
        ]);
    }

    /**
     * Verify user by old number and update to new number.
     * Payload: old_number, new_number (E164)
     */
    public function changeNumber(Request $request): JsonResponse
    {
        $data = $request->validate([
            'old_number' => 'required|string|exists:users,user_phone_e164',
            'new_number' => 'required|string|unique:users,user_phone_e164',
        ]);

        $oldNumber = $data['old_number'];
        $newNumber = $data['new_number'];

        $user = User::where('user_phone_e164', $oldNumber)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found with the given old number.',
            ], 404);
        }

        DB::transaction(function () use ($oldNumber, $newNumber) {
            Schema::disableForeignKeyConstraints();

            Customer::where('user_phone_e164', $oldNumber)->update(['user_phone_e164' => $newNumber]);
            Debt::where('user_phone_e164', $oldNumber)->update(['user_phone_e164' => $newNumber]);
            DeviceToken::where('user_phone_e164', $oldNumber)->update(['user_phone_e164' => $newNumber]);
            User::where('user_phone_e164', $oldNumber)->update(['user_phone_e164' => $newNumber]);

            Schema::enableForeignKeyConstraints();
        });

        return response()->json([
            'status' => true,
            'message' => 'Phone number updated successfully.',
        ]);
    }
}
