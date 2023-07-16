@extends('Admin.home')

@section('admin_content')

    <div class="d-sm-flex align-items-center justify-content-between mb4">
        <h1 class="h3 mb-0 text-gray-800">Card Đồ Họa</h1>
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
                                        <h1 class="h4 text-gray-900 mb-4">Create Card</h1>
                                    </div>
                                    <div>
                                        @if (session()->has('message'))
                                            <div class="alert alert-success"
                                                style="
                                                    display: flex;
                                                    align-items: center;
                                                    justify-content: center;
                                                ">
                                                {{ session('message') }}
                                            </div>
                                        @endif
                                    </div>
                                
                                    <form method="POST" action="{{ route('graphicsCard-store') }}" >
                                        @csrf
                                        
                                        <div class="form-group">
                                            <h6>Tên Card</h6>
                                            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                                                required autocomplete="name" autofocus id="exampleInputName"
                                                placeholder="Mainboard name">
            
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <input type="hidden" name="slug" value="slug"/>

                                        <div class="form-group">
                                            <h6>Loại Card</h6>
                                            <select class="form-control" id="exampleFormControlSelect1" name="cateCard" >
                                                <option selected value="Card Onboard">Card Onboard</option>
                                                <option value="Card đồ họa rời">Card đồ họa rời</option>
                                            </select>
                                         
            
                                            @error('cateCard')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <h6>Dung lượng Card</h6>

                                            <input type="text" class="form-control form-control-user @error('capacityCard') is-invalid @enderror" name="capacityCard" value="{{ old('capacityCard') }}"
                                                required autocomplete="name" autofocus id="exampleInputName"
                                                placeholder="capacityCard">
            
                                            @error('capacityCard')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <h6>Hãng sản xuất Card</h6>
                                            <input type="text" class="form-control form-control-user @error('manufacturer') is-invalid @enderror" name="manufacturer" value="{{ old('manufacturer') }}"
                                                required autocomplete="name" autofocus id="exampleInputName"
                                                placeholder="manufacturer">
            
                                            @error('manufacturer')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <h6>Mô Tả</h6>
                                            <input type="text" class="form-control form-control-user @error('desc') is-invalid @enderror" name="desc" value="{{ old('desc') }}"
                                                required autocomplete="name" autofocus id="exampleInputName"
                                                placeholder="Mô tả">
            
                                            @error('desc')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            {{-- <label for="exampleFormControlSelect1">Trạng Thái</label> --}}
                                            <select class="form-control" id="exampleFormControlSelect1" name="status" >
                                                <option selected value="1">Kích Hoạt</option>
                                                <option value="0">Không Kích Hoạt</option>
                                            </select>
                                        </div>
                                        


                                            <hr>

                                        <div class="">
                                            <div class="">
                                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                                    {{ __('Create Brands') }}
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

    

@endsection