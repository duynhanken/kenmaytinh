@extends('Admin.home')

@section('admin_content')

    <div class="d-sm-flex align-items-center justify-content-between mb4">
        <h1 class="h3 mb-0 text-gray-800">Voucher</h1>
    </div>

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update Voucher
                        <a href="{{route('voucher-list')}}" class="float-right">Back</a>
                    </div>
           
               
                <div class="card-body">
                    <form method="POST" action="{{ route('voucher-update',$voucher->id) }}" >
                        @csrf
                        @method('PUT')
    
                        <div class="form-group">
                            <h6>Voucher Code</h6>
                            <input type="text" class="form-control form-control-user @error('code') is-invalid @enderror" name="code" value="{{ old('code',$voucher->code) }}"
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
                            <input type="number" class="form-control form-control-user @error('value') is-invalid @enderror" name="value" value="{{ old('value',$voucher->value) }}"
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
                            <input type="number" class="form-control form-control-user @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity',$voucher->quantity) }}"
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
                            <input type="date" class="form-control form-control-user @error('date_start') is-invalid @enderror" name="date_start" value="{{ old('date_start',$voucher->date_start) }}"
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
                            <input type="date" class="form-control form-control-user @error('date_end') is-invalid @enderror" name="date_end" value="{{ old('date_end',$voucher->date_end) }}"
                                required autocomplete="name" autofocus id="exampleInputName"
                                placeholder="">

                            @error('date_end')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        

                        <input type="hidden" name="status" value="{{$voucher->status}}"/>

                        <hr>

                        <div class="">
                            <div class="">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('Update Voucher') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection