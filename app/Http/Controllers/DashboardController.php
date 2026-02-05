<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Debt;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function userData(Request $request)
    {
        // 🔐 Validate input
        $data = $request->validate([
            'user_phone_e164' => 'required|exists:users,user_phone_e164',
        ]);

        $userPhone = $data['user_phone_e164'];

        // 👤 Get customers of this user
        $customers = Customer::where('user_phone_e164', $userPhone)
            ->select([
                'customer_name as name',
                'customer_phone_e164',
                'created_at',
                'updated_at'
            ])
            ->get()
            ->map(function ($customer, $index) {
                return [
                    'id' => $index + 1, // frontend-friendly id
                    'name' => $customer->name,
                    'phone_e164' => $customer->customer_phone_e164,
                    'customer_phone_e164' => $customer->customer_phone_e164,
                    'created_at' => $customer->created_at,
                    'updated_at' => $customer->updated_at,
                ];
            });

        // 💰 Get all transactions of this user
        $transactions = Debt::where('user_phone_e164', $userPhone)
            ->orderBy('date', 'desc')
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

        return response()->json([
            'status' => true,
            'customers' => $customers,
            'transactions' => $transactions
        ]);
    }
}
