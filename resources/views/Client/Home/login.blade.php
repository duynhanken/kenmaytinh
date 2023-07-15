@extends('client.index')

@section('content')


<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('get-client-home')}}" rel="nofollow">Home</a>                    
                <span></span> Login
            </div>
        </div>
    </div>
    <div class="container">

            @if (session()->has('status-message'))
                <div class="alert alert-success"
                    style="
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    ">
                    {{ session('status-message') }}
                </div>
            @endif
	</div>
    <section class="pt-150 pb-150">
        <div class="container">
           
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h3 class="mb-30">Login</h3>
                                    </div>
                                    <form method="post" action="{{route('post-login-client')}}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" required="" name="email" placeholder="Your Email">
                                        </div>
                                        <div class="form-group">
                                            <input required="" type="password" name="password" placeholder="Password">
                                        </div>
                                        
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login">Log in</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-6">
                           <img src="{!! asset('layout/assets/imgs/login.png')!!}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection