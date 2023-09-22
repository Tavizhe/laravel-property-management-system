@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
Blog | املاک ملک گستر
@endsection

<!--Page Title-->
<section class="page-title-two cta-section bg-color-2 centred">
    <div class="pattern-layer"
        style="pointer-events: none; background-image: url({{ asset('frontend/assets/images/shape/shape-9.png') }})">
    </div>
    <div class="auto-container">
        <div class="content-box clearfix">
            <a style="font-size: 24px;" href="#">مقالات</a>
            <div class="text-center">
                <nav aria-label="bread-crumb">
                    <ol class="bread-crumb">
                        <li><a href="{{ route('home') }}">خانه</a></li>
                        <li>وبلاگ</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!--End Page Title-->
<section class="property-page-section property-list d-flex align-items-center justify-content-center">
    <div class="row">
        <h2>به زودی</h2>
    </div>
</section>

<!-- sidebar-page-container -->
<section class="sidebar-page-container blog-grid sec-pad-2">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-grid-content">
                    <div class="row clearfix">
                        @foreach ($blog as $item)
                        <div class="col-lg-6 col-md-6 col-sm-12 news-block">
                            <div class="news-block-one wow fadeInUp animated" data-wow-delay="00ms"
                                data-wow-duration="1500ms">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><a
                                                href="{{ url('blog/details/' . $item->post_slug) }}"><img
                                                    src="{{ asset($item->post_image) }}" alt=""></a>
                                        </figure>
                                        <span class="category">Featured</span>
                                    </div>
                                    <div class="lower-content">
                                        <h4><a href="{{ url('blog/details/' . $item->post_slug) }}">{{
                                                $item->post_title
                                                }}</a>
                                        </h4>
                                        <ul class="post-info clearfix">
                                            <li>{{ $item->created_at->format('M d Y') }}</li>
                                        </ul>
                                        <div class="text">
                                            <p>{{ $item->short_desc }}</p>
                                        </div>
                                        <div class="btn-box">
                                            <a href="{{ url('blog/details/' . $item->post_slug) }}"
                                                class="theme-btn btn-two">See Details</a>
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
</section>
@endsection