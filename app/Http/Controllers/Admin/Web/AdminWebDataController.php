<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Debt;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminWebDataController extends Controller
{
    /**
     * Delete all app data (users, customers, debts). Requires current admin password.
     * Admins table is left intact so you can still log in.
     */
    public function destroyAll(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $admin = Auth::guard('admin')->user();
        if (! Hash::check($request->password, $admin->password)) {
            throw ValidationException::withMessages([
                'password' => ['The password is incorrect.'],
            ]);
        }

        DB::transaction(function () {
            Debt::query()->delete();
            Customer::query()->delete();
            User::query()->delete();
        });

        return redirect()->route('admin.dashboard')->with('success', 'All data (users, customers, debts) has been deleted.');
    }
}
