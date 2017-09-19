<nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span
                    class="icon-bar"></span><span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">منوی اصلی</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li>
                <a href="{{route('dashboard')}}">داشبورد</a>
            </li>
            <li>
                <a href="{{route('settings')}}">تنظیمات</a>
            </li>

        </ul>
        <ul class="nav navbar-nav navbar-left">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->name}}<strong
                            class="caret"></strong></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{route('settings')}}">تنظیمات</a>
                    </li>
                    <li>
                        <a href="{{route('index')}}">صفحه اصلی وبسایت</a>
                    </li>
                    <li class="divider">
                    </li>
                    <li>
                        <a href="{{route('logout')}}">خروج از حساب</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{route('logout')}}">خروج</a>
            </li>
        </ul>
    </div>
</nav>