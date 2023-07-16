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
    public function getClientIndex()
    {
        $list_product = Product::where([['status',1],['quantity','>',0]])->take(8)->get();
        return view('client.home.index',compact('list_product'));
    }

    // public function getClientHomeIndex(){
    //     $id_customer = Auth::guard('customer')->user()->id;
    //     $all_cart = Cart::where('customer_id',$id_customer)->get();
    //     $cart_count = Cart::where('customer_id',$id_customer)->count();
    //     $list_product = Product::where([['status',1],['quantity','>',0]])->take(8)->get();
    //     return view('client.home.index',compact('list_product','all_cart','cart_count'));
    // }

    public function getClientHome()
    {
        
        // $id_customer = Auth::guard('customer')->user()->id;
        // $all_cart = Cart::where('customer_id',$id_customer)->get();
        // $cart_count = Cart::where('customer_id',$id_customer)->count();
        $list_product = Product::where([['status',1],['quantity','>',0]])->take(8)->get();
        return view('client.home.home',compact('list_product'));
    }

    public function getAccount()
    {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('get-client-home');
        } else {
            return view('client.home.account');
        }
    }

   
    
}
