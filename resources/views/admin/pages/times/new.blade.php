@extends('admin.master')
@section('title', 'ایجاد زمان جدید')
@section('content')
    <div class="well">
        <h3>@yield('title')</h3>
        <p>از طریق فرم زیر میتوانید ساعت درسی جدید ایجاد کنید. برای مثال 11 الی 13:30</p>
        <div class="row">
            <form action="{{route('manage-times')}}" method="POST">
                {{csrf_field()}}
                <div class="col-md-offset-2 col-md-3 form-group">
                    <label for="start">زمان شروع:</label>
                    <input placeholder="07:30" name="start_time" id="start" type="text" class="form-control">
                </div>
                <div class="col-md-3 form-group">
                    <label for="end">زمان پایان:</label>
                    <input placeholder="09:00" name="end_time" id="end" type="text" class="form-control">
                </div>
                <div class="col-md-2 form-group">
                    <a><button type="submit" class="margin-top-20 btn btn-raised btn-info">ایجاد زمان جدید </button></a>
                </div>
            </form>
        </div>
    </div>
@endsection