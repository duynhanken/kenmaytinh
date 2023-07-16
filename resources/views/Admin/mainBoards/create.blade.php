@extends('Admin.home')

@section('admin_content')

    <div class="d-sm-flex align-items-center justify-content-between mb4">
        <h1 class="h3 mb-0 text-gray-800">Mainboard</h1>
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
                                        <h1 class="h4 text-gray-900 mb-4">Create Mainboard</h1>
                                    </div>
                                    <form method="POST" action="{{ route('mainBoard-store') }}" >
                                        @csrf
                                        
                                        <div class="form-group">
                                            <h6>Tên Mainboard</h6>
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
                                            <h6>Kích Thước Mainboard</h6>
                                            <input type="text" class="form-control form-control-user @error('size') is-invalid @enderror" name="size" value="{{ old('size') }}"
                                                required autocomplete="name" autofocus id="exampleInputName"
                                                placeholder="size">
            
                                            @error('size')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <h6>Chipset</h6>
                                            <input type="text" class="form-control form-control-user @error('chipset') is-invalid @enderror" name="chipset" value="{{ old('chipset') }}"
                                                required autocomplete="name" autofocus id="exampleInputName"
                                                placeholder="chipset">
            
                                            @error('chipset')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <h6>Cổng USB</h6>
                                            <input type="text" class="form-control form-control-user @error('usbgate') is-invalid @enderror" name="usbgate" value="{{ old('usbgate') }}"
                                                required autocomplete="name" autofocus id="exampleInputName"
                                                placeholder="usbgate">
            
                                            @error('usbgate')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <h6>Khe Cắm Ram</h6>
                                            <input type="text" class="form-control form-control-user @error('ramslots') is-invalid @enderror" name="ramslots" value="{{ old('ramslots') }}"
                                                required autocomplete="name" autofocus id="exampleInputName"
                                                placeholder="ramslots">
            
                                            @error('ramslots')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <h6>Hãng sản xuất</h6>
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