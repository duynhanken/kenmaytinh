<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Ken May Tinh</title>

    <!-- Custom fonts for this template-->
    @vite(['public/vendor/fontawesome-free/css/all.min.css'])
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    @vite(['public/css/sb-admin-2.min.css'])

    @vite(['public/css/datatables.css'])
    

</head>

<body class="bg-gradient-primary" id="page-top">

    {{-- Home --}}

        @yield('content')

    <!-- Bootstrap core JavaScript-->

    @vite(['public/vendor/jquery/jquery.min.js'])
    <!-- Custom scripts for all pages-->
 
    @vite(['public/js/sb-admin-2.min.js'])
    @vite(['public/vendor/bootstrap/js/bootstrap.bundle.min.js'])

    <!-- Core plugin JavaScript-->
    @vite(['public/vendor/jquery-easing/jquery.easing.min.js'])

    @vite(['resources/js/app.js']);

    @vite(['public/build/ckeditor.js',]);

    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>



    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    

    <script>//Hàm 2 giây đóng
        setTimeout(function() {
            var btn = document.getElementById('close');
            btn.click();
    }, 2000);
    </script>
      <!-- Page level plugins -->

    <!-- Page level custom scripts -->
    

    {{-- <script>
        function showFile(event){
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function(){
                
                var dataURL = reader.result;
                var output = document.getElementById('file-preview');
                output.src = dataURL;

            }

            reader.readAsDataURL(input.file[0]);
        }
    </script> --}}



</body>

</html>