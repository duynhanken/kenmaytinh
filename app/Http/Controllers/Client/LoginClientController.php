<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginClientController extends Controller
{

    public function getClientLogin()
    {
        return view('client.home.login');
    }

    public function postClientLogin(Request $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 1,
        ];

        if(Auth::guard('customer')->attempt($login))
        {
            $user = Auth::guard('customer')->user();
            $id_customer = Auth::guard('customer')->user()->id;

            $cart = (array) session('cart');
       
            foreach($cart as $id => $details)
            {
                $quantity = $details['quantity'];
                $price = $details['price'];
    
                Cart::create([
                    'customer_id' => $id_customer,
                    'product_id' => $id,
                    'price' => $price,
                    'quantity' => $quantity,
                ]);
            }
    
            session(['cart'=>'']);   
            session()->forget('cart');    
          
          
            return redirect()->route('get-client-home');
        }else{
            return view('client.home.login')->with('status-message','Email or Password không đúng');
        }
    }


    public function getClientLogout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('get-client-home');
    }
}
