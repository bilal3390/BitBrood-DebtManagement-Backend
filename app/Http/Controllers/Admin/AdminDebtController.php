<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDebtRequest;
use App\Http\Requests\Admin\UpdateDebtRequest;
use App\Models\Debt;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminDebtController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $perPage = (int) $request->get('per_page', 15);
        $perPage = min(max($perPage, 1), 100);

        $query = Debt::query()->orderBy('date', 'desc');

        if ($request->filled('user_phone_e164')) {
            $query->where('user_phone_e164', $request->user_phone_e164);
        }
        if ($request->filled('customer_phone_e164')) {
            $query->where('customer_phone_e164', $request->customer_phone_e164);
        }

        $debts = $query->paginate($perPage);

        return response()->json([
            'status' => true,
            'debts' => $debts->items(),
            'pagination' => [
                'current_page' => $debts->currentPage(),
                'per_page' => $debts->perPage(),
                'total' => $debts->total(),
                'last_page' => $debts->lastPage(),
            ],
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $debt = Debt::findOrFail($id);

        return response()->json([
            'status' => true,
            'debt' => $debt,
        ]);
    }

    public function store(StoreDebtRequest $request): JsonResponse
    {
        $debt = Debt::create($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Debt created successfully',
            'debt' => $debt,
        ], 201);
    }

    public function update(UpdateDebtRequest $request, int $id): JsonResponse
    {
        $debt = Debt::findOrFail($id);
        $debt->update($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Debt updated successfully',
            'debt' => $debt->fresh(),
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $debt = Debt::findOrFail($id);
        $debt->delete();

        return response()->json([
            'status' => true,
            'message' => 'Debt deleted successfully',
        ]);
    }
}
