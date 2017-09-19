@extends('admin.master')
@section('title', 'ویرایش استاد')
@section('content')
    <div class="well">
        <h3>@yield('title')</h3>
        <p>از طریق فرم زیر میتوانید استاد را ویرایش کنید.</p>
        <div class="row">
            <form action="{{route('destroy-teacher', $model->id)}}" method="POST">
                {{method_field('PUT')}}
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-offset-2 col-md-8">
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
                </div>
                <div class="row">
                    <div class="col-sm-offset-2 col-sm-4 form-group">
                        <label for="name">نام استاد:</label>
                        <input value="{{$model->name}}" name="name" id="name" type="text" class="form-control">
                    </div>
                    <div class="col-sm-4 form-group">
                        <label for="family">نام خانوادگی استاد:</label>
                        <input value="{{$model->family}}" name="family" id="family" type="text" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-offset-2 col-sm-4 form-group">
                        <label for="email">ایمیل استاد:</label>
                        <input dir="ltr" value="{{$model->email}}" name="email" id="email" type="email" class="form-control">
                    </div>
                    <div class="col-sm-4 form-group">
                        <label for="mobile">شماره موبایل:</label>
                        <input dir="ltr" value="{{$model->mobile}}" name="mobile" id="mobile" type="number" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-offset-4 col-sm-2 form-group">
                        <button type="submit" class="margin-top-20 btn btn-raised btn-info">ویرایش استاد </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection