<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<div class="row col-12 text-center">
    <section class="category-section centered">
        <div class="sec-title centered">
            <h3 style="color: #FFB616;" class="fw-bold ml-4 mr-4 border p-2 rounded-pill bg-color-2">خدمات
                ما</h3>
        </div>
        <div class="inner-container wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="800ms">
            <ul class="category-list clearfix">
                @php
                $img = ['upload\category\مقالات.jpg', 'upload\category\کارشناسی املاک.jpg',
                'upload\category\ثبت ملک.jpg', 'upload\category\درخواست ملک.jpg',
                'upload\category\بانک املاک.jpg'];
                $link = [route('blog.list'), route('Index.kojanajafabad'), route('formForUsShow'),
                route('ShowRequestForProperty.ShowRequest'), route('FrontEndAllTypes.index')];
                @endphp
                <div style="justify-content: center;" class="row">
                    @for ($i = 0; $i < count($img); $i++) <div class="col-md-2">
                        <div class="category-block-one">
                            <div class="position-relative">
                                <a href="{{ $link[$i] }}">
                                    <img src="{{ $img[$i] }}" alt="Category Image" class="img-fluid rounded-lg p-1"
                                        style="border-radius: 25px;">
                                </a>
                            </div>
                        </div>
                </div>
                @endfor
        </div>
        </ul>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="more-btn"><a href="{{ route('rent.property') }}" class="btn btn-primary">لیست
                            کامل املاک برای رهن</a></div>
                </div>
                <div class="col-md-4">
                    <div class="more-btn"><a href="{{ route('FrontEndAllTypes.index') }}" class="btn btn-primary">لیست
                            کامل املاک و طبقه بندی ها</a></div>
                </div>
                <div class="col-md-4">
                    <div class="more-btn"><a href="{{ route('buy.property') }}" class="btn btn-primary">لیست
                            کامل املاک برای خرید</a></div>
                </div>
            </div>
        </div>
    </section>
</div>