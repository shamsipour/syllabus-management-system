@extends('admin.master')
@section('title', 'برنامه روز '.config('system.DAYS')[$day])
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
            <li role="presentation"><a href="#search" aria-controls="search" role="tab" data-toggle="tab">جستجوی رکورد</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="manage">
                <div class="well">
                    <div class="row">
                        <div class="col-sm-8">
                            <h3>@yield('title')</h3>
                        </div>
                        <div class="col-sm-4">
                            <br>

                            <div class="pull-left">
                                <a data-toggle="modal" data-target="#newMajor" class="btn btn-info btn-raised no-margin"><i class="fa fa-plus"></i>ایجاد رکورد جدید</i><div class="ripple-container"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="table-responsive">
                        <table class="table table-hover" id="table">
                            <thead>
                            <tr>
                                <th width="10%" class="text-center">#</th>
                                <th width="15%" class="text-center">ساعت</th>
                                <th width="20%" class="text-center">درس</th>
                                <th width="20%" class="text-center">استاد</th>
                                <th width="10%" class="text-center">کلاس</th>
                                <th width="25%" class="text-center">امکانات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($records->count() < 1) $key = 0; ?>
                            @foreach($records as $key => $record)
                                <tr class="row-{{$record->id}}">
                                    <td class="text-center" style="padding-top:10px">{{++$key}}</td>
                                    <td class="text-center" style="padding-top:10px" dir="ltr">{{$record->time->start}} - {{$record->time->end}}</td>
                                    <td class="text-center" style="padding-top:10px">{{$record->lesson->name}}</td>
                                    <td class="text-center" style="padding-top:10px">{{$record->teacher->name}} {{$record->teacher->family}}</td>
                                    <td class="text-center" style="padding-top:10px">{{$record->class}}</td>
                                    <td class="text-center">
                                        <a href="{{route('destroy-plan', $record->id)}}"
                                           class="btn btn-sm btn-raised no-margin ajax-edit">ویرایش</i>
                                            <div class="ripple-container"></div>
                                        </a>
                                        &nbsp;&nbsp;
                                        <a href="{{route('destroy-plan', $record->id)}}"
                                           class="btn btn-sm btn-raised no-margin ajax-delete">حذف</i>
                                            <div class="ripple-container"></div>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div role="tabpanel" class="tab-pane fade" id="search">
                <div class="well">
                    <form method="post" id="search-form">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3>@yield('title')</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-offset-1 col-md-10">
                                <!-- Showing Validation Errors -->
                                <ul id="search-errors" class="text-danger">
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-offset-1 col-md-8">
                                <div class="form-group no-margin">
                                    <label for="name">نام درس:</label>
                                    <input placeholder="سیستم عامل" name="search-name" id="name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group text-center">
                                    <a href="{{route('search-plan')}}" id="ajax-search" class="btn btn-info btn-raised no-margin">
                                        <i class="fa fa-search"></i>جستجو رکورد</i>
                                        <div class="ripple-container"></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover" id="result-table">
                                    <thead>
                                    <tr>
                                        <th width="10%" class="text-center">#</th>
                                        <th width="15%" class="text-center">ساعت</th>
                                        <th width="20%" class="text-center">درس</th>
                                        <th width="20%" class="text-center">استاد</th>
                                        <th width="10%" class="text-center">کلاس</th>
                                        <th width="25%" class="text-center">امکانات</th>
                                    </tr>
                                    </thead>
                                    <tbody id="result-body">
                                    <tr>
                                        <td colspan="6" class="text-center">رکوردی جهت نمایش موجود نیست.</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
                            <div class="col-sm-offset-1 col-sm-4 form-group">
                                <label for="time_id">ساعت:</label>
                                <select name="time_id" id="time_id" class="form-control">
                                    @foreach($times as $time)
                                        <option value="{{$time->id}}">{{$time->start}} - {{$time->end}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="lesson_id">درس:</label>
                                <select name="lesson_id" id="lesson_id" class="form-control">
                                    @foreach($lessons as $lesson)
                                        <option value="{{$lesson->id}}">{{$lesson->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-offset-1 col-sm-6 form-group">
                                <label for="teacher_id">استاد:</label>
                                <select name="teacher_id" id="teacher_id" class="form-control">
                                    @foreach($teachers as $teacher)
                                        <option value="{{$teacher->id}}">{{$teacher->name}} {{$teacher->family}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label for="class">کلاس:</label>
                                <input name="class" id="class" type="text" class="form-control">
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
                            <div class="col-sm-offset-1 col-sm-4 form-group">
                                <label for="edit-time_id">ساعت:</label>
                                <select name="edit-time_id" id="edit-time_id" class="form-control">
                                    @foreach($times as $time)
                                        <option value="{{$time->id}}">{{$time->start}} - {{$time->end}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="lesson_id">درس:</label>
                                <select name="edit-lesson_id" id="edit-lesson_id" class="form-control">
                                    @foreach($lessons as $lesson)
                                        <option value="{{$lesson->id}}">{{$lesson->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-offset-1 col-sm-6 form-group">
                                <label for="edit-teacher_id">استاد:</label>
                                <select name="edit-teacher_id" id="edit-teacher_id" class="form-control">
                                    @foreach($teachers as $teacher)
                                        <option value="{{$teacher->id}}">{{$teacher->name}} {{$teacher->family}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 form-group">
                                <label for="edit-class">کلاس:</label>
                                <input name="edit-class" id="edit-class" type="text" class="form-control">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a id="ajax-update" href="{{route('manage-lessons')}}" class="btn btn-primary">ویرایش اطلاعات</a>
                    <a type="button" class="btn btn-default" data-dismiss="modal">انصراف</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script src="{{url('js/snackbar.min.js')}}"></script>
<script>
    var day = '{{$day}}';
    var token = '{{csrf_token()}}';
    var lastCounter = '{{$key}}';
    var editPath = '{{route('manage-plans')}}/';
    var TEACHERS = [], TIMES = [], LESSONS = [];

    $(document).ready(function(){
        $("#time_id option").each(function(){
            TIMES[$(this).val()] = {name: $(this).text(), value: $(this).val()};
        });
        $("#lesson_id option").each(function(){
            LESSONS[$(this).val()] = {name: $(this).text(), value: $(this).val()};
        });
        $("#teacher_id option").each(function(){
            TEACHERS[$(this).val()] = {name: $(this).text(), value: $(this).val()};
        });
    });

    $(document).on('click', '#ajax-store', function (e){
        e.preventDefault(); // does not go through with the link.
        var $this = $(this);
        var timeInput = $("select[name='time_id']"), teacherInput = $("select[name='teacher_id']"), lessonInput = $("select[name='lesson_id']"), classInput = $("input[name='class']");
        $this.addClass('disabled');
        $this.text('صبر کنید...');
        $("#errors").html('');
        $this.blur();
        $.ajax({
            url: $this.attr('href'), type: 'post', data: {
                day: day,
                class: classInput.val(),
                time_id: timeInput.val(),
                teacher_id: teacherInput.val(),
                lesson_id: lessonInput.val(),
                _token: token
            },
            success: function (result) {
                var messages = "";
                //noinspection JSUnresolvedVariable
                var errors = result.errors;
                if (result.status == 400) {
                    for(var field in errors)
                        for(var i in errors[field])
                            messages += "<li>"+errors[field][i]+"</li>";
                    $("#errors").html(messages);
                    $.snackbar({content: "اطلاعات وارد شده معتبر نیست."});
                }
                else if(result.status == 200){
                    $('#newMajor').modal('hide');
                    $("#errors").html('');
                    // Add to simple Bootstrap table
                    $('#table').find('tbody').append([
                        '<tr class="row-'+result.data.id+'">',
                        '<td class="text-center">'+ ++lastCounter +'</td>',
                        '<td class="text-center">'+ TIMES[result.data.time_id].name +'</td>',
                        '<td class="text-center">'+ LESSONS[result.data.lesson_id].name +'</td>',
                        '<td class="text-center">'+ TEACHERS[result.data.teacher_id].name +'</td>',
                        '<td class="text-center">'+ classInput.val() +'</td>',
                        '<td class="text-center" width="25%">' +
                        '<a href="'+editPath+result.data.id+'" class="btn btn-sm btn-raised no-margin ajax-edit">ویرایش</i><div class="ripple-container"></div></a>&nbsp;&nbsp;' +
                        '<a href="'+editPath+result.data.id+'" class="btn btn-sm btn-raised no-margin ajax-delete">حذف</i><div class="ripple-container"></div></a>' +
                        '</td>',
                        '</tr>'
                    ].join(''));
                    classInput.val('');
                    sortTable('#table', 2);
                    $.snackbar({content: "رکورد مورد نظر با موفقیت ایجاد شد."});
                }
                $this.removeClass('disabled');
                $this.text('ارسال اطلاعات');
            }
        });
    });

    $(document).on('click', 'a.ajax-delete', function (e) {
        e.preventDefault(); // does not go through with the link.
        var $this = $(this);
        $this.blur();
        if (!window.confirm('آیا مطمئن هستید؟ تمامی رکورد های وابسته به این رکورد نیز حدف خواهند شد.'))
            return;
        var row = ".row-" + $this.attr('href').split('/').slice(-1)[0];
        $this.addClass('disabled');
        $.ajax({
            url: $this.attr('href'), type: 'post', data: {_method: 'delete', _token: token},
            success: function (result) {
                if (result.status == 204) {
                    $(row).fadeOut(250);
                    $.snackbar({content: "رکورد مورد نظر با موفقیت حذف شد."});
                }
                else{
                    $this.removeClass('disabled');
                    $.snackbar({content: "مشکلی در حذف رکورد به وجود آمده."});
                }
            }
        });
    });

    $(document).on('click', 'a.ajax-edit', function (e) {
        e.preventDefault(); // does not go through with the link.
        var $this = $(this);
        $this.blur();
        $this.addClass('disabled');
        $("#loading").fadeIn(200, function(){
            if(TEACHERS && TIMES && LESSONS){
                $.ajax({
                    url: $this.attr('href'), type: 'get',
                    success: function (result) {
                        if(result.status == 200){
                            $("#edit-time_id").val(result.data.time_id);
                            $("#edit-teacher_id").val(result.data.teacher_id);
                            $("#edit-lesson_id").val(result.data.lesson_id);
                            $("#edit-class").val(result.data.class);
                            $("#ajax-update").attr('href', $this.attr('href'));
                            $("#loading").hide();
                            $("#editMajor").modal('show');
                        }
                        else
                            $("#loading").hide();
                    }
                });
            }
            else
                alert('Levels didn\'t receive. Refresh the page.');
        });
        $this.removeClass('disabled');
        $("#loading").fadeOut(200);
    });

    $(document).on('click', '#ajax-update', function (e) {
        e.preventDefault(); // does not go through with the link.
        var $this = $(this);
        var timeInput = $("select[name='edit-time_id']"), teacherInput = $("select[name='edit-teacher_id']"), lessonInput = $("select[name='edit-lesson_id']"), classInput = $("input[name='edit-class']");
        var row = ".row-" + $this.attr('href').split('/').slice(-1)[0];
        $this.addClass('disabled');
        $this.text('صبر کنید...');
        $("#edit-errors").html('');
        $this.blur();
        $.ajax({
            url: $this.attr('href'), type: 'post', data: {
                day: day,
                class: classInput.val(),
                time_id: timeInput.val(),
                teacher_id: teacherInput.val(),
                lesson_id: lessonInput.val(),
                _method: 'PUT',
                _token: token
            },
            success: function (result) {
                var messages = "";
                //noinspection JSUnresolvedVariable
                var errors = result.errors;
                if (result.status == 400) {
                    for(var field in errors)
                        for(var i in errors[field])
                            messages += "<li>"+errors[field][i]+"</li>";
                    $("#edit-errors").html(messages);
                    $.snackbar({content: "اطلاعات وارد شده معتبر نیست."});
                }
                else if(result.status == 204){
                    jQuery(row).find('td:eq(1)').text(TIMES[timeInput.val()].name);
                    jQuery(row).find('td:eq(2)').text(LESSONS[lessonInput.val()].name);
                    jQuery(row).find('td:eq(3)').text(TEACHERS[teacherInput.val()].name);
                    jQuery(row).find('td:eq(4)').text(classInput.val());
                    $("#edit-errors").html('');
                    $('#editMajor').modal('hide');
                    $.snackbar({content: "رکورد مورد نظر با موفقیت ویرایش شد."});
                }
                else
                    $.snackbar({content: "مشکلی در ارسال اطلاعات وجود دارد."});

                $this.removeClass('disabled');
                $this.text('ویرایش اطلاعات');
            },
            error: function(result){
                console.log(result);
            }
        });
    });

    $(document).on('click', '#ajax-search', function (e) {
        e.preventDefault(); // does not go through with the link.
        var $this = $(this);
        var nameInput = $("input[name='search-name']");
        $this.addClass('disabled');
        $this.text('صبر کنید...');
        $("#errors").html('');
        $this.blur();
        $.ajax({
            url: $this.attr('href'), type: 'post', data: {
                name: nameInput.val(),
                day: day,
                _token: token
            },
            success: function (result) {
                var messages = "", records = "", searchCounter = 0;
                if(result.status == 200){
                    $("#search-errors").html('');
                    for(var item in result.data){
                        records += [
                            '<tr class="row-'+result.data[item].id+'">',
                            '<td class="text-center">'+ ++searchCounter +'</td>',
                            '<td class="text-center">'+ TIMES[result.data[item].time_id].name +'</td>',
                            '<td class="text-center">'+ LESSONS[result.data[item].lesson_id].name +'</td>',
                            '<td class="text-center">'+ TEACHERS[result.data[item].teacher_id].name +'</td>',
                            '<td class="text-center">'+ result.data[item].class +'</td>',
                            '<td class="text-center">' +
                            '<a href="'+editPath+result.data[item].id+'" class="btn btn-sm btn-raised no-margin ajax-edit">ویرایش</i><div class="ripple-container"></div></a>&nbsp;&nbsp;' +
                            '<a href="'+editPath+result.data[item].id+'" class="btn btn-sm btn-raised no-margin ajax-delete">حذف</i><div class="ripple-container"></div></a>' +
                            '</td>',
                            '</tr>'
                        ].join('');
                    }
                    // Add to simple Bootstrap table
                    $('#result-table').find('tbody').html(records);
                    sortTable('#result-table', 1);
                    $.snackbar({content: result.data.length + " رکورد یافت شد."});
                }
                else{
                    $('#result-table').find('tbody').html([
                        '<tr>',
                        '<td colspan="6" class="text-center">رکوردی جهت نمایش موجود نیست.</td>',
                        '</tr>'
                    ].join(''));
                    //noinspection JSUnresolvedVariable
                    var errors = result.errors;
                    if (result.status == 400) {
                        for(var field in errors)
                            for(var i in errors[field])
                                messages += "<li>"+errors[field][i]+"</li>";
                        $("#search-errors").html(messages);
                        $.snackbar({content: "اطلاعات وارد شده معتبر نیست."});
                    }
                    else if(result.status == 404){
                        $("#search-errors").html('');
                        $.snackbar({content: "رکوردی با چنین مشخصاتی یافت نشد."});
                    }
                }
                $this.removeClass('disabled');
                $this.html('<i class="fa fa-search"></i>جستجو رکورد</i><div class="ripple-container"></div>');
            }
        });
    });

    $(document).on('submit', '#search-form', function (e) {
        e.preventDefault();
        $("#ajax-search").click();
    });

</script>
@endpush