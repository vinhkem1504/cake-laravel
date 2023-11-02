<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Cake Template">
    <meta name="keywords" content="Cake, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Cake | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('template/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('template/css/flaticon.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('template/css/barfiller.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('template/css/magnific-popup.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('template/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('template/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('template/css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('template/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('template/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('template/css/style.css')}}" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    @include('partial-views.menu')
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    @include('partial-views.header')
    <!-- Header Section End -->

    <!-- Title Bar-->
    @yield('title-bar')
    <!-- End Title Bar-->

    <!-- Content page-->
    @yield('content')
    <!-- End content -->

    <!-- Map Begin -->
    @yield('map')

    <!-- Map End -->

    <!-- Footer Section Begin -->
    @include('partial-views.footer')
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="{{asset('template/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('template/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('template/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('template/js/jquery.barfiller.js')}}"></script>
    <script src="{{asset('template/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('template/js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('template/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('template/js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('template/js/main.js')}}"></script>
</body>

</html>