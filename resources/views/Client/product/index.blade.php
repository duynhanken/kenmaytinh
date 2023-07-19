@extends('client.index')

@section('content')




<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('get-client-home')}}" rel="nofollow">Home</a>
                <span>Shop</span> 
				<span><?php if(isset($searchName)) echo '<span>'.$searchName.'</span>'; else if(isset($cpu_name)) echo '<span>'.$cpu_name.'</span>';else if(isset($hd_name)) echo '<span>'.$hd_name.'</span>';else if(isset($ram_name)) echo '<span>'.$ram_name.'</span>';  else if(isset($brand_name)) echo ' <span>'.$brand_name.'</span>'; else echo 'Sản Phẩm';  ?></span>
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
			<div class="row">
				<div class="col-lg-9">
                        <div class="mt-10 mb-50">
                            <div class="shop-product-fillter">
                               
                                <div class="sort-by-product-area">
                                  
                                    <div class="sort-by-cover">
                                        <div class="sort-by-product-wrap">
                                            <div class="sort-by">
                                                <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                            </div>
                                            <div class="sort-by-dropdown-wrap">
                                                <form action="">
                                                    @csrf
                                                    <div class="select-option">
                                                        <select name="sort_by" onchange="this.form.submit();" class="sorting">
                                                            <option {{request('sort_by') == 'name_ascending'? 'selected':''}} value="name_ascending"> Name A-Z</option>
                                                            <option {{request('sort_by') == 'name_descending'? 'selected':''}} value="name_descending"> Name Z-A</option>
                                                            <option {{request('sort_by') == 'price_ascending'? 'selected':''}} value="price_ascending"> Giá tăng dần</option>
                                                            <option {{request('sort_by') == 'price_descending'? 'selected':''}} value="price_descending"> Giá giảm dần</option>
                                                        </select>
                                                        
                                                    </div>
                                                   </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h3><center><?php if(isset($searchName)) echo 'Kết quả tìm kiếm: <span>'.$searchName.'</span>'; else if(isset($cpu_name)) echo 'Sản Phẩm Thuộc Cpu <span>'.$cpu_name.'</span>';else if(isset($hd_name)) echo 'Sản Phẩm Thuộc ổ cứng <span>'.$hd_name.'</span>'; else if(isset($ram_name)) echo 'Sản phẩm thuộc ram <span>'.$ram_name.'</span>'; else if(isset($brand_name)) echo 'Sản Phẩm Thuộc Thương Hiệu <span>'.$brand_name.'</span>'; else echo 'Tất Cả Sản Phẩm';  ?> </center>
                            </h3>
                            {{-- <div class="col-lg-9 order-1 order-lg-2">
                                <div class="product-show-option">
                                    <div class="row">
                                        <div class="col-lg7 col-md-7">
                                           <form action="">
                                            @csrf
                                            <div class="select-option">
                                                <select name="sort_by" onchange="this.form.submit();" class="sorting">
                                                    <option {{request('sort_by') == 'name_ascending'? 'selected':''}} value="name_ascending">Sorting: Name A-Z</option>
                                                    <option {{request('sort_by') == 'name_descending'? 'selected':''}} value="name_descending">Sorting: Name Z-A</option>
                                                    <option {{request('sort_by') == 'price_ascending'? 'selected':''}} value="price_ascending">Sorting: Price Ascending</option>
                                                    <option {{request('sort_by') == 'price_descending'? 'selected':''}} value="price_descending">Sorting: Price Descending</option>
                                                </select>
                                                
                                            </div>
                                           </form>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <?php
                        if(Auth::guard('customer')->check())
                        {
                            ?>
                       
                                <div class="row product-grid-4">
        
                                    @foreach ($list_product ?? '' as $product)
                                        
                                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                                <form action="{{ route('add-to-cart-lg', $product->id) }}" method="POST">
                                                    @csrf
                                                <div class="product-cart-wrap mb-30">
                                                    <div class="product-img-action-wrap">
                                                        <div class="product-img product-img-zoom">
                                                            <a href="{{ route('get-client-productDetail', $product->id) }}">
                                                                <img class="default-img"
                                                                    src="{{ "/storage/$product->image" }}" alt="">
                                                                <img class="hover-img" src="{{ "/storage/$product->image" }}"
                                                                    alt="">
                                                            </a>
                                                        </div>
        
                                                        <div class="product-badges product-badges-position product-badges-mrg">
        
                                                        </div>
                                                        <div class="product-content-wrap">
                                                            {{-- <div class="product-category">
                                                        <a href="shop.html">Clothing</a>
                                                    </div> --}}
                                                            <h2><a
                                                                    href="{{ route('get-client-productDetail', $product->id) }}">{{ $product->name }}</a>
                                                            </h2>
        
                                                            <input type="hidden" name="product_qty" value="1"
                                                                min="1">
        
        
                                                            <div class="product-price">
                                                                <span class=""><?php echo number_format($product->out_price); ?> đ</span>
                                                                {{-- <span class="old-price">$245.8</span> --}}
                                                            </div>
                                                            <div class="product-price">
                                                                <span>{{ $product->ram->name }}</span>
                                                            </div>
                                                            <div class="product-action-1 show">
        
                                                                <button aria-label="Add To Cart"
                                                                    class="action-btn hover-up"><i
                                                                        class="fi-rs-shopping-bag-add"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                </div>
                                            </form>
                                            </div>
                                                
                                        
                                    @endforeach
                                </div>
                            
        
                            <!--End product-grid-4-->
                      
                    <?php
                        }else
                        {
                            ?>
        
                    
                            <div class="row product-grid-4">
                                @foreach ($list_product ?? '' as $product)
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                        <form action="{{ route('add-to-cart', $product->id) }}" method="GET">
                                            @csrf
                                        <div class="product-cart-wrap mb-30">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="{{ route('get-client-productDetail', $product->id) }}">
                                                        <img class="default-img" src="{{ "/storage/$product->image" }}"
                                                            alt="">
                                                        <img class="hover-img" src="{{ "/storage/$product->image" }}"
                                                            alt="">
                                                    </a>
                                                </div>
        
                                                <div class="product-badges product-badges-position product-badges-mrg">
        
                                                </div>
                                                <div class="product-content-wrap">
                                                    {{-- <div class="product-category">
                                                            <a href="shop.html">Clothing</a>
                                                        </div> --}}
                                                    <h2><a
                                                            href="{{ route('get-client-productDetail', $product->id) }}">{{ $product->name }}</a>
                                                    </h2>
                                                    <input type="hidden" name="quatity" value="1"
                                                    min="1">
                                                    <div class="product-price">
                                                        <span class=""><?php echo number_format($product->out_price); ?> đ</span>
                                                        {{-- <span class="old-price">$245.8</span> --}}
                                                    </div>
                                                    <div class="product-price">
                                                        <span>{{ $product->ram->name }}</span>
                                                    </div>
                                                    <div class="product-action-1 show">
        
                                                        <button aria-label="Add To Cart"
                                                            class="action-btn hover-up"><i
                                                                class="fi-rs-shopping-bag-add"></i></button>
                                                    </div>
                                                </div>
                                            </div>
        
                                        </div>
                                        
                                        </form>
                                    </div>
                                @endforeach
        
                            </div>
                        <?php
                        }
                        ?>
                           
                            <?php try{ ?>{{$list_product->links()}}<?php } catch(Exception $e) {} ?>
                        </div>
                        
				<div class="col-lg-3 primary-sidebar sticky-sidebar">
                    <!-- Fillter By Price -->
                  <form>
                    @csrf
                    <div class="sidebar-widget price_range range mb-30">
                        <div class="widget-header position-relative mb-20 pb-10">
                            <h5 class="widget-title mb-10">Fill by price</h5>
                            <div class="bt-1 border-color-1"></div>
                        </div>
                        <div class="price-filter">
                            <div class="price-filter-inner">
                                <div id="slider-range"></div>
                                <div class="price_slider_amount">
                                    <div class="label-input">
                                        <label for="amount">Price range:</label>
                                         
                                        <span>Range:</span><input type="text" id="amount" name="price" placeholder="Add Your Price">
                                        <input type="hidden" name="start_price" id="start_price">
                                        <input type="hidden" name="end_price" id="end_price">
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                        <button type="submit" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Fillter</button>
                    </div>
                  </form>
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

                     <!-- Fillter By cpu -->
                     <div class="widget-category mb-30">
                        
                        <h5 class="section-title style-1 mb-30 wow fadeIn animated">Ổ Cứng</h5>
                        <ul class="categories">
                        @foreach ($all_hd ?? '' as $hd)
                        <li><a href="{{ route('get-client-productByHd', $hd->id) }}">{{$hd->name}}</a></li>
                            
                            </a>
                        @endforeach
                        
                        
                        </ul>
                    
                </div>

                     <!-- Fillter By Ram -->
                     <div class="widget-category mb-30">
                        
                        <h5 class="section-title style-1 mb-30 wow fadeIn animated">Ram</h5>
                        <ul class="categories">
                        @foreach ($all_ram ?? '' as $ram)
                        <li><a href="{{ route('get-client-productByRam', $ram->id) }}">{{$ram->name}}</a></li>
                            
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




@section('scripts')

<script type="text/javascript">
    
    var sliderrange = $('#slider-range');
    var amountprice = $('#amount');
    var star_price = $('#start_price');
    var end_price = $('#end_price');
    $(document).ready( function() {
        sliderrange.slider({
        range: true,
        min: {{$min_price}},
        max:  {{$max_price}},
        step: 100000,
        values: [{{$min_price}}, {{$max_price}}],
        slide: function( event, ui ) {
            amountprice.val(" đ " + ui.values[0] + " - đ " + ui.values[1]);
            star_price.val(ui.values[0]);
            end_price.val(ui.values[1]);
        }
        });
        amountprice.val("đ " + sliderrange.slider("values", 0) +
        " - đ " + sliderrange.slider("values", 1));
        
  } );

    
</script>

    
@endsection
@endsection