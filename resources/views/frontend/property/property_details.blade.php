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
<!--End Page Title-->
<?php
echo '<div class="row">';
foreach ($images as $image) {
    echo '<div class="col-md-4 mt-4">';
    echo '<img src="' . '/' . $image . '" class="img-fluid" alt="Property Image">';
    echo '</div>';
}
echo '</div>';
?>
{{-- @foreach ($images as $image)
    <img src="{{ $image }}" alt="Image">
@endforeach --}}
{{-- <div id="slideshow-carousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach ($imagesSTR as $index => $image)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <img src="{{ $image }}" alt="Slide {{ $index + 1 }}" class="d-block w-100">
            </div>
        @endforeach
    </div>
</div> --}}

{{-- <div class="carousel-inner">
    <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">
        @foreach ($DirectPath as $img)
            <figure class="image-box"><img src="{{ asset($img->photo_name) }}" alt=""></figure>
        @endforeach
    </div>
</div> --}}
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
        <img src="{{ $imageUrl }}" alt="Image">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 content-side">
                <div class="property-details-content">
                    <div class="carousel-inner">
                        <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">
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
                        </ul>
                    </div>
                    <div class="nearby-box content-widget">
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
        <script>
            new bootstrap.Carousel(document.getElementById('slideshow-carousel'))
        </script>

</section>
<!-- property-details end -->
@endsection
