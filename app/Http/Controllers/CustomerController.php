<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\CustomerStoreRequest;
use App\Http\Requests\Admin\CustomerUpdateRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $customers = Customer::paginate(5);
        return view('admin.customers.index',compact('customers'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $customers = Customer::where('name','like',"%$search%")->paginate(5);
        
        return view('admin.customers.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerStoreRequest $request)
    {
        $customers = new Customer();

        $customers['email'] = $request->email;
        $customers['password'] = Hash::make($request->password);
        $customers['name'] = $request->name;
        $customers['phone'] = $request->phone;
        $customers['address'] = $request->address;
        $path = Storage::disk('public')->put('/admin/customer',$request->file('image'));
        $customers['image'] = $path;
        $customers['status'] = $request->status;

        $customers->save();
        
        return redirect()->route('customer-list')->with('message','Create Brands Successfully');   
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
    public function edit(Customer $customer)
    {
        return view('admin.customers.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
  

    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        
        $customer['name'] = $request->name;
        $customer['phone'] = $request->phone;
        $customer['address'] = $request->address;
        $path = Storage::disk('public')->put('/admin/customer',$request->file('image'));
        $customer['image'] = $path;
        $customer['status'] = $request->status;

        $customer->save();

        return redirect()->route('customer-list')->with('message','Create Update Customer Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($brand_id)
    {
        $customer = Customer::find($brand_id);
        if($oldImage = $customer->image){
            Storage::disk('public')->delete($oldImage);
        }
        $customer->delete();
        return redirect()->route('customer-list')->with('message','Delete Customer Successfully');
    }


    public function active($brands_id) {
        $customers = Customer::find($brands_id);
        $customers->status = 1;
        $customers->save();
        return redirect()->back()->with('message','Active Customer Successfully');
    }

    public function unactive($brands_id) {
        $customers = Customer::find($brands_id);
        $customers->status = 0;
        $customers->save();
        return redirect()->back()->with('message','UnActive Customer Successfully');
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
                return redirect()->route('customer-list')->with('message','message','Delete Customer Successfully');
            }
            else if($request->action == "active")
            {
                foreach($list_brandID as $brand_id)
                {
                    $this->active($brand_id); 
                }
                return redirect()->route('customer-list')->with('message','Active Customer Successfully');
            }
            else if($request->action == "unactive")
            {
                foreach($list_brandID as $brand_id)
                {
                    $this->unactive($brand_id); 
                }
                return redirect()->route('customer-list')->with('message','UnActive Customer Successfully');
            }
        }
        return redirect()->route('customer-list');

    }
}
