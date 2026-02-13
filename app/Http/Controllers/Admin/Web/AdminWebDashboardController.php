<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Debt;
use App\Models\User;
use Illuminate\View\View;

class AdminWebDashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'usersCount' => User::count(),
            'customersCount' => Customer::count(),
            'debtsCount' => Debt::count(),
        ]);
    }
}
