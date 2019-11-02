<?php

?>

<!DOCTYPE html>
<html  lang="en" >

<head>
    @include("layouts.partials.head")
</head>



<body class="fix-header card-no-border logo-center">
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>
<div id="main-wrapper">
    @include("layouts.partials.header")
    @include("layouts.partials.nav")
    <div >
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">On-Boarding</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        </ol>
                    </div>

                </div>
                <card class="card">
                    <div id="app">
                        @yield('content')
                    </div>
                </card>



            </div>

            @include('layouts.partials.footer')

        </div>
    </div>

</div>

<body  >


@yield('js')

@include('layouts.partials.footer-scripts')


<script src="{{ asset('js/app.js') }}" ></script>
</body>
</html>
