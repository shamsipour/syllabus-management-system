@extends('admin.master')
@section('title', 'تنظیمات سیستم')
@push('styles')
<link href="{{url('css/snackbar.min.css')}}" rel="stylesheet">
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="well">
                <h3>@yield('title')</h3>
                <br>

                <div class="row">
                    <div class="col-md-12">
                        <h4 class="text-center">برنامه هفتگی</h4>

                        <p class="text-center">با کلیک بر روی دکمه زیر میتوانید برنامه هفتگی ای که در سیستم ایجاد کرده
                            اید را در قالب PDF برای دانشجویان جهت دانلود مستقیم قرار دهید.</p>

                        <div class="text-center">
                            <a href="{{route('export-pdf')}}" class="btn btn-success btn-raised no-margin"><i
                                        class="fa fa-share-alt "></i>انتشار برنامه هفتگی
                                <div class="ripple-container"></div>
                            </a>
                        </div>
                    </div>
                    {{-- <div class="col-md-6">
                        <h4 class="text-center">بک آپ دیتابیس</h4>

                        <p class="text-center">با کلیک بر روی دکمه زیر میتوانید بک آپ دیتابیس را با پسوند XLS دانلود و
                            نگهداری کنید تا در صورت نیاز آن را بازیابی نمایید.</p>

                        <div class="text-center">
                            <a href="{{route('export-db')}}" class="btn btn-info btn-raised no-margin"><i
                                        class="fa fa-database"></i> دانلود بک آپ دیتابیس
                                <div class="ripple-container"></div>
                            </a>
                        </div>
                    </div> --}}
                </div>

                {{-- <div class="row">
                    <div class="col-md-12">
                        <h4 class="text-center">بازگردانی دیتابیس</h4>
                        <p class="text-center">با انتخاب و کلیک بر روی دکمه زیر میتوانید بک آپ دیتابیسی که از قبل ایجاد و دانلود کرده اید را مجددا بارگذاری کنید. توجه داشته باشید که تمامی اطلاعات قبلی حذف، و اطلاعات جدید جایگزین خواهند شد.</p>
                        <div class="text-center">
                            <form action="{{route('import-db')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-offset-1 col-md-6">
                                        <div class="form-group">
                                            <input type="file" name="file">
                                            <input type="text" readonly="" class="form-control" placeholder="فایل بک آپ اکسل خود را انتخاب کنید...">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger btn-raised no-margin"><i class="fa fa-refresh"></i> بارگذاری اطلاعات جدید </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> --}}

            </div>

        </div>
    </div>
@endsection