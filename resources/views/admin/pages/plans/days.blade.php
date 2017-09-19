@extends('admin.master')
@section('title', 'انتخاب روز هفته')
@push('styles')
<style type="text/css">
    .label {
        font-size: 14px;
        padding: 1px 5px;
        margin: 5px;
    }
</style>
<link href="{{url('css/snackbar.min.css')}}" rel="stylesheet">
@endpush
@section('content')
    <div>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs bg-danger" role="tablist">
            <li role="presentation" class="active"><a href="#manage" aria-controls="manage" role="tab" data-toggle="tab">مدیریت رکورد ها</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="manage">
                <div class="well">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>@yield('title')</h3>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <?php $c = ['dark', 'default', 'primary', 'info', 'success', 'warning', 'danger']; ?>
                        @foreach($c as $index => $item)
                        <div class="col-md-6">
                                <a href="{{route('show-plan', $index)}}" style="width:100%" class="btn btn-lg btn-{{$item}} btn-raised">برنامه روز {{config('system.DAYS')[$index]}}<div class="ripple-container"></div></a>
                        </div>
                        @endforeach
                    </div>


                </div>

            </div>

        </div>

    </div>




    <!-- New Major Modal -->
    <div class="modal fade" id="newMajor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">ایجاد رکورد جدید</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="row">
                            <div class="col-md-offset-1 col-md-10">
                                <!-- Showing Validation Errors -->
                                <ul id="errors" class="text-danger">
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-offset-1 col-sm-10 form-group">
                                <label for="name">عنوان درس:</label>
                                <input placeholder="سیستم عامل" name="name" id="name" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-offset-1 col-sm-4 form-group">
                                <label for="units">تعداد واحد:</label>
                                <input value="3" name="units" id="units" type="number" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="major_id">رشته:</label>
                                <select name="major_id" id="major_id" class="form-control">
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a id="ajax-store" href="{{route('manage-plans')}}" class="btn btn-primary">ارسال اطلاعات</a>
                    <a type="button" class="btn btn-default" data-dismiss="modal">انصراف</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Major Modal -->
    <div class="modal fade" id="editMajor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">ویرایش درس </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="row">
                            <div class="col-md-offset-1 col-md-10">
                                <!-- Showing Validation Errors -->
                                <ul id="edit-errors" class="text-danger">
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-offset-1 col-sm-10 form-group">
                                <label for="edit-name">عنوان درس:</label>
                                <input placeholder="سیستم عامل" name="edit-name" id="edit-name" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-offset-1 col-sm-4 form-group">
                                <label for="edit-units">تعداد واحد:</label>
                                <input name="edit-units" id="edit-units" type="number" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="edit-major_id">رشته:</label>
                                <select name="edit-major_id" id="edit-major_id" class="form-control">
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a id="ajax-update" href="{{route('manage-plans')}}" class="btn btn-primary">ویرایش اطلاعات</a>
                    <a type="button" class="btn btn-default" data-dismiss="modal">انصراف</a>
                </div>
            </div>
        </div>
    </div>

@endsection