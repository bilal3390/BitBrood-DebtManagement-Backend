<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function allCustomers(Request $request)
    {
        $data = $request->validate([
            'user_phone_e164' => 'required|exists:users,user_phone_e164'
        ]);

        $customers = Customer::where('user_phone_e164', $data['user_phone_e164'])->get();

        return response()->json([
            'status' => true,
            'customers' => $customers
        ]);
    }

    public function addCustomer(Request $request)
    {
        $data = $request->validate([
            'user_phone_e164' => 'required|exists:users,user_phone_e164',
            'customer_phone_e164' => 'required|unique:customers,customer_phone_e164',
            'customer_name' => 'required|string|max:255',
        ]);

        $customer = Customer::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Customer created successfully',
            'customer' => $customer
        ]);
    }

    public function singleCustomer(Request $request)
    {
        $data = $request->validate([
            'customer_phone_e164' => 'required|exists:customers,customer_phone_e164'
        ]);

        $customer = Customer::where(
            'customer_phone_e164',
            $data['customer_phone_e164']
        )->first();

        return response()->json([
            'status' => true,
            'customer' => $customer
        ]);
    }

    public function updateCustomer(Request $request)
    {
        $data = $request->validate([
            'customer_phone_e164' => 'required|exists:customers,customer_phone_e164',
            'customer_name' => 'required|string|max:255'
        ]);

        Customer::where('customer_phone_e164', $data['customer_phone_e164'])
            ->update([
                'customer_name' => $data['customer_name']
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Customer updated successfully'
        ]);
    }

    public function deleteCustomer(Request $request)
    {
        $data = $request->validate([
            'customer_phone_e164' => 'required|exists:customers,customer_phone_e164'
        ]);

        Customer::where('customer_phone_e164', $data['customer_phone_e164'])->delete();

        return response()->json([
            'status' => true,
            'message' => 'Customer deleted successfully'
        ]);
    }
}
