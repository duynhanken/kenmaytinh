<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ProductStoreRequest;
use App\Models\Brand;
use App\Models\Cpu;
use App\Models\GraphicsCard;
use App\Models\HardDriver;
use App\Models\MainBoard;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Ram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::all();
        return view('admin.products.index',compact('products'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $products = Product::where('name','like',"%$search%")->paginate(5);
        
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::where('status',1)->get();
        $rams = Ram::where('status',1)->get();
        $cpus = Cpu::where('status',1)->get();
        $mainBoards = MainBoard::where('status',1)->get();
        $graphics = GraphicsCard::where('status',1)->get();
        $harddrives = HardDriver::where('status',1)->get();


        return view('admin.products.create',compact('brands','rams','cpus','harddrives','mainBoards','graphics'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $path = Storage::disk('public')->put('/admin/product',$request->file('image'));
        $products = new Product();
        $products['name']= $request->name;
        $products['brand_id']= $request->brand_id;
        $products['ram_id']= $request->ram_id;
        $products['cpu_id']= $request->cpu_id;
        $products['hard_driver_id']= $request->hard_driver_id;
        $products['graphics_card_id']= $request->graphics_card_id;
        $products['main_board_id']= $request->main_board_id;
        $products['slug']=Str::slug($request->slug);
        $products['desc']= $request->desc;
        $products['image'] = $path;
        $products['out_price']= $request->out_price;
        $products['status'] = $request->status;
        $product = Product::where('slug',$products['slug'])->first();
       if(isset( $product))
        {
            return redirect()->back()->with('message','Slug đã tồn tại, mời bạn đổi lại');
        }
        else{
            $products['slug']=Str::slug($request->slug);
        }
     

        $products->save();
        return redirect()->route('product-list')->with('message','Create Product Successfully');   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $list_brand = Brand::where('status',1)->get();
        $list_rams = Ram::where('status',1)->get();
        $list_cpus = Cpu::where('status',1)->get();
        $list_harddrives = HardDriver::where('status',1)->get();
        $list_graphics_card = GraphicsCard::where('status',1)->get();
        $list_main_board = MainBoard::where('status',1)->get();
        return view('admin.products.edit',compact('product','list_brand','list_rams','list_cpus','list_harddrives','list_graphics_card','list_main_board'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductStoreRequest $request, Product $product)
    {
        $product['name']= $request->name;
        $product['brand_id']= $request->brand_id;
        $product['ram_id']= $request->ram_id;
        $product['cpu_id']= $request->cpu_id;
        $product['hard_driver_id']= $request->hard_driver_id;
        $product['graphics_card_id']= $request->graphics_card_id;
      
        $product['main_board_id']= $request->main_board_id;
        $product['slug']=Str::slug($request->slug);
        $product['desc']= $request->desc;
        
        if($oldImage = $product->image)
        {
            Storage::disk('public')->delete($oldImage);
            $path = Storage::disk('public')->put('/admin/product',$request->file('image'));
        
            $product['image'] = $path;
        
        }
        $product['image'] = $path;
      
        $product['out_price']= $request->out_price;
        $product['status'] = $request->status;
      
        $product->save();
        return redirect()->route('product-list')->with('message','Update Product Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product_id)
    {
        $product = Product::find($product_id);
        if($oldImage = $product->image){
            Storage::disk('public')->delete($oldImage);
        }
        $product->delete();
        return redirect()->route('product-list')->with('message','Delete Product Successfully');
    }


    public function active($product_id) {
        $products = Product::find($product_id);
        $products->status = 1;
        $products->save();
        return redirect()->back()->with('message','Active Product Successfully');
    }

    public function unactive($product_id) {
        $products = Product::find($product_id);
        $products->status = 0;
        $products->save();
        return redirect()->back()->with('message','UnActive Product Successfully');
    }

    public function process_all(Request $request)
    {
        $list_productID = $request->productID;
        if($list_productID!=null)
        {
            if($request->action == "delete")
            {
                foreach($list_productID as $brand_id)
                {
                    $this->destroy($brand_id); 
                }
                return redirect()->route('product-list')->with('message','message','Delete Product Successfully');
            }
            else if($request->action == "active")
            {
                foreach($list_productID as $brand_id)
                {
                    $this->active($brand_id); 
                }
                return redirect()->route('product-list')->with('message','Active Product Successfully');
            }
            else if($request->action == "unactive")
            {
                foreach($list_productID as $brand_id)
                {
                    $this->unactive($brand_id); 
                }
                return redirect()->route('product-list')->with('message','UnActive Product Successfully');
            }
        }
        return redirect()->route('product-list');

    }

}
