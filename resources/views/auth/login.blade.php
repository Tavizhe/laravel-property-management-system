@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
ورود ادمین | املاک ملک گوستر
@endsection
<!--Page Title-->
<section class="page-title-two bg-color-1 centred">
    <div class="pattern-layer">
        <div class="pattern-1" style="background-image: url({{ asset('frontend/assets/images/shape/shape-9.png') }});">
        </div>
        <div class="pattern-2" style="background-image: url({{ asset('frontend/assets/images/shape/shape-10.png') }});">
        </div>
    </div>
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>ورود</h1>
            <ul class="clearfix">
                <li><a href="{{ route('home') }}">خانه</a></li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->
<!-- ragister-section -->
<section class="register-section centered sec-pad">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="justify-content-center align-items-center col-xl-12 col-lg-4 col-md-4 big-column">
                <div class="tabs-box">
                    <div class="justify-content-center align-items-center">
                        <div class="tab-btn-box">
                            <div class="tabs-content">
                                <div class="tab active-tab" id="tab-1">
                                    <div class="inner-box">
                                        <form action="{{ route('login') }}" method="post" class="default-form">
                                            @csrf
                                            <div class="form-group">
                                                <label>ایمیل/نام/موبایل</label>
                                                <input type="text" name="login" id="login" required>
                                            </div>
                                            <div class="form-group">
                                                <label>رمز</label>
                                                <input type="password" name="password" id="password" required>
                                            </div>
                                            <div class="form-group message-btn">
                                                <button type="submit" class="theme-btn btn-one">ورود</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection