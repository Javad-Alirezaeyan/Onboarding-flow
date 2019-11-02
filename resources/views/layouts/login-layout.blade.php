<?php


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" sizes="16x16" href="{{asset("theme/horizontal/assets/images/favicon.png")}}">
    <title>@yield('title')</title>

    <link href="{{asset("theme/assets/plugins/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">

    <link href="{{asset("theme/horizontal/css/style.css")}}" rel="stylesheet">

    <link href="{{asset("theme/horizontal/css/colors/blue.css")}}" id="theme" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>

@yield('content')

<script src="{{asset("theme/assets/plugins/jquery/jquery.min.js")}}"></script>
<script ssrc="{{asset("theme/assets/plugins/bootstrap/js/tether.min.js")}}"></script>
<script src="{{asset("theme/assets/plugins/bootstrap/js/bootstrap.min.js")}}"></script>
<script src="{{asset("theme/horizontal/js/jquery.slimscroll.js")}}"></script>
<script src="{{asset("theme/horizontal/js/waves.js")}}"></script>
<script src="{{asset("theme/horizontal/js/sidebarmenu.js")}}"></script>
<script src="{{asset("theme/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js")}}"></script>
<script src="{{asset("theme/assets/plugins/sparkline/jquery.sparkline.min.js")}}"></script>
<script src="{{asset("theme/horizontal/js/custom.min.js")}}"></script>
<script src="{{asset("theme/assets/plugins/styleswitcher/jQuery.style.switcher.js")}}"></script>
</body>

</html>
