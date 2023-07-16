@extends('Admin.home')

@section('admin_content')

    <div class="d-sm-flex align-items-center justify-content-between mb4">
        <h1 class="h3 mb-0 text-gray-800">Card đồ họa</h1>
    </div>

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update Card
                        <a href="{{route('graphicsCard-list')}}" class="float-right">Back</a>
                    </div>
           
               
                <div class="card-body">
                    <form method="POST" action="{{ route('graphicsCard-update',$graphicsCard->slug) }}" >
                        @csrf
                        @method('PUT')
    
                        <div class="form-group">
                            <h6>Tên Mainboard</h6>
                            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name',$graphicsCard->name) }}"
                                required autocomplete="name" autofocus id="exampleInputName"
                                placeholder="graphicsCard -name">
    
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
    
                        </div>

                        <input type="hidden" name="slug" value="{{$graphicsCard->slug}}"/>

                        <div class="form-group">
                            <h6>Loại Card</h6>
                            <input type="text" class="form-control form-control-user @error('cateCard') is-invalid @enderror" name="cateCard" value="{{ old('cateCard',$graphicsCard->cateCard) }}"
                                required autocomplete="name" autofocus id="exampleInputName"
                                placeholder="cateCard">

                            @error('cateCard')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h6>Dung lượng Card</h6>
                            <input type="text" class="form-control form-control-user @error('capacityCard') is-invalid @enderror" name="capacityCard" value="{{ old('capacityCard',$graphicsCard->capacityCard) }}"
                                required autocomplete="name" autofocus id="exampleInputName"
                                placeholder="capacityCard">

                            @error('capacityCard')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h6>Hãng sản xuất Card</h6>
                            <input type="text" class="form-control form-control-user @error('manufacturer') is-invalid @enderror" name="manufacturer" value="{{ old('manufacturer',$graphicsCard->manufacturer) }}"
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

                            <input type="text" class="form-control form-control-user @error('desc') is-invalid @enderror" name="desc" value="{{ old('desc',$graphicsCard->desc) }}"
                                required autocomplete="name" autofocus id="exampleInputName"
                                placeholder="Mô tả">

                            @error('desc')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <input type="hidden" name="status" value="{{$graphicsCard->status}}"/>

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