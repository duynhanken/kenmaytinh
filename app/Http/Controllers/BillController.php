<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BillController extends Controller
{
    public function getBill() {
        $all_bills = Bill::where('status','<>',0)->orderByDesc('id')->get();
        return view('admin.bills.index',compact('all_bills'));
    }

    public function postBill()
    {
        $all_bills = Bill::where('status','<>',0)->orderByDesc('id')->get();
        return view('admin.bills.index',compact('all_bills'));
    }


    public function getAddBill() {
        $list_product = Product::all();
        $list_customer = Customer::all();
        return view('admin.bills.create',compact('list_product','list_customer'));
    }

    public function postAddBill(Request $request)
    {
        $id_customer = $request->customer_id;
        $customer = Customer::findOrFail($id_customer);

        $bills = new Bill();
        $bills->customer_id = $id_customer;
        $bills->name = $customer->name;
        $bills->address = $customer->address;
        $bills->phone = $customer->phone;
        $bills->total_price = 0;
        $bills->date_create =date('Y-m-d');
        $bills->price_checkout =0;
        $bills->voucher_id = null;
        $bills->status =1;

        $bills->save();
        $list_product = Product::all();
        $list_customer = Customer::all();

        return view('admin.bills.detail_bill',compact('bills','list_product','list_customer'));
        }

    public function postAddDetailBill(Request $request)
    {
        $bills_id = $request->id_bill;
        $product_id = $request->product_id;
        $product = Product::findOrFail($product_id);
        
        $detail_bill = new BillDetail();
        $detail_bill->bill_id = $bills_id;
        $detail_bill->product_id = $product_id;
        if($request->quantity <= $product->quantity)
        {
            $detail_bill->quantity = $request->quantity;
        }else{
            $detail_bill->quantity = $product->quantity;
            Session::put('message','Một số sản phẩm không còn đủ số lượng để cung cấp cho bạn');
        }
        $detail_bill->price = $product->out_price;
        $detail_bill->save();
        $bills = Bill::findOrFail($bills_id);
        $bills->total_price = $bills->total_price + ($detail_bill->quantity * $detail_bill->price); 
        $bills->price_checkout = $bills->total_price *(1-(($bills->voucher->value ?? 0) / 100));

        $list_product = Product::all();
        $list_customer = Customer::all();
        return view('admin.bills.detail_bill',compact('bills','list_product','list_customer'));

    }


 
    public function getDetail($bill_id)
    {
        $bill = Bill::findOrFail($bill_id);
        return view('admin.bills.detail',compact('bill'));
    }

    public function confirm($id)
    {
        $bill = Bill::findOrFail($id);
        $bill->status = 2;
        $bill->save();
        return redirect()->back();
    }

    public function shipping($id)
    {
        $bill = Bill::findOrFail($id);
        $bill->status = 4;
        $bill->save();
        foreach($bill->detail_bill as $detail_bill)
        {
            $product = Product::findOrFail($detail_bill->product_id);
            $product->quantity = $product->quantity - $detail_bill->quantity;
            $product->save(); 
        }
        return redirect()->back();
    }

    public function success($id)
    {
        $bill = Bill::findOrFail($id);
        $bill->status = 3;
        $bill->save();
        return redirect()->back();
    }
    public function cancle($id)
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

}
