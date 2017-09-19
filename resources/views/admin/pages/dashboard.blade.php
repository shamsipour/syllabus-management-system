@extends('admin.master')
@section('title', 'داشبورد مدیریت')
@section('content')
    <div class="row">
        <div class="col-xs-4">
            <div class="well">
                <div class="text-center">
                    <i class="fa fa-calendar-check-o big-icon"></i>
                    <h4>تاریخ امروز</h4>
                    <h3>{{ date('Y/m/d') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="well">
                <div class="text-center">
                    <i class="fa fa-clock-o big-icon"></i>
                    <h4>ساعت و زمان</h4>
                    <h3 dir="ltr">{{ date('H : i') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="well">
                <div class="text-center">
                    <i class="fa fa-cubes big-icon"></i>
                    <h4>تعداد کلاس ها</h4>
                    <h3>{{\App\Plan::all()->count()}} کلاس</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <div class="well">
                <div class="text-center">
                    <i class="fa fa-user-circle-o big-icon"></i>
                    <h4>تعداد اساتید (مدرسین)</h4>
                    <h3>{{\App\Teacher::all()->count()}} نفر</h3>
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="well">
                <div class="text-center">
                    <i class="fa fa-book big-icon"></i>
                    <h4>تعداد دروس</h4>
                    <h3>{{\App\Lesson::all()->count()}} درس</h3>
                </div>
            </div>
        </div>
    </div>
@endsection