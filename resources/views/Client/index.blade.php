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
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css"> --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    @vite(['public/layout/slider/jqr_css.css'])

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
                                        {{-- <span class="pro-count blue">{{ $cart_count }}</span> --}}
                                    </a>




                                    {{-- <div class="cart-dropdown-wrap cart-dropdown-hm2">
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
                                    </div> --}}


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
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href="index.html"><img src="assets/imgs/logo/logo.png" alt="logo"></a>
                    </div>
                    <div class="header-nav d-none d-lg-flex">

                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                            <nav>
                                <ul>
                                    <li><a class="active" href="{{ route('get-client-home') }}">Home </a></li>
                                    {{-- <li><a href="{{route('delivery')}}">Đơn hàng</a></li> --}}
                                    <li><a href="{{route('get-client-product')}}">Shop</a></li>

                                  
                                </ul>
                            </nav>
                        </div>
                    </div>
                
            </div>
        </div>
    </header>
   
    <main class="main">
       
        <div class="container">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>

     

        @yield('content')





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
                        <h5 class="widget-title wow fadeIn animated">My Account</h5>
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
    {{-- @vite(['public/layout/assets/js/vendor/jquery-3.6.0.min.js']) --}}
    {{-- @vite(['public/layout/assets/js/vendor/jquery-migrate-3.3.0.min.js']) --}}
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    @vite(['public/layout/assets/js/vendor/bootstrap.bundle.min.js'])
    @vite(['public/layout/assets/js/plugins/slick.js'])
    @vite(['public/layout/assets/js/plugins/jquery.syotimer.min.js'])
    <script src="//cdnjs.cloudflare.com/ajax/libs/wow/1.1.0/wow.min.js"></script>
    {{-- @vite(['public/layout/assets/js/plugins/jquery-ui.js']) --}}
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
    {{-- @vite(['public/layout/assets/js/main.js?v=3.3'])
    @vite(['public/layout/assets/js/shop.js?v=3.3']) --}}
    {{-- @vite(['public/layout/slider/jqr_js.js'])
    @vite(['public/layout/slider/jqr_ver.js']) --}}
    {{-- <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> --}}
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    
    @yield('scripts')



</html>
