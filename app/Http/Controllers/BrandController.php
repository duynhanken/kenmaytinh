<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\BrandStoreRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $brands = Brand::all();
        return view('admin.brands.index',compact('brands'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $brands = Brand::where('name','like',"%$search%")->paginate(5);
        
        return view('admin.brands.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandStoreRequest $request)
    {
        $brands = new Brand();

        $brands['name'] = $request->name;
        $brands['desc'] = $request->desc;

        $path = Storage::disk('public')->put('/admin/brand',$request->file('image'));
        $brands['slug'] = Str::slug($request->slug);
        $brands['image'] = $path;
        $brands['status'] = $request->status;

        $brands->save();
        
        return redirect()->route('brand-list')->with('message','Create Brands Successfully');   
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
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandStoreRequest $request, Brand $brand)
    {
        $brand['name'] = $request->name;
        $brand['desc']=$request->desc;
        $brand['slug'] = Str::slug($request->slug);
        if($oldImage = $brand->image){
            Storage::disk('public')->delete($oldImage);
            $path = Storage::disk('public')->put('/admin/brand',$request->file('image'));
            $brand['image'] = $path;
        }
        $brand['status']= $request->status;
        $brand->save();

        return redirect()->route('brand-list')->with('message','Create Update Brand Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($brand_id)
    {
        $brand = Brand::find($brand_id);
        if($oldImage = $brand->image){
            Storage::disk('public')->delete($oldImage);
        }
        $brand->delete();
        return redirect()->route('brand-list')->with('message','Delete Brand Successfully');
    }


    public function active($brands_id) {
        $brands = Brand::find($brands_id);
        $brands->status = 1;
        $brands->save();
        return redirect()->back()->with('message','Active Brand Successfully');
    }

    public function unactive($brands_id) {
        $brands = Brand::find($brands_id);
        $brands->status = 0;
        $brands->save();
        return redirect()->back()->with('message','UnActive Brand Successfully');
    }

    public function process_all(Request $request)
    {
        $list_brandID = $request->brandID;
        if($list_brandID!=null)
        {
            if($request->action == "delete")
            {
                foreach($list_brandID as $brand_id)
                {
                    $this->destroy($brand_id); 
                }
                return redirect()->route('brand-list')->with('message','message','Delete Brand Successfully');
            }
            else if($request->action == "active")
            {
                foreach($list_brandID as $brand_id)
                {
                    $this->active($brand_id); 
                }
                return redirect()->route('brand-list')->with('message','Active Brand Successfully');
            }
            else if($request->action == "unactive")
            {
                foreach($list_brandID as $brand_id)
                {
                    $this->unactive($brand_id); 
                }
                return redirect()->route('brand-list')->with('message','UnActive Brand Successfully');
            }
        }
        return redirect()->route('brand-list');

    }
}
