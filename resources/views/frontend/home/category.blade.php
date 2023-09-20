@php
$ptype = App\Models\PropertyType::latest()
->limit(5)
->get();
@endphp
<section class="category-section centred">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .underline-on-hover:hover {
            text-decoration: underline;
        }
    </style>
    <div class="auto-container">
        <div class="sec-title centred">
            <h3 style="color: #FFB616;" class="fw-bold text-center ml-4 mr-4 border p-2 rounded-pill bg-color-2">خدمات
                ما</h5>
            </h3>
        </div>
        <div class="inner-container wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="800ms">
            <ul class="category-list clearfix">
                <div class="row">
                    @php
                    $icons = [
                    'fa fa-newspaper',
                    'fas fa-edit',
                    'fas fa-building',
                    'fa fa-home'
                    ];
                    $text = ['مقالات', 'کارشناسی املاک', 'درخواست ملک', 'بانک املاک'];
                    $link1 = [route('blog.list'), route('Index.kojanajafabad'),
                    route('ShowRequestForProperty.ShowRequest'), route('FrontEndAllTypes.index')];
                    @endphp
                    @for($i = 0; $i < 4; $i++) <div class="col-md-3">
                        <div class="category-block-one">
                            <div class="position-relative">
                                <img style="border-radius: 25px;" src="upload/Category.jpg" alt="Category Image"
                                    class="img-fluid p-2 rounded-lg">
                                <a style="color:black;text-decoration: none;" href="{{ $link1[$i] }}"
                                    class="position-absolute top-50 start-50 translate-middle text-center">
                                    <i class="{{ $icons[$i] }}" style="font-size: 40px; color:black"></i>
                                    <br>
                                    <h6 class="underline-on-hover">{{ $text[$i] }}</h6>
                                </a>
                            </div>
                        </div>
                </div>
                @endfor
        </div>
    </div>
    </div>
    </ul>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="more-btn"><a href="{{ route('rent.property') }}" class="btn btn-primary">لیست کامل
                        املاک برای
                        رهن</a></div>
            </div>
            <div class="col-md-4">
                <div class="more-btn"><a href="{{ route('FrontEndAllTypes.index') }}" class="btn btn-primary">لیست
                        کامل
                        املاک و طبقه بندی ها</a></div>
            </div>
            <div class="col-md-4">
                <div class="more-btn"><a href="{{ route('buy.property') }}" class="btn btn-primary">لیست کامل
                        املاک برای
                        خرید</a></div>
            </div>
        </div>
    </div>
</section>