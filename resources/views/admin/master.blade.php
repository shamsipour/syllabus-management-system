<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title') - پنل مدیریت</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Shamsipour Technical University">
    <meta name="developer" content="Erfan Sahafnejad">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('css/bootstrap-material-design.min.css')}}" rel="stylesheet">
    <link href="{{url('css/ripples.min.css')}}" rel="stylesheet">
    <link href="{{url('css/bootstrap-rtl.min.css')}}" rel="stylesheet">
    <link href="{{url('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{url('css/fonts.css')}}" rel="stylesheet">
    <link href="{{url('css/app.css')}}" rel="stylesheet">
    <link href="{{url('css/style.css')}}" rel="stylesheet">


    <!-- Custom Styles -->
    @stack('styles')

</head>
<body>

<div id="loading"></div>
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <!-- Start Navbar -->
            @include('admin.layouts.navbar')
            <!-- End Navbar -->

            <div class="row">
                <div class="col-md-3">

                    <!-- Start Sidebar -->
                    @include('admin.layouts.sidebar')
                    <!-- End Sidebar -->

                </div>
                <div class="col-md-9">
                    @if(session('alert-title'))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-dismissable alert-{{session('alert-type')}}">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4>{{session('alert-title')}}</h4>
                                {{session('alert-message')}}
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Start Content -->
                    @yield('content')
                    <!-- End Content -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 no-padding">
    <footer class="bg-gray">
        <div class="text-center">
            تمامی حقوق مادی و معنوی محفوظ است.
            <br>
            طراحی و پیاده سازی توسط <a href="mailto:erfan.sahaf@gmail.com">عرفان صحاف نژاد</a>
        </div>
    </footer>
</div>

<script src="{{url('js/jquery.min.js')}}"></script>
<script src="{{url('js/bootstrap.min.js')}}"></script>
<script src="{{url('js/material.min.js')}}"></script>
<script src="{{url('js/ripples.min.js')}}"></script>
<script src="{{url('js/scripts.js')}}"></script>

<!-- Custom Scripts -->
@stack('scripts')

</body>
</html>