@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
    {{ $property->property_name }} | Easy RealEstate
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
            <h1> کد ملک: {{ $property->property_name }}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">خانه</a></li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->
<!-- property-details -->
<section class="property-details property-details-one">
    <div class="auto-container">
        <div class="top-details clearfix">
            <div class="right-column pull-right clearfix">
                <div class="price-inner clearfix">
                    <ul class="category clearfix pull-left">
                        <li><a href="{{ route('property.type', $property->type) }}">{{ $property->type->type_name }}</a>
                            {{-- </li>
                        @php
                            $buyRoute = '';
                            $rentRoute = '';
                        
                            if ($property->property_status == 'buy') {
                                $buyRoute = route('buy.property');
                            } elseif ($property->property_status == 'rent') {
                                $rentRoute = route('rent.property');
                            }
                        @endphp
                        
                        <li><a href="{{ $buyRoute }}">برای خرید</a></li>
                        <li><a href="{{ $rentRoute }}">برای رهن</a></li> --}}

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
        <img src="{{ $imageUrl }}" alt="Image">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 content-side">
                <div class="property-details-content">
                    <div class="carousel-inner">
                        <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">
                            {{-- @foreach ($images as $img)
                                <figure class="image-box"><img src="{{ $img }}" alt="">
                                </figure>
                            @endforeach --}}
                        </div>
                    </div>
                    <div class="discription-box content-widget">
                        <div class="title-box">
                            <h4>توضیحات مربوطه:</h4>
                        </div>
                        <div class="text">
                            <p>{!! $property->long_descp !!}</p>
                        </div>
                    </div>
                    <div class="details-box content-widget">
                        <div class="title-box">
                            <h4>امکانات ملک:</h4>
                        </div>
                        <ul class="list clearfix">
                            <li>کد ملک: <span>{{ $property->property_code }}</span></li>
                            <li>تعداد خواب: <span>{{ $property->bedrooms }}</span></li>
                            <li>نوع ملک: <span>{{ $property->type->type_name }}</span></li>
                            <li>وضعیت ملک: <span>برای {{ $property->property_status }}</span></li>
                            <li>مساحت ملک: <span>{{ $property->property_size }} مساحت متراژ</span></li>
                            <li>پارکینگ: <span>{{ $property->garage }}</span></li>
                        </ul>
                    </div>
                    <div class="amenities-box content-widget">
                        <div class="title-box">
                            <h4>امکانات اضافی:</h4>
                        </div>
                        <ul class="list clearfix">
                            @foreach ($property_amen as $amen)
                                <li>{{ $amen }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="location-box content-widget">
                        <div class="title-box">
                            <h4>حدوده محدوده بر نقشه</h4>
                        </div>
                        <ul class="info clearfix">
                            <span>حدود آدرس:</span> {{ $property->address }}
                            {{-- <li><span>State/county:</span> {{ $property['pstate']['state_name'] }}</li>
                            <li><span>Neighborhood:</span> {{ $property->neighborhood }}</li>
                            <li><span>Zip/Postal Code:</span> {{ $property->postal_code }}</li>
                            <li><span>City:</span> {{ $property->city }}</li> --}}
                        </ul>
                        {{-- <div class="google-map-area">
                            <div class="google-map" id="contact-google-map" data-map-lat="{{ $property->latitude }}"
                                data-map-lng="{{ $property->longitude }}"
                                data-icon-path="{{ asset('frontend/assets/images/icons/map-marker.png') }}"
                                data-map-title="Brooklyn, New York, United Kingdom" data-map-zoom="12"
                                data-markers='{
            "marker-1": [40.712776, -74.005974, "<h4>Branch Office</h4><p>77/99 New York</p>","{{ asset('
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            frontend/assets/images/icons/map-marker.png') }}"] }'>
                            </div>
                        </div> --}}
                    </div>
                    <div class="nearby-box content-widget">
                        {{-- <div class="title-box">
                            <h4>What’s Nearby?</h4>
                        </div>
                        <div class="inner-box"> --}}
                        {{-- <div class="single-item">
                                <div class="icon-box"><i class="fas fa-book-reader"></i></div>
                                <div class="inner">
                                    <h5>Places:</h5>
                                    {{-- @foreach ($facility as $item)
                                    <div class="box clearfix">
                                        <div class="text pull-left">
                                            <h6>{{ $item->facility_name }} <span>({{ $item->distance }} km)</span></h6>
                                        </div>
                                        <ul class="rating pull-right clearfix">
                                            <li><i class="icon-39"></i></li>
                                            <li><i class="icon-39"></i></li>
                                            <li><i class="icon-39"></i></li>
                                            <li><i class="icon-39"></i></li>
                                            <li><i class="icon-40"></i></li>
                                        </ul>
                                    </div>
                                    @endforeach
                                </div>
                            </div> 
                        </div> --}}
                    </div>
                    <div class="statistics-box content-widget">
                        <div class="title-box">
                            <h4>فیلم ملک</h4>
                        </div>
                        <figure class="image-box">
                            <iframe width="700" height="415" src="{{ $property->property_video }}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                        </figure>
                    </div>
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
