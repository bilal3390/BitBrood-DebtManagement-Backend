<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Debt;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AdminDashboardController extends Controller
{
    public function stats(): JsonResponse
    {
        return response()->json([
            'status' => true,
            'stats' => [
                'users_count' => User::count(),
                'customers_count' => Customer::count(),
                'debts_count' => Debt::count(),
            ],
        ]);
    }
}
