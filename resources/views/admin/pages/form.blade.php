@extends('admin.master')
@section('title', 'داشبورد مدیریت')
@section('content')
    <form method="post" action="{{route('login')}}">
        {{csrf_field()}}
        <input type="text" name="test">
        <input type="submit" value="Send">
    </form>
@endsection