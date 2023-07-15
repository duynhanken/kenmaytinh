@extends('Admin.home')
@section('admin_content')
    
     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Nhập Hàng</h1>
    </div>


    <!-- Content Row -->

    <div class="row">
        <div class="col-xl-12 col-lg-7">
            <div class="row">
                <div class="card mx-auto">
        
                    <form action="{{route('post-bill-import-depot')}}" method="post" >
                        @csrf
                        
                        <input type="hidden" name="users_id" class="form-control" value="{{Auth::user()->id}}">
                        
                        <div class="">
                            <button type="submit" class="form-control btn btn-primary">Lập Phiếu Nhập Hàng</button>
                        </div>
                        
                </div>
            </div>
        </div>
    </div>
     
        
    </div>


@endsection