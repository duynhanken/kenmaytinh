<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeClientController extends Controller
{


    public function getClientHome()
    {
        if (Auth::guard('customer')->check()){
            $id_customer = Auth::guard('customer')->user()->id;
            $all_cart = Cart::where('customer_id',$id_customer)->get();
            $cart_count = Cart::where('customer_id',$id_customer)->count();
            $list_product = Product::where([['status',1],['quantity','>',0]])->orderBy('out_price','DESC')->take(8)->get();
            return view('client.home.home',compact('list_product','all_cart','cart_count'));
        }else{
            $list_product = Product::where([['status',1],['quantity','>',0]])->orderBy('id','DESC')->take(8)->get();
            return view('client.home.home',compact('list_product'));
        }
    }

    public function getAccount()
    {
        
        if (Auth::guard('customer')->check()) {
            $id_customer = Auth::guard('customer')->user()->id;
            $cart_count = Cart::where('customer_id',$id_customer)->count();
            $all_cart = Cart::where('customer_id',$id_customer)->get();
            return redirect()->route('get-client-home',compact('all_cart','cart_count'));
        } else {
            return view('client.home.account');
        }
    }

   
    
}
