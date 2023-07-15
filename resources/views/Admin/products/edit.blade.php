@extends('Admin.home')

@section('admin_content')

    <div class="d-sm-flex align-items-center justify-content-between mb4">
        <h1 class="h3 mb-0 text-gray-800">Sản Phẩm</h1>
    </div>

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update Products
                        <a href="{{route('product-list')}}" class="float-right">Back</a>
                    </div>
           
               
                <div class="card-body">
                    <form method="POST" action="{{ route('product-update',$product->slug) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
    
                        <div class="form-group">
                            <h6>Tên Sản Phẩm</h6>
                            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name',$product->name) }}"
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
                            <input type="text" class="form-control form-control-user @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug',$product->slug) }}"
                                required autocomplete="slug" autofocus id="exampleInputName"
                                placeholder="slug">
    
                            @error('slug')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
    
                        </div>


                        <div class="form-group">

                            <select name="brand_id" class="form-control" aria-label="Default select example">
                                <option selected>Open this select menu Brand</option>

                               @foreach ($list_brand as $brand)

                                    @if ($brand->id ==$product->brand_id)
                                            <option value="{{$brand->id}}" selected>{{$brand->name}}</option>
                                    @else
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endif
                               
                               @endforeach
                               
                              </select>

                            @error('brand_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">

                            <select name="ram_id" class="form-control" aria-label="Default select example">
                                <option selected>Open this select menu Ram</option>

                               @foreach ($list_rams as $ram)

                                    @if ($ram->id ==$product->ram_id)
                                            <option value="{{$ram->id}}" selected>{{$ram->name}}</option>
                                    @else
                                            <option value="{{$ram->id}}">{{$ram->name}}</option>
                                    @endif
                               
                               @endforeach
                               
                              </select>

                            @error('ram_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">

                            <select name="cpu_id" class="form-control" aria-label="Default select example">
                                <option selected>Open this select menu Cpu</option>

                               @foreach ($list_cpus as $cpu)

                                    @if ($cpu->id ==$product->cpu_id)
                                            <option value="{{$cpu->id}}" selected>{{$cpu->name}}</option>
                                    @else
                                            <option value="{{$cpu->id}}">{{$cpu->name}}</option>
                                    @endif
                               
                               @endforeach
                               
                              </select>

                            @error('cpu_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">

                            <select name="hard_driver_id" class="form-control" aria-label="Default select example">
                                <option selected>Open this select menu Hard Drive</option>

                               @foreach ($list_harddrives as $harddrive)

                                    @if ($harddrive->id ==$product->hard_driver_id)
                                            <option value="{{$harddrive->id}}" selected>{{$harddrive->name}}</option>
                                    @else
                                            <option value="{{$harddrive->id}}">{{$harddrive->name}}</option>
                                    @endif
                               
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
                            <img with="50" height="50" src="{{"/storage/$product->image"}}" alt="">
                            <input type="file" class="form-control form-control-user @error('image') is-invalid @enderror" name="image"
                                required autocomplete="name" autofocus id="exampleInputName"
                                onchange="preview_image(event,'output_image')">

                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h6>Giá Bán</h6>
                            <input type="text" class="form-control form-control-user @error('out_price') is-invalid @enderror" name="out_price" value="{{ old('out_price',$product->out_price) }}"
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
                            <textarea  id="editor" class="form-control " rows="5" required=""  name="desc" value="{{ old('desc',$product->desc) }}">

                            </textarea>
                            {{-- <input type="text" class="form-control form-control-user @error('desc') is-invalid @enderror" name="desc" value="{{ old('desc',$product->desc) }}"
                                required autocomplete="name" autofocus id="exampleInputName"
                                placeholder=""> --}}

                            @error('desc')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <input type="hidden" name="status" value="{{$product->status}}"/>

                        <hr>

                        <div class="">
                            <div class="">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('Update Product') }}
                                </button>
                            </div>
                        </div>
                    </form>
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