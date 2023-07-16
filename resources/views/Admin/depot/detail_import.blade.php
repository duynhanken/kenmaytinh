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
                    <h5 class="h3 mb-0 text-gray-800">Phiếu Nhập Hàng</h5>    
                    <div class="card-body">
                        <div class="form-group">
                            <label >Nhân Viên Lập</label>
                            <input type="text" readonly class="form-control" value="{{$bill_import->user->name}}">
                        </div>    
                        
                        <div class="form-group">
                            <label >Ngày Nhập</label>
                            <input type="text" readonly class="form-control" value="{{$bill_import->date_create}}">                    
                        </div>                
                        <div class="form-group">
                            <div class="">
                                <label >Tổng Tiền</label>
                                <input type="text" readonly class="form-control" value="<?php echo number_format($bill_import->total_price);  ?>">                    
                            </div>
                        </div>
                             <div class="col-sm-6"><a class="btn btn-primary" href="{{route('cancel-depot',$bill_import->id)}}" style="margin-top: 20px;width:100%;">Hủy</a></div>
                             <div class="col-sm-6"><a class="btn btn-primary" href="{{route('payment-depot',$bill_import->id)}}" style="margin-top: 20px;width:100%;">Thanh Toán</a></div>
                    </div>
                </div>

                <div class="outer-w3-agile col-xl mt-3">
                    <h4 class="tittle-w3-agileits mb-4" style="font-family: 'Times New Roman', Times, serif;">Chi Tiết Phiếu Nhập Hàng</h4>
                    <div class="btn btn-outline-secondary" style="margin-bottom:10px;" data-toggle="modal" data-target="#import_product">Nhập Sản Phẩm</div>
                    <table class="table table-hover">
                        <thead style="background-color:lightgrey;">
                            <th></th>
                            <th style="width:50%;">Sản Phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá Nhập</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($bill_import->detail_bill_import ?? '' as $detail_bill)
                            <tr>
                                <td></td>
                                <td>{{$detail_bill->product->name}}</td>
                                <td>{{$detail_bill->quantity}}</td>
                                <td>{{$detail_bill->price}}</td>
                                <td>
                               
                                {{-- <a href="" onclick="return confirm('Bạn có chắc muốn ');" ><label class="fa fa-trash">Xóa</label></a> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                

                <div class="modal fade" id="import_product" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Nhập Sản Phẩm</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="{{route('post-detail-bill-import-depot')}}" method="post">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="id_bill_import" value="{{$bill_import->id}}">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Sản Phẩm</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="product_id" >
                                        @foreach($list_product as $product)
                                            <option value="{{$product->id}}">{{$product->name}}</option>  
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" >Số lượng nhập</label>
                                    <input type="number" name="quantity" class="form-control" id="exampleFormControlInput1" placeholder="" required="" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" >Giá nhập</label>
                                    <input type="number" name="price" class="form-control" id="exampleFormControlInput1" placeholder="" required="" >
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-primary">Nhập</button>
                            </div>

                        </form>
                          
                        
                      </div>
                    </div>
                  </div>
                    
            </div>
        </div>
    </div>
    
        
        <div class="col-xl-12 col-lg-7">
            <div class="row">
                <div class="card mx-auto">
                    
                </div>
            </div>
        </div>

    </div>


@endsection