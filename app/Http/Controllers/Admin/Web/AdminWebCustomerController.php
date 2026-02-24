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
use Symfony\Component\HttpFoundation\Response;

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

    public function show(string $customer_phone_e164): Response
    {
        abort(403, 'Viewing customer details is not allowed.');
    }

    public function create(): Response
    {
        abort(403, 'Creating customers is not allowed.');
    }

    public function store(StoreCustomerRequest $request): Response
    {
        abort(403, 'Creating customers is not allowed.');
    }

    public function edit(string $customer_phone_e164): Response
    {
        abort(403, 'Editing customers is not allowed.');
    }

    public function update(UpdateCustomerRequest $request, string $customer_phone_e164): Response
    {
        abort(403, 'Editing customers is not allowed.');
    }

    public function destroy(string $customer_phone_e164): Response
    {
        abort(403, 'Deleting customers is not allowed.');
    }
}
