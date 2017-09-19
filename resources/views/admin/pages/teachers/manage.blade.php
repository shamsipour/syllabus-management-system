@extends('admin.master')
@section('title', 'مدیریت اساتید')
@push('styles')
    <!--suppress JSUnresolvedVariable -->
<style type="text/css">
        .label {font-size: 14px;padding:1px 5px;margin:5px;}
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
                        <div class="col-sm-12">
                            <h3>@yield('title')</h3>
                        </div>
                    </div>
                    <br>

                    <div class="table-responsive">
                        <table class="table table-hover" id="table">
                            <thead>
                            <tr>
                                <th width="10%" class="text-center">#</th>
                                <th width="15%" class="text-center">نام</th>
                                <th width="30%" class="text-center">نام خانوادگی</th>
                                <th width="20%" class="text-center">موبایل</th>
                                <th width="25%" class="text-center">امکانات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $key => $record)
                                <tr id="row-{{$record->id}}">
                                    <td class="text-center" style="padding-top:10px">{{++$key}}</td>
                                    <td class="text-center" style="padding-top:10px">{{$record->name}}</td>
                                    <td class="text-center" style="padding-top:10px">{{$record->family}}</td>
                                    <td class="text-center" style="padding-top:10px">{{$record->mobile}}</td>
                                    <td class="text-center">
                                        <a href="{{route('edit-teacher', $record->id)}}" class="btn btn-sm btn-raised no-margin">ویرایش</i><div class="ripple-container"></div></a>
                                        &nbsp;&nbsp;
                                        <a href="{{route('destroy-teacher', $record->id)}}" class="btn btn-sm btn-raised no-margin ajax-delete">حذف</i><div class="ripple-container"></div></a>
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
                                    <label for="name">نام استاد:</label>
                                    <input name="search-name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group no-margin">
                                    <label for="name">نام خانوادگی استاد:</label>
                                    <input name="search-family" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group text-center">
                                    <a href="{{route('search-teacher')}}" id="ajax-search" class="btn btn-info btn-raised no-margin">
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
                                        <th width="15%" class="text-center">نام</th>
                                        <th width="30%" class="text-center">نام خانوادگی</th>
                                        <th width="20%" class="text-center">موبایل</th>
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

@endsection

@push('scripts')
<script src="{{url('js/snackbar.min.js')}}"></script>
<script>
    var token = '{{csrf_token()}}';
    var lastCounter = '{{$key}}';
    var editPath = '{{route('manage-teachers')}}/';

    $(document).on('click', 'a.ajax-delete', function(e) {
        e.preventDefault(); // does not go through with the link.
        var $this = $(this);
        $this.blur();
        if(!window.confirm('آیا مطمئن هستید؟ تمام رکورد های وابسته نیز حذف خواهند شد.'))
            return;
        var row = "#row-" + $this.attr('href').split('/').slice(-1)[0];
        $this.addClass('disabled');
        $.ajax({url: $this.attr('href'), type: 'post', data: {_method: 'delete', _token :token},
            success: function(result){
                if(result.status != 'success'){
                    $this.removeClass('disabled');
                    $.snackbar({content: "مشکلی در حذف رکورد به وجود آمده."});
                    return 0;
                }
                $(row).fadeOut(250, function(){
                    $.snackbar({content: "رکورد مورد نظر با موفقیت حذف شد."});
                });
            }
        });
    });

    $(document).on('click', '#ajax-search', function (e) {
        e.preventDefault(); // does not go through with the link.
        var $this = $(this);
        var nameInput = $("input[name='search-name']"), familyInput = $("input[name='search-family']");
        $this.addClass('disabled');
        $this.text('صبر کنید...');
        $("#errors").html('');
        $this.blur();
        $.ajax({
            url: $this.attr('href'), type: 'post', data: {
                name: nameInput.val(),
                family: familyInput.val(),
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
                            '<td class="text-center">'+ result.data[item].family +'</td>',
                            '<td class="text-center">'+ result.data[item].mobile +'</td>',
                            '<td class="text-center">' +
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