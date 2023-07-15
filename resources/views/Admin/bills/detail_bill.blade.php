@extends('Admin.home')
@section('admin_content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Nhập Thông Tin Hóa Đơn</h1>
    </div>


    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-7">
            <div class="row">
                <div class="card mx-auto">

                    <?php
                    $message = Session::get('message');
                    if($message)
                    {
                        echo '<div class="alert">
                        <span id = "close" class="closebtn" onclick="this.parentElement.style.display='."'none'".';">&times;</span>'.$message.'</div>';
                        Session::put('message',null);
                    }
            
                ?>
                </div>

                    <div class="container">

                        <div class="row justify-content-center">

                            <div class="col-xl-10 col-lg-12 col-md-9">
                                <div class="card o-hidden border-0 shadow-lg my-5">
                                    <div class="card-body p-0">
                                        <!-- Nested Row within Card Body -->
                                        <div class="row">
                                            <div class="col-lg-3 d-none d-lg-block"></div>
                                            <div class="col-lg-6">
                                                <div class="p-7">
                                                    <div class="text-center">
                                                        <h1 class="h4 text-gray-900 mb-4">Create Bills</h1>
                                                    </div>
                                                    <div class="form-group">
                                                        <label >Tên Khách Hàng</label>
                                                        <input type="text" readonly class="form-control" value="{{$bills->customer->name ?? ''}}">                    
                                                    </div>

                                                    <div class="form-group">
                                                        <label >Email Khách Hàng</label>
                                                        <input type="text" readonly class="form-control" value="{{$bills->customer->email ?? ''}}">                    
                                                    </div>

                                                    <div class="form-group">
                                                        <label >SĐT</label>
                                                        <input type="text" readonly class="form-control" value="{{$bills->customer->phone ?? ''}}">                    
                                                    </div>
                                                  
                                                    <hr>
                                                    <form method="POST" action="{{ route('post-detail-bill') }}">
                                                        @csrf

                                                        <input type="hidden" name="id_bill" value="{{$bills->id}}">

                                                        <div class="form-group">
                                                            <h6>Sản Phẩm</h6>
                                                            <select name="product_id" class="form-control"
                                                                aria-label="Default select example">
                                                                <option selected>Product</option>

                                                                @foreach ($list_product as $product)
                                                                    <option value="{{ $product->id }}">
                                                                        {{ $product->name }}</option>
                                                                @endforeach

                                                            </select>

                                                            @error('product_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleFormControlInput1" >Số lượng nhập</label>
                                                            <input type="number" name="quantity" class="form-control" id="exampleFormControlInput1" placeholder="" required="" >
                                                        </div>
                                                        
                                                        

                                                        <div class="">
                                                            <div class="">
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-user btn-block">
                                                                    {{ __('Create Bills') }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

    <script>//Hàm 2 giây đóng
        setTimeout(function() {
            var btn = document.getElementById('close');
            btn.click();
    }, 2000);
    </script>

@endsection
