@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
    خرید ملک | املاک ملک گستر
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
            <h1>خرید ملک</h1>
            <ul class="">
                <li><a href="{{ route('home') }}">خانه</a></li>
                <li>لیست املاک برای خرید</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->
<!-- property-page-section -->
<style>
    .buy-btn {
        position: relative;
        display: inline-block;
        font-size: 12px;
        line-height: 26px;
        color: #ffffff;
        font-weight: 500;
        text-transform: uppercase;
        text-align: center;
        border-radius: 3px;
        background-color: #7360ff;
        padding: 0px 14px;
    }
</style>
<section class="property-page-section property-list">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 content-side">
                <div class="property-content-side">
                    <div class="item-shorting clearfix">
                        <div class="left-column pull-right">
                            <h5>نتیجه جستجو: <span>نمایش {{ count($property) }} مورد از {{ $count }} ملک</span></h5>
                        </div>
                        <div class="right-column pull-right clearfix">
                        </div>
                    </div>
                    <div class="wrapper list">
                        <div class="deals-list-content list-item">
                            @foreach ($property as $item)
                                <div class="deals-block-one">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <figure class="image"><img src="{{ asset($item->property_thumbnail) }}"
                                                    alt="" style="width:300px; height:350px;"></figure>
                                        </div>
                                        <div class="lower-content">
                                            <div class="author-info clearfix">
                                                <div class="title-text">
                                                    <h4><a style="text-decoration: none;"
                                                            href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}">کد:
                                                            {{ $item->property_name }}</a>
                                                        <div class="buy-btn pull-left">
                                                            <a
                                                                style="color: white; text-decoration: none;">{{ $item->type->type_name }}</a>
                                                        </div>
                                                    </h4>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="price-box clearfix">
                                                <div class="price-info pull-right">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            @if ($item->lowest_price != 0)
                                                                <h6>مبلغ</h6>
                                                                <h4>{{ number_format($item->lowest_price, 0, '.', ',') }}
                                                                    میلیون
                                                                    تومان</h4>
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-6">
                                                            @if ($item->house_mortgage != 0)
                                                                <h6>رهن</h6>
                                                                <h4>{{ number_format($item->house_mortgage, 0, '.', ',') }}
                                                                    میلیون تومان
                                                                </h4>
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-6">
                                                            @if ($item->rent != 0)
                                                                <h6>اجاره</h6>
                                                                <h4>{{ number_format($item->rent, 0, '.', ',') }} تومان
                                                                </h4>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <p>{{ $item->short_desc }}</p>
                                                <br>
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <ul class="more-details">
                                                                @if ($item->bedrooms)
                                                                    <li style="text-align: left">{{ $item->bedrooms }}
                                                                        خوابه <i class="bi icon-14 float-end"></i></li>
                                                                @endif
                                                                @if ($item->bathrooms)
                                                                    <li style="text-align: left">
                                                                        {{ $item->bathrooms }}
                                                                        سرویس <i class="bi icon-15 float-end"></i>
                                                                    </li>
                                                                @endif
                                                                @if ($item->property_size)
                                                                <li style="text-align: left">
                                                                    {{ $item->property_size }}
                                                                    متر <i class="bi icon-16 float-end"></i>
                                                                </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row justify-content-center">
                                            <div class="col-md-12 text-center">
                                                <a href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}"
                                                    class="btn btn-primary p-2">نمایش اطلاعات بیشتر</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="pagination-wrapper">
                        {{ $property->links('vendor.pagination.custom') }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
