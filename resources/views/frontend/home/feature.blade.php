@php
    $property = App\Models\Property::where('status', '1')
        ->limit(3)
        ->latest()
        ->get();
@endphp
<section class="feature-section sec-pad">
    <div class="auto-container">
        <div class="sec-title centred">
            <h5 style="color: #FFD700" class="fw-bold text-center mt-4 mb-3 border p-2 rounded-pill bg-color-2">آخرین
                املاک ثبت شده</h5>
        </div>
        <div class="row clearfix">
            @foreach ($property as $item)
                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="{{ asset($item->property_thumbnail) }}" alt="">
                                </figure>
                                <span class="category">جدید</span></span>
                            </div>
                            <div class="lower-content">
                                <div class="author-info clearfix">
                                    <div class="title-text text-center">
                                        <h4><a style="text-decoration: none;"
                                                href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}">کد:
                                                {{ $item->property_name }}</a></h4>
                                    </div>
                                    <hr>
                                    <div class="buy-btn pull-left">
                                        <a
                                            href="{{ url('property/details/' . $item->id . '/' . $item->property_slug, $item->type) }}">{{ $item->type->type_name }}</a>
                                    </div>
                                    @php
                                        $status = $item->property_status === 'rent' ? 'اجاره' : 'خرید';
                                    @endphp
                                    <div class="buy-btn pull-right"><a>برای: {{ $status }}</a></div>
                                </div>
                                <div class="price-box clearfix">
                                    <div class="price-info pull-right">
                                        @if ($item->lowest_price != 0)
                                            <h6>مبلغ</h6>
                                            <h4>{{ number_format($item->lowest_price, 0, '.', ',') }} میلیون تومان</h4>
                                        @endif
                                        @if ($item->house_mortgage != 0)
                                            <h6>رهن</h6>
                                            <h4>{{ number_format($item->house_mortgage, 0, '.', ',') }} میلیون تومان
                                            </h4>
                                        @endif
                                        @if ($item->rent != 0)
                                            <h6>اجاره</h6>
                                            <h4>{{ number_format($item->rent, 0, '.', ',') }} تومان</h4>
                                        @endif
                                    </div>
                                </div>
                                <p>{{ $item->short_descp }}</p>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul class="more-details">
                                                <li style="text-align: left">{{ $item->bedrooms }} خوابه <i
                                                        class="bi icon-14 float-end"></i></li>
                                                <li style="text-align: left">{{ $item->bathrooms }} سرویس <i
                                                        class="bi icon-15 float-end"></i></li>
                                                <li style="text-align: left">{{ $item->property_size }} متر <i
                                                        class="bi icon-16 float-end"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                    <div class="container text-center">
                                        <div class="row">
                                            <div class="justify-content-center">
                                                <div class="col-md-12">
                                                    <a href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}"
                                                        class="theme-btn btn-two">نمایش اطلاعات بیشتر</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>