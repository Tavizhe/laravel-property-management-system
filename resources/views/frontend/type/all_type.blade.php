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

<section class="page-title-two cta-section bg-color-2 centred">
    <div class="pattern-layer"
        style="pointer-events: none; background-image: url({{ asset('frontend/assets/images/shape/shape-9.png') }})">
    </div>
    <div class="auto-container">
        <div class="content-box clearfix">
            <a style="font-size: 24px;" href="#">لیست کلیه املاک</a>
            <div class="text-center">
                <nav aria-label="bread-crumb">
                    <ol class="bread-crumb">
                        <li><a href="{{ route('home') }}">خانه</a></li>
                        <li>لیست کلیه املاک</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="page-content">
        @php
            $ptype = App\Models\PropertyType::latest()->get();
        @endphp
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="sec-title centred">
                    <h5 style="color: #FFD700" class="fw-bold text-center mt-4 mb-3 border p-2 rounded-pill bg-color-2">
                        دسته
                        بندی املاک</h5>
                    </h5>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="row ">
                                @foreach ($types as $key => $items)
                                    @php
                                        $property = App\Models\Property::where('ptype_id', $items->id)->get();
                                    @endphp
                                    <div class="col-md-3">
                                        <ul class="category-list clearfix">
                                            <div class="category-block-one">
                                                <div style="background-image: url('/{{ $items->type_icon }}');background-size: cover; height:210px;wieght:182px"
                                                    class="inner-box center m-5">
                                                    <div class="overlay"></div>
                                                    <h5 class="center" style="text-align: center"><a
                                                            style="background-color: white;border-radius: 10px;width: 7ch;text-decoration: none;text-align: center"
                                                            href="{{ route('property.type', $items->id) }}">{{ $items->type_name }}</a>
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
</section>

<section class="property-page-section property-list">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 content-side">
                <div class="property-content-side">
                    <div class="item-shorting clearfix">
                        <div class="left-column pull-right">
                            <h5>نتیجه جستجو: <span>نمایش {{ count($property) }} مورد از {{ $count }} ملک</span>
                            </h5>
                        </div>
                        <div class="right-column pull-right clearfix">
                        </div>
                    </div>
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
                                            @php
                                                $type = $item->pType_id;
                                                if (!empty($item->property_thumbnail)) {
                                                    $property_thumbnail = $item->property_thumbnail;
                                                } else {
                                                    $property_thumbnail = 'upload/no-image/' . $type . '.jpg';
                                                }
                                            @endphp
                                            <figure class="image"><img src="{{ asset($property_thumbnail) }}"
                                                    alt="" style="width:300px; height:350px;"></figure>
                                        </div>
                                        <div class="lower-content">
                                            <div class="author-info clearfix">
                                                <div class="title-text">
                                                    <h4>
                                                        <h4><a href="{{ url('property/details/' . $item->id) }}">کد
                                                                {{ $item->property_name }})</a>
                                                            برای
                                                            {{ $item->property_status == 'rent' ? 'رهن و اجاره' : 'فروش' }}
                                                            واقع در
                                                            {{ $item->address }}
                                                            ({{ $item->type->type_name }})
                                                        </h4>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="price-box clearfix">
                                                <div class="price-info pull-right">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            @if ($item->lowest_price != 0)
                                                                @php
                                                                    $price = intval($item->lowest_price);
                                                                @endphp
                                                                @if ($price != 0)
                                                                    <h6>مبلغ</h6>
                                                                    <h4>{{ number_format($price, 0, '.', ',') }} تومان
                                                                    </h4>
                                                                    {{-- <h4>{{ print_r($item->lowest_price) }}</h4> --}}
                                                                @endif
                                                            @endif

                                                        </div>
                                                        <div class="col-lg-6">
                                                            @if ($item->house_mortgage != 0)
                                                                <h6>رهن</h6>
                                                                <h4>{{ number_format($item->house_mortgage, 0, '.', ',') }}
                                                                    تومان
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
                                                                    <li style="text-align: left">{{ $item->bedrooms }}
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
                                                <a href="{{ url('property/details/' . $item->id) }}"
                                                    class="btn btn-primary p-2">نمایش اطلاعات بیشتر</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <nav class="pagination-wrapper">
                            <ul class="pagination">
                                {{ $properties->onEachSide(0)->links('vendor.pagination.custom') }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
