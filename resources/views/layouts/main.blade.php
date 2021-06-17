<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>يوتيوبي</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap-rtl.css')}}">
    <link rel="stylesheet" href="{{ asset('css/index.css')}}">
    @yield('style')

</head>
<body class="mt-5 rtl ">
    <div class="layer"></div>

     <div id="top-menu">
        <div class="container-fluid">
           
            <!-- navbar -->
                @include('layouts.navbar')
            <!-- End Navbar -->

           <!-- sidebar -->
                 @include('layouts.sidebar')
           <!-- End Sidebar -->
          
           <!-- -->
            <div class="content m-4">
                @if (Session::has('success'))
                    <div class="p-3 mb-2 bg-success text-white rounded mx-auto col-8">
                        <span class="text-center">{{ session('success') }}</span>
                    </div>
                @endif
                @yield('title')
              <div class="row">
                

                    @yield('content')
             
             
                </div>
            </div>

        </div>
    </div>




    <script src="https://kit.fontawesome.com/dc9e78ad18.js" crossorigin="anonymous"></script>
    <!-- <script src="js/jquery-3.5.1.slim.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/popper.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.js')}}"></script>
    <script src="{{ asset('js/index.js')}}"></script>
    @yield('script')
</body>
</html>