@extends('Admin.home')

@section('admin_content')

    <div class="d-sm-flex align-items-center justify-content-between mb4">
        <h1 class="h3 mb-0 text-gray-800">Mainboard</h1>
    </div>

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update Mainboard
                        <a href="{{route('mainBoard-list')}}" class="float-right">Back</a>
                    </div>
           
               
                <div class="card-body">
                    <form method="POST" action="{{ route('mainBoard-update',$mainBoard->slug) }}" >
                        @csrf
                        @method('PUT')
    
                        <div class="form-group">
                            <h6>Tên Mainboard</h6>
                            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name',$mainBoard->name) }}"
                                required autocomplete="name" autofocus id="exampleInputName"
                                placeholder="mainBoard -name">
    
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
    
                        </div>

                        <input type="hidden" name="slug" value="{{$mainBoard->slug}}"/>

                        <div class="form-group">
                            <h6>Kích Thước Mainboard</h6>
                            <input type="text" class="form-control form-control-user @error('size') is-invalid @enderror" name="size" value="{{ old('size',$mainBoard->size) }}"
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
                            <input type="text" class="form-control form-control-user @error('chipset') is-invalid @enderror" name="chipset" value="{{ old('chipset',$mainBoard->chipset) }}"
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
                            <input type="text" class="form-control form-control-user @error('usbgate') is-invalid @enderror" name="usbgate" value="{{ old('usbgate',$mainBoard->usbgate) }}"
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
                            <input type="text" class="form-control form-control-user @error('ramslots') is-invalid @enderror" name="ramslots" value="{{ old('ramslots',$mainBoard->ramslots) }}"
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
                            <input type="text" class="form-control form-control-user @error('manufacturer') is-invalid @enderror" name="manufacturer" value="{{ old('manufacturer',$mainBoard->manufacturer) }}"
                                required autocomplete="name" autofocus id="exampleInputName"
                                placeholder="manufacturer">

                            @error('manufacturer')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">

                            <h6>Mô tả</h6>

                            <input type="text" class="form-control form-control-user @error('desc') is-invalid @enderror" name="desc" value="{{ old('desc',$mainBoard->desc) }}"
                                required autocomplete="name" autofocus id="exampleInputName"
                                placeholder="Mô tả">

                            @error('desc')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <input type="hidden" name="status" value="{{$mainBoard->status}}"/>

                        <hr>

                        <div class="">
                            <div class="">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('Update rams') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection