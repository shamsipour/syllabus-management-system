<!DOCTYPE html>
<html lang="en">
<head>
    <title>ورود به سیستم</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Shamsipour Technical University">
    <meta name="developer" content="Erfan Sahafnejad">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />

    <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('css/bootstrap-material-design.min.css')}}" rel="stylesheet">
    <link href="{{url('css/ripples.min.css')}}" rel="stylesheet">
    <link href="{{url('css/bootstrap-rtl.min.css')}}" rel="stylesheet">
    <link href="{{url('css/app.css')}}" rel="stylesheet">
    <link href="{{url('css/fonts.css')}}" rel="stylesheet">
    <style>
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <br><br><br><br><br>
        <div class="col-md-offset-4 col-md-4">
            <div class="login-box pagination-centered">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">ورود به سیستم</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="{{route('login')}}">
                            {!! csrf_field() !!}
                            <div class="row">
                                <h5 class="text-center">نام کاربری و رمز عبور خود را وارد کنید.</h5>
                                <div class="col-xs-12">
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group no-margin">
                                        <div class="col-xs-6 col-md-10 col-md-offset-1">
                                            <input name="username" type="text" class="form-control" placeholder="نام کاربری" value="{{old('username')}}">
                                        </div>
                                    </div>
                                    <div class="form-group no-margin">
                                        <div class="col-xs-6 col-md-10 col-md-offset-1">
                                            <input name="password" type="password" class="form-control" placeholder="کلمه عبور">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">

                                    <div class="form-group no-margin">
                                        <div class="col-xs-5 col-md-offset-1">
                                            <input name="captcha" type="text" class="form-control" placeholder="کپچا">
                                        </div>
                                        <div class="col-xs-5 no-pad-right">
                                            <img src="{{captcha_src('flat')}}" class="img-responsive">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 text-center">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-raised">ورود<div class="ripple-container"></div></button>
                                        <button type="reset" class="btn btn-danger btn-raised">انصراف<div class="ripple-container"></div></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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