<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCustomerRequest;
use App\Http\Requests\Admin\UpdateCustomerRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminWebCustomerController extends Controller
{
    public function index(Request $request): View
    {
        $query = Customer::query()->with('user')->orderBy('created_at', 'desc');

        if ($request->filled('user_phone_e164')) {
            $query->where('user_phone_e164', $request->user_phone_e164);
        }

        $customers = $query->paginate(15)->withQueryString();

        return view('admin.customers.index', compact('customers'));
    }

    public function show(string $customer_phone_e164): View
    {
        $customer = Customer::where('customer_phone_e164', $customer_phone_e164)->firstOrFail();

        return view('admin.customers.show', compact('customer'));
    }

    public function create(): View
    {
        $users = User::orderBy('name')->get(['user_phone_e164', 'name']);

        return view('admin.customers.create', compact('users'));
    }

    public function store(StoreCustomerRequest $request): RedirectResponse
    {
        Customer::create($request->validated());

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Customer created successfully.');
    }

    public function edit(string $customer_phone_e164): View
    {
        $customer = Customer::where('customer_phone_e164', $customer_phone_e164)->firstOrFail();
        $users = User::orderBy('name')->get(['user_phone_e164', 'name']);

        return view('admin.customers.edit', compact('customer', 'users'));
    }

    public function update(UpdateCustomerRequest $request, string $customer_phone_e164): RedirectResponse
    {
        $customer = Customer::where('customer_phone_e164', $customer_phone_e164)->firstOrFail();
        $customer->update($request->validated());

        return redirect()
            ->route('admin.customers.show', $customer_phone_e164)
            ->with('success', 'Customer updated successfully.');
    }

    public function destroy(string $customer_phone_e164): RedirectResponse
    {
        $customer = Customer::where('customer_phone_e164', $customer_phone_e164)->firstOrFail();
        $customer->delete();

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Customer deleted successfully.');
    }
}
