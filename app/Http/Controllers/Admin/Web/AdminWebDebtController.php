<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDebtRequest;
use App\Http\Requests\Admin\UpdateDebtRequest;
use App\Models\Customer;
use App\Models\Debt;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminWebDebtController extends Controller
{
    public function index(Request $request): View
    {
        $query = Debt::query()->with(['user', 'customer'])->orderBy('date', 'desc');

        if ($request->filled('user_phone_e164')) {
            $query->where('user_phone_e164', $request->user_phone_e164);
        }
        if ($request->filled('customer_phone_e164')) {
            $query->where('customer_phone_e164', $request->customer_phone_e164);
        }

        $debts = $query->paginate(15)->withQueryString();

        return view('admin.debts.index', compact('debts'));
    }

    public function show(int $id): View|RedirectResponse
    {
        $debt = Debt::with(['user', 'customer'])->find($id);

        if (! $debt) {
            return redirect()->route('admin.debts.index')->with('error', 'Debt not found.');
        }

        return view('admin.debts.show', compact('debt'));
    }

    public function create(): View
    {
        $users = User::orderBy('name')->get(['user_phone_e164', 'name']);
        $customers = Customer::with('user')->orderBy('customer_name')->get();

        return view('admin.debts.create', compact('users', 'customers'));
    }

    public function store(StoreDebtRequest $request): RedirectResponse
    {
        Debt::create($request->validated());

        return redirect()->route('admin.debts.index')->with('success', 'Debt created successfully.');
    }

    public function edit(int $id): View|RedirectResponse
    {
        $debt = Debt::with(['user', 'customer'])->find($id);

        if (! $debt) {
            return redirect()->route('admin.debts.index')->with('error', 'Debt not found.');
        }

        $users = User::orderBy('name')->get(['user_phone_e164', 'name']);
        $customers = Customer::with('user')->orderBy('customer_name')->get();

        return view('admin.debts.edit', compact('debt', 'users', 'customers'));
    }

    public function update(UpdateDebtRequest $request, int $id): RedirectResponse
    {
        $debt = Debt::find($id);

        if (! $debt) {
            return redirect()->route('admin.debts.index')->with('error', 'Debt not found.');
        }

        $debt->update($request->validated());

        return redirect()->route('admin.debts.show', $debt->id)->with('success', 'Debt updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $debt = Debt::find($id);

        if (! $debt) {
            return redirect()->route('admin.debts.index')->with('error', 'Debt not found.');
        }

        $debt->delete();

        return redirect()->back()->with('success', 'Debt deleted successfully.');
    }
}
