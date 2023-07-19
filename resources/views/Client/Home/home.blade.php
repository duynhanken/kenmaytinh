{{-- Dem tong so sp cart --}}
{{-- Dem tong so sp cart --}}
{{-- @php
    use App\Http\Controllers\Client\CartClientController;
    $cart_count = CartClientController::cartCount();
    $all_cart = CartClientController::allcartCount();
@endphp --}}


<!--Nếu chưa đăng nhập
-->
<?php // Xu li loi chua dang nhap
$error = Session::get('error');
if($error)
{
?>
<script type="text/javascript">
    alert('<?php echo $error; ?>');
</script>
<?php
Session::put('error',null);
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>KenMayTinh</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <link rel="shortcut icon" type="image/x-icon" href="assets/imgs/theme/favicon.ico">
    @vite(['public/layout/assets/css/main.css'])
    @vite(['public/layout/assets/css/custom.css'])

<body>
    <header class="header-area header-style-1 header-height-2">
        <div class="header-top header-top-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info">

                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <div class="text-center">

                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info header-info-right">
                            <ul>
                                <?php
                                if(Auth::guard('customer')->check())
                                {
                                    ?>
                                <li>
                                    Xin chào <?php echo Auth::guard('customer')->user()->name; ?>
                                    <a href="{{ route('get-logout-client') }}">
                                         <img alt="" style="
                                        width: 18px;
                                    " src="{!! asset('layout/assets/imgs/theme/icons/out.png') !!}">
                                    </a>
                                </li>
                                <?php
                                }else
                                {
                                    ?>
                                <li><i class="fi-rs-key"></i><a href="{{ route('get-login-client') }}">Log In </a> / <a
                                        href="{{ route('get-client-account') }}">Sign Up</a></li>
                                <?php
                                }
                               ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="{{ route('get-client-home') }}"><img src="{!! asset('layout/assets/imgs/logo/hinhnenden.png') !!}" alt="logo"></a>
                    </div>
                    <div class="header-right">
                        <div class="search-style-1">
                            <form action="{{route('get-search-product')}}">
                                <input type="text" name="search" placeholder="Search for items...">
                            </form>
                        </div>
                        <div class="header-action-right">
                            <div class="header-action-2">
                                {{-- <div class="header-action-icon-2">
                                    <a href="shop-wishlist.php">
                                        <img class="svgInject" alt="Surfside Media" src="{!! asset('layout/assets/imgs/theme/icons/icon-heart.svg')!!}">
                                    </a>
                                </div> --}}
                                <?php
                                if(Auth::guard('customer')->check())
                                {
                                    ?>
                                    <div class="header-action-icon-2">
                                        <a href="{{route('delivery')}}">
                                            <img class="svgInject" alt="Surfside Media" src="{!! asset('layout/assets/imgs/theme/icons/delivery.png') !!}">
                                        </a>
                                    </div>
                                <div class="header-action-icon-2">
                                    <a class="mini-cart-icon" href="{{ route('view-to-cart') }}">
                                        <img alt="Surfside Media" src="{!! asset('layout/assets/imgs/theme/icons/icon-cart.svg') !!}">
                                        <span class="pro-count blue">{{ $cart_count }}</span>
                                    </a>




                                    <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                        @foreach ($all_cart as $cart)
                                            <ul>
                                                <li>
                                                    <div class="shopping-cart-img">
                                                        <a
                                                            href="{{ route('get-client-productDetail', $cart->product->id) }}"><img
                                                                alt="Surfside Media"
                                                                src="{{ '/storage/' . $cart->product->image }}"></a>
                                                    </div>
                                                    <div class="shopping-cart-title">
                                                        <h4><a
                                                                href="{{ route('get-client-productDetail', $cart->product->id) }}">{{ $cart->product->name }}</a>
                                                        </h4>
                                                        <h4><span>SL:{{ $cart->quantity }} </h4>
                                                        <h4></span> Price:<?php echo number_format($cart->price); ?> VNĐ
                                                        </h4>
                                                    </div>
                                                    <div class="shopping-cart-delete">
                                                        <a href="{{route('delete-product-i',$cart->product->id)}}"><i class="fi-rs-cross-small"></i></a>
                                                    </div>
                                                </li>
                                            </ul>
                                        @endforeach
                                        <div class="shopping-cart-footer">
                                           
                                            <div class="shopping-cart-button">
                                                <a href="{{route('view-to-cart')}}" class="outline">View cart</a>
                                               
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <?php
                                }else
                                {
                                    ?>
                                <div class="header-action-icon-2">
                                    <a class="mini-cart-icon" href="{{ route('view-to-cart') }}">
                                        <img alt="Surfside Media" src="{!! asset('layout/assets/imgs/theme/icons/icon-cart.svg') !!}">
                                        <span class="pro-count blue">{{ count((array) session('cart')) }}</span>
                                    </a>



                                    @if (session('cart'))


                                        <div class="cart-dropdown-wrap cart-dropdown-hm2">

                                            <ul>
                                                @foreach ((array) session('cart') as $id => $details)
                                                    <?php $total = 0; ?>
                                                    <?php $total = $total + $details['price'] * $details['quantity']; ?>
                                                    <li>
                                                        <div class="shopping-cart-img">
                                                            <a
                                                                href="{{ route('get-client-productDetail', $details['id']) }}"><img
                                                                    alt="Surfside Media"
                                                                    src="{{ asset('storage') }}/{{ $details['image'] }}"></a>
                                                        </div>
                                                        <div class="shopping-cart-title">
                                                            <h4><a
                                                                    href="{{ route('get-client-productDetail', $details['id']) }}">{{ $details['name'] }}</a>
                                                            </h4>
                                                            <h4><span>SL: {{ $details['quantity'] }} </span> Price:
                                                                {{ $details['price'] }}</h4>
                                                        </div>
                                                        <div class="shopping-cart-delete">
                                                            <a href="{{route('remove-to-cart', $details['id'])}}"><i class="fi-rs-cross-small"></i></a>
                                                        </div>
                                                    </li>
                                                    <div class="shopping-cart-total">
                                                        <h4>Total <span>
                                                                {{ $total }}
                                                            </span></h4>
                                                    </div>
                                                @endforeach
                                            </ul>
                                            <div class="shopping-cart-footer">

                                                <div class="shopping-cart-button">
                                                    <a href="{{route('view-to-cart')}}" class="outline">View cart</a>
                                                    {{-- <a href="{{ route('checkout') }}">Checkout</a> --}}
                                                </div>
                                            </div>
                                        </div>

                                    @endif

                                </div>
                                <?php
                                }
                               ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href="{{ route('get-client-home') }}"><img src="assets/imgs/logo/logo.png"
                                alt="logo"></a>
                    </div>
                    <div class="header-nav d-none d-lg-flex">

                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                            <nav>
                                <ul>
                                    <li><a class="active" href="{{ route('get-client-home') }}">Home </a></li>
                                    {{-- <li><a href="{{route('delivery')}}">Đơn hàng</a></li> --}}
                                    <li><a href="{{route('get-client-product')}}">Shop</a></li>
                                    {{-- <li><a href="shop.html">Shop</a></li>
                                    <li class="position-static"><a href="#">Phụ Kiện <i
                                                class="fi-rs-angle-down"></i></a>
                                        <ul class="mega-menu">
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="#">Women's Fashion</a>
                                                <ul>
                                                    <li><a href="product-details.html">Dresses</a></li>
                                                    <li><a href="product-details.html">Blouses & Shirts</a></li>
                                                    <li><a href="product-details.html">Hoodies & Sweatshirts</a></li>
                                                    <li><a href="product-details.html">Wedding Dresses</a></li>
                                                    <li><a href="product-details.html">Prom Dresses</a></li>
                                                    <li><a href="product-details.html">Cosplay Costumes</a></li>
                                                </ul>
                                            </li>

                                        </ul>
                                    </li>
                                    <li><a href="">My Account </a></li> --}}
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="hotline d-none d-lg-block">
                        <p><i class="fi-rs-smartphone"></i><span>Phone</span> (+84) 0000-000-000 </p>
                    </div>

                    <!-- giỏ hàng -->
                    
                </div>
            </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="index.html"><img src="assets/imgs/logo/logo.png" alt="logo"></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>
    <main class="main">
        <div class="container">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
         <section class="home-slider position-relative pt-50" style="
         background-color: aliceblue;
     ">
            <div class="hero-slider-1 dot-style-1 dot-style-1-position-1">
                <div class="single-hero-slider single-animation-wrap">
                    <div class="container">
                        <div class="row align-items-center slider-animated-1">
                            <div class="col-lg-5 col-md-6">
                                <div class="hero-slider-content-2">
                                    <h4 class="animated">Chào mừng bạn đến với</h4>
                                    <h2 class="animated fw-900">website chúng tôi</h2>
                                    <h1 class="animated fw-900 text-brand">On all products</h1>
                                  
                                    <a class="animated btn btn-brush btn-brush-3" href="{{route('get-client-product')}}"> Shop Now </a>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <div class="single-slider-img single-slider-img-1">
                                    <img class="animated slider-1-1" src="{!! asset('layout/assets/imgs/hinhnen.jpg')!!}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div> 
        </section> 
        {{-- Brand   --}}
        <section class="section-padding">
            <div class="container">
                <h3 class="section-title mb-20 wow fadeIn animated"><span>Featured</span> Brands</h3>
                <div class="carausel-6-columns-cover position-relative wow fadeIn animated">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow"
                        id="carausel-6-columns-3-arrows"></div>
                    <div class="carausel-6-columns text-center" id="carausel-6-columns-3">

                        <div class="brand-logo">
                            @foreach ($all_brand ?? '' as $brand)
                                <a href="{{ route('get-client-productByBrand', $brand->id) }}">
                                    <img class="img-grey-hover" src="{{ "/storage/$brand->image" }}" alt="">
                                </a>
                            @endforeach
                        </div>



                    </div>
                </div>
            </div>
        </section>

        {{-- product --}}
        <section class="product-tabs section-padding position-relative wow fadeIn animated">
            <div class="bg-square"></div>
            <div class="container">
                <!-- <div class="tab-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one" aria-selected="true">Featured</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-two" data-bs-toggle="tab" data-bs-target="#tab-two" type="button" role="tab" aria-controls="tab-two" aria-selected="false">Popular</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-three" data-bs-toggle="tab" data-bs-target="#tab-three" type="button" role="tab" aria-controls="tab-three" aria-selected="false">New added</button>
                        </li>
                    </ul>
                    <a href="#" class="view-more d-none d-md-flex">View More<i class="fi-rs-angle-double-small-right"></i></a>
                </div> -->
                <!--End nav-tabs-->
                <?php
                if(Auth::guard('customer')->check())
                {
                    ?>
                <div class="tab-content wow fadeIn animated" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
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
                    </div>
                </div>

                    <!--End product-grid-4-->
                </div>

                <!--En tab two (Popular)-->

                <!--En tab three (New added)-->
            </div>
            <?php
                }else
                {
                    ?>

            <div class="tab-content wow fadeIn animated" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
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
                        <!--End product-grid-4-->
                    </div>

                    <!--En tab two (Popular)-->

                    <!--En tab three (New added)-->
                </div>


                <?php
                }
                ?>


            
        </section>






    </main>

    <footer class="main">
        <section class="section-padding footer-mid" style="background-color: #e9cfac;">
            <div class="container pt-15 pb-20">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="widget-about font-md mb-md-5 mb-lg-0">
                            <div class="logo logo-width-1 wow fadeIn animated">
                                <a href="{{ route('get-client-home') }}"><img src="{!! asset('layout/assets/imgs/logo/hinhnenden.png')!!}" alt="logo"></a>
                            </div>
                            <h5 class="mt-20 mb-10 fw-600 text-grey-4 wow fadeIn animated">Contact</h5>
                            <p class="wow fadeIn animated">
                                <strong>Address: </strong>74 Đường Paster Quận 1 Tp Hồ Chí Minh
                            </p>
                            <p class="wow fadeIn animated">
                                <strong>Phone: </strong>+1 0000-000-000
                            </p>
                            <p class="wow fadeIn animated">
                                <strong>Email: </strong>0306181056@caothang.edu.vn
                            </p>
                           
                        </div>
                    </div>
                    
                    <div class="col-lg-2  col-md-3">
                        <h5 class="widget-title wow fadeIn animated">Hóa đơn</h5>
                        <ul class="footer-list wow fadeIn animated">
                            <li><a href="{{route('delivery')}}">My Order</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </section>

    </footer>
    <!-- Vendor JS-->
    @vite(['public/layout/assets/js/vendor/modernizr-3.6.0.min.js'])
    @vite(['public/layout/assets/js/vendor/jquery-3.6.0.min.js'])
    @vite(['public/layout/assets/js/vendor/jquery-migrate-3.3.0.min.js'])
    @vite(['public/layout/assets/js/vendor/bootstrap.bundle.min.js'])
    @vite(['public/layout/assets/js/plugins/slick.js'])
    @vite(['public/layout/assets/js/plugins/jquery.syotimer.min.js'])
    @vite(['public/layout/assets/js/plugins/wow.js'])
    @vite(['public/layout/assets/js/plugins/jquery-ui.js'])
    @vite(['public/layout/assets/js/plugins/perfect-scrollbar.js'])
    @vite(['public/layout/assets/js/plugins/magnific-popup.js'])
    @vite(['public/layout/assets/js/plugins/select2.min.js'])
    @vite(['public/layout/assets/js/plugins/waypoints.js'])
    @vite(['public/layout/assets/js/plugins/counterup.js'])
    @vite(['public/layout/assets/js/plugins/jquery.countdown.min.js'])
    @vite(['public/layout/assets/js/plugins/images-loaded.js'])
    @vite(['public/layout/assets/js/plugins/isotope.js'])
    @vite(['public/layout/assets/js/plugins/scrollup.js'])
    @vite(['public/layout/assets/js/plugins/jquery.vticker-min.js'])
    @vite(['public/layout/assets/js/plugins/jquery.theia.sticky.js'])
    @vite(['public/layout/assets/js/plugins/jquery.elevatezoom.js'])
    <!-- Template  JS -->
    @vite(['public/layout/assets/js/main.js?v=3.3'])
    @vite(['public/layout/assets/js/shop.js?v=3.3'])
    @vite(['public/layout/assets/js/moneyformat'])

</html>
