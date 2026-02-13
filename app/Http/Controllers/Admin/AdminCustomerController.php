<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCustomerRequest;
use App\Http\Requests\Admin\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $perPage = (int) $request->get('per_page', 15);
        $perPage = min(max($perPage, 1), 100);

        $query = Customer::query()->with('user')->orderBy('created_at', 'desc');

        if ($request->filled('user_phone_e164')) {
            $query->where('user_phone_e164', $request->user_phone_e164);
        }

        $customers = $query->paginate($perPage);

        return response()->json([
            'status' => true,
            'customers' => $customers->items(),
            'pagination' => [
                'current_page' => $customers->currentPage(),
                'per_page' => $customers->perPage(),
                'total' => $customers->total(),
                'last_page' => $customers->lastPage(),
            ],
        ]);
    }

    public function show(string $customer_phone_e164): JsonResponse
    {
        $customer = Customer::where('customer_phone_e164', $customer_phone_e164)->firstOrFail();

        return response()->json([
            'status' => true,
            'customer' => $customer,
        ]);
    }

    public function store(StoreCustomerRequest $request): JsonResponse
    {
        $customer = Customer::create($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Customer created successfully',
            'customer' => $customer,
        ], 201);
    }

    public function update(UpdateCustomerRequest $request, string $customer_phone_e164): JsonResponse
    {
        $customer = Customer::where('customer_phone_e164', $customer_phone_e164)->firstOrFail();
        $customer->update($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Customer updated successfully',
            'customer' => $customer->fresh(),
        ]);
    }

    public function destroy(string $customer_phone_e164): JsonResponse
    {
        $customer = Customer::where('customer_phone_e164', $customer_phone_e164)->firstOrFail();
        $customer->delete();

        return response()->json([
            'status' => true,
            'message' => 'Customer deleted successfully',
        ]);
    }
}
