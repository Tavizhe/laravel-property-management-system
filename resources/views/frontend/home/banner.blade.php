@php
$ptypes = App\Models\PropertyType::latest()->get();
@endphp
<style>
    .arrow-down {
        width: 0;
        height: 0;
        border-left: 20px solid transparent;
        border-right: 20px solid transparent;
        border-top: 20px solid #f00;
    }
</style>
<section style="background-color: black" class="banner-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="content-box text-center">
                    <h2 class="text-warning">گروه مشاورین املاک ملک گستر</h2>
                    <hr class="hr text-white">
                    <h4 class="text-warning">بهترین املاک شهر و محل اقامت خود را پیدا کنید</h4>
                    <br>
                </div>
                <div class="search-field">
                    <div class="tabs-box">
                        <div class="tab-btn-box">
                            <ul class="tab-btns tab-buttons centred clearfix d-flex justify-content-center">
                                <li class="tab-btn active-btn" data-tab="#tab-1">خرید و فروش</li>
                                <li class="tab-btn" data-tab="#tab-2">رهن و اجاره</li>
                            </ul>
                        </div>
                        <div class="tabs-content info-group">
                            <div class="tab active-tab" id="tab-1">
                                <div class="inner-box">
                                    <div class="top-search rounded-pill">
                                        <form action="{{ route('buy.property.search') }}" method="post"
                                            class="search-form">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-5 col-md-12 mb-3 mb-lg-0">
                                                    <div class="form-group">
                                                        <div class="field-input">
                                                            <i class="fas fa-search"></i>
                                                            <input class="form-control rounded-pill" type="search"
                                                                name="search" style="padding-right: 5px"
                                                                placeholder="اطلاعات ملک را وارد فرمایید" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-lg-3 col-md-6 mb-3 mb-lg-0 d-flex justify-content-center">
                                                    <div class="form-group">
                                                        <div class="select-box">
                                                            <select name="pType_id" class="form-control rounded-pill">
                                                                <option>لیست املاک</option>
                                                                @foreach ($ptypes as $type)
                                                                <option value="{{ $type->type_name }}">{{
                                                                    $type->type_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 d-flex justify-content-center">
                                                    <div class="form-group">
                                                        <button style="font-size: 14px;font-weight:bold" type="submit"
                                                            class="btn btn-primary btn-lx rounded-pill">جست و
                                                            جو</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab" id="tab-2">
                                <div class="inner-box">
                                    <div class="top-search">
                                        <form action="{{ route('rent.property.search') }}" method="post"
                                            class="search-form">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-5 col-md-12 mb-3 mb-lg-0">
                                                    <div class="form-group">
                                                        <div class="field-input">
                                                            <i class="fas fa-search"></i>
                                                            <input class="form-control rounded-pill" type="search"
                                                                name="search" style="padding-right: 5px"
                                                                placeholder="اطلاعات ملک را وارد فرمایید" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-lg-3 col-md-6 mb-3 mb-lg-0 d-flex justify-content-center">
                                                    <div class="form-group">
                                                        <div class="select-box">
                                                            <select name="pType_id" class="form-control rounded-pill">
                                                                <option>لیست املاک</option>
                                                                @foreach ($ptypes as $type)
                                                                <option value="{{ $type->type_name }}">{{
                                                                    $type->type_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 d-flex justify-content-center">
                                                    <div class="form-group">
                                                        <button style="font-size: 14px;font-weight:bold" type="submit"
                                                            class="btn btn-primary btn-lx rounded-pill">جست و
                                                            جو</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>