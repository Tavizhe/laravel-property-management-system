@php
$setting = App\Models\SiteSetting::find(1);
$blog = App\Models\BlogPost::latest()->limit(2)->get();
@endphp
<div class="mobile-menu">
    <div class="menu-backdrop"></div>
    <div class="close-btn"><i class="fas fa-times"></i></div>

    <nav class="menu-box">
        <div class="nav-logo"><a href="#"><img src="{{ asset('frontend/assets/images/logo-2.png') }}" alt=""
                    title=""></a></div>
        <div class="menu-outer">
            <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
        </div>
        <div class="contact-info">
            <h4>ارتباط با ما</h4>
            <ul>
                <li>{{ $setting->company_address }}</li>
                <li><a href="tel:09133310337">09133310337</a></li>
                <li><a href="mailto:support@mellkgostar.ir">support@mellkgostar.ir</a></li>
            </ul>
        </div>
        <div class="social-links">
            <ul class="clearfix">
                <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                <li><a href="#"><span class="fab fa-youtube"></span></a></li>
            </ul>
        </div>
    </nav>
</div>