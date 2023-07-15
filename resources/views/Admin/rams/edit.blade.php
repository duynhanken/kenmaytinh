@extends('Admin.home')

@section('admin_content')

    <div class="d-sm-flex align-items-center justify-content-between mb4">
        <h1 class="h3 mb-0 text-gray-800">RAM</h1>
    </div>

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update RAM
                        <a href="{{route('ram-list')}}" class="float-right">Back</a>
                    </div>
           
               
                <div class="card-body">
                    <form method="POST" action="{{ route('ram-update',$ram->slug) }}" >
                        @csrf
                        @method('PUT')
    
                        <div class="form-group">
                            <h6>Name</h6>
                            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name',$ram->name) }}"
                                required autocomplete="name" autofocus id="exampleInputName"
                                placeholder="ram -name">
    
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
    
                        </div>

                        <input type="hidden" name="slug" value="{{$ram->slug}}"/>


                        <div class="form-group">

                            <h6>Description</h6>

                            <input type="text" class="form-control form-control-user @error('desc') is-invalid @enderror" name="desc" value="{{ old('desc',$ram->desc) }}"
                                required autocomplete="name" autofocus id="exampleInputName"
                                placeholder="Mô tả">

                            @error('desc')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <input type="hidden" name="status" value="{{$ram->status}}"/>

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