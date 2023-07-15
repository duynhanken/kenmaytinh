<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\Cpu;
use App\Models\HardDriver;
use App\Models\Product;
use App\Models\Ram;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

      
        
        $all_brand = Brand::where('status','1')->get();
        View::share('all_brand',$all_brand);


        $all_cpu = Cpu::where('status','1')->get();
        View::share('all_cpu',$all_cpu);

        $all_hd = HardDriver::where('status','1')->get();
        View::share('all_hd',$all_hd);

        $all_ram = Ram::where('status','1')->get();
        View::share('all_ram',$all_ram);

        
    }
}
