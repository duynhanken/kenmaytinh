<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Cpu;
use App\Models\HardDriver;
use App\Models\Product;
use App\Models\Ram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductClientController extends Controller
{

    public function getDetail($id)
    {
        if(Auth::guard('customer')->check()){
            $id_customer = Auth::guard('customer')->user()->id;
            $cart_count = Cart::where('customer_id',$id_customer)->count();
            $all_cart = Cart::where('customer_id',$id_customer)->get();
            $product = Product::where([['id',$id],['status',1]])->first();
        return view('client.product.detail',compact('product','cart_count','all_cart'));
        }
        else{
            $product = Product::where([['id',$id],['status',1]])->first();
            return view('client.product.detail',compact('product'));
        }
        
    }

    public function getProductByBrand($id_brand,Request $request)
    {
        
        $min_price = Product::min('out_price');
        $max_price = Product::max('out_price');
        $brand = Brand::find($id_brand);
        $orderBy = $request->sort_by ?? 'name_ascending';
        if(isset($request->sort_by))
        {

            switch($orderBy){
                case 'name_ascending':
                    $list_product = Product::where('brand_id',$id_brand)->where('status',1)->where('quantity','>',0)->orderBy('name','ASC')->paginate(8)->appends(['sort_by' =>$orderBy]);
                    break;
                case 'name_descending':
                    $list_product = Product::where('brand_id',$id_brand)->where('status',1)->where('quantity','>',0)->orderBy('name','DESC')->paginate(8)->appends(['sort_by' =>$orderBy]);
                    break;
                case 'price_ascending':
                    $list_product = Product::where('brand_id',$id_brand)->where('status',1)->where('quantity','>',0)->orderBy('out_price','ASC')->paginate(8)->appends(['sort_by' =>$orderBy]);
                    break;
                case 'price_descending':
                    $list_product = Product::where('brand_id',$id_brand)->where('status',1)->where('quantity','>',0)->orderBy('out_price','DESC')->paginate(8)->appends(['sort_by' =>$orderBy]);
                    break;
                default:
                    $list_product = Product::where('brand_id',$id_brand)->where('status',1)->where('quantity','>',0)->orderBy('name','DESC')->paginate(8)->appends(['sort_by' =>$orderBy]);
                    break;
        }
            
    }
       else if(isset($_GET['start_price']) && $_GET['end_price']){
            $min = $_GET['start_price'];
            $max = $_GET['end_price'];
            $list_product = Product::where('brand_id',$id_brand)->where('status',1)->where('quantity','>',0)->whereBetween('out_price',[ $min,$max])->paginate(8);
        }
        else{
     
            $list_product =  Product::where('brand_id',$id_brand)->where('status',1)->where('quantity','>',0)->paginate(8);
        }
        if(Auth::guard('customer')->check()){
            $id_customer = Auth::guard('customer')->user()->id;
            $cart_count = Cart::where('customer_id',$id_customer)->count();
            $all_cart = Cart::where('customer_id',$id_customer)->get();
            return view('client.product.index')->with('cart_count',$cart_count)->with('all_cart',$all_cart)->with('brand_name',$brand->name)->with('list_product',$list_product)->with('min_price',$min_price)->with('max_price',$max_price);
        }
       else{
        return view('client.product.index')->with('brand_name',$brand->name)->with('list_product',$list_product)->with('min_price',$min_price)->with('max_price',$max_price);
       }
    }

    public function getProductByCpu($id_cpu,Request $request)
    {
        
        $min_price = Product::min('out_price');
        $max_price = Product::max('out_price');
        $cpu = Cpu::find($id_cpu);
        $orderBy = $request->sort_by ?? 'name_ascending';
        if(isset($request->sort_by))
        {

            switch($orderBy){
                case 'name_ascending':
                    $list_product = Product::where('cpu_id',$id_cpu)->where('status',1)->where('quantity','>',0)->orderBy('name','ASC')->paginate(8)->appends(['sort_by' =>$orderBy]);
                    break;
                case 'name_descending':
                    $list_product = Product::where('cpu_id',$id_cpu)->where('status',1)->where('quantity','>',0)->orderBy('name','DESC')->paginate(8)->appends(['sort_by' =>$orderBy]);
                    break;
                case 'price_ascending':
                    $list_product = Product::where('cpu_id',$id_cpu)->where('status',1)->where('quantity','>',0)->orderBy('out_price','ASC')->paginate(8)->appends(['sort_by' =>$orderBy]);
                    break;
                case 'price_descending':
                    $list_product = Product::where('cpu_id',$id_cpu)->where('status',1)->where('quantity','>',0)->orderBy('out_price','DESC')->paginate(8)->appends(['sort_by' =>$orderBy]);
                    break;
                default:
                    $list_product = Product::where('cpu_id',$id_cpu)->where('status',1)->where('quantity','>',0)->orderBy('name','DESC')->paginate(8)->appends(['sort_by' =>$orderBy]);
                    break;
        }
            
    }
       else if(isset($_GET['start_price']) && $_GET['end_price']){
            $min = $_GET['start_price'];
            $max = $_GET['end_price'];
            $list_product = Product::where('cpu_id',$id_cpu)->where('status',1)->where('quantity','>',0)->whereBetween('out_price',[ $min,$max])->paginate(8);
        }
        else{
            $list_product = Product::where('cpu_id',$id_cpu)->where('status',1)->where('quantity','>',0)->paginate(8);
        }
        if(Auth::guard('customer')->check()){
            $id_customer = Auth::guard('customer')->user()->id;
            $cart_count = Cart::where('customer_id',$id_customer)->count();
            $all_cart = Cart::where('customer_id',$id_customer)->get();
            return view('client.product.index')->with('cart_count',$cart_count)->with('all_cart',$all_cart)->with('cpu_name',$cpu->name)->with('list_product',$list_product)->with('min_price',$min_price)->with('max_price',$max_price);
        }
        else{
            return view('client.product.index')->with('cpu_name',$cpu->name)->with('list_product',$list_product)->with('min_price',$min_price)->with('max_price',$max_price);
        }
       
    }

    public function getProductByHd($id_hd)
    {
        if(Auth::guard('customer')->check()){
            $id_customer = Auth::guard('customer')->user()->id;
            $cart_count = Cart::where('customer_id',$id_customer)->count();
            $all_cart = Cart::where('customer_id',$id_customer)->get();
        }
        $min_price = Product::min('out_price');
        $max_price = Product::max('out_price');
        $hd = HardDriver::find($id_hd);
        if(isset($_GET['start_price']) && $_GET['end_price']){
            $min = $_GET['start_price'];
            $max = $_GET['end_price'];
            $list_product =  Product::where('hard_driver_id',$id_hd)->where('status',1)->where('quantity','>',0)->whereBetween('out_price',[ $min,$max])->paginate(8);
        }
        else{
        $list_product = Product::where('hard_driver_id',$id_hd)->where('status',1)->where('quantity','>',0)->paginate(8);
        }
        return view('client.product.index')->with('cart_count',$cart_count)->with('all_cart',$all_cart)->with('hd_name',$hd->name)->with('list_product',$list_product)->with('min_price',$min_price)->with('max_price',$max_price);
    }

    public function getProductByRam($id_ram)
    {
        if(Auth::guard('customer')->check()){
            $id_customer = Auth::guard('customer')->user()->id;
            $cart_count = Cart::where('customer_id',$id_customer)->count();
            $all_cart = Cart::where('customer_id',$id_customer)->get();
        }
        $min_price = Product::min('out_price');
        $max_price = Product::max('out_price');
        $ram = Ram::find($id_ram);
        if(isset($_GET['start_price']) && $_GET['end_price']){
            $min = $_GET['start_price'];
            $max = $_GET['end_price'];
            $list_product =  Product::where('ram_id',$id_ram)->whereBetween('out_price',[ $min,$max])->paginate(8);
        }
        else{
            $list_product = Product::where('ram_id',$id_ram)->where('status',1)->where('quantity','>',0)->paginate(8);
        }
        return view('client.product.index')->with('cart_count',$cart_count)->with('all_cart',$all_cart)->with('ram_name',$ram->name)->with('list_product',$list_product)->with('min_price',$min_price)->with('max_price',$max_price);
    }

    public function getProduct(Request $request)
    {
       
        $product = Product::all();
        $min_price = Product::min('out_price');
        $max_price = Product::max('out_price');
        $orderBy = $request->sort_by ?? 'name_ascending';
        
        if(isset($request->sort_by))
        {

            switch($orderBy){
                case 'name_ascending':
                    $list_product = Product::orderBy('name','ASC')->paginate(8)->appends(['sort_by' =>$orderBy]);
                    break;
                case 'name_descending':
                    $list_product = Product::orderBy('name','DESC')->paginate(8)->appends(['sort_by' =>$orderBy]);
                    break;
                case 'price_ascending':
                    $list_product = Product::orderBy('out_price','ASC')->paginate(8)->appends(['sort_by' =>$orderBy]);
                    break;
                case 'price_descending':
                    $list_product = Product::orderBy('out_price','DESC')->paginate(8)->appends(['sort_by' =>$orderBy]);
                    break;
                default:
                    $list_product = Product::orderBy('name','DESC')->paginate(8)->appends(['sort_by' =>$orderBy]);
                    break;
        }
            
    }
        
        else if(isset($_GET['start_price']) && $_GET['end_price']){
          
            $min = $_GET['start_price'];
            $max = $_GET['end_price'];
            $list_product =Product::where('status',1)->where('quantity','>',0)->whereBetween('out_price',[ $min,$max])->paginate(8);
        }
        else{
     
            $list_product = Product::where('status',1)->where('quantity','>',0)->paginate(8);
        }
        if(Auth::guard('customer')->check()){
            $id_customer = Auth::guard('customer')->user()->id;
            $cart_count = Cart::where('customer_id',$id_customer)->count();
            $all_cart = Cart::where('customer_id',$id_customer)->get();
            return view('client.product.index')->with('cart_count',$cart_count)->with('all_cart',$all_cart)->with('list_product',$list_product)->with('min_price',$min_price)->with('max_price',$max_price);
        }else{
            return view('client.product.index')->with('list_product',$list_product)->with('min_price',$min_price)->with('max_price',$max_price);
        }
       
    }

    public function getSearch(Request $request)
    {
        if(Auth::guard('customer')->check()){
            $id_customer = Auth::guard('customer')->user()->id;
            $cart_count = Cart::where('customer_id',$id_customer)->count();
            $all_cart = Cart::where('customer_id',$id_customer)->get();
        }
        $min_price = Product::min('out_price');
        $max_price = Product::max('out_price');
        $list_product = Product::where([['name','like','%'.$request->search.'%'],['status',1],['quantity','>',0]])->get();
        return view('client.product.index')->with('cart_count',$cart_count)->with('all_cart',$all_cart)->with('searchName',$request->search)->with('list_product',$list_product)->with('min_price',$min_price)->with('max_price',$max_price);
    }

    

}
