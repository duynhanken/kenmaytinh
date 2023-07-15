@extends('client.index')

@section('content')

<div class="container" style="
padding: 30px;
">
    <h3><center>Đơn hàng của bạn</center></h3>
    
</div>
<div class="conatiner ">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10 ">
            <table>
                <thead>
                    <tr>
                        <th>Mã hóa đơn</th>
                        <th>Tổng tiền</th>
                        <th>Tình trạng</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bill as $bill)
                    <tr>
                        <td>{{$bill->bill_number}}</td>
                        <td>{{$bill->total_price}}</td>
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
                                else if($bill->status == -1)
                                {
                                    echo 'Đã Hủy';
                                }
                                ?>
                        </td>
                        <td>
                            <a href="{{route('view-order',$bill->id)}}" class="btn btn-primary">View</a>
                        </td>
                    </tr>
                    @endforeach
                  
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection