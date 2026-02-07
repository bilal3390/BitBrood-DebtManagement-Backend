<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Debt;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Shared method to get customers
     */
    private function getCustomers(string $userPhone)
    {
        return Customer::where('user_phone_e164', $userPhone)
            ->select([
                'customer_name as name',
                'customer_phone_e164',
                'created_at',
                'updated_at'
            ])
            ->get()
            ->values()
            ->map(function ($customer, $index) {
                return [
                    'id' => $index + 1,
                    'name' => $customer->name,
                    'phone_e164' => $customer->customer_phone_e164,
                    'customer_phone_e164' => $customer->customer_phone_e164,
                    'created_at' => $customer->created_at,
                    'updated_at' => $customer->updated_at,
                ];
            });
    }

    /**
     * Shared method to get transactions
     */
    private function getTransactions(string $userPhone)
    {
        return Debt::where('user_phone_e164', $userPhone)
            ->orderByDesc('date')
            ->get([
                'id',
                'customer_phone_e164',
                'type',
                'total_amount',
                'note',
                'date',
                'due_date',
                'source',
                'cheque_number',
                'source_other'
            ]);
    }

    /**
     * Dashboard data
     */
    public function userData(Request $request)
    {
        $data = $request->validate([
            'user_phone_e164' => 'required|exists:users,user_phone_e164',
        ]);

        $userPhone = $data['user_phone_e164'];

        return response()->json([
            'status' => true,
            'customers' => $this->getCustomers($userPhone),
            'transactions' => $this->getTransactions($userPhone),
        ]);
    }

    /**
     * Check user existence & verification
     */
    public function checkUserExistence(Request $request)
    {
        $data = $request->validate([
            'user_phone_e164' => 'required|exists:users,user_phone_e164',
        ]);

        $userPhone = $data['user_phone_e164'];

        // exists validation already guarantees user exists
        $user = User::where('user_phone_e164', $userPhone)
            ->select('phone_verified_at')
            ->first();

        if (!$user->phone_verified_at) {
            return response()->json([
                'status' => true,
                'statusCode' => 101, // user exists but not verified
            ]);
        }

        return response()->json([
            'status' => true,
            'statusCode' => 100, // verified
            'customers' => $this->getCustomers($userPhone),
            'transactions' => $this->getTransactions($userPhone),
        ]);
    }
}
