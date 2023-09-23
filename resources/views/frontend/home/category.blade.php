@php
$ptype = App\Models\PropertyType::latest()
->limit(5)
->get();
@endphp
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>
    .underline-on-hover:hover {
        text-decoration: underline;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <section class="category-section centered">
                <div class="auto-container">
                    <div class="sec-title centered">
                        <h3 style="color: #FFB616;" class="fw-bold ml-4 mr-4 border p-2 rounded-pill bg-color-2">خدمات ما</h3>
                    </div>
                    <div class="inner-container wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="800ms">
                        <ul class="category-list clearfix">
                            @php
                            $icons = ['fa fa-newspaper', 'fa fa-edit', 'fa fa-plus', 'fa fa-building', 'fa fa-home'];
                            $text = ['مقالات', 'کارشناسی املاک', 'ثبت ملک', 'درخواست ملک', 'بانک املاک'];
                            $link1 = [route('blog.list'), route('Index.kojanajafabad'), route('formForUsShow'), route('ShowRequestForProperty.ShowRequest'), route('FrontEndAllTypes.index')];
                            @endphp
                            <div style="align-items: center;justify-content: center;" class="row">
                            @for ($i = 0; $i < count($icons); $i++)
                                <div class="col-md-2">
                                    <div class="category-block-one">
                                        <div class="position-relative">
                                            <img style="border-radius: 25px;" src="upload/Category.jpg" alt="Category Image" class="img-fluid p-2 rounded-lg">
                                            <a style="color:black;text-decoration: none;" href="{{ $link1[$i] }}" class="position-absolute top-50 start-50 translate-middle text-center">
                                                <i class="{{ $icons[$i] }}" style="font-size: 20px; color:black"></i>
                                                <br>
                                                <h6 style="font-weight: bold;font-size: 12px" class="underline-on-hover">{{ $text[$i] }}</h6>
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
                                    <div class="more-btn"><a href="{{ route('rent.property') }}" class="btn btn-primary">لیست کامل املاک برای رهن</a></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="more-btn"><a href="{{ route('FrontEndAllTypes.index') }}" class="btn btn-primary">لیست کامل املاک و طبقه بندی ها</a></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="more-btn"><a href="{{ route('buy.property') }}" class="btn btn-primary">لیست کامل املاک برای خرید</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
