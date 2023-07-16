<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Cpu;
use App\Models\HardDriver;
use App\Models\Product;
use App\Models\Ram;
use Illuminate\Http\Request;

class ProductClientController extends Controller
{

    public function getDetail($id)
    {
        $product = Product::where([['id',$id],['status',1]])->first();
        return view('client.product.detail',compact('product'));
    }

    public function getProductByBrand($id_brand)
    {

        $min_price = Product::min('out_price');
        $max_price = Product::max('out_price');
        $brand = Brand::find($id_brand);
        
        if(isset($_GET['start_price']) && $_GET['end_price']){
            $min = $_GET['start_price'];
            $max = $_GET['end_price'];
            $list_product = Product::where('brand_id',$id_brand)->where('status',1)->where('quantity','>',0)->whereBetween('out_price',[ $min,$max])->paginate(8);
        }
        else{
     
            $list_product =  Product::where('brand_id',$id_brand)->where('status',1)->where('quantity','>',0)->paginate(8);
        }
        return view('client.product.index')->with('brand_name',$brand->name)->with('list_product',$list_product)->with('min_price',$min_price)->with('max_price',$max_price);
    }

    public function getProductByCpu($id_cpu)
    {
        $min_price = Product::min('out_price');
        $max_price = Product::max('out_price');
        $cpu = Cpu::find($id_cpu);
        if(isset($_GET['start_price']) && $_GET['end_price']){
            $min = $_GET['start_price'];
            $max = $_GET['end_price'];
            $list_product = Product::where('cpu_id',$id_cpu)->where('status',1)->where('quantity','>',0)->whereBetween('out_price',[ $min,$max])->paginate(8);
        }
        else{
            $list_product = Product::where('cpu_id',$id_cpu)->where('status',1)->where('quantity','>',0)->paginate(8);
        }
        return view('client.product.index')->with('cpu_name',$cpu->name)->with('list_product',$list_product)->with('min_price',$min_price)->with('max_price',$max_price);
    }

    public function getProductByHd($id_hd)
    {
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
        return view('client.product.index')->with('hd_name',$hd->name)->with('list_product',$list_product)->with('min_price',$min_price)->with('max_price',$max_price);
    }

    public function getProductByRam($id_ram)
    {
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
        return view('client.product.index')->with('ram_name',$ram->name)->with('list_product',$list_product)->with('min_price',$min_price)->with('max_price',$max_price);
    }

    public function getProduct(Request $request)
    {
        
        $product = Product::all();
        $min_price = Product::min('out_price');
        $max_price = Product::max('out_price');
        $orderBy = $request->sort_by ?? 'name_ascending';
        
        if(isset($_GET['sort_by']))
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
            $list_product = $product->whereBetween('out_price',[ $min,$max]);
        }
        else{
     
            $list_product = Product::where('status',1)->where('quantity','>',0)->paginate(8);
        }
        return view('client.product.index')->with('list_product',$list_product)->with('min_price',$min_price)->with('max_price',$max_price);
    }

    public function getSearch(Request $request)
    {
        $min_price = Product::min('out_price');
        $max_price = Product::max('out_price');
        $list_product = Product::where([['name','like','%'.$request->search.'%'],['status',1]])->get();
        return view('client.product.index')->with('searchName',$request->search)->with('list_product',$list_product)->with('min_price',$min_price)->with('max_price',$max_price);
    }

    

}
