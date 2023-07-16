<?php

namespace App\Http\Controllers;

use App\Models\BillDetail;
use App\Models\BillDetailImport;
use App\Models\BillImport;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DepotController extends Controller
{
    public function getList()
    {
        $all_product = Product::all();
        return view('admin.depot.index',compact('all_product'));
    }

    public function postList()
    {
        $all_product = Product::all();
        return view('admin.depot.index',compact('all_product'));
    }

    public function getSearch(Request $request)
    {
        $search = $request->search;
        $products = Product::where('name','like',"%$search%")->get();
        return view('admin.depot.index',compact('products'));
    }

    public function getImport()
    {
        return view('admin.depot.import');
    }

    public function postAddBillImport(Request $request)
    {
        $id_user = $request->users_id;

        $bill_import = new BillImport();
        $bill_import->users_id = $id_user;
        $bill_import->total_Price = 0;
        $bill_import->status = 0;
        $bill_import->date_create = now();
        $bill_import->save();
        $list_product = Product::all();
        return view('admin.depot.detail_import',compact('bill_import','list_product'));
    }

    public function postAddDetailBillImport(Request $request)
    {
        $product_id = $request->product_id;
        $bill_id = $request->id_bill_import;
        $quantity = $request->quantity;
        $price = $request->price;

        // kiem tra ton tai

    
       
        $detail_bill = new BillDetailImport();
        $detail_bill->bill_import_id = $bill_id;
        $detail_bill->product_id = $product_id;
        $detail_bill->quantity = $quantity;
        $detail_bill->price = $price;
        $detail_bill->save();
        
    
        
        $bill = BillImport::findOrFail($bill_id);
        $total_price = 0;
        foreach($bill->detail_bill_import as $detail_bill)
        {
            $total_price = $total_price + ($detail_bill->price*$detail_bill->quantity);
        }
        $bill->total_price = $total_price;
        $bill->save();
        $list_product = Product::all();

        return view('admin.depot.detail_import')->with('bill_import',$bill)->with('list_product',$list_product);        
    }

    public function payment($id)
    {
        $bill = BillImport::findOrFail($id);
        $bill->status = 1;
        $bill->save();
        foreach($bill->detail_bill_import as $detail_bill)
        {
          
            $product = Product::find($detail_bill->product_id);
           
            // if($detail_bill->price == $product->price)
            {
                $new_quantity = $detail_bill->quantity + $product->quantity;
                $new_in_price = $detail_bill->price;
                
                $product->quantity = $new_quantity;
                $product->in_price = $new_in_price;
                
                $product->save();
            }
            // if($detail_bill->price != $product->price)
            // {
            //     $product = new Product();
            //     $product->name =  $detail_bill->product->name;
            //     $product->quantity = $detail_bill->quantity;
            //     $product->in_price = $detail_bill->price;
            //     $product->save();
            // }
            
        }
        
        return redirect()->route('depot-list')->with('message','Thanh Toán Hóa Đơn Nhập Thành Công');
    }

    public function getListBill()
    {
        $dathanhtoan = BillImport::where('status',1)->orderBy('id','desc')->get();
        $chuathanhtoan = BillImport::where('status',0)->orderBy('id','desc')->get();
        $dahuy = BillImport::where('status',-1)->orderBy('id','desc')->get(); 
        return view('admin.depot.list_bill',compact('dathanhtoan','chuathanhtoan','dahuy'));
    }

    public function cancel($id)
    {
        $bill = BillImport::findOrFail($id);
        $bill->status = -1;
        $bill->save();
       
        return redirect()->route('depot-list')->with('message','Hủy Hóa Đơn Nhập Thành Công');
    }

    public function getDetailBill($id_bill)
    {
        $bill = BillImport::findOrFail($id_bill);
        return view('admin.depot.detail_bill')->with('bill_import',$bill);
    }

}
