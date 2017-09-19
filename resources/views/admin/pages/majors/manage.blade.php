@extends('admin.master')
@section('title', 'مدیریت رشته ها')
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
                                <a data-toggle="modal" data-target="#newMajor" class="btn btn-info btn-raised no-margin"><i
                                            class="fa fa-plus"></i>ایجاد رشته جدید</i>
                                    <div class="ripple-container"></div>
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
                                <th width="30%" class="text-center">عنوان رشته</th>
                                <th width="20%" class="text-center">مقطع</th>
                                <th width="15%" class="text-center">تعداد دروس</th>
                                <th width="25%" class="text-center">امکانات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $key => $record)
                                <tr class="row-{{$record->id}}">
                                    <td width="10%" class="text-center" style="padding-top:10px">{{++$key}}</td>
                                    <td width="30%" class="text-center" style="padding-top:10px">{{$record->name}}</td>
                                    <td width="20%" class="text-center"
                                        style="padding-top:10px">{{config('system.MAJOR_LEVELS')[$record->level]['name']}}
                                    </td>
                                    <td width="15%" class="text-center">{{$record->lessons->count()}}</td>
                                    <td width="25%" class="text-center">
                                        <a href="{{route('destroy-major', $record->id)}}"
                                           class="btn btn-sm btn-raised no-margin ajax-edit">ویرایش</i>
                                            <div class="ripple-container"></div>
                                        </a>
                                        &nbsp;&nbsp;
                                        <a href="{{route('destroy-major', $record->id)}}"
                                           class="btn btn-sm btn-raised no-margin ajax-delete">حذف</i>
                                            <div class="ripple-container"></div>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {{$records->links()}}
                        </div>
                    </div>
                </div>

            </div>
            <div role="tabpanel" class="tab-pane fade" id="search">
                <div class="well">
                    <form method="post" id="search-form">
                        <div class="row">
                            <div class="col-md-offset-1 col-md-10">
                                <!-- Showing Validation Errors -->
                                <ul id="search-errors" class="text-danger">
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-offset-1 col-md-4">
                                <div class="form-group no-margin">
                                    <label for="name">عنوان رشته:</label>
                                    <input placeholder="فناوری اطلاعات" name="search-name" id="name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group no-margin">
                                    <label for="search-level">مقطع:</label>
                                    <select name="search-level" id="search-level" class="form-control">
                                        <option value="all" selected>همه</option>
                                        @foreach(config('system.MAJOR_LEVELS') as $level)
                                            <option value="{{$level['value']}}">{{$level['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group text-center">
                                    <a href="{{route('search-major')}}" id="ajax-search" class="btn btn-info btn-raised no-margin">
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
                                        <th width="40%" class="text-center">عنوان رشته</th>
                                        <th width="25%" class="text-center">مقطع</th>
                                        <th width="25%" class="text-center">امکانات</th>
                                    </tr>
                                    </thead>
                                    <tbody id="result-body">
                                    <tr>
                                        <td colspan="5" class="text-center">رکوردی جهت نمایش موجود نیست.</td>
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
                    <h4 class="modal-title" id="myModalLabel">ایجاد رشته جدید</h4>
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
                            <div class="col-sm-offset-1 col-sm-6 form-group">
                                <label for="name">عنوان رشته:</label>
                                <input placeholder="فناوری اطلاعات" name="name" id="name" type="text" class="form-control">
                            </div>
                            <div class="col-sm-4 form-group">
                                <label for="level">مقطع:</label>
                                <select name="level" id="level" class="form-control">
                                    @foreach(config('system.MAJOR_LEVELS') as $level)
                                        <option value="{{$level['value']}}">{{$level['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a id="ajax-store" href="{{route('manage-majors')}}" class="btn btn-primary">ارسال اطلاعات</a>
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
                    <h4 class="modal-title" id="myModalLabel">ویرایش رشته </h4>
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
                            <div class="col-sm-offset-1 col-sm-6 form-group">
                                <label for="edit-name">عنوان رشته:</label>
                                <input placeholder="فناوری اطلاعات" name="edit-name" id="edit-name" type="text" class="form-control">
                            </div>
                            <div class="col-sm-4 form-group">
                                <label for="edit-level">مقطع:</label>
                                <select id="edit-level" class="form-control">
                                    @foreach(config('system.MAJOR_LEVELS') as $level)
                                        <option value="{{$level['value']}}">{{$level['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a id="ajax-update" href="{{route('manage-majors')}}" class="btn btn-primary">ویرایش اطلاعات</a>
                    <a type="button" class="btn btn-default" data-dismiss="modal">انصراف</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script src="{{url('js/snackbar.min.js')}}"></script>
<script>
    var token = '{{csrf_token()}}';
    var lastCounter = '{{$key}}';
    var editPath = '{{route('manage-majors')}}/';
    var LEVELS = [];

    $(document).ready(function(){
        $("#level option").each(function(){
            LEVELS.push({name: $(this).text(), value: $(this).val()});
        });
    });

    $(document).on('click', '#ajax-store', function (e) {
        e.preventDefault(); // does not go through with the link.
        var $this = $(this);
        var nameInput = $("input[name='name']"), levelInput = $("select[name='level']");
        $this.addClass('disabled');
        $this.text('صبر کنید...');
        $("#errors").html('');
        $this.blur();
        $.ajax({
            url: $this.attr('href'), type: 'post', data: {
                name: nameInput.val(),
                level: levelInput.val(),
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
                    $('table').find('tbody').append([
                        '<tr class="row-'+result.data.id+'">',
                        '<td class="text-center">'+ ++lastCounter +'</td>',
                        '<td class="text-center">'+ nameInput.val() +'</td>',
                        '<td class="text-center">'+ $("select[name='level'] option:selected").text() +'</td>',
                        '<td class="text-center">'+ 0 +'</td>',
                        '<td class="text-center" width="25%">' +
                        '<a href="'+editPath+result.data.id+'" class="btn btn-sm btn-raised no-margin ajax-edit">ویرایش</i><div class="ripple-container"></div></a>&nbsp;&nbsp;' +
                        '<a href="'+editPath+result.data.id+'" class="btn btn-sm btn-raised no-margin ajax-delete">حذف</i><div class="ripple-container"></div></a>' +
                        '</td>',
                        '</tr>'
                    ].join(''));
                    nameInput.val('');
                    sortTable('table', 1);
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
                $this.removeClass('disabled');
                $.snackbar({content: "مشکلی در حذف رکورد به وجود آمده."});
            }
        });
    });

    $(document).on('click', 'a.ajax-edit', function (e) {
        e.preventDefault(); // does not go through with the link.
        var $this = $(this);
        $this.blur();
        $this.addClass('disabled');
        $("#loading").fadeIn(200, function(){
            if(LEVELS){
                $.ajax({
                    url: $this.attr('href'), type: 'get',
                    success: function (result) {
                        if(result.status == 200){
                            $("#edit-name").val(result.data.name);
                            $("#edit-level").val(result.data.level);
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
    });

    $(document).on('click', '#ajax-update', function (e) {
        e.preventDefault(); // does not go through with the link.
        var $this = $(this);
        var nameInput = $("#edit-name"), levelInput = $("#edit-level");
        var row = ".row-" + $this.attr('href').split('/').slice(-1)[0];
        $this.addClass('disabled');
        $this.text('صبر کنید...');
        $("#edit-errors").html('');
        $this.blur();
        $.ajax({
            url: $this.attr('href'), type: 'post', data: {
                name: nameInput.val(),
                level: levelInput.val(),
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
                    jQuery(row).find('td:eq(1)').text(nameInput.val());
                    jQuery(row).find('td:eq(2)').text(LEVELS[levelInput.val()].name);
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
        var nameInput = $("input[name='search-name']"), levelInput = $("select[name='search-level']");
        $this.addClass('disabled');
        $this.text('صبر کنید...');
        $("#errors").html('');
        $this.blur();
        $.ajax({
            url: $this.attr('href'), type: 'post', data: {
                name: nameInput.val(),
                level: levelInput.val(),
                _token: token
            },
            success: function (result) {
                var messages = "", records = "", searchCounter = 0;
                console.log(result);
                if(result.status == 200){
                    $("#search-errors").html('');
                    for(var item in result.data){
                        records += [
                            '<tr class="row-'+result.data[item].id+'">',
                            '<td class="text-center">'+ ++searchCounter +'</td>',
                            '<td class="text-center">'+ result.data[item].name +'</td>',
                            '<td class="text-center">'+ LEVELS[result.data[item].level].name +'</td>',
                            '<td class="text-center" width="25%">' +
                            '<a href="'+editPath+result.data[item].id+'" class="btn btn-sm btn-raised no-margin ajax-edit">ویرایش</i><div class="ripple-container"></div></a>&nbsp;&nbsp;' +
                            '<a href="'+editPath+result.data[item].id+'" class="btn btn-sm btn-raised no-margin ajax-delete">حذف</i><div class="ripple-container"></div></a>' +
                            '</td>',
                            '</tr>'
                        ].join('');
                    }
                    // Add to simple Bootstrap table
                    $('#result-table').find('tbody').html(records);
                    sortTable('table', 1);
                    $.snackbar({content: result.data.length + " رکورد یافت شد."});
                }
                else{
                    $('#result-table').find('tbody').html([
                        '<tr>',
                        '<td colspan="5" class="text-center">رکوردی جهت نمایش موجود نیست.</td>',
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