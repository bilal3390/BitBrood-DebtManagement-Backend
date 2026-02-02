<?php

namespace App\Http\Controllers;

use App\Http\Requests\AllTransactionsRequest;
use App\Http\Requests\CreateTransactionRequest;
use App\Http\Requests\DeleteTransactionRequest;
use App\Http\Requests\EditTransactionRequest;
use App\Models\Debt;

class TransactionController extends Controller
{
    public function createTransaction(CreateTransactionRequest $request)
    {
        $dataArray = $request->validated();

        $transaction = Debt::create([
            'user_id' => $dataArray['user_id'],
            'customer_id' => $dataArray['customer_id'],
            'type' => $dataArray['type'],
            'total_amount' => $dataArray['total_amount'],
            'note' => $dataArray['note'],
            'date' => $dataArray['date'],
            'due_date' => $dataArray['due_date'],
            'cheque_number' => $dataArray['source'],
            'source_other' => $dataArray['source_other']
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Transaction created successfully',
            'transactions' => $transaction
        ]);
    }

    public function transactions(AllTransactionsRequest $request)
    {
        $dataArray = $request->validated();

        $transactions = Debt::where('user_id', $dataArray['user_id'])
            ->where('customer_id', $dataArray['customer_id'])->get();

        return response()->json([
            'status' => true,
            'message' => 'All transactions',
            'transactions' => $transactions
        ]);
    }

    public function editTransaction(EditTransactionRequest $request)
    {
        $dataArray = $request->validated();

        $transaction = Debt::whereId($dataArray['id'])->update([
            'user_id' => $dataArray['user_id'],
            'customer_id' => $dataArray['customer_id'],
            'type' => $dataArray['type'],
            'total_amount' => $dataArray['total_amount'],
            'note' => $dataArray['note'],
            'date' => $dataArray['date'],
            'due_date' => $dataArray['due_date'],
            'cheque_number' => $dataArray['source'],
            'source_other' => $dataArray['source_other']
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Transaction updated successfully',
            'transaction' => $transaction
        ]);
    }

    public function deleteTransaction(DeleteTransactionRequest $request)
    {
        $id = $request->validated()['id'];

        Debt::whereId($id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Transaction deleted successfully',
            'transaction' => null
        ]);
    }
}
