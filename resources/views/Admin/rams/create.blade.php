@extends('Admin.home')

@section('admin_content')

    <div class="d-sm-flex align-items-center justify-content-between mb4">
        <h1 class="h3 mb-0 text-gray-800">RAM</h1>
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
                                        <h1 class="h4 text-gray-900 mb-4">Create RAM</h1>
                                    </div>
                                    <form method="POST" action="{{ route('ram-store') }}" >
                                        @csrf
                                        
                                        <div class="form-group">
                                            <h6>Tên Ram</h6>
                                            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                                                required autocomplete="name" autofocus id="exampleInputName"
                                                placeholder="Rams name">
            
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <input type="hidden" name="slug" value="slug"/>

                                        <div class="form-group">
                                            <h6>Dung Lượng Ram (GB)</h6>
                                            <input type="text" class="form-control form-control-user @error('capacity') is-invalid @enderror" name="capacity" value="{{ old('capacity') }}"
                                                required autocomplete="name" autofocus id="exampleInputName"
                                                placeholder="Rams capacity">
            
                                            @error('capacity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <h6>Tốc Độ Bus (MHZ)</h6>
                                            <input type="text" class="form-control form-control-user @error('bus') is-invalid @enderror" name="bus" value="{{ old('bus') }}"
                                                required autocomplete="name" autofocus id="exampleInputName"
                                                placeholder="Rams bus">
            
                                            @error('bus')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <h6>Băng Thông</h6>
                                            <input type="text" class="form-control form-control-user @error('bandwidth') is-invalid @enderror" name="bandwidth" value="{{ old('bandwidth') }}"
                                                required autocomplete="name" autofocus id="exampleInputName"
                                                placeholder="Rams bandwidth">
            
                                            @error('bandwidth')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <h6>Số Chân</h6>
                                            <input type="text" class="form-control form-control-user @error('numberofpins') is-invalid @enderror" name="numberofpins" value="{{ old('numberofpins') }}"
                                                required autocomplete="name" autofocus id="exampleInputName"
                                                placeholder="Rams numberofpins">
            
                                            @error('numberofpins')
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