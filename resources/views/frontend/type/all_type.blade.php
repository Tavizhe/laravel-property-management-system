@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
انواع ملک | املاک ملک گستر
@endsection
<style>
    .inner-box {
        position: relative;
        z-index: 0;
    }

    .inner-box .overlay {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.2);
        z-index: -1;
    }
</style>
<section class="page-title-two bg-color-1 centred">
    <div class="pattern-layer">
        <div class="pattern-1" style="background-image: url({{ asset('frontend/assets/images/shape/shape-9.png') }});">
        </div>
        <div class="pattern-2" style="background-image: url({{ asset('frontend/assets/images/shape/shape-10.png') }});">
        </div>
    </div>
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>املاک</h1>
            <ul class="">
                <li><a href="{{ route('home') }}">خانه</a></li>
                <li>لیست کلیه املاک</li>
            </ul>
        </div>
    </div>
</section>
<div class="page-content">
    @php
    $ptype = App\Models\PropertyType::latest()->get();
    @endphp
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="sec-title centred">
                <h5 style="color: #FFD700" class="fw-bold text-center mt-4 mb-3 border p-2 rounded-pill bg-color-2">دسته
                    بندی املاک</h5>
                </h5>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <div class="row ">
                            @foreach ($types as $key => $item)
                            @php
                            $property = App\Models\Property::where('ptype_id', $item->id)->get();
                            @endphp
                            <div class="col-md-3">
                                <ul class="category-list clearfix">
                                    <div class="category-block-one">
                                        <div style="background-image: url('/{{ $item->type_icon }}');background-size: cover; height:210px;wieght:182px"
                                            class="inner-box center m-5">
                                            <div class="overlay"></div>
                                            <h5 class="center" style="text-align: center"><a
                                                    style="background-color: white;border-radius: 10px;width: 7ch;text-decoration: none;text-align: center"
                                                    href="{{ route('property.type', $item->id) }}">{{ $item->type_name
                                                    }}</a>
                                                <hr><span>{{ count($property) }}</span>
                                            </h5>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="property-page-section property-list">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 content-side">
                <div class="property-content-side">
                    <div class="wrapper list">
                        <div class="deals-list-content list-item">
                            @foreach ($properties as $item)
                            <div class="lower-content">
                                <div class="author-info clearfix">
                                </div>
                            </div>
                            <div class="deals-block-one">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img src="{{ asset($item->property_thumbnail) }}" alt=""
                                                style="width:300px; height:350px;"></figure>
                                    </div>
                                    <div class="lower-content">
                                        <div class="author-info clearfix">
                                            <div class="title-text">
                                                <h4><a style="text-decoration: none;"
                                                        href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}">کد:
                                                        {{ $item->property_name }}</a>
                                                    <div class="buy-btn pull-left">
                                                        <a style="color: white; text-decoration: none;">{{
                                                            $item->type->type_name }}</a>
                                                        @php
                                                        $status = $item->property_status === 'rent' ? 'اجاره' : 'خرید';
                                                        @endphp
                                                        <button class="btn btn-primary float-end m-2">برای: {{ $status
                                                            }}</button>
                                                        <button class="btn btn-primary float-end m-2">
                                                            <a>{{
                                                                $item->type->type_name }}</a>
                                                        </button>
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
                                                        <h4>{{ number_format($item->lowest_price, 0, '.',
                                                            ',') }}
                                                            میلیون
                                                            تومان</h4>
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-6">
                                                        @if ($item->house_mortgage != 0)
                                                        <h6>رهن</h6>
                                                        <h4>{{ number_format($item->house_mortgage, 0, '.',
                                                            ',') }}
                                                            میلیون تومان
                                                        </h4>
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-6">
                                                        @if ($item->rent != 0)
                                                        <h6>اجاره</h6>
                                                        <h4>{{ number_format($item->rent, 0, '.', ',') }}
                                                            تومان
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
                                                            <li style="text-align: left">{{ $item->bedrooms
                                                                }}
                                                                خوابه <i class="bi icon-14 float-end"></i>
                                                            </li>
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
                    <nav class="pagination-wrapper">
                        <ul class="pagination justify-content-center">
                            {{ $properties->links('vendor.pagination.custom') }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection