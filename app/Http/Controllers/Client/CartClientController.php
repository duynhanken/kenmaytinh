<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartClientController extends Controller
{
    
    public function addtocartlg(Request $request,$id)
    {
        $id_customer = Auth::guard('customer')->user()->id;

        $product = Product::find($id);
        $id_product = $product->id;
        
        $cart = Cart::where([['customer_id',$id_customer],['product_id',$id_product]])->first();
       
        if(isset($cart))
        {
            if($cart->quantity)
            $cart->quantity++;
            $cart->save();
            return redirect()->back()->with('success','sản phẩm đã được thêm vào giỏ hàng');
        }else{
      
            $cart = new Cart();

            $cart->customer_id = $id_customer;
            $cart->product_id =  $id_product;
            if($request->product_qty <= $product->quantity)
            {
                $cart->quantity = $request->product_qty;
            }else{
                $cart->quantity = $product->quantity;
                Session::put('message','Một số sản phẩm không còn đủ số lượng để cung cấp cho bạn. Xin lổi vì sự bất tiện này');
                return redirect()->back();
            }
           
            $cart->price = $product->out_price;

            $cart->save();
            return redirect()->back()->with('success','sản phẩm đã được thêm vào giỏ hàng');
        }
        
       
    }

    public function deleteProductCart($id){
        $id_customer = Auth::guard('customer')->user()->id;

        $product = Product::find($id);
        $id_product = $product->id;
        $cart = Cart::where([['customer_id',$id_customer],['product_id',$id_product]])->first();
        $cart->delete();
        return redirect()->back()->with('success','xóa một sản phẩm khỏi giỏ hàng thành công');
    }




    public function addtocart(Request $request,$id)
    {

        $product = Product::find($id);
        
        $cart = session()->get('cart',[]); 

        if(isset($cart[$id])){
            $cart[$id]['quantity']++;
        }else{
            $cart[$id] = [
                'id' => $product->id,
                'number' => $product->number,
                'name' =>$product->name,
                'quantity' => $request->quatity,
                'price' => $product->out_price,
                'image' => $product->image,
            ];
        }
      
    
        session()->put('cart',$cart);

       
        return redirect()->back()->with('success','sản phẩm đã được thêm vào giỏ hàng');
       
    }  


    public function remove($id){
        $cart = session()->get('cart',[]);
        if(isset($cart[$id])){
            unset($cart[$id]);
            session()->put('cart',$cart);
        }
        return redirect()->back()->with('success', 'sản phẩm xóa thành công');
    }



    public function viewtoCart()
    {
        if (Auth::guard('customer')->check()) {
            $id_customer = Auth::guard('customer')->user()->id;
            $cart_count = Cart::where('customer_id',$id_customer)->count();
            $all_cart = Cart::where('customer_id',$id_customer)->get();
        
        return view('client.cart.cartproduct',compact('all_cart','cart_count'));
        }
    }


   public function postCheckOut(Request $request)
   {
        $id_customer = Auth::guard('customer')->user()->id;
        $bill = Bill::where([['customer_id',$id_customer],['status',0]])->first();
        $customer = Customer::findOrFail($id_customer);
        

        if(isset($bill))
        {
            foreach($bill->detail_bill as $detail_bill)
            {
                $detail_bill->delete();     
            }
            $bill->delete();
        }



        $bill = new Bill();
        $bill->customer_id = $id_customer;
        $bill->name=$customer->name;
        $bill->address = $customer->address;
        $bill->phone = $customer->phone;
        $bill->total_price = 0;
        $bill->price_checkout = 0;
        $bill->date_create = date('Y-m-d H:i:s');
        $bill->status = 0;
        
        $bill->save();

        $cart = Cart::where('customer_id',$id_customer)->get();
       

        foreach($cart as $item)
        {
           
            $detail_bill = new BillDetail();
          
            $detail_bill->bill_id = $bill->id;
          
            $detail_bill->product_id = $item->product_id;
           
            
            $product = Product::find($item->product_id); 
            
            $ct = "quanty_".$item->id;
            
            if($request->$ct <= $product->quantity)
            {
                $item->quantity = $request->$ct;
                $item->save();
                $detail_bill->quantity = $item->quantity;
            }
            else{
                $item->quantity =  $product->quantity;
                $item->save();
                Session::put('message','Một số sản phẩm không còn đủ số lượng để cung cấp cho bạn. Xin lổi vì sự bất tiện này');
                return redirect()->back();
                
            }
        
            
          
          
            $detail_bill->price = $item->product->out_price;
            $bill->total_price = $bill->total_price + ($detail_bill->quantity * $detail_bill->price); 

            $bill->price_checkout = $bill->total_price *(1-(($bill->voucher->value ?? 0) / 100));


            $detail_bill->save();

            $bill->save();
        }
        if (Auth::guard('customer')->check()) {
            $id_customer = Auth::guard('customer')->user()->id;
            $cart_count = Cart::where('customer_id',$id_customer)->count();
            $all_cart = Cart::where('customer_id',$id_customer)->get();
        }
        return view('client.cart.cart',compact('bill','cart_count','all_cart'));

   }


   public function updateQuantityCart(Request $request,$id)
   {
        $cart = Cart::findOrFail($id);
        $cart->quantity = $request->quanty;
        $cart->save();
        return redirect()->back();
   }




    public function updateQuantity(Request $request)
    {
        $bill = Bill::findOrFail($request->id_bill);
        $bill->total_price = 0;
        $bill->price_checkout = 0;
        foreach($bill->detail_bill as $detail_bill)
        {
            $quantity = "quantity_".$detail_bill->product->id;
            if($request->$quantity == 0)
            {
                $detail_bill->delete();
            }
            else
            {
                $detail_bill->quantity = $request->$quantity;
                $detail_bill->save();
                $bill->total_Price = $bill->total_Price + ($detail_bill->quantity * $detail_bill->price); 
            }
        }
        $bill->price_Checkout = $bill->total_Price *(1-(($bill->voucher->value ?? 0) / 100));
        $bill->save();
        return redirect()->route('getCart',$bill->id);
    }

    public function getCart($id_bill)
    {
        $bill = Bill::where([['id',$id_bill],['status',0]])->first();
        if(isset($bill))
        {
            if (Auth::guard('customer')->check()) {
                $id_customer = Auth::guard('customer')->user()->id;
                $cart_count = Cart::where('customer_id',$id_customer)->count();
                $all_cart = Cart::where('customer_id',$id_customer)->get();
            }
            return view('client.cart.cart',compact('cart_count','all_cart'))->with('bill',$bill);    
        }
        return redirect()->route('get-client-home');
    }



    public function checkOut(Request $request)
    {
        $id_customer = Auth::guard('customer')->user()->id;
        

        $bill = Bill::findOrFail($request->bill_id);
        $bill->name = $request->name;
        $bill->phone = $request->phone;
        $bill->address = $request->address;
        $bill->desc = $request->desc;
        $bill->status = 1;
        
        $bill->save();

       

        foreach($bill->detail_bill as $detail_bill)
        {
            $product = Product::findOrFail($detail_bill->product->id);
            $product->quantity = $product->quantity - $detail_bill->quantity;
            $product->save();
        }
        if(isset($bill->voucher_id))
        {
            $voucher = Voucher::findOrFail($bill->voucher_id);
            $voucher->quantity =  $voucher->quantity -1;
            $voucher->save();
        }

        $cart = Cart::where('customer_id',$id_customer)->get();
        Cart::destroy($cart);

        if (Auth::guard('customer')->check()) {
            $id_customer = Auth::guard('customer')->user()->id;
            $cart_count = Cart::where('customer_id',$id_customer)->count();
            $all_cart = Cart::where('customer_id',$id_customer)->get();
        }
        return view('client.cart.success',compact('cart_count','all_cart'));
    }

    public function updateVoucher(Request $request)
    {
        $today = date('Y-m-d');
        $bill = Bill::findOrFail($request->bill_id);
        if($request->voucher == "")
        {
            $bill->voucher_id = null;
            $bill->price_checkout = $bill->total_price;
            $bill->save();
        }

        $voucher = Voucher::where('code','=',$request->voucher)->where('quantity','>',0)->where('status',1)->first();
        if(isset($voucher))
        {
            if(strtotime($today) >= strtotime($voucher->date_start))
            {
                if(strtotime($today) <= strtotime($voucher->date_end))
                {
                    $bill->voucher_id = $voucher->id;
                    $bill->price_checkout = $bill->total_price * (1-($voucher->value)/100);
                    $bill->save();
                    return redirect()->route('getCart',$bill->id);
                }else{
                    Session::put('message','Mã giảm giá của bạn đã quá hạn ngày sử dụng!');
                    return redirect()->route('getCart',$bill->id);
                }
            }else{
                Session::put('message','Mã giảm giá của bạn chưa đến ngày sử dụng!');
                return redirect()->route('getCart',$bill->id);
            }
        }else{
            Session::put('message','Mã giảm giá của bạn không tồn tại!');
            return redirect()->route('getCart',$bill->id);
        }
    }


    public function delivery()
    {
        if(Auth::guard('customer')->check()){
            $id_customer = Auth::guard('customer')->user()->id;
            $cart_count = Cart::where('customer_id',$id_customer)->count();
            $all_cart = Cart::where('customer_id',$id_customer)->get();
        }
        $id_customer = Auth::guard('customer')->user()->id;
        $bill = Bill::where([['customer_id',$id_customer]])->get();
        if(isset($bill))
        {
            return view('client.bill.delivery')->with('bill',$bill)->with('cart_count',$cart_count)->with('all_cart',$all_cart);    
        }
        return redirect()->route('get-client-home');
    }

    public function viewDelivery($id)
    {
        if(Auth::guard('customer')->check()){
            $id_customer = Auth::guard('customer')->user()->id;
            $cart_count = Cart::where('customer_id',$id_customer)->count();
            $all_cart = Cart::where('customer_id',$id_customer)->get();
        }
        $id_customer = Auth::guard('customer')->user()->id;
        $bill = Bill::where([['id',$id],['customer_id',$id_customer]])->first();
        return view('client.bill.detail')->with('bill',$bill)->with('cart_count',$cart_count)->with('all_cart',$all_cart);
    }

    public function deleteDelivery($id)
    {
        $bill = Bill::findOrFail($id);
        $bill->status = -1;
        $bill->save();
        foreach($bill->detail_bill as $detail_bill)
        {
            $product = Product::findOrFail($detail_bill->product_id);
            $product->quantity = $product->quantity + $detail_bill->quantity;
            $product->save(); 
        }
        return redirect()->back();
    }

    public function restoreDelivery($id)
    {
        $bill = Bill::findOrFail($id);
        $bill->status = 1;
        $bill->save();
        foreach($bill->detail_bill as $detail_bill)
        {
            $product = Product::findOrFail($detail_bill->product_id);
            if($detail_bill->quantity <= $product->quantity)
            {
                $product->quantity = $product->quantity - $detail_bill->quantity;
                $product->save(); 
                return redirect()->back();
            }else{
                return redirect()->back()->with('message','Sản phẩm của bạn đã hết hàng ! Xin lỗi vì sự bất tiện này.');
            }
           
        }
       
        return redirect()->back();
    }

   

}
