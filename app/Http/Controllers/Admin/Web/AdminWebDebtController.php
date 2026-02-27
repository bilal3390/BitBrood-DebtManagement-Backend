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
use Symfony\Component\HttpFoundation\Response;

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

    public function show(int $id): Response
    {
        abort(403, 'Viewing debt details is not allowed.');
    }

    public function create(): Response
    {
        abort(403, 'Creating debts is not allowed.');
    }

    public function store(StoreDebtRequest $request): Response
    {
        abort(403, 'Creating debts is not allowed.');
    }

    public function edit(int $id): Response
    {
        abort(403, 'Editing debts is not allowed.');
    }

    public function update(UpdateDebtRequest $request, int $id): Response
    {
        abort(403, 'Editing debts is not allowed.');
    }

    public function destroy(int $id): Response
    {
        abort(403, 'Deleting debts is not allowed.');
    }
}
