@extends('Admin.home')
@section('admin_content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Nhãn Hàng</h1>
    </div>

    <div>
        <a href="{{ route('brand-create') }}" class="btn btn-primary mb-2">Create</a>
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

    <form action="{{ route('process-all-brand') }}" method="POST">
        @csrf
        <div class="card-body">
            <table id="myTable" class="table">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="checkAll" onClick="toggle(this)"></th>
                        <th scope="col">STT</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Mô Tả</th>
                        <th scope="col">Hình Ảnh</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                        <tr>
                            <td><input type="checkbox" name="brandID[]" value="{{ $brand->id }}"></td>
                            <th scope="row">{{ $brand->id }}</th>
                            <td>{{ $brand->name }}</td>
                            <td>{{ $brand->desc }}</td>
                            <td>
                                <img with="50" height="50" class="" src="{{ "/storage/$brand->image" }}"
                                    alt="">
                            </td>
                            <td>
                                <?php
                                                if($brand->status ==0) { ?>
                                <a href="{{ route('active-brands', $brand->id) }}"><span class="fa fa-lock"></span></a>
                                <?php }else{ ?>
                                <a href="{{ route('unactive-brands', $brand->id) }}"><span
                                        class="fa fa-unlock-alt"></span></a>
                                <?php } ?>
                            </td>

                            {{-- <td>
    
                                                <a href="{{route('view-product-brand',$brand->id)}}">
                                                    <label class="fa fa-eye"></label>
                                                </a>
    
                                            </td> --}}

                            <td>
                                <a href="{{ route('brand-edit', $brand->slug) }}" class="btn btn-success">Edit</a>
                            </td>
                            <td>
                                <a href="{{ route('brand-destroy', $brand->id) }}" class="btn btn-danger"
                                    onclick="return confirm('Are you want delete {{ $brand->name }} ?')">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <button type="submit" name="action" value="delete" class="btn btn-outline-secondary"
                onclick="return confirm('Bạn có chắc muốn xóa những thương hiệu đang chọn ??');">Delete</button>
            <button type="submit" name="action" value="active" class="btn btn-outline-secondary">Active</button>
            <button type="submit" name="action" value="unactive" class="btn btn-outline-secondary">Unactive</button>
            <hr>
            {{-- {{ $brands->links() }} --}}

        </div>
    </form>

    <!-- Content Row -->


    <script>
        function toggle(source) {
            checkboxes = document.getElementsByName('brandID[]');
            for (var i = 0, n = checkboxes.length; i < n; i++) {
                checkboxes[i].checked = source.checked;
            }
        }
    </script>
    <script></script>
@endsection
