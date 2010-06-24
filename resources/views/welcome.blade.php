<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta csrf_token="{{csrf_token()}}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

        <title>SmorFarm</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


         <!-- Material Design Iconic Font-V2.2.0 -->
         <link rel="stylesheet" href="{{asset('css/material-design-iconic-font.min.css')}}">
         <!-- Font Awesome -->
         <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
         <!-- Font Awesome Stars-->
         <link rel="stylesheet" href="{{asset('css/fontawesome-stars.css')}}">
         <!-- Meanmenu CSS -->
         <link rel="stylesheet" href="{{asset('css/meanmenu.css')}}">
         <!-- owl carousel CSS -->
         <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
         <!-- Slick Carousel CSS -->
         <link rel="stylesheet" href="{{asset('css/slick.css')}}">
         <!-- Animate CSS -->
         <link rel="stylesheet" href="{{asset('css/animate.css')}}">
         <!-- Jquery-ui CSS -->
         <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
         <!-- Venobox CSS -->
         <link rel="stylesheet" href="{{asset('css/venobox.css')}}">
         <!-- Nice Select CSS -->
         <link rel="stylesheet" href="{{asset('css/nice-select.css')}}">
         <!-- Magnific Popup CSS -->
         <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
         <!-- Bootstrap V4.1.3 Fremwork CSS -->
         <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
         <!-- Helper CSS -->
         <link rel="stylesheet" href="{{asset('css/helper.css')}}">
         <!-- Main Style CSS -->
         <link rel="stylesheet" href="{{asset('css/style.css')}}">
         <!-- Responsive CSS -->
         <link rel="stylesheet" href="{{asset('css/responsive.css')}}">



    </head>
    <body>
        <div id="app"></div>
        <script>
          const BASE_URL = '{{URL::to('/')}}';
        </script>
        <script src="{{asset('js/app.js')}}"></script>
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <!-- Meanmenu js -->
        <script src="{{asset('js/popper.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>

        <!-- Meanmenu js -->
        <script src="{{asset('js/jquery.meanmenu.min.js')}}"></script>
        <!-- Wow.min js -->
        <script src="{{asset('js/wow.min.js')}}"></script>
        <!-- Slick Carousel js -->
        <script src="js/slick.min.js"></script>
        <!-- Owl Carousel-2 js -->
        <script src="{{asset('js/owl.carousel.min.js')}}"></script>
        <!-- Magnific popup js -->
        <script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
        <!-- Isotope js -->
        <script src="{{asset('js/isotope.pkgd.min.js')}}"></script>
        <!-- Imagesloaded js -->
        <script src="{{asset('js/imagesloaded.pkgd.min.js')}}"></script>
        <!-- Mixitup js -->
        <script src="{{asset('js/jquery.mixitup.min.js')}}"></script>
        <!-- Countdown -->
        <script src="{{asset('js/jquery.countdown.min.js')}}"></script>
        <!-- Counterup -->
        <script src="{{asset('js/jquery.counterup.min.js')}}"></script>
        <!-- Barrating -->
        <script src="{{asset('js/jquery.barrating.min.js')}}"></script>
        <!-- Waypoints -->
        <script src="{{asset('js/waypoints.min.js')}}"></script>
        <!-- Jquery-ui -->
        <script src="{{asset('js/jquery-ui.min.js')}}"></script>
        <!-- Venobox -->
        <script src="{{asset('js/venobox.min.js')}}"></script>
        <!-- Nice Select js -->
        <script src="{{asset('js/jquery.nice-select.min.js')}}"></script>
        <!-- ScrollUp js -->
        <script src="{{asset('js/scrollUp.min.js')}}"></script>
        <!-- Main/Activator js -->
        <script src="{{asset('js/main.js')}}"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').toggleClass('active');
                });
            });
        </script>

    </body>
</html>
