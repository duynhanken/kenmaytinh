@extends('Admin.index')
@section('content')
    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php

            $user = Auth::user();

        ?>

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('get-admin-home')}}">
                
                <div class="sidebar-brand-text mx-3">Ken</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

          

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Sản Phẩm
            </div>

            
            
            {{-- Nhãn hiệu --}}
            <li class="nav-item">
                <a class="nav-link" href="{{route('brand-list')}}">
                    <span>Nhãn hiệu</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('product-list')}}">
                    <span>Sản Phẩm</span></a>
            </li>


                     <!-- Divider -->
             <hr class="sidebar-divider">

              <!-- Heading -->
            <div class="sidebar-heading">
               Linh Kiện
            </div>
                <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <span>Linh Kiện</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                       
                        <a class="collapse-item" href="{{route('ram-list')}}">Ram</a>
                        <a class="collapse-item" href="{{route('cpu-list')}}">CPU</a>
                        <a class="collapse-item" href="{{route('harddriver-list')}}">Ổ Cứng</a>
                        <a class="collapse-item" href="{{route('mainBoard-list')}}">Mainboard</a>
                        <a class="collapse-item" href="{{route('graphicsCard-list')}}">Card Đồ Họa</a>

                    </div>
                </div>
            </li>
            
            {{--Sản Phẩm --}}
            {{-- <li class="nav-item">
                <a class="nav-link" href="">
                    <span>Sản Phẩm</span></a>
            </li>

             <!-- Divider -->
             <hr class="sidebar-divider"> --}}


                <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Voucher
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{route('voucher-list')}}">
                    <span>Voucher</span></a>
            </li>

            
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Khách Hàng
                </div>
    
                <li class="nav-item">
                    <a class="nav-link" href="{{route('customer-list')}}">
                        <span>Customer</span></a>
                </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Kho Hàng
             </div>
           
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                
                    <span>Kho Hàng</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                       
                        <a class="collapse-item" href="{{route('depot-list')}}">Thống kê kho hàng</a>
                        <a class="collapse-item" href="{{route('get-bill-import-depot')}}">Lập phiếu nhập hàng</a>
                        
                        <a class="collapse-item" href="{{route('get-list-bill-depot')}}">Hóa đơn nhập hàng</a>

                    </div>
                </div>
            </li>

             <!-- Divider -->
             <hr class="sidebar-divider">

             <div class="sidebar-heading">
                 Hóa đơn khách hàng
              </div>
            
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                
                    <span>Hóa Đơn</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                       
                        <a class="collapse-item" href="{{route('get-list-bill')}}">Danh sách hóa đơn</a>
                        {{-- <a class="collapse-item" href="{{route('get-create-bill')}}">Thêm hóa đơn</a> --}}
                       
                        
                    </div>
                </div>
            </li>
        

          
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    {{-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> --}}

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                     
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{$user->name ?? ''}}</span>
                                <img class="img-profile rounded-circle"
                                    src="{!! asset('avatar_admin')!!}/{{$user->avatar ??''}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{route('get-admin-logout')}}" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('admin_content')
                   

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{route('get-admin-logout')}}">Logout</a>
                </div>
            </div>
        </div>
    </div>
@endsection