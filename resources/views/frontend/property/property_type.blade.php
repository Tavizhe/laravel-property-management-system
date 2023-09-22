@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
نمایش مدل ملک انتخابی| املاک ملک گستر
@endsection
<!--Page Title-->
<section class="page-title-two cta-section bg-color-2 centred">
    <div class="pattern-layer"
        style="pointer-events: none; background-image: url({{ asset('frontend/assets/images/shape/shape-9.png') }});">
    </div>
    <div class="auto-container">
        <div class="content-box clearfix">
            <a style="font-size: 24px" href="#">نمایش مدل ملک انتخابی</a>
            <div class="text-center">
                <nav aria-label="bread-crumb">
                    <ol class="bread-crumb">
                        <li><a href="{{ route('home') }}">خانه</a></li>
                        </ul>
                    </ol>
                </nav>
            </div>
        </div>
</section>
<!--End Page Title-->
<!-- property-page-section -->
<section class="property-page-section property-list">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 content-side">
                <div class="property-content-side">
                    <div class="item-shorting clearfix">
                        <div class="left-column pull-right">
                            <h5>نتیجه جستجو: <span>نمایش {{ count($property) }} مورد</span></h5>
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
                                        <figure class="image"><img src="{{ asset($item->property_thumbnail) }}" alt=""
                                                style="width:300px; height:350px;"></figure>
                                    </div>
                                    <div class="lower-content">
                                        <div class="title-text">
                                            <h4><a href="{{ url('property/details/' . $item->id) }}">{{
                                                    $item->property_name }}</a>
                                            </h4>
                                        </div>
                                        <hr>
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
                                            <a href="{{ url('property/details/' . $item->id) }}"
                                                class="btn btn-primary p-2">نمایش اطلاعات بیشتر</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <nav class="pagination-wrapper">
                <ul class="pagination">
                    {{ $property->onEachSide(0)->links('vendor.pagination.custom') }}
                </ul>
            </nav>
        </div>
    </div>
</section>
<!-- property-page-section end -->
@endsection