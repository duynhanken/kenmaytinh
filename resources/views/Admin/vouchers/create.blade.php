@extends('Admin.home')

@section('admin_content')

    <div class="d-sm-flex align-items-center justify-content-between mb4">
        <h1 class="h3 mb-0 text-gray-800">Voucher</h1>
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
                                        <h1 class="h4 text-gray-900 mb-4">Create Voucher</h1>
                                    </div>
                                    <form method="POST" action="{{ route('voucher-store') }}" enctype="multipart/form-data">
                                        @csrf
                                        
                                        <div class="form-group">
                                            <h6>Voucher Code</h6>
                                            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="code" value="{{ old('code') }}"
                                                required autocomplete="code" autofocus id="exampleInputName"
                                                placeholder="">
            
                                            @error('code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <h6>Giá Trị(%)</h6>
                                            <input type="number" class="form-control form-control-user @error('value') is-invalid @enderror" name="value" value="{{ old('value') }}"
                                                required autocomplete="name" autofocus id="exampleInputName"
                                                placeholder="">
            
                                            @error('value')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <h6>Số Lượng:</h6>
                                            <input type="number" class="form-control form-control-user @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}"
                                                required autocomplete="name" autofocus id="exampleInputName"
                                                placeholder="">
            
                                            @error('quantity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <h6>Ngày Bắt Đầu</h6>
                                            <input type="date" class="form-control form-control-user @error('date_start') is-invalid @enderror" name="date_start" value="{{ old('date_start') }}"
                                                required autocomplete="name" autofocus id="exampleInputName"
                                                placeholder="">
            
                                            @error('date_start')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        
                                        <div class="form-group">
                                            <h6>Ngày Kết Thúc</h6>
                                            <input type="date" class="form-control form-control-user @error('date_end') is-invalid @enderror" name="date_end" value="{{ old('date_end') }}"
                                                required autocomplete="name" autofocus id="exampleInputName"
                                                placeholder="">
            
                                            @error('date_end')
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
                                                    {{ __('Create Voucher') }}
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