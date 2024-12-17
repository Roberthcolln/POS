<?php

use App\Models\Setting;

$konf = Setting::first();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{$konf->instansi_setting}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon/'.$konf->favicon_setting) }}">
    <link rel="stylesheet" href="web/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="web/css/animate.css">

    <link rel="stylesheet" href="web/css/owl.carousel.min.css">
    <link rel="stylesheet" href="web/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="web/css/magnific-popup.css">

    <link rel="stylesheet" href="web/css/aos.css">

    <link rel="stylesheet" href="web/css/ionicons.min.css">

    <link rel="stylesheet" href="web/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="web/css/jquery.timepicker.css">


    <link rel="stylesheet" href="web/css/flaticon.css">
    <link rel="stylesheet" href="web/css/icomoon.css">
    <link rel="stylesheet" href="web/css/style.css">
</head>

<body>

    <!-- END nav -->



    @yield('isi')

    



    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div>


    <script src="web/js/jquery.min.js"></script>
    <script src="web/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="web/js/popper.min.js"></script>
    <script src="web/js/bootstrap.min.js"></script>
    <script src="web/js/jquery.easing.1.3.js"></script>
    <script src="web/js/jquery.waypoints.min.js"></script>
    <script src="web/js/jquery.stellar.min.js"></script>
    <script src="web/js/owl.carousel.min.js"></script>
    <script src="web/js/jquery.magnific-popup.min.js"></script>
    <script src="web/js/aos.js"></script>
    <script src="web/js/jquery.animateNumber.min.js"></script>
    <script src="web/js/bootstrap-datepicker.js"></script>
    <script src="web/js/jquery.timepicker.min.js"></script>
    <script src="web/js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="web/js/google-map.js"></script>
    <script src="web/js/main.js"></script>

</body>

</html>