@extends('Admin.home')
@section('admin_content')
    
     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Voucher</h1>
    </div>

    <div>
        <a href="{{route('voucher-create')}}" class="btn btn-primary mb-2">Create</a>
    </div>


    <div>
        @if (session()->has('message'))
            <div class="alert alert-success"
                style="
                    display: flex;
                    align-items: center;
                    justify-content: center;
                ">
                {{ session('message') }}
            </div>
        @endif
    </div>


    <form action="{{route('process-all-voucher')}}" method="POST">
        @csrf
        <div class="card-body">
            <table  id="myTable" class="table">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="checkAll" onClick="toggle(this)"></th>
                        <th scope="col">STT</th>
                        <th scope="col">Voucher Code</th>
                        <th scope="col">Value(%)</th>
                        <th scope="col">Số Lượng</th>
                        <th scope="col">Ngày Bắt Đầu</th>
                        <th scope="col">Ngày Kết Thúc</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($vouchers as $voucher)
                    
                        <tr>
                            <td><input type="checkbox" name="voucherID[]" value="{{$voucher->id}}"></td>
                            <th scope="row">{{$voucher->id}}</th>
                            <td>{{$voucher->code}}</td>
                            <td>{{$voucher->value}}</td>
                            <td>{{$voucher->quantity}}</td>
                            <td>{{$voucher->date_start}}</td>
                            <td>{{$voucher->date_end}}</td>
                            <td>
                                <?php
                                if($voucher->status ==0) { ?>
                                    <a href="{{route('active-voucher',$voucher->id)}}"><span class="fa fa-lock"></span></a>
                                <?php }else{ ?>
                                    <a href="{{route('unactive-voucher',$voucher->id)}}"><span class="fa fa-unlock-alt"></span></a>
                                <?php } ?>                
                            </td>
                            
                            {{-- <td>

                                <a href="{{route('view-product-voucher',$voucher->id)}}">
                                    <label class="fa fa-eye"></label>
                                </a>

                            </td> --}}

                            <td>
                                <a href="{{route('voucher-edit',$voucher->id)}}" class="btn btn-success">Edit</a>
                            </td>
                            <td>
                                <a href="{{route('voucher-destroy',$voucher->id)}}" class="btn btn-danger" onclick="return confirm('Are you want delete {{$voucher->code}} ?')">Delete</a>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
            <hr>
            <button type="submit" name="action" value="delete" class="btn btn-outline-secondary" onclick="return confirm('Bạn có chắc muốn xóa những thương hiệu đang chọn ??');">Delete</button>
            <button type="submit" name="action" value="active" class="btn btn-outline-secondary">Active</button>
            <button type="submit" name="action" value="unactive" class="btn btn-outline-secondary">Unactive</button>
            <hr>
            {{-- {{ $vouchers->links() }} --}}

        </div>
    </form>

    <!-- Content Row -->

   

    
    <script>
        function toggle(source){

            var checkboxes = [];
            // $('#voucherID').find('input[type=checkbox]:checked').each(function(){
            //     checkboxes.push(this.value);
            // })
            checkboxes = document.getElementsByName('voucherID[]');
            for(var i=0,n= checkboxes.length;i<n;i++){
                checkboxes[i].checked = source.checked;
            }
        }
    </script>

@endsection