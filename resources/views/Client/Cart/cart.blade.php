@extends('client.index')

@section('content')

<main class="main">
    
    <section class="mt-50 mb-50">
        <div class="container"> 
            <?php
            $message = Session::get('message');
            if($message)
            {
                echo '<div class="alert">
                <span id ="close"class="closebtn" onclick="this.parentElement.style.display='."'none'".';">&times;</span>'.$message.'</div>';
                Session::put('message',null);
            }
        ?>
            
          
            <div class="row">
                <div class="col-md-6">
                   <div class="order_review">
                    <div class="mb-25">
                        <h4> Thông Tin Đặt Hàng</h4>
                    </div>
                    <form action="{{route('checkout')}}" method="post">
                        @csrf
                        <input type="hidden" name="bill_id" value="{{$bill->id}}">
                        <div class="form-group">
                            
                            <input required="" value="{{$bill->name}}" type="text" name="name" placeholder="First name *">
                        </div>
                        {{-- <div class="form-group">
                            <input type="text" required="" name="lname" placeholder="Last name *">
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="cname" placeholder="Company Name">
                        </div>
                         --}}
                        <div class="form-group">
                            <input required="" type="text" value="{{$bill->address}}" name="address" placeholder="Address *">
                        </div>
                        {{-- <div class="form-group">
                            <input type="text" name="billing_address2" required="" placeholder="Address line2">
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="city" placeholder="City / Town *">
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="state" placeholder="State / County *">
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="zipcode" placeholder="Postcode / ZIP *">
                        </div> --}}
                        <div class="form-group">
                            <input type="text" value="{{$bill->phone}}" title="Điện thoại" name="phone"  placeholder="Phone *">
                        </div>
                        {{-- <div class="form-group">
                            <input required="" type="text" name="email" placeholder="Email address *">
                        </div> --}}
                        <div class="form-group">
                            <div class="checkbox">
                                {{-- <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="createaccount">
                                    <label class="form-check-label label_info" data-bs-toggle="collapse" href="#collapsePassword" data-target="#collapsePassword" aria-controls="collapsePassword" for="createaccount"><span>Create an account?</span></label>
                                </div> --}}
                            </div>
                        </div>
                        {{-- <div id="collapsePassword" class="form-group create-account collapse in">
                            <input required="" type="password" placeholder="Password" name="password">
                        </div> --}}
                        <div class="ship_detail">
                            <div class="form-group">
                                <div class="chek-form">
                                    
                                </div>
                            </div>
                           
                        </div>
                        <div class="mb-20">
                            <h5>Ghi chú</h5>
                        </div>
                        <div class="form-group mb-30">
                            <textarea id="ghichu" class="md-textarea form-control" rows="3" placeholder="Ghi Chú" name="desc">{{$bill->desc}}</textarea>
                        </div>

                        <span>
                            <hr>
                            <div class="row">
                                <div class="col"><b>Tổng Tiền:</b> <?php echo number_format($bill->total_price).'đ' ?></div>
                            </div>
                            
                            <div class="row">
                                <div class="col"><b>Mã Giảm Giá:</b> <?php echo $bill->voucher->code ??'Không có';
                                echo ' <b>(';
                                echo $bill->voucher->value ?? 0;
                                echo '%)</b>'; ?></div>
                            </div>
                            
                            <div class="row">
                                <div class="col"><b>Thành Tiền:</b><?php echo number_format($bill->price_checkout).'đ' ?> </div>
                            </div>
                            <hr>
                        </span>
                        <span>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-outline-secondary btn-block">Đặt Hàng</button>
                                </div>
                            </div>
                        </span>
                    </form>
                   </div>
                </div>
                <div class="col-md-6">
                    <div class="order_review">
                        <div class="mb-20">
                            <h4>Đơn Hàng Của Bạn</h4>
                        </div>
                        <form action="{{route('updateQuantity')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id_bill" value="{{$bill->id}}">
                            <input type="hidden" name="tong_soluong_sp" value="2"/>
                            <div class="table-responsive order_table text-center">
                               
                                <table class="table">
                                    <thead>
                                        <tr>
                                           
                                            <th colspan="2">Sản Phẩm</th>
                                            <th>Số Lượng</th>
                                            <th>Giá Tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bill->detail_bill as $detail_bill)
                                        <tr>
                                            <td class="image product-thumbnail"><img src="{{ '/storage/'.$detail_bill->product->image }}" alt="#"></td>
                                            <td>
                                                <h5><a href=""> <p id="ten_sp_gio_hang" style="
                                                    display: -webkit-box;
                                                    max-width: 200px;
                                                    -webkit-line-clamp: 1;
                                                    -webkit-box-orient: vertical;
                                                    overflow: hidden;
                                                    text-overflow: ellipsis;
                                                ">{{$detail_bill->product->name}}</p></a></h5>
                                            </td>
                                            <td>
                                                <p id="sl_sp_giohang">
                                                    <input type="number" value="{{$detail_bill->quantity}}" min="1" max="{{$detail_bill->product->quantity}}" name="quantity_{{$detail_bill->product->id}}" >
                                                </p>
                                            </td>
                                            <td><p id="gia_sp_gio_hang"><?php echo number_format($detail_bill->price).'đ' ?></p></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                               
                                <span>
                                    <button type="submit" class="btn btn-outline-secondary btn-block">Cập Nhật Giỏ Hàng</button>
                                </span>
                            </div>
                        </form>
                       
                        <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                        <div class="payment_method">
                            <div class="mb-25">
                                <h5>Voucher</h5>
                            </div>
                            <div class="payment_option">
                               <form action="{{route('updateVoucher')}}" method="post">
                                    {{csrf_field()}}
                                        <div class="form-group">
                                            <input type="hidden" name ="bill_id" value="{{$bill->id}}">
                                            <input class="form-control" name="voucher">
                                        </div>
                                        <button type="submit" class="btn btn-outline-secondary btn-block">Nhập Mã Giảm Giá</button>
                                    </form>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    setTimeout(function() {
        var btn = document.getElementById('close');
        btn.click();
}, 4000);
</script>

@endsection