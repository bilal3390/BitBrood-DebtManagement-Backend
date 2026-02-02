<?php

namespace App\Http\Controllers;

use App\Http\Requests\AllCustomersRequest;
use App\Http\Requests\CreateCustomersRequest;
use App\Http\Requests\DeleteCustomersRequest;
use App\Http\Requests\UpdateCustomersRequest;
use App\Http\Requests\ViewCustomersRequest;
use App\Models\Customer;
use App\Models\User;

class CustomerController extends Controller
{
    public function allCustomers(AllCustomersRequest $request)
    {
        $phone = $request->validated()['phone_e164'];

        $user = User::where('phone_e164', $phone)->first();

        $customers = Customer::where('user_id', $user->id)->get();

        return response()->json([
            'status' => true,
            'message' => 'All customers',
            'customers' => $customers
        ]);
    }

    public function addCustomer(CreateCustomersRequest $request)
    {
        $dataArray = $request->validated();

        $customer = Customer::create([
            'name' => $dataArray['name'],
            'phone_e164' => $dataArray['phone_e164']
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Customer created successful',
            'customer' => $customer
        ]);
    }

    public function updateCustomer(UpdateCustomersRequest $request)
    {
        $dataArray = $request->validated();

        $customer = Customer::whereId($dataArray['id'])->update([
            'name' => $dataArray['name'],
            'phone_e164' => $dataArray['phone_e164']
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Customer updated successful',
            'customer' => $customer
        ]);
    }

    public function singleCustomer(ViewCustomersRequest $request)
    {
        $id = $request->validated()['id'];

        $customer = Customer::whereId($id)->first();

        return response()->json([
            'status' => true,
            'message' => 'Customer detail',
            'customer' => $customer
        ]);
    }

    public function deleteCustomer(DeleteCustomersRequest $request)
    {
        $id = $request->validated()['id'];

        Customer::whereId($id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Customer deleted successfully',
            'customer' => null
        ]);
    }
}
