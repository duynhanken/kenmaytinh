@extends('client.index')

@section('content')

<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('get-client-home')}}" rel="nofollow">Home</a>
                <span></span> 
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">

                    <?php
                        if(Auth::guard('customer')->check())
                        {
                            ?>
                           <form action="{{route('add-to-cart-lg',$product->id)}}" method="POST">
                            @csrf
                            <div class="product-detail accordion-detail">
                                <div class="row mb-50">
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="detail-gallery">
                                            <!-- MAIN SLIDES -->
                                            <div class="product-image-slider">
                                                <figure class="border-radius-10">
                                                    <img src="{{ "/storage/$product->image" }}" alt="product image">
                                                </figure>
                                            
                                            </div>
                                            <!-- THUMBNAILS -->
                                        
                                        </div>
                                        <!-- End Gallery -->
                                        
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="detail-info">
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <input type="hidden" name="product_number" value="{{$product->number}}">
    
                                            <h2 class="title-detail" name= "product_name">{{$product->name}}</h2>
                                            <div class="product-detail-rating">
                                                <div class="pro-details-brand">
                                                    <span> Thương hiệu: <a href="shop.html">{{$product->brand->name}}</a></span>
                                                </div>
                                            
                                            </div>
                                            <div class="clearfix product-price-cover">
                                                <div class="product-price primary-color float-left">
                                                    <ins><span class="text-brand" name="product_price"><?php echo number_format($product->out_price); ?> VNĐ</span></ins>
                                                    {{-- <ins><span class="old-price font-md ml-15">$200.00</span></ins>
                                                    <span class="save-price  font-md color3 ml-15">25% Off</span> --}}
                                                </div>
                                            </div>
                                            <div class="bt-1 border-color-1 mt-15 mb-15"></div>
    
                                                <input class="detail-qty border radius" type="number" value="1" min="1" max="{{$product->quantity}}" name="product_qty" >
                                            
                                            
                                            <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                            
                                                    <button class="button button-add-to-cart"> Add to cart</button>
                                            
                                        </div>
                                        <!-- Detail Info -->
                                    </div>
                                </div>
                                <div class="tab-style3">
                                    <ul class="nav nav-tabs text-uppercase">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content shop_info_tab entry-main-content">
                                        <div class="tab-pane fade show active" id="Description">
                                            <div class="">
                                                <?php echo $product->desc;   ?>
                                            </div>
                                        
                                    </div>
                                </div>
                                </div>
                                                    
                            </div>
                        </form>
                        <?php
                        }else
                        {
                            ?>
                         <form action="{{route('add-to-cart',$product->id)}}" method="GET">
                            @csrf
                            <div class="product-detail accordion-detail">
                                <div class="row mb-50">
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="detail-gallery">
                                            <!-- MAIN SLIDES -->
                                            <div class="product-image-slider">
                                                <figure class="border-radius-10">
                                                    <img src="{{ "/storage/$product->image" }}" alt="product image">
                                                </figure>
                                            
                                            </div>
                                            <!-- THUMBNAILS -->
                                        
                                        </div>
                                        <!-- End Gallery -->
                                        
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="detail-info">
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <input type="hidden" name="product_number" value="{{$product->number}}">
    
                                            <h2 class="title-detail" name= "product_name">{{$product->name}}</h2>
                                            <div class="product-detail-rating">
                                                <div class="pro-details-brand">
                                                    <span> Thương hiệu: <a href="shop.html">{{$product->brand->name}}</a></span>
                                                </div>
                                            
                                            </div>
                                            <div class="clearfix product-price-cover">
                                                <div class="product-price primary-color float-left">
                                                    <ins><span class="text-brand" name="product_price"><?php echo number_format($product->out_price); ?> VNĐ</span></ins>
                                                    {{-- <ins><span class="old-price font-md ml-15">$200.00</span></ins>
                                                    <span class="save-price  font-md color3 ml-15">25% Off</span> --}}
                                                </div>
                                            </div>
                                            <div class="bt-1 border-color-1 mt-15 mb-15"></div>
    
                                                <input class="detail-qty border radius" type="number" value="1" min="1" max="{{$product->quantity}}" name="quatity" >
                                            
                                            
                                            <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                            
                                                    <button class="button button-add-to-cart"> Add to cart</button>
                                            
                                        </div>
                                        <!-- Detail Info -->
                                    </div>
                                </div>
                                <div class="tab-style3">
                                    <ul class="nav nav-tabs text-uppercase">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content shop_info_tab entry-main-content">
                                        <div class="tab-pane fade show active" id="Description">
                                            <div class="">
                                                <?php echo $product->desc;   ?>
                                            </div>
                                        
                                    </div>
                                </div>
                                </div>
                                                    
                            </div>
                        </form>
                        <?php
                        }
                    ?>

                   
                </div>
                <div class="col-lg-3 primary-sidebar sticky-sidebar">
                    <div class="widget-category mb-30">
                        <h5 class="section-title style-1 mb-30 wow fadeIn animated">Nhãn hàng</h5>
                        <ul class="categories">
                        @foreach ($all_brand ?? '' as $brand)
                        <li><a href="{{ route('get-client-productByBrand', $brand->id) }}">{{$brand->name}}</a></li>
                            
                            </a>
                        @endforeach
                        
                        
                        </ul>
                    </div>
                    <!-- Fillter By cpu -->
                    <div class="widget-category mb-30">
                        
                            <h5 class="section-title style-1 mb-30 wow fadeIn animated">Cpu</h5>
                            <ul class="categories">
                            @foreach ($all_cpu ?? '' as $cpu)
                            <li><a href="{{ route('get-client-productByCpu', $cpu->id) }}">{{$cpu->name}}</a></li>
                                
                                </a>
                            @endforeach
                            
                            
                            </ul>
                        
                    </div>
                    <!-- Product sidebar Widget -->
                    {{-- <div class="sidebar-widget product-sidebar  mb-30 p-30 bg-grey border-radius-10">
                        <div class="widget-header position-relative mb-20 pb-10">
                            <h5 class="widget-title mb-10">New products</h5>
                            <div class="bt-1 border-color-1"></div>
                        </div>
                        <div class="single-post clearfix">
                            <div class="image">
                                <img src="assets/imgs/shop/thumbnail-3.jpg" alt="#">
                            </div>
                            <div class="content pt-10">
                                <h5><a href="product-details.html">Chen Cardigan</a></h5>
                                <p class="price mb-0 mt-5">$99.50</p>
                                <div class="product-rate">
                                    <div class="product-rating" style="width:90%"></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>                         --}}
                </div>
            </div>
        </div>
    </section>
</main>




@endsection