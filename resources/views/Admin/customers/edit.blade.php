@extends('Admin.home')

@section('admin_content')

    <div class="d-sm-flex align-items-center justify-content-between mb4">
        <h1 class="h3 mb-0 text-gray-800">Customer</h1>
    </div>

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update Customer
                        <a href="{{route('customer-list')}}" class="float-right">Back</a>
                    </div>
           
               
                <div class="card-body">
                    <form method="POST" action="{{ route('customer-update',$customer->id) }}" >
                        @csrf
                        @method('PUT')
    
                        <div class="form-group">
                            <h6>Name</h6>
                            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name',$customer->name) }}"
                                required autocomplete="name" autofocus id="exampleInputName"
                                placeholder="customer -name">
    
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
    
                        </div>

                        <div class="form-group">
                            <h6>Email</h6>
                            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email',$customer->email) }}"
                                required autocomplete="name" autofocus id="exampleInputName"
                                placeholder="abc@gmail.com">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h6>Password</h6>
                            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" value="{{ old('password',$customer->password) }}"
                                required autocomplete="name" autofocus id="exampleInputName"
                                placeholder="">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            
                            <img with="50" height="50" src="{{"/storage/$customer->image"}}" alt="">

                            <input type="file" class="form-control form-control-user @error('image') is-invalid @enderror" name="image" value=""
                                required autocomplete="name" autofocus id="exampleInputName" accept="image/*"
                                onchange="showFile(event)">

                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <h6>Phone</h6>
                            <input type="number" class="form-control form-control-user @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone',$customer->phone) }}"
                                required autocomplete="name" autofocus id="exampleInputName"
                                placeholder="">

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h6>Addres</h6>
                            <input type="text" class="form-control form-control-user @error('address') is-invalid @enderror" name="address" value="{{ old('address',$customer->address) }}"
                                required autocomplete="name" autofocus id="exampleInputName"
                                placeholder="">

                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <input type="hidden" name="status" value="{{$customer->status}}"/>

                        <hr>

                        <div class="">
                            <div class="">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('Update Customer') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection