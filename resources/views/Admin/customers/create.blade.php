@extends('Admin.home')

@section('admin_content')

    <div class="d-sm-flex align-items-center justify-content-between mb4">
        <h1 class="h3 mb-0 text-gray-800">Customer</h1>
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
                                        <h1 class="h4 text-gray-900 mb-4">Create Customer</h1>
                                    </div>
                                    <form method="POST" action="{{ route('customer-store') }}" enctype="multipart/form-data">
                                        @csrf
                                        
                                        <div class="form-group">
                                            <h6>Name</h6>
                                            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                                                required autocomplete="name" autofocus id="exampleInputName"
                                                placeholder="">
            
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <h6>Email</h6>
                                            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
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
                                            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}"
                                                required autocomplete="name" autofocus id="exampleInputName"
                                                placeholder="">
            
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            
                                            <img src="" alt="" class="img-product" id="file-preview"/> 

                                            <input type="file" class="form-control form-control-user @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}"
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
                                            <input type="number" class="form-control form-control-user @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"
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
                                            <input type="text" class="form-control form-control-user @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}"
                                                required autocomplete="name" autofocus id="exampleInputName"
                                                placeholder="">
            
                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            {{-- <label for="exampleFormControlSelect1">Trạng Thái</label> --}}
                                            <select class="form-control" id="exampleFormControlSelect1" name="status" >
                                                <option selected>Bạn có muốn kích hoạt Lĩnh Vực</option>
                                                <option value="1">Kích Hoạt</option>
                                                <option value="0">Không Kích Hoạt</option>
                                            </select>
                                        </div>
                                        


                                            <hr>

                                        <div class="">
                                            <div class="">
                                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                                    {{ __('Create Customer') }}
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

    <script>
        function showFile() 
        {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function()
                {
                    var dataURL = reader.result;
                    var output = document.getElementById('file-preview');
                    output.src = dataURL;
                }
            reader.readAsDataURL(input.files([0]));
        }
    </script>
    

@endsection