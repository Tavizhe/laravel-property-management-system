@php
    $setting = App\Models\SiteSetting::find(1);
@endphp

<header class="main-header">
    <!-- header-top -->
    <div class="header-top">
        <div class="top-inner clearfix">
            <div class="left-column pull-left">
                <ul class="info clearfix">
                    <li><i class="far fa-map-marker-alt"></i>{{ $setting->company_address }}</li>
                    <li><i class="far fa-clock"></i>شنبه تا پنج شنبه، صبح ها از 9 تا 1 و عصر ها از 5 الی 10</li>
                    <li><i class="far fa-phone"></i><a href="tel:09133310337">+{{ $setting->support_phone }}</a></li>
                </ul>
            </div>
            <div class="right-column pull-right">
                @auth
                    <div class="sign-box">
                        <a href="{{ route('dashboard') }}"><i class="fas fa-user"></i>میز کار</a>
                        <a href="{{ route('user.logout') }}"><i class="fas fa-user"></i>خروج</a>
                    </div>
                @else
                    <div class="sign-box">
                        <a href="{{ route('login') }}"><i class="fas fa-user"></i>ورود</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
    <!-- header-lower -->
    <div style="display: flex; justify-content:center; " class="header-lower">
        <div class="outer-box">
            <div class="main-box">
                <div class="logo-box">
                    <figure class="logo"><a href="{{ url('/') }}"><img style="width:140px; height:60px;"
                                src="{{ asset($setting->logo) }}" alt=""></a>
                    </figure>
                </div>
                <div class="menu-area clearfix">
                    <!--Mobile Navigation Toggler-->
                    <div class="mobile-nav-toggler">
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                    </div>
                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li><a style="text-decoration: none" href="{{ route('team.home') }}"><span>تیم ما</span></a> </li>
                                <li><a style="text-decoration: none" href="{{ route('blog.list') }}"><span>مقالات</span></a> </li>
                                <li><a style="text-decoration: none" href="#"><span>تماس با ما</span></a></li>
                                <li class="dropdown">
                                    <a style="text-decoration: none" href="#"><span>املاک</span></a>
                                    <ul>
                                        <li><a  style="text-align: right;text-decoration: none" href='{{ route('rent.property') }}'>املاک برای رهن و اجاره</a></li>
                                        <li><a  style="text-align: right;text-decoration: none" href="{{ route('buy.property') }}">املاک برای خرید</a></li>
                                    </ul>
                                </li>
                                <li><a style="text-decoration: none" href="{{ url('/') }}"><span>خانه</span></a> </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- sticky Header -->
    <div class="sticky-header">
        <div class="outer-box">
            <div class="main-box">
                <div class="logo-box">
                    <figure class="logo"><a href="{{ url('/') }}"><img src="{{ asset($setting->logo) }}"
                                alt=""></a></figure>
                </div>
                <div class="menu-area clearfix center">
                    <nav class="main-menu clearfix">
                        <!-- Keep This Empty / Menu will come through Javascript -->
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
