@extends('Admin.home')

@section('admin_content')

    <div class="d-sm-flex align-items-center justify-content-between mb4">
        <h1 class="h3 mb-0 text-gray-800">Sản Phẩm</h1>
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
                                        <h1 class="h4 text-gray-900 mb-4">Create Products</h1>
                                    </div>
                                    <form method="POST" action="{{ route('product-store') }}" enctype="multipart/form-data">
                                        @csrf
                                        
                                        <div class="form-group">
                                            <h6>Tên Sản Phẩm</h6>
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
                                            <h6>Slug</h6>
                                            <input type="text" class="form-control form-control-user @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug') }}"
                                                required autocomplete="slug" autofocus id="exampleInputName"
                                                placeholder="">
            
                                            @error('slug')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <h6>Nhãn Hiệu</h6>
                                            <select name="brand_id" class="form-control" aria-label="Default select example">
                                                <option selected>Open this select menu Brand</option>

                                               @foreach ($brands as $brand)
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                               @endforeach
                                               
                                              </select>
            
                                            @error('brand_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <h6>Ram</h6>
                                            <select name="ram_id" class="form-control" aria-label="Default select example">
                                                <option selected>Open this select menu Ram</option>

                                               @foreach ($rams as $ram)
                                                <option value="{{$ram->id}}">{{$ram->name}}</option>
                                               @endforeach
                                               
                                              </select>
            
                                            @error('ram_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        
                                        <div class="form-group">
                                            <h6>CPU</h6>
                                            <select name="cpu_id" class="form-control" aria-label="Default select example">
                                                <option selected>Open this select menu Cpu</option>

                                               @foreach ($cpus as $cpu)
                                                <option value="{{$cpu->id}}">{{$cpu->name}}</option>
                                               @endforeach
                                               
                                              </select>
            
                                            @error('cpu_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        
                                        <div class="form-group">
                                            <h6>Ổ cứng</h6>
                                            <select name="hard_driver_id" class="form-control" aria-label="Default select example">
                                                <option selected>Open this select menu Hard Driver</option>

                                               @foreach ($harddrives as $harddrive)
                                                <option value="{{$harddrive->id}}">{{$harddrive->name}}</option>
                                               @endforeach
                                               
                                              </select>
            
                                            @error('hard_driver_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <h6>Hình Ảnh</h6>
                                            
                                            <img id="output_image" src="{!! asset('admin-asset/images/2Nlogo.jpg')!!}" class="img-thumbnail" style="width: 100px;"/>
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input" id="exampleFormControlInput1" onchange="preview_image(event,'output_image')" />
                                                <label class="custom-file-label" for="exampleFormControlInput1" >Chọn Ảnh</label>
                                            </div>
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <h6>Giá Bán</h6>
                                            <input type="number" class="form-control form-control-user @error('out_price') is-invalid @enderror" name="out_price" value="{{ old('out_price') }}"
                                                required autocomplete="name" autofocus id="exampleInputName"
                                                placeholder="">
            
                                            @error('out_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <h6>Mô tả</h6>
                                            <textarea  id="editor" class="form-control " rows="5" required=""  name="desc" value="{{ old('desc') }}">

                                            </textarea>
                                           
            
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
                                                    {{ __('Create Products') }}
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
    <script type='text/javascript'>
        function preview_image(event,$id) 
        {
         var reader = new FileReader();
         reader.onload = function()
         {
          var output = document.getElementById($id);
          output.src = reader.result;
         }
         reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection