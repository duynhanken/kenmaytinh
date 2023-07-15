@extends('Admin.home')
@section('admin_content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm Hóa Đơn</h1>
    </div>


    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-7">
            <div class="row">
                <div class="card mx-auto"></div>

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
                                                    <form method="POST" action="{{ route('post-create-bill') }}">
                                                        @csrf

                                                        
                                                        <div class="form-group">
                                                            <h6>Tên Khách Hàng</h6>
                                                            <select name="customer_id" class="form-control"
                                                                aria-label="Default select example">
                                                                <option selected>Customer</option>

                                                                @foreach ($list_customer as $customer)
                                                                    <option value="{{ $customer->id }}">
                                                                        {{ $customer->name }}</option>
                                                                @endforeach

                                                            </select>

                                                            @error('customer_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>


                                                      

                                                        <hr>

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

@endsection
