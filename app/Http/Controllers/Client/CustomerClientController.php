<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomerStoreRequest;
use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class CustomerClientController extends Controller
{

   

    public function postAdd(Request $request)
    {
        $this->Validate($request,
        [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required'
        ]);

        $customer = new Customer();
        $customer['name'] = $request->name;
        $customer['email'] = $request->email;
        $customer['phone'] = $request->phone;
        $customer['address'] = $request->address;
        $customer['password'] = Hash::make($request->password);
        $customer['status'] = 1;
       
        $customer->save();

        return view('client.home.login')->with('message_ac','Tạo Tài Khoản Thành Công');
    }

    public function viewUpdateAccount(Customer $customer)
    {
        if(Auth::guard('customer')->check()){
            $id_customer = Auth::guard('customer')->user()->id;
            $cart_count = Cart::where('customer_id',$id_customer)->count();
            $all_cart = Cart::where('customer_id',$id_customer)->get();
        }
        return view('client.home.account_detail',compact('customer','all_cart','cart_count'));
    }

    public function updateAccount(CustomerStoreRequest $request, Customer $customer)
    {
        
        $customer['name'] = $request->name;
        $customer['phone'] = $request->phone;
        $customer['address'] = $request->address;
        $path = Storage::disk('public')->put('/admin/customer',$request->file('image'));
        $customer['image'] = $path;
        $customer['status'] = $request->status;

        dd($customer);
        
        $customer->save();

        return redirect()->route('view-my-account')->with('message','Update Customer Successfully');
    }
}
