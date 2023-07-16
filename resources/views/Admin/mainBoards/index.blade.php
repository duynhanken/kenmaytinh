@extends('Admin.home')
@section('admin_content')
    
     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Mainboard</h1>
    </div>


    <div>
        <a href="{{route('mainBoard-create')}}" class="btn btn-primary mb-2">Create</a>
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


    <form action="{{route('process-all-mainBoard')}}" method="POST">
        @csrf
        <div class="card-body">
            <table  id="myTable" class="table">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="checkAll" onClick="toggle(this)"></th>
                        <th scope="col">STT</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Mô Tả</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mainBoards as $mainBoard)
                    
                        <tr>
                            <td><input type="checkbox" name="mbID[]" value="{{$mainBoard->id}}"></td>
                            <th scope="row">{{$mainBoard->id}}</th>
                            <td>{{$mainBoard->name}}</td>
                            <td>{{$mainBoard->desc}}</td>
                            <td>
                                <?php
                                if($mainBoard->status ==0) { ?>
                                    <a href="{{route('active-mainBoards',$mainBoard->id)}}"><span class="fa fa-lock"></span></a>
                                <?php }else{ ?>
                                    <a href="{{route('unactive-mainBoards',$mainBoard->id)}}"><span class="fa fa-unlock-alt"></span></a>
                                <?php } ?>                
                            </td>
                            
                            {{-- <td>

                                <a href="{{route('view-product-mainBoard',$mainBoard->id)}}">
                                    <label class="fa fa-eye"></label>
                                </a>

                            </td> --}}

                            <td>
                                <a href="{{route('mainBoard-edit',$mainBoard->slug)}}" class="btn btn-success">Edit</a>
                            </td>
                            <td>
                                <a href="{{route('mainBoard-destroy',$mainBoard->id)}}" class="btn btn-danger" onclick="return confirm('Are you want delete {{$mainBoard->name}} ?');">Delete</a>
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
            {{-- {{ $mainBoards->links() }} --}}
        </div>
    </form>
    <!-- Content Row -->


    <script>
        function toggle(source){
            checkboxes = document.getElementsByName('mbID[]');
            for(var i=0,n= checkboxes.length;i<n;i++){
                checkboxes[i].checked = source.checked;
            }
        }
    </script>
@endsection