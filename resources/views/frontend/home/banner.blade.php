@php
$states = App\Models\State::latest()->get();
$ptypes = App\Models\PropertyType::latest()->get();

@endphp

<section class="banner-section"
    style="background-image: url({{ asset('frontend/assets/images/banner/banner-1.jpg') }});">
    <div class="auto-container">
        <div class="inner-container">
            <div class="content-box centred">
                <h2 style="color: #FFD700">گروه مشاورین املاک ملک گستر</h2>
                <p>بهترین املاک شهر و محل اقامت خود را پیدا کنید</p>
            </div>
            <div class="search-field">
                <div class="tabs-box">
                    <div class="tab-btn-box">
                        <ul class="tab-btns tab-buttons centred clearfix">
                            <li class="tab-btn active-btn" data-tab="#tab-1">خرید و فروش</li>
                            <li class="tab-btn" data-tab="#tab-2">رهن و اجاره</li>
                        </ul>
                    </div>
                    <div class="tabs-content info-group">
                        <div class="tab active-tab" id="tab-1">
                            <div class="inner-box">
                                <div class="top-search">
                                    <form action="{{ route('buy.property.search') }}" method="post" class="search-form">
                                        @csrf
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-12 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>ملک</label>
                                                    <div class="field-input">
                                                        <i class="fas fa-search"></i>
                                                        <input type="search" name="search" placeholder="نام ملک"
                                                            required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>مکان</label>
                                                    <div class="select-box">
                                                        <i class="far fa-compass"></i>
                                                        <select name="state" class="wide">
                                                            <option data-display="محدوده">Input location
                                                            </option>
                                                            @foreach ($states as $state)
                                                            <option value="{{ $state->state_name }}">
                                                                {{ $state->state_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>نوع ملک</label>
                                                    <div class="select-box">
                                                        <select name="pType_id" class="wide">
                                                            <option data-display="زمین یا منزل">All Type</option>
                                                            @foreach ($ptypes as $type)
                                                            <option value="{{ $type->type_name }}">
                                                                {{ $type->type_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="search-btn">
                                            <button type="submit"><i class="fas fa-search"></i>جستجو</button>
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

                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-12 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>ملک</label>
                                                    <div class="field-input">
                                                        <i class="fas fa-search"></i>
                                                        <input type="search" name="search" placeholder="نام ملک"
                                                            required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>مکان</label>
                                                    <div class="select-box">
                                                        <i class="far fa-compass"></i>
                                                        <select name="state" class="wide">
                                                            <option data-display="محدوده">Input location
                                                            </option>
                                                            @foreach ($states as $state)
                                                            <option value="{{ $state->state_name }}">
                                                                {{ $state->state_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>نوع ملک</label>
                                                    <div class="select-box">
                                                        <select name="pType_id" class="wide">
                                                            <option data-display="منزل یا باغ">All Type</option>
                                                            @foreach ($ptypes as $type)
                                                            <option value="{{ $type->type_name }}">
                                                                {{ $type->type_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="search-btn">
                                            <button type="submit"><i class="fas fa-search"></i>جستجو</button>
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
</section>