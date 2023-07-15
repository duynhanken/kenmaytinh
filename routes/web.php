<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\Client\CartClientController;
use App\Http\Controllers\Client\CustomerClientController;
use App\Http\Controllers\Client\HomeClientController;
use App\Http\Controllers\Client\LoginClientController;
use App\Http\Controllers\Client\ProductClientController;
use App\Http\Controllers\CpuController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DepotController;
use App\Http\Controllers\HardDriverController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RamController;
use App\Http\Controllers\VoucherController;
use App\Models\Cpu;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'admin','namespace' => 'admin'], function () { 
    Route::get('/login',[LoginController::class,'getLogin'])->name('get-admin-login');
    Route::post('/login',[LoginController::class,'postLogin'])->name('post-admin-login');
    Route::get('/logout',[LoginController::class,'getLogout'])->name('get-admin-logout');
});


// Nhan hang(Brand)

Route::group(['middleware' => 'CheckAdminLogin','prefix' => 'admin','namespace' => 'admin'], function () {
    
    Route::get('/home',[HomeController::class,'getHome'])->name('get-admin-home');


    Route::get('/brands',[BrandController::class,'index'])->name('brand-list');
    Route::get('/brands/create',[BrandController::class,'create'])->name('brand-create');
    Route::post('/brands/store',[BrandController::class,'store'])->name('brand-store');
    Route::get('/brands/edit/{brand:slug}',[BrandController::class,'edit'])->name('brand-edit');
    Route::put('/brands/update/{brand}',[BrandController::class,'update'])->name('brand-update');
    Route::get('/brands/destroy/{brand_id}',[BrandController::class,'destroy'])->name('brand-destroy');
    Route::post('/brands/process-all',[BrandController::class,'process_all'])->name('process-all-brand');
    Route::get('/brands/search',[BrandController::class,'search'])->name('search-brand');
    Route::get('/brands/{brands_id}/active',[BrandController::class,'active'])->name('active-brands');
    Route::get('/brands/{brands_id}/unactive',[BrandController::class,'unactive'])->name('unactive-brands');

    // Ram(Ram)

    Route::get('/rams',[RamController::class,'index'])->name('ram-list');
    Route::get('/rams/create',[RamController::class,'create'])->name('ram-create');
    Route::post('/rams/store',[RamController::class,'store'])->name('ram-store');
    Route::get('/rams/edit/{ram:slug}',[RamController::class,'edit'])->name('ram-edit');
    Route::put('/rams/update/{ram}',[RamController::class,'update'])->name('ram-update');
    Route::get('/rams/destroy/{rams_id}',[RamController::class,'destroy'])->name('ram-destroy');
    Route::post('/rams/process-all',[RamController::class,'process_all'])->name('process-all-ram');
    Route::get('/rams/search',[RamController::class,'search'])->name('search-ram');
    Route::get('/rams/{rams_id}/active',[RamController::class,'active'])->name('active-rams');
    Route::get('/rams/{rams_id}/unactive',[RamController::class,'unactive'])->name('unactive-rams');

    //CPU


    Route::get('/cpus',[CpuController::class,'index'])->name('cpu-list');
    Route::get('/cpus/create',[CpuController::class,'create'])->name('cpu-create');
    Route::post('/cpus/store',[CpuController::class,'store'])->name('cpu-store');
    Route::get('/cpus/edit/{cpu:slug}',[CpuController::class,'edit'])->name('cpu-edit');
    Route::put('/cpus/update/{cpu}',[CpuController::class,'update'])->name('cpu-update');
    Route::get('/cpus/destroy/{cpus_id}',[CpuController::class,'destroy'])->name('cpu-destroy');
    Route::post('/cpus/process-all',[CpuController::class,'process_all'])->name('process-all-cpu');
    Route::get('/cpus/search',[CpuController::class,'search'])->name('search-cpu');
    Route::get('/cpus/{cpus_id}/active',[CpuController::class,'active'])->name('active-cpus');
    Route::get('/cpus/{cpus_id}/unactive',[CpuController::class,'unactive'])->name('unactive-cpus');


    //Hard Driver (Ổ Cứng)


    Route::get('/harddrivers',[HardDriverController::class,'index'])->name('harddriver-list');
    Route::get('/harddrivers/create',[HardDriverController::class,'create'])->name('harddriver-create');
    Route::post('/harddrivers/store',[HardDriverController::class,'store'])->name('harddriver-store');
    Route::get('/harddrivers/edit/{hardDriver:slug}',[HardDriverController::class,'edit'])->name('harddriver-edit');
    Route::put('/harddrivers/update/{hardDriver}',[HardDriverController::class,'update'])->name('harddriver-update');
    Route::get('/harddrivers/destroy/{hardDrivers_id}',[HardDriverController::class,'destroy'])->name('harddriver-destroy');
    Route::post('/harddrivers/process-all',[HardDriverController::class,'process_all'])->name('process-all-harddriver');
    Route::get('/harddrivers/search',[HardDriverController::class,'search'])->name('search-harddriver');
    Route::get('/harddrivers/{hardDrivers_id}/active',[HardDriverController::class,'active'])->name('active-harddrivers');
    Route::get('/harddrivers/{hardDrivers_id}/unactive',[HardDriverController::class,'unactive'])->name('unactive-harddrivers');


    //Voucher (Mã giảm giá)


    Route::get('/vouchers',[VoucherController::class,'index'])->name('voucher-list');
    Route::get('/vouchers/create',[VoucherController::class,'create'])->name('voucher-create');
    Route::post('/vouchers/store',[VoucherController::class,'store'])->name('voucher-store');
    Route::get('/vouchers/edit/{voucher}',[VoucherController::class,'edit'])->name('voucher-edit');
    Route::put('/vouchers/update/{voucher}',[VoucherController::class,'update'])->name('voucher-update');
    Route::get('/vouchers/destroy/{vouchers_id}',[VoucherController::class,'destroy'])->name('voucher-destroy');
    Route::post('/vouchers/process-all',[VoucherController::class,'process_all'])->name('process-all-voucher');
    Route::get('/vouchers/search',[VoucherController::class,'search'])->name('search-voucher');
    Route::get('/vouchers/{vouchers_id}/active',[VoucherController::class,'active'])->name('active-voucher');
    Route::get('/vouchers/{vouchers_id}/unactive',[VoucherController::class,'unactive'])->name('unactive-voucher');

    //Customer (Khách Hàng)


    Route::get('/customers',[CustomerController::class,'index'])->name('customer-list');
    Route::get('/customers/create',[CustomerController::class,'create'])->name('customer-create');
    Route::post('/customers/store',[CustomerController::class,'store'])->name('customer-store');
    Route::get('/customers/edit/{customer}',[CustomerController::class,'edit'])->name('customer-edit');
    Route::put('/customers/update/{customer}',[CustomerController::class,'update'])->name('customer-update');
    Route::get('/customers/destroy/{customers_id}',[CustomerController::class,'destroy'])->name('customer-destroy');
    Route::post('/customers/process-all',[CustomerController::class,'process_all'])->name('process-all-customer');
    Route::get('/customers/search',[CustomerController::class,'search'])->name('search-customer');
    Route::get('/customers/{customers_id}/active',[CustomerController::class,'active'])->name('active-customers');
    Route::get('/customers/{customers_id}/unactive',[CustomerController::class,'unactive'])->name('unactive-customers');

    //Product (Sản Phẩm)


    Route::get('/products',[ProductController::class,'index'])->name('product-list');
    Route::get('/products/create',[ProductController::class,'create'])->name('product-create');
    Route::post('/products/store',[ProductController::class,'store'])->name('product-store');
    Route::get('/products/edit/{product:slug}',[ProductController::class,'edit'])->name('product-edit');
    Route::put('/products/update/{product}',[ProductController::class,'update'])->name('product-update');
    Route::get('/products/destroy/{products_id}',[ProductController::class,'destroy'])->name('product-destroy');
    Route::post('/products/process-all',[ProductController::class,'process_all'])->name('process-all-product');
    Route::get('/products/search',[ProductController::class,'search'])->name('search-product');
    Route::get('/products/{products_id}/active',[ProductController::class,'active'])->name('active-product');
    Route::get('/products/{products_id}/unactive',[ProductController::class,'unactive'])->name('unactive-product');

    // Depot(Kho Hang)

    Route::post('/depot/list',[DepotController::class,'postList'])->name('post-list-depot');
    Route::get('/depot/list',[DepotController::class,'getList'])->name('depot-list');
    Route::get('/depot/search',[DepotController::class,'getSearch'])->name('search-depot');
    Route::get('/depot/import',[DepotController::class,'getImport'])->name('get-bill-import-depot');
    Route::post('/depot/import',[DepotController::class,'postAddBillImport'])->name('post-bill-import-depot');
    Route::post('/depot/import-detail',[DepotController::class,'postAddDetailBillImport'])->name('post-detail-bill-import-depot');
    Route::get('/depot/payment/{id}',[DepotController::class,'payment'])->name('payment-depot');
    Route::get('/depot/cancel/{id}',[DepotController::class,'cancel'])->name('cancel-depot');
    Route::get('/depot/list-bill',[DepotController::class,'getListBill'])->name('get-list-bill-depot');
    Route::get('/depot/detail/{id}',[DepotController::class,'getDetailBill'])->name('get-detail-bill-depot');


    // Bill (Hóa Đơn)

    Route::get('/bill/list',[BillController::class,'getBill'])->name('get-list-bill');
    Route::post('/bill/list',[BillController::class,'postBill'])->name('post-list-bill');

    Route::get('/bill/create',[BillController::class,'getAddBill'])->name('get-create-bill');
    Route::post('/bill/store',[BillController::class,'postAddBill'])->name('post-create-bill');
    Route::post('/bill/detail',[BillController::class,'postAddDetailBill'])->name('post-detail-bill');

    Route::get('/bill/detail/{bill_number}',[BillController::class,'getDetail'])->name('get-detail-bill');

    Route::get('/bill/cancle/{id}',[BillController::class,'cancle'])->name('cancle-bill');
    Route::get('/bill/confirm/{id}',[BillController::class,'confirm'])->name('confirm-bill');
    Route::get('/bill/success/{id}',[BillController::class,'success'])->name('success-bill');
   
});


//Client

Route::get('/', function () {
    return view('client/index');
});

Route::group(['namespace' => 'client'],function(){
    //Login
    Route::get('/login',[LoginClientController::class,'getClientLogin'])->name('get-login-client');
    Route::post('/login',[LoginClientController::class,'postClientLogin'])->name('post-login-client');
    Route::get('/logout',[LoginClientController::class,'getClientLogout'])->name('get-logout-client');

    //home
    Route::get('/',[HomeClientController::class,'getClientHome'])->name('get-client-home');
    // Route::get('/',[HomeClientController::class,'getClientHomeIndex'])->name('get-client-home-index');
    Route::get('/home',[HomeClientController::class,'getClientHome'])->name('get-client-home');
   

    //product
    Route::get('/product',[ProductClientController::class,'getProduct'])->name('get-client-product');
    Route::get('/product/search',[ProductClientController::class,'getSearch'])->name('get-search-product');

    Route::get('/product/detail/{id}',[ProductClientController::class,'getDetail'])->name('get-client-productDetail');
    Route::get('/product/brand/{brand:slug}',[ProductClientController::class,'getProductByBrand'])->name('get-client-productByBrand');
    Route::get('/product/cpu/{cpu:slug}',[ProductClientController::class,'getProductByCpu'])->name('get-client-productByCpu');
    Route::get('/product/hard-driver/{hd:slug}',[ProductClientController::class,'getProductByHd'])->name('get-client-productByHd');
    Route::get('/product/ram/{ram:slug}',[ProductClientController::class,'getProductByRam'])->name('get-client-productByRam');


    // fillter
    // Route::post('/product/brand/fillter/',[ProductClientController::class,'fillterProductBran'])->name('get-client-fillter-productByBrand');



      //Customer
       Route::get('/account',[HomeClientController::class,'getAccount'])->name('get-client-account');

      Route::post('/customer/add',[CustomerClientController::class,'postAdd'])->name('post-add-customer');

    //add cart session
    Route::get('/product/cart/{id}',[CartClientController::class,'addtocart'])->name('add-to-cart');
    Route::get('/remove-cart/{id}',[CartClientController::class,'remove'])->name('remove-to-cart');



});

Route::group(['middleware' => 'CheckClientLogin','namespace' => 'client'],function(){


    Route::get('/my-account/{number}',[CustomerClientController::class,'viewUpdateAccount'])->name('view-my-account');
    Route::put('/customers/update/{number}',[CustomerClientController::class,'updateAccount'])->name('updateAccount');


    Route::get('/product/cart/',[CartClientController::class,'viewtocart'])->name('view-to-cart');    

    Route::get('/product/cart/checkout',[CartClientController::class,'getCheckOut'])->name('postCheckOut');    
    Route::post('/product/cart/checkout',[CartClientController::class,'postCheckOut'])->name('postCheckOut');  

    Route::post('/product/cart/{id}',[CartClientController::class,'addtocartlg'])->name('add-to-cart-lg');
    Route::get('/product/delete/cart/{id}',[CartClientController::class,'deleteProductCart'])->name('delete-product-i');
  
    Route::post('/product/cart/updateQuantityCarrt',[CartClientController::class,'updateQuantityCart'])->name('update-quanty-cart');

    Route::get('/cart/{id}',[CartClientController::class,'getCart'])->name('getCart');
    Route::post('/cart/update',[CartClientController::class,'updateQuantity'])->name('updateQuantity');
    Route::post('/cart/update_voucher',[CartClientController::class,'updateVoucher'])->name('updateVoucher');
    Route::post('/cart/checkout',[CartClientController::class,'checkOut'])->name('checkout');

    Route::get('/delivery',[CartClientController::class,'delivery'])->name('delivery');
    Route::get('/view/delivery/{id}',[CartClientController::class,'viewDelivery'])->name('view-order');

    Route::get('/view/delete/delivery/{id}',[CartClientController::class,'deleteDelivery'])->name('view-order-delete');
    Route::get('/view/restore/delivery/{id}',[CartClientController::class,'restoreDelivery'])->name('view-order-restore');


});