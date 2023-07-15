<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getHome()
    {
        $count_admin = User::where('status',1)->count();
        $count_brand = Brand::where('status',1)->count();
        $count_product = Product::where('status',1)->count();
        $count_customer = Customer::where('status',1)->count();

        $count = array('admin'=>$count_admin,'brand'=>$count_brand,'product'=>$count_product,'customer'=>$count_customer);
        return view('admin.home.index')->with('count',$count);
    }
}
