@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
{{ $property->property_name }} | Easy RealEstate
@endsection
<!-- CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
            <h1> کد ملک: {{ $property->property_name }}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">خانه</a></li>
            </ul>
        </div>
    </div>
</section>
<!-- property-details -->
<section class="property-details property-details-one">
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
                        <h3 id="buy">
                            مبلغ خرید:
                            <?php echo $formattedLowestPrice; ?> تومان
                        </h3>
                        <h3 id="rent-1">
                            رهن
                            <?php echo $formattedRent; ?> تومان
                        </h3>
                        <h3 id="rent-2">
                            اجاره
                            <?php echo $formattedhouseMortgage; ?> تومان
                        </h3>
                    </div>
                </div>
                <ul class="other-option pull-right clearfix">
                    <li><a href="property-details.html"><i class="icon-37"></i></a></li>
                    <li><a href="property-details.html"><i class="icon-38"></i></a></li>
                    <li><a href="property-details.html"><i class="icon-12"></i></a></li>
                    <li><a href="property-details.html"><i class="icon-13"></i></a></li>
                </ul>
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
                    <div class="top-details clearfix">
                        <div class="right-column pull-right clearfix">
                            <h3 id="buy">
                                عکس های ملک:
                            </h3>
                            <?php
                                if (!empty($images)) {
                                    $count = count($images);
                            ?>
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
                            @php
                            }
                            @endphp
                        </div>
                    </div>
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
                            <li class="float-end">کد ملک: {{ $propertyCode }}</li>
                            @endif
                            {{-- Bedrooms --}}
                            @if($bedrooms)
                            <li class="float-end">تعداد خواب: {{ $bedrooms }}</li>
                            @endif
                            {{-- Type Name --}}
                            @if($typeName)
                            <li class="float-end">نوع ملک: {{ $typeName }}</li>
                            @endif
                            {{-- Property Status --}}
                            @if($propertyStatus)
                            <li class="float-end">وضعیت ملک: برای {{ $propertyStatus }}</li>
                            @endif
                            {{-- Property Size --}}
                            @if($propertySize)
                            <li class="float-end">مساحت ملک: {{ $propertySize }} مساحت متراژ</li>
                            @endif
                            {{-- Garage --}}
                            @if($garage)
                            <li class="float-end">پارکینگ: {{ $garage }}</li>
                            @endif
                        </ul>
                    </div> @if(!empty($amenities2))
                    <div class="amenities-box content-widget">
                        <h4>اطلاعات بیشتر</h4>
                        <ul class="list clearfix">
                            <li>سند:{{ $amenities2 }}</li>
                        </ul>
                    </div>@endif
                    @if ($videos && filter_var($videos, FILTER_VALIDATE_URL))
                    <div class="statistics-box content-widget">
                        <div class="title-box">
                            <h4>فیلم ملک</h4>
                        </div>
                        <div class="video-box">
                            <video width="640" height="480" controls>
                                <source src="{{ asset($videos) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <script>
            var users = @json($property2);
            var elements = [{
                    id: "buy",
                    property: "lowest_price"
                },
                {
                    id: "rent-1",
                    property: "house_mortgage"
                },
                {
                    id: "rent-2",
                    property: "rent"
                },
                {
                    id: "buy-a",
                    property: "lowest_price"
                },
                {
                    id: "rent-1-a",
                    property: "house_mortgage"
                },
                {
                    id: "rent-2-a",
                    property: "rent"
                },
                {
                    id: "rent-2-a",
                    property: "rent"
                }
            ];
            for (var i = 0; i < elements.length; i++) {
                var element = document.getElementById(elements[i].id);
                if (users[0][elements[i].property] == 0) {
                    element.style.display = "none";
                } else {
                    element.style.display = "block";
                }
            }
        </script>
</section>
<!-- property-details end -->
@endsection