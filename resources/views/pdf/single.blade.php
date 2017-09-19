<html lang="fa">
<body>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css">
        body {
            font-family: yekan;
            direction: rtl;
        }

        th {
            background: #2a2a2a;
            color: white;
            font-size: 22px;
            padding: 5px
        }

        td {
            font-size: 18px;
            padding: 10px 20px;
            text-align: center;
        }

        table {
            margin-left: auto;
            margin-right: auto;
        }

        h1 {
            margin: 20px 0 10px;
        }

        @page {
            header: page-header;
            footer: page-footer;
        }

        .text-center {
            text-align: center
        }
    </style>
</head>
<body>
<htmlpageheader name="page-header">
    <div><h1 class="text-center">سامانه آنلاین اعلام برنامه هفتگی دانشکده شمسی پور</h1></div>
    <hr>
</htmlpageheader>
<div>
    <h2 class="text-center">برنامه دروس روز {{config('system.DAYS')[$day]}}</h2>
    <Br>
    <div>
        <table border="1">
            <thead>
            <tr>
                <th>ساعت</th>
                <th>نام درس</th>
                <th>نام استاد</th>
                <th>کلاس</th>
            </tr>
            </thead>
            <tbody>
            @foreach($plans as $plan)
                <tr>
                    <td>{{$plan->start}} الی {{$plan->end}}</td>
                    <td>{{$plan->lname}}</td>
                    <td>{{$plan->teacher->name}} {{$plan->teacher->family}}</td>
                    <td>{{$plan->class}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>