@extends('Admin.home')

@section('admin_content')

    <div class="d-sm-flex align-items-center justify-content-between mb4">
        <h1 class="h3 mb-0 text-gray-800">Hard Driver</h1>
    </div>

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update Hard Driver
                        <a href="{{route('harddriver-list')}}" class="float-right">Back</a>
                    </div>
           
               
                <div class="card-body">
                    <form method="POST" action="{{ route('harddriver-update',$hardDriver->slug) }}" >
                        @csrf
                        @method('PUT')
    
                        <div class="form-group">
                            <h6>Name</h6>
                            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name',$hardDriver->name) }}"
                                required autocomplete="name" autofocus id="exampleInputName"
                                placeholder="harddriver -name">
    
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
    
                        </div>

                        <input type="hidden" name="slug" value="{{$hardDriver->slug}}"/>

                        <div class="form-group">
                            <h6>Cổng</h6>
                            <input type="text" class="form-control form-control-user @error('gate') is-invalid @enderror" name="gate" value="{{ old('gate',$hardDriver->gate) }}"
                                required autocomplete="name" autofocus id="exampleInputName"
                                placeholder="Harddrive gate">

                            @error('gate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h6>Tốc độ đọc dữ liệu</h6>
                            <input type="text" class="form-control form-control-user @error('readingSpeed') is-invalid @enderror" name="readingSpeed" value="{{ old('readingSpeed',$hardDriver->readingSpeed) }}"
                                required autocomplete="name" autofocus id="exampleInputName"
                                placeholder="Harddrive readingSpeed">

                            @error('readingSpeed')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h6>Điện năng sử dụng</h6>
                            <input type="text" class="form-control form-control-user @error('electricUsed') is-invalid @enderror" name="electricUsed" value="{{ old('electricUsed',$hardDriver->electricUsed) }}"
                                required autocomplete="name" autofocus id="exampleInputName"
                                placeholder="Harddrive electricUsed">

                            @error('electricUsed')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">

                            <h6>Description</h6>

                            <input type="text" class="form-control form-control-user @error('desc') is-invalid @enderror" name="desc" value="{{ old('desc',$hardDriver->desc) }}"
                                required autocomplete="name" autofocus id="exampleInputName"
                                placeholder="Mô tả">

                            @error('desc')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <input type="hidden" name="status" value="{{$hardDriver->status}}"/>

                        <hr>

                        <div class="">
                            <div class="">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('Update cpus') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection