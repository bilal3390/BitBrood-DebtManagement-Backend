<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Debt;

class TransactionController extends Controller
{
    // 🔹 Create transaction
    public function createTransaction(Request $request)
    {
        $data = $request->validate([
            'user_phone_e164' => 'required|exists:users,user_phone_e164',
            'customer_phone_e164' => 'required|exists:customers,customer_phone_e164',
            'type' => 'required|in:borrowed,gave',
            'total_amount' => 'required|numeric|min:0',
            'note' => 'nullable|string',
            'date' => 'required|date',
            'due_date' => 'nullable|date',
            'source' => 'nullable|in:Cash,Cheque,Other',
            'cheque_number' => 'nullable|string',
            'source_other' => 'nullable|string',
        ]);

        $transaction = Debt::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Transaction created successfully',
            'transaction' => $transaction
        ]);
    }

    // 🔹 Get all transactions of a customer
    public function transactions(Request $request)
    {
        $data = $request->validate([
            'user_phone_e164' => 'required|exists:users,user_phone_e164',
            'customer_phone_e164' => 'required|exists:customers,customer_phone_e164',
        ]);

        $transactions = Debt::where('user_phone_e164', $data['user_phone_e164'])
            ->where('customer_phone_e164', $data['customer_phone_e164'])
            ->orderBy('date', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'transactions' => $transactions
        ]);
    }

    // 🔹 Update transaction
    public function updateTransaction(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|exists:debts,id',
            'type' => 'required|in:borrowed,gave',
            'total_amount' => 'required|numeric|min:0',
            'note' => 'nullable|string',
            'date' => 'required|date',
            'due_date' => 'nullable|date',
            'source' => 'nullable|in:Cash,Cheque,Other',
            'cheque_number' => 'nullable|string',
            'source_other' => 'nullable|string',
        ]);

        Debt::whereId($data['id'])->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Transaction updated successfully'
        ]);
    }

    // 🔹 Delete transaction
    public function deleteTransaction(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|exists:debts,id'
        ]);

        Debt::whereId($data['id'])->delete();

        return response()->json([
            'status' => true,
            'message' => 'Transaction deleted successfully'
        ]);
    }
}
