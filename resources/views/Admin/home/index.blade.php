@extends('Admin.home')
@section('admin_content')
    

<div class="container-fluid">
    <div class="row"style="font-family: 'Times New Roman', Times, serif;">
       
        <div class="outer-w3-agile col-xl" >
            <div class="stat-grid p-3 d-flex align-items-center justify-content-between" >
                <div class="s-l">
                    <h5>Nhân Viên</h5>
                    
                </div>
                <div class="s-r">
                    <h6>{{$count['admin'] ??''}}
                        <i class="fa fa-users"></i>
                    </h6>
                </div>
            </div>
            <div class="stat-grid p-3 mt-3 d-flex align-items-center justify-content-between">
                <div class="s-l">
                    <h5>Khách Hàng</h5>
                    
                </div>
                <div class="s-r">
                    <h6>{{$count['customer']??''}}
                        <i class="fa fa-users"></i>
                    </h6>
                </div>
            </div>

          
            <div class="stat-grid p-3 mt-3 d-flex align-items-center justify-content-between">
                <div class="s-l">
                    <h5>Thương Hiệu</h5>
                   
                </div>
                <div class="s-r">
                    <h6>{{$count['brand']??''}}
                        <i class="far fa-list-alt"></i>
                    </h6>
                </div>
            </div>
            <div class="stat-grid p-3 mt-3 d-flex align-items-center justify-content-between">
                <div class="s-l">
                    <h5>Sản Phẩm</h5>
                    
                </div>
                <div class="s-r">
                    <h6>{{$count['product']??''}}
                        <i class="fas fa-list-alt"></i>
                    </h6>
                </div>
            </div>
            
        </div>
    </div>
</div>


@endsection