@extends('admin.master')
@section('title', 'مدیریت زمان ها')
@push('styles')
    <style type="text/css">
        .label {font-size: 14px;padding:1px 5px;margin:5px;}
    </style>
    <link href="{{url('css/snackbar.min.css')}}" rel="stylesheet">
@endpush
@section('content')
    <div class="well">
        <h3>@yield('title')</h3>
        <table class="table">
            <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">ساعت شروع و پایان</th>
                <th class="text-center">امکانات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($records as $key => $record)
                <tr id="row-{{$record->id}}">
                    <td width="10%" class="text-center" style="padding-top:10px">{{++$key}}</td>
                    <td width="60%" class="text-center" style="padding-top:10px"> از
                        <span class="label label-info">{{$record->start}}</span> الی
                        <span class="label label-danger">{{$record->end}}</span>
                    </td>
                    <td width="30%" class="text-center">
                        <a href="{{route('edit-time', $record->id)}}" class="btn btn-sm btn-raised no-margin">ویرایش</i><div class="ripple-container"></div></a>
                        &nbsp;&nbsp;
                        <a href="{{route('destroy-time', $record->id)}}" class="btn btn-sm btn-raised no-margin ajax-delete">حذف</i><div class="ripple-container"></div></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{--<div class="row">
            <div class="col-md-12">
                {{$records->links()}}
            </div>
        </div>--}}
    </div>
@endsection

@push('scripts')
<script src="{{url('js/snackbar.min.js')}}"></script>
<script>
    $(document).on('click', 'a.ajax-delete', function(e) {
        e.preventDefault(); // does not go through with the link.
        var $this = $(this);
        $this.blur();
        if(!window.confirm('آیا مطمئن هستید؟'))
            return;
        var row = "#row-" + $this.attr('href').split('/').slice(-1)[0];
        var token = '{{csrf_token()}}';
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
</script>
@endpush