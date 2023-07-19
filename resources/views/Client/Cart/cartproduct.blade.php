@extends('client.index')

@section('content')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('get-client-home')}}" rel="nofollow">Home</a>
                <span></span> Shop
                <span></span> Your Cart
            </div>
        </div>
    </div>

    <?php
        $message = Session::get('message');
        if($message)
        {
            echo '<div class="alert">
    
                    <center> <span id ="close"  onclick="this.parentElement.style.display='."'none'".';">&times;</span>'.$message.'</center>
                </div>';
            Session::put('message',null);
        }
    ?>


    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <form action="{{route('postCheckOut')}}" method="POST">
                    @csrf
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table shopping-summery text-center clean">
                            <thead>
                                <tr class="main-heading">
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                   
                                    <th scope="col">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($all_cart as $cart)
                                <tr>
                                    <td class="image product-thumbnail"><img src="{{ '/storage/'.$cart->product->image }}" alt="#"></td>
                                    <td class="product-des product-name">
                                        <h5 class="product-name" name="name"><a href="product-details.html">{{$cart->product->name}}</a></h5>
                                        
                                    </td>
                                    <td class="price" data-title="Price" name="price[]"><span><?php echo number_format($cart->price); ?> đ </span></td>
                                    <td class="text-center" data-title="Stock">
                                            <input type="hidden" name="id_cart" value="{{$cart->id}}">
                                     
                                            <input type="number" value="{{$cart->quantity}}" min="1" max="{{$cart->product->quantity}}"  name="quanty_{{$cart->id}}" >
                                           
                                    </td>
                                    {{-- <td class="text-right" data-title="Cart">
                                        <span><?php echo number_format($cart->quantity * $cart->price); ?>  đ </span>
                                    </td> --}}
                                    <td class="action" data-title="" >
                                        <a href="{{route('delete-product-i',$cart->product->id)}}">
                                            <i class="fi-rs-trash"></i>
                                        </a>
                                
                                    </a></td>
                                </tr>
                                @endforeach
                                <tr>
                                    {{-- <td colspan="6" class="text-end">
                                        <a href="#" class="text-muted"> <i class="fi-rs-cross-small"></i> Clear Cart</a>
                                    </td> --}}
                                </tr>
                          
                            </tbody>
                        </table>
                    </div>
                    <div class="cart-action text-end">
                       
                        <a href="{{route('get-client-home')}}" class="btn " style="
                        padding: 25px;
                        height: 73px;
                    "><i class="fi-rs-shopping-bag mr-10"></i>Continue Shopping</a>
                        <a href="" class="btn  mr-10 mb-sm-15">
                            
                                    <button class="btn  mr-10 mb-sm-15"></i>Checkout</button>
                               
                        </a>
                        
                        
                    </div>
                    <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div>
                   
                </div>
            </form>
            </div>
        </div>
    </section>
</main>



@endsection

