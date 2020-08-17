<!DOCTYPE html>
<html lang="en">
<head>
    <title>برنامه های کلاسی دانشگاه علم و فرهنگ</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Shamsipour Technical University">
    <meta name="developer" content="Erfan Sahafnejad">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('css/bootstrap-rtl.min.css')}}" rel="stylesheet">
    <link href="{{url('css/fonts.css')}}" rel="stylesheet">
    <link href="{{url('css/index.css')}}" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-8 vcenter">
            <div class="content center-block">
                <div class="main-img">
                    <img src="{{url('img/clock.png')}}" alt="" class="img-responsive">
                    {{--<img src="{{url('img/logo.png')}}" alt="" class="img-responsive">--}}
                </div>
                <div class="text-center">
                    <h3>سامانه دریافت برنامه زمانبندی کلاس های دانشگاه علم و فرهنگ</h3>
                    <p class="text-justify">این وبسایت جهت نمایش برنامه هفتگی کلاس های دانشکده ایجاد شده است که شما دانشجویان عزیز میتوانید با مشخص نمودن روز مورد نظر در هفته، کلاس های موجود را مشاهده کنید. همچنین این امکان در نظر گرفته شده تا با کلیک بر روی دکمه مربوطه بتوانید برنامه تمام روز های هفته را در قالب PDF دانلود کنید.</p>
                    <p></p>
                </div>
                <div class="row">
                    {{-- <div class="col-md-6">
                        <button class="form-control btn btn-info">انتخاب یک روز خاص</button>
                    </div> --}}
                    <div class="col-md-12">
                        <a href="{{url('plans/full-plans.pdf')}}"><button class="form-control btn btn-success">دانلود PDF کل جدول هفتگی</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>