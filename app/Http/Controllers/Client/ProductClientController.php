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
    public function fillterProduct($product,Request $request)
    {
        
    }

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
        
        if(isset($_GET['star_price']) && $_GET['end_price']){
            $min = $_GET['star_price'];
            $max = $_GET['end_price'];
            $list_product = $brand->product->whereBetween('out_price',[ $min,$max])->get();
        }
     
        $list_product = $brand->product->where('status',1)->where('quantity','>',0);
        return view('client.product.index')->with('brand_name',$brand->name)->with('list_product',$list_product)->with('min_price',$min_price)->with('max_price',$max_price);
    }

    public function getProductByCpu($id_cpu)
    {
        $cpu = Cpu::find($id_cpu);
        $list_product = $cpu->product->where('status',1)->where('quantity','>',0);
        return view('client.product.index')->with('cpu_name',$cpu->name)->with('list_product',$list_product);
    }

    public function getProductByHd($id_hd)
    {
        $hd = HardDriver::find($id_hd);
        $list_product = $hd->product->where('status',1)->where('quantity','>',0);
        return view('client.product.index')->with('hd_name',$hd->name)->with('list_product',$list_product);
    }

    public function getProductByRam($id_ram)
    {
        $ram = Ram::find($id_ram);
        $list_product = $ram->product->where('status',1)->where('quantity','>',0);
        return view('client.product.index')->with('ram_name',$ram->name)->with('list_product',$list_product);
    }

    public function getProduct()
    {
        $min_price = Product::min('out_price');
        $max_price = Product::max('out_price');
        $list_product = Product::where([['status',1],['quantity','>',0]])->paginate(8);
        return view('client.product.index')->with('list_product',$list_product)->with('min_price',$min_price)->with('max_price',$max_price);
    }
    public function getSearch(Request $request)
    {
        $list_product = Product::where([['name','like','%'.$request->search.'%'],['status',1]])->get();
        return view('client.product.index')->with('searchName',$request->search)->with('list_product',$list_product);
    }
}
