@extends('client.index')


@section('content')


<div class="conatiner">
    
<div class="card">
    <div class="card-header">
        <h5>Account Details</h5>
    </div>
    <div class="card-body">
        {{-- <p>Already have an account? <a href="login.html">Log in instead!</a></p> --}}
        <form method="POST" action="{{ route('updateAccount', Auth::guard('customer')->user()->number) }}" >
            @csrf
            @method('PUT')
            <div class="row">
                
                <div class="form-group col-md-12">
                    <label>Name <span class="required">*</span></label>
                    <input required="" class="form-control square" name="name" value="{{ old('name',Auth::guard('customer')->user()->name) }}" type="text">
                </div>
                <div class="form-group col-md-12">
                            
                    <img with="50" height="50" src="{{ asset('storage') }}/{{Auth::guard('customer')->user()->image}}" alt="">

                    <input type="file" class="form-control square" name="image" value=""
                        required autocomplete="name" autofocus id="exampleInputName" accept="image/*"
                        onchange="showFile(event)">
                </div>
                <div class="form-group col-md-12">
                    <label>Phone <span class="required">*</span></label>
                    <input required="" class="form-control square" name="phone" value="{{ old('phone',Auth::guard('customer')->user()->phone) }}" type="number">
                </div>
                <div class="form-group col-md-12">
                    <label>Address <span class="required">*</span></label>
                    <input required="" class="form-control square" name="address" value="{{ old('address',Auth::guard('customer')->user()->address) }}" type="text">
                </div>
                <input type="hidden" name="status" value="{{Auth::guard('customer')->user()->status}}"/>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-fill-out submit" name="submit" value="Submit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

</div>

@endsection