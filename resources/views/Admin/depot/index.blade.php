@extends('Admin.home')
@section('admin_content')
    
     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kho Hàng</h1>
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



    <form action="{{route('post-list-depot')}}" method="POST">
        @csrf
        <div class="card-body">
            <table id="myTable" class="table">
                <thead>
                    <tr>
                     
                        <th scope="col">STT</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Giá Nhập</th>
                        <th scope="col">Giá Bán</th>
                        <th scope="col">Số lượng tồn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_product as $product)
                    
                        <tr>
                            <th scope="row">{{$product->id}}</th>
                            <td>{{$product->name}}</td>
                            <td>{{$product->in_price}}</td>
                            <td>{{$product->out_price}}</td>
                            <td>{{$product->quantity}}</td>
                            

                    @endforeach
                </tbody>
            </table>
          

        </div>
    </form>

    <!-- Content Row -->



@endsection