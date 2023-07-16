@extends('Admin.home')
@section('admin_content')
    
     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh Sách Hóa Đơn</h1>
    </div>


    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-7">
            <div class="row">
                <div class="card mx-auto">
        
                    <div>
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{session('message')}}
                            </div>
                        @endif
                    </div>
                      
                    
                    
                    <form action="{{route('post-list-bill')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <table class="table" id="">
                                <thead>
                                    <tr>
                                     
                                        <th scope="col">STT</th>
                                        <th scope="col">Tên Khách Hàng</th>
                                        <th scope="col">Thành Tiền</th>
                                        <th scope="col">Trạng Thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_bills as $bill)
                                    
                                        <tr>
                                            <th scope="row">{{$bill->id}}</th>
                                            <td>{{$bill->customer->name}}</td>
                                            <td><?php echo number_format($bill->price_checkout).'đ'; ?></td>
                                            <td>
                                                <?php 
                                                if($bill->status == 1)
                                                {
                                                    echo 'Chưa Xác Nhận';
                                                }
                                                else if($bill->status == 2)
                                                {
                                                    echo 'Đã Xác Nhận';
                                                }
                                                else if($bill->status == 3)
                                                {
                                                    echo 'Thành Công';
                                                }
                                                else if($bill->status == 4)
                                                {
                                                    echo 'Đang giao hàng';
                                                }
                                                else if($bill->status == -1)
                                                {
                                                    echo 'Đã Hủy';
                                                }
                                                ?>
                                            </td>
                                            <td><a href="{{route('get-detail-bill',$bill->id)}}" ><label class="fa fa-info-circle">Chi Tiết</label></a></td>
            
                                    @endforeach
                                </tbody>
                            </table>
                           
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>

        
    </div>


@endsection