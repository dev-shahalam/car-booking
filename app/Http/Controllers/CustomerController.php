<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller {
    public function customerPage(Request $request) {
        $user_id = $request->header('id');
        $admin = User::where('id', $user_id)->where('role', 'admin')->first();
        if ($user_id) {
            $customers = User::where('role', 'customer')->with(['rentals'=>function($query){
                $query->where('status','completed');
            }])->get();
            return view('components.customer.customer-list', compact('customers','admin'));
        } else {
            return redirect()->route('login');
        }
    }

    // public function customerList(Request $request){
    //     $customers = User::where('role','customer')->get();
    //     return view('components.customer.customer-list',compact('$customers'));

    // }

    public function updateCustomerPage(Request $request) {
        $user_id = $request->header('id');
        $customer_id = $request->id;
        $customer = User::find($customer_id);
        if ($user_id) {
            return view('components.customer.customer-update', compact('customer'));
        } else {
            return redirect()->route('login');
        }

    }

    public function updateCustomer(Request $request) {

        $user_id = $request->header('id');
        $customer_id = $request->id;
        if ($user_id) {
            $customer = User::find($customer_id);
            if ($customer && $customer->role == 'customer') {
                $customer->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone_number' => $request->input('phone_number'),
                    'address' => $request->input('address'),
                ]);
                return redirect()->route('customer-page');
            } else {
                return redirect()->back()->with('error', 'Customer not found');
            }
        } else {
            return redirect()->route('/login');
        }
    }

    public function deleteCustomer(Request $request) {
        $user_id = $request->header('id');
        $customer_id = $request->id;
        if ($user_id) {
            $customer = User::find($customer_id);
            if ($customer && $customer->role == 'customer') {
                $customer->delete();
                return redirect()->route('customer-page');
            } else {
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('login');
        }
    }

}
