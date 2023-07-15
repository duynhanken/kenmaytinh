<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>KenMayTinh - Login</title>
    @vite(['public/vendor/fontawesome-free/css/all.min.css'])
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    @vite(['public/css/sb-admin-2.min.css'])
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Admin!</h1>
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


                                    <form class="user" action="{{route('post-admin-login')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" name="txtEmail" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="txtPassword" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                   
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    @vite(['public/vendor/jquery/jquery.min.js'])
    <!-- Custom scripts for all pages-->
 
    @vite(['public/js/sb-admin-2.min.js'])
    @vite(['public/vendor/bootstrap/js/bootstrap.bundle.min.js'])

    <!-- Core plugin JavaScript-->
    @vite(['public/vendor/jquery-easing/jquery.easing.min.js'])

    
</body>

</html>