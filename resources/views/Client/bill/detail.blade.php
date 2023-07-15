@extends('client.index')

@section('content')



<div class="outer-w3-agile col-xl mt-3">
    <h4 class="tittle-w3-agileits mb-4" style="font-family: 'Times New Roman', Times, serif;"><center>Chi Tiết Hóa Đơn</center></h4>
    <hr>
    
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-3">
            <b>ID Hoa Don:</b>
        </div>
        <div class="col-sm-7">
            <p>{{$bill->bill_number}}</p>
        </div>
        <br><br>
        <div class="col-sm-2"></div>
        <div class="col-sm-3">
            <b>Tên Khách Hàng:</b>
        </div>
        <div class="col-sm-7">
            <p>{{$bill->customer->name}}</p>
        </div>
        <br><br>
        <div class="col-sm-2"></div>
        <div class="col-sm-3">
            <b>Tổng Tiền:</b>
        </div>
        <div class="col-sm-7">
            <p><?php echo number_format($bill->total_price);  ?></p>
        </div>
        <br><br>
        <div class="col-sm-2"></div>
        <div class="col-sm-3">
            <b>Voucher:</b>
        </div>
        <div class="col-sm-7">
            <p><?php echo $bill->voucher->code??'Không có ';
            echo '<b> (';
            echo $bill->voucher->value ?? 0;
            echo '%)</b>';  ?></p>
        </div>
        <br><br>
        <div class="col-sm-2"></div>
        <div class="col-sm-3">
            <b>Thành Tiền:</b>
        </div>
        <div class="col-sm-7">
            <p><?php echo number_format($bill->price_checkout);  ?></p>
        </div>
        <br><br>
        <div class="col-sm-2"></div>
        <div class="col-sm-3">
            <b>Trạng Thái:</b>
        </div>
        <div class="col-sm-7">
            <?php
            if($bill->status == 1)
            { ?>
                Chưa Xác Nhận 
                <a href='{{route("view-order-delete",$bill->id)}}' class='btn btn-danger'>Hủy Đơn Hàng</a>
            <?php }
            else if($bill->status == 2)
            {
            ?>
                Đã Xác Nhận 
            <?php }
            else if($bill->status == 3)
            {
                echo 'Thành Công';
            }
            else if($bill->status == -1)
            {
                echo 'Đã Hủy';
                ?>
                 <a href='{{route("view-order-restore",$bill->id)}}' class='btn btn-danger'>Khôi Phục Đơn Hàng</a>
                <?php
            }
            ?>
        </div>  
    </div>
    <br><br>
    <div class="container">
        <table class="table table-hover">
            <thead style="background-color:lightgrey;">
                <th>Hình ảnh</th>
                <th >Tên Sản Phẩm</th>
                
                <th >Số Lượng</th>

                <th >Giá</th>
            </thead>
            <tbody>
            @foreach($bill->detail_bill as $detail_bill)
                <tr >
                    <td>
                        <img src="{{ asset('storage') }}/{{$detail_bill->product->image}}" alt="" style="
                        object-fit: contain;
                        width: 100px;
                        height: 100px;
                    ">
                    </td>
                    <td>{{$detail_bill->product->name}}</td>
                    <td>{{$detail_bill->quantity}}</td>
                    <td><?php echo number_format($detail_bill->price).'đ'; ?></td>
                   
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection