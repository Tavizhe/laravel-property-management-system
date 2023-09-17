@php
    $setting = App\Models\SiteSetting::find(1);
    $blog = App\Models\BlogPost::latest()
        ->limit(2)
        ->get();
@endphp
<style>
    .list-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .icon-container {
        margin-left: auto;
    }
</style>
<footer class="main-footer">
    <div class="footer-top bg-color-2">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="footer-widget about-widget">
                        <div class="widget-title d-flex justify-content-center align-items-center">
                            <h3>درباره ما
                                <hr class="text-hr">
                            </h3>
                        </div>
                        <div class="text">
                            <p>گروه مشاورین املاک ملک گستر خرید و فروش ملک، رهن و اجاره ملک و مشاوره در خرید و فروش ملک
                                در نجف آباد و … تنها بخش کوچکی از خدمات این مجموعه می باشد.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="footer-widget links-widget bordered">
                        <div class="widget-title d-flex justify-content-center align-items-center">
                            <h3>خدمات ما
                                <hr class="text-hr">
                            </h3>
                        </div>
                        <div class="widget-content">
                            <ul class="links-list nav">
                                <li style="margin: 5px" class="nav-item btn-dark rounded"><a href="#"
                                        class="nav-link">منزل مسکونی</a></li>
                                <li style="margin: 5px" class="nav-item btn-dark rounded"><a href="#"
                                        class="nav-link">اداری، تجاری و کارگاهی</a></li>
                                <li style="margin: 5px" class="nav-item btn-dark rounded"><a href="#"
                                        class="nav-link">آپارتمان</a></li>
                                <li style="margin: 5px" class="nav-item btn-dark rounded"><a href="#"
                                        class="nav-link">باغ و ویلا</a></li>
                                <li style="margin: 5px" class="nav-item btn-dark rounded"><a href="#"
                                        class="nav-link">زمین و ملک</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="footer-widget contact-widget bordered">
                        <div class="widget-title d-flex justify-content-center align-items-center">
                            <h3 id="contact-us">تماس با ما
                                <hr class="text-hr">
                            </h3>
                        </div>
                        <div class="widget-content">
                            <ul class="info-list clearfix">
                                <li class="list-item">{{ $setting->company_address }} <div class="icon-container"><i
                                            class="fas fa-map-marker-alt"></i></div>
                                </li>
                                <li class="list-item"><a href="tel:09133310337">{{ $setting->support_phone }}</a>
                                    <div class="icon-container"><i class="fas fa-microphone"></i></div>
                                </li>
                                <li class="list-item"><a href="mailto:support@mellkgostar.ir">{{ $setting->email }}</a>
                                    <div class="icon-container"><i class="fas fa-envelope"></i></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="auto-container">
            <div class="inner-box clearfix">
                <figure class="footer-logo"><a href="#"><img
                            src="{{ asset('frontend/assets/images/footer-logo.png') }}" alt=""></a></figure>
            </div>
        </div>
    </div>
</footer>
