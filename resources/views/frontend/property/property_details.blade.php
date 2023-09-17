@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
{{ $property->property_name }} | ملک گستر
@endsection
<!-- CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!--Page Title-->
<section class="page-title-two bg-color-1 centred">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1> کد ملک: {{ $property->property_name }}</h1>
            <ul class="">
                <li><a href="{{ route('home') }}">خانه</a></li>
            </ul>
        </div>
    </div>
</section>
<!-- property-details -->
<section style="background-image: url('/{{ $pType1 }}'); background-size: cover;"
    class="property-details property-details-one">
    <div class="auto-container">
        <div class="top-details clearfix">
            <div class="right-column pull-right clearfix">
                <div class="price-inner clearfix">
                    <ul class="category clearfix pull-left">
                        <li><a href="{{ route('property.type', $property->type) }}">{{ $property->type->type_name }}</a>
                    </ul>
                    <div class="price-box
                                pull-right">
                        <?php
                        $lowestPrice = $property->lowest_price;
                        $formattedLowestPrice = number_format($lowestPrice, 0, '.', ',');
                        $houseMortgage = $property->house_mortgage;
                        $formattedhouseMortgage = number_format($houseMortgage, 0, '.', ',');
                        $Rent = $property->rent;
                        $formattedRent = number_format($Rent, 0, '.', ',');
                        ?>
                        @if ($lowestPrice != 0)
                        <h3 id="buy">
                            مبلغ خرید:
                            <?php echo $formattedLowestPrice; ?> تومان
                        </h3>
                        @endif
                        @if ($houseMortgage != 0)
                        <h3 id="rent-1">
                            رهن
                            <?php echo $formattedRent; ?> تومان
                        </h3>
                        @endif
                        @if ($Rent != 0)
                        <h3 id="rent-2">
                            اجاره
                            <?php echo $formattedhouseMortgage; ?> تومان
                        </h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 content-side">
                <div class="property-details-content">
                    <div class="carousel-inner">
                        <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">
                        </div>
                    </div>
                    <div class="discription-box content-widget">
                        <h4 class="list clearfix">توضیحات:
                            <h6 class="list clearfix"> {!! $property->long_desc !!} </h6>
                        </h4>
                        <hr>
                        <h4>حدود آدرس:
                            <h6> {{ $property->address }} </h6>
                        </h4>
                    </div>
                    <?php
                   if (!empty($images)) {
                   $count = count($images);
                    ?>
                    <div class="top-details clearfix">
                        <div class="right-column pull-right clearfix">
                            <h3 id="buy">
                                عکس های ملک:
                            </h3>
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                <ol class="carousel-indicators">
                                    @foreach ($images as $index => $image)
                                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}"
                                        class="@if ($index === 0) active @endif"></li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    @foreach ($images as $index => $image)
                                    <div class="carousel-item @if ($index === 0) active @endif">
                                        <img src="{{ asset($image) }}" alt="">
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
                        </div>
                    </div>
                    @php
                    }
                    @endphp
                    <div class="details-box content-widget text-end">
                        <h4>امکانات ملک:</h4>
                        <ul class="list clearfix">
                            @php
                            // Assign the nested properties to variables to avoid multiple access
                            $propertyCode = $property->property_code ?? null;
                            $bedrooms = $property->bedrooms ?? null;
                            $typeName = $property->type->type_name ?? null;
                            $propertyStatus = $property->property_status ?? null;
                            $propertySize = $property->property_size ?? null;
                            $garage = $property->garage ?? null;
                            @endphp
                            {{-- Property Code --}}
                            @if($propertyCode)
                            <li class="float-end">
                                <h5>کد ملک: {{ $propertyCode }}</h5>
                            </li>
                            @endif
                            {{-- Bedrooms --}}
                            @if($bedrooms)
                            <li class="float-end">
                                <h5>تعداد خواب: {{ $bedrooms }}</h5>
                            </li>
                            @endif
                            {{-- Type Name --}}
                            @if($typeName)
                            <li class="float-end">
                                <h5>نوع ملک: {{ $typeName }}</h5>
                            </li>
                            @endif
                            {{-- Property Status --}}
                            @php
                            $type = ($propertyStatus == 'rent') ? 'اجاره' : 'خرید';
                            @endphp
                            <h5>وضعیت ملک: {{ $type }}</h5>
                            {{-- Property Size --}}
                            <li class="float-end">
                                <h5>مساحت ملک: {{ $propertySize }} متر</h5>
                            </li>
                            {{-- Garage --}}
                            @if($garage)
                            <li class="float-end">
                                <h5>پارکینگ: {{ $garage }}</h5>
                            </li>
                            @endif
                        </ul>
                    </div> @if(!empty($amenities2))
                    <div class="amenities-box content-widget">
                        <h4>اطلاعات بیشتر</h4>
                        <ul class="list clearfix">
                            <li>سند:{{ $amenities2 }}</li>
                        </ul>
                    </div>@endif
                    @if (!empty($firstVideo))
                    <div class="statistics-box content-widget">
                        <div class="title-box">
                            <h4>فیلم ملک</h4>
                        </div>
                        <div class="video-box">
                            <video width="640" height="480" controls>
                                <source src="{{ asset($firstVideo) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
</section>
<!-- property-details end -->
@endsection