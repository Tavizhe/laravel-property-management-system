@extends('frontend.frontend_dashboard')
@section('main')
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
                {{-- <h1> {{ $pBread->type_name }} Type Property </h1> --}}
                <ul class="">
                    <li><a href="{{ route('home') }}">خانه</a></li>
                    {{-- <li>{{ $pBread->type_name }} </li> --}}
                </ul>
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
                                                <figure class="image"><img src="{{ asset($item->property_thumbnail) }}"
                                                        alt="" style="width:300px; height:350px;"></figure>
                                            </div>
                                            <div class="lower-content">
                                                <div class="title-text">
                                                    <h4><a
                                                            href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}">{{ $item->property_name }}</a>
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
                                            <div class="container text-center">
                                                <div class="row">
                                                    <div class="justify-content-center">
                                                        <div class="col-md-12">
                                                            <a href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}"
                                                                class="theme-btn btn-two p-2">نمایش اطلاعات بیشتر</a>
                                                        </div>
                                                    </div>
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
            <nav class="pagination-wrapper">
                <ul class="pagination justify-content-center">
                    {{ $property->links('vendor.pagination.custom') }}
                </ul>
            </nav>
        </div>
    </section>
    <!-- property-page-section end -->

   
@endsection
