<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title">امکانات پنل</h3>
    </div>
    <div class="panel-body">
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading"><i class="fa fa-clock-o"></i> زمان کلاسها</h4>
                <ul>
                    <li><a href="{{route('manage-times')}}">مدیریت زمان ها</a></li>
                    <li><a href="{{route('new-time')}}">ایجاد زمان جدید</a></li>
                </ul>
            </div>
            <div class="list-group-separator"></div>
            <div class="list-group-item">
                <h4 class="list-group-item-heading"><i class="fa fa-list-alt"></i> رشته ها</h4>
                <ul>
                    <li><a href="{{route('manage-majors')}}">مدیریت رشته ها</a></li>
                </ul>
            </div>
            <div class="list-group-separator"></div>
            <div class="list-group-item">
                <h4 class="list-group-item-heading"><i class="fa fa-book"></i> دروس</h4>
                <ul>
                    <li><a href="{{route('manage-lessons')}}">مدیریت دروس</a></li>
                </ul>
            </div>
            <div class="list-group-separator"></div>
            <div class="list-group-item">
                <h4 class="list-group-item-heading"><i class="fa fa-address-card-o"></i> اساتید</h4>
                <ul>
                    <li><a href="{{route('manage-teachers')}}">مدیریت اساتید</a></li>
                    <li><a href="{{route('new-teacher')}}">ایجاد استاد جدید</a></li>
                </ul>
            </div>
            <div class="list-group-separator"></div>
            <div class="list-group-item">
                <h4 class="list-group-item-heading"><i class="fa fa-calendar"></i> برنامه کلاس ها</h4>
                <ul>
                    <li><a href="{{route('manage-plans')}}">مدیریت برنامه ها</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>