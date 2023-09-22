@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
{{ $property->property_name }} | ملک گستر
@endsection
<!--Page Title-->

<head>
    <!-- Other head elements -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
</head>
<section class="page-title-two cta-section bg-color-2 centred">
    <div class="pattern-layer"
        style="pointer-events: none; background-image: url({{ asset('frontend/assets/images/shape/shape-9.png') }});">
    </div>
    <div class="auto-container">
        <div class="content-box clearfix">
            <a style="font-size: 24px;color:goldenrod;" href="#">کد ملک: {{ $property->property_name }}</a>
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
<!-- property-details -->
<section class="property-details property-details-one">
    <div class="bg-image">
        <div class="container h-100">
            <div class="row h-100 d-flex flex-column justify-content-center align-items-center">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <br>
                    <div class="container">
                        <div class="top-details clearfix">
                            <div class="container">
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        @if (!empty($imageUrl))
                                        <div class="right-column pull-right clearfix">
                                            <img style="max-height: 100%; max-width:100%;" src="{{ asset($imageUrl) }}"
                                                alt="">
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-lg-7 col-md-6 col-sm-6 col-xs-12">
                                        <h4>ملک برای {{ $property->property_status == 'rent' ? 'رهن و اجاره' : 'فروش' }}
                                            واقع در
                                            {{ $property->address }}</h4>
                                            <br>
                                        <div class="right-column pull-right clearfix">
                                            <div class="price-inner clearfix">
                                                <div class="price-box pull-right">
                                                    @php
                                                    $lowestPrice = $property->lowest_price;
                                                    $formattedLowestPrice = number_format($lowestPrice, 0, '.', ',');
                                                    $houseMortgage = $property->house_mortgage;
                                                    $formattedhouseMortgage = number_format($houseMortgage, 0, '.',
                                                    ',');
                                                    $rent = $property->rent;
                                                    $formattedRent = number_format($rent, 0, '.', ',');
                                                    @endphp
                                                    @if ($lowestPrice != 0)
                                                    <h3 id="buy">مبلغ خرید: {{ $formattedLowestPrice }} تومان</h3>
                                                    @endif
                                                    @if ($houseMortgage != 0)
                                                    <h3 id="rent-1">رهن {{ $formattedRent }} تومان</h3>
                                                    @endif
                                                    @if ($rent != 0)
                                                    <h3 id="rent-2">اجاره {{ $formattedhouseMortgage }} تومان</h3>
                                                    @endif
                                                </div>
                                            </div><br>
                                            <hr>
                                            <h4 class="list clearfix">توضیحات:
                                                <h6 class="list clearfix"> {{ $property->long_desc }} </h6>
                                            </h4>
                                            <hr>
                                            <h4>امکانات ملک:</h4>
                                            <ul style="list-style: none;padding: 0;"
                                                class="list-unstyled clearfix list-group">
                                                @php
                                                $propertyCode = $property->property_code ?? null;
                                                $bedrooms = $property->bedrooms ?? null;
                                                $typeName = $property->type->type_name ?? null;
                                                $propertyStatus = $property->property_status ?? null;
                                                $propertySize = $property->property_size ?? null;
                                                $garage = $property->garage ?? null;
                                                @endphp
                                                @if($propertyCode)
                                                <li style="display: flex;align-items: center;" class="float-end">
                                                    <style>
                                                        li.float-end::before {
                                                            content: "•";
                                                            color: black;
                                                            padding-left: 5px;
                                                        }
                                                    </style>
                                                    <h6>کد ملک: {{ $propertyCode }}</h6>
                                                </li>
                                                @endif
                                                @if($bedrooms)
                                                <li style="display: flex;align-items: center;" class="float-end">
                                                    <style>
                                                        li.float-end::before {
                                                            content: "•";
                                                            color: black;
                                                            padding-left: 5px;
                                                        }
                                                    </style>
                                                    <h6>تعداد خواب: {{ $bedrooms }} مورد</h6>
                                                </li>
                                                @endif
                                                @if($typeName)
                                                <li style="display: flex;align-items: center;" class="float-end">
                                                    <style>
                                                        li.float-end::before {
                                                            content: "•";
                                                            color: black;
                                                            padding-left: 5px;
                                                        }
                                                    </style>
                                                    <h6>نوع ملک: {{ $typeName }}</h6>
                                                </li>
                                                @endif
                                                @php
                                                $type = ($propertyStatus == 'rent') ? 'اجاره' : 'خرید';
                                                @endphp
                                                <li style="display: flex;align-items: center;" class="float-end">
                                                    <style>
                                                        li.float-end::before {
                                                            content: "•";
                                                            color: black;
                                                            padding-left: 5px;
                                                        }
                                                    </style>وضعیت
                                                    ملک: {{ $type }}
                                                </li>
                                                <li style="display: flex;align-items: center;" class="float-end">
                                                    <style>
                                                        li.float-end::before {
                                                            content: "•";
                                                            color: black;
                                                            padding-left: 5px;
                                                        }
                                                    </style>
                                                    <h6>مساحت ملک: {{ $propertySize }} متر</h6>
                                                </li>
                                                @if($garage)
                                                <li style="display: flex;align-items: center;" class="float-end">
                                                    <style>
                                                        li.float-end::before {
                                                            content: "•";
                                                            color: black;
                                                            padding-left: 5px;
                                                        }
                                                    </style>
                                                    <h6>پارکینگ: {{ $garage }} مورد</h6>
                                                </li>
                                                @endif
                                                @if($property->Jahat)
                                                <li style="display: flex;align-items: center;" class="float-end">
                                                    <style>
                                                        li.float-end::before {
                                                            content: "•";
                                                            color: black;
                                                            padding-left: 5px;
                                                        }
                                                    </style>
                                                    <h6>جهت: {{ $property->Jahat }}</h6>
                                                </li>
                                                @endif
                                                @if($property->nama)
                                                <li style="display: flex;align-items: center;" class="float-end">
                                                    <style>
                                                        li.float-end::before {
                                                            content: "•";
                                                            color: black;
                                                            padding-left: 5px;
                                                        }
                                                    </style>
                                                    <h6>نما: {{ $property->nama }}</h6>
                                                </li>
                                                @endif
                                                @if($property->KafPush)
                                                <li style="display: flex;align-items: center;" class="float-end">
                                                    <style>
                                                        li.float-end::before {
                                                            content: "•";
                                                            color: black;
                                                            padding-left: 5px;
                                                        }
                                                    </style>
                                                    <h6>کف پوش: {{ $property->KafPush }}</h6>
                                                </li>
                                                @endif
                                                @if($property->ServiceKitchen)
                                                <li style="display: flex;align-items: center;" class="float-end">
                                                    <style>
                                                        li.float-end::before {
                                                            content: "•";
                                                            color: black;
                                                            padding-left: 5px;
                                                        }
                                                    </style>
                                                    <h6>سرویس کابینت: {{ $property->ServiceKitchen }}</h6>
                                                </li>
                                                @endif
                                                @if($property->VorudiMoshtarak)
                                                <li style="display: flex;align-items: center;" class="float-end">
                                                    <style>
                                                        li.float-end::before {
                                                            content: "•";
                                                            color: black;
                                                            padding-left: 5px;
                                                        }
                                                    </style>
                                                    <h6>ورودی مشترک: @if($property->VorudiMoshtarak) دارد @else ندارد
                                                        @endif</h6>
                                                </li>
                                                @endif
                                            </ul>
                                            <hr>
                                            @if($images)
                                            <button type="button" class="btn btn-primary"
                                                onclick="location.href='#image'">نمایش
                                                عکسها</button>
                                            @endif
                                            @if($firstVideo)
                                            <button type="button" class="btn btn-primary"
                                                onclick="location.href='#film'">نمایش
                                                فیلم</a>
                                                @endif
                                                @if (!$images && !$firstVideo)
                                                <button type="button" class="btn btn-primary"
                                                    onclick="location.href='#'">عکس و فیلم موجود نیست</a>
                                                    @endif
                                                    @if ($images && !$firstVideo)
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="location.href='#'">فیلم موجود نیست</a>
                                                        @endif
                                                        @if (!$images && $firstVideo)
                                                        <button type="button" class="btn btn-primary"
                                                            onclick="location.href='#'">عکس موجود نیست</a>
                                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                        <a href="{{ route('property.type', $property->type) }}"
                                            class="btn btn-primary">{{
                                            $property->type->type_name }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($images)
                        <section id="image" class="top-details">
                            <h3>
                                عکس های ملک:
                            </h3>
                            <div id="carouselExampleIndicators" class="carousel slide carousel-fade"
                                data-bs-ride="carousel">
                                <ol class="carousel-indicators">
                                    @foreach ($images as $key => $image)
                                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}"
                                        class="{{ $key == 0 ? 'active' : '' }}"></li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    @foreach ($images as $key => $image)
                                    @php
                                    $resizedImage = Image::make(public_path($image))->fit(612, 644)->encode('data-url');
                                    @endphp
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img style="height: 612px;width: 644px;" src="{{ $resizedImage }}"
                                            class="d-block w-100 carousel-image" alt="">
                                    </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">قبل</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">بعد</span>
                                </a>
                            </div>
                        </section>
                        @endif
                        @if($firstVideo)
                        <section id="film" class="top-details">
                            <h3>فیلم ملک:</h3>
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <video controls>
                                        <source src="{{ asset($firstVideo) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>
                        </section>
                        @endif
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- property-details end -->
@endsection