@php
    $ptypes = App\Models\PropertyType::latest()->get();
@endphp
<style>
    .arrow-down {
        width: 0;
        height: 0;
        border-left: 20px solid transparent;
        border-right: 20px solid transparent;
        border-top: 20px solid #ffa600;
    }
</style>
<style>
    ::selection {
        color: #fff;
        background: #17A2B8;
    }

    .price-input {
        width: 100%;
        display: flex;
        margin: 30px 0 35px;
    }

    .wrapper {
        width: 400px;
        background: #fff;
        border-radius: 10px;
        padding: 20px 25px 40px;
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
    }

    .price-input .field {
        display: flex;
        width: 100%;
        height: 45px;
        align-items: center;
    }

    .field input {
        width: 100%;
        height: 100%;
        outline: none;
        font-size: 19px;
        margin-left: 12px;
        border-radius: 5px;
        text-align: center;
        border: 1px solid #999;
        -moz-appearance: textfield;
    }

    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }

    .price-input .separator {
        width: 130px;
        display: flex;
        font-size: 19px;
        align-items: center;
        justify-content: center;
    }

    .slider {
        height: 5px;
        position: relative;
        background: #ddd;
        border-radius: 5px;
    }

    .slider .progress {
        height: 100%;
        left: 25%;
        right: 25%;
        position: absolute;
        border-radius: 5px;
        background: #17A2B8;
    }

    .range-input {
        position: relative;
    }

    .range-input input {
        position: absolute;
        width: 100%;
        height: 5px;
        top: -5px;
        background: none;
        pointer-events: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }

    input[type="range"]::-webkit-slider-thumb {
        height: 17px;
        width: 17px;
        border-radius: 50%;
        background: #17A2B8;
        pointer-events: auto;
        -webkit-appearance: none;
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
    }

    input[type="range"]::-moz-range-thumb {
        height: 17px;
        width: 17px;
        border: none;
        border-radius: 50%;
        background: #17A2B8;
        pointer-events: auto;
        -moz-appearance: none;
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
    }

    form.form-search {
        font-size: 16px;
        margin-bottom: 10px;
        color: #006c70;
        font-weight: 700;
    }

    .main-inner {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 6px;
        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        -ms-border-radius: 6px;
        -o-border-radius: 6px;
    }

    .form-group-location {
        display: -webkit-flex;
        /* Safari */
        -webkit-align-items: center;
        /* Safari 7.0+ */
        display: flex;
        align-items: center;
        margin-left: -10px;
        margin-right: -10px;
    }

    .form-group-inner {
        position: relative;
        position: absolute;
        top: 50%;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        -o-transform: translateY(-50%);
        transform: translateY(-50%);
        right: 12px;
        font-size: 18px;
        z-index: 1;
        opacity: 0.7;
        filter: alpha(opacity=70);
    }

    .row-20 {
        margin-left: -10px;
        margin-right: -10px;
    }

    .content-main-inner {
        padding: 20px;
        background-color: #fff;
        border-radius: 6px;
        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        -ms-border-radius: 6px;
        -o-border-radius: 6px;
        margin: 10px;
    }

    .main-inner {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 6px;
        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        -ms-border-radius: 6px;
        -o-border-radius: 6px;
    }

    .search-form-inner {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        z-index: 3;
    }

    .form-search {
        font-size: 16px;
        margin-bottom: 10px;
        color: #006c70;
        font-weight: 700;
    }

    .style1 {
        display: inline-block;
        border-radius: 50px;
        -webkit-border-radius: 50px;
        -moz-border-radius: 50px;
        -ms-border-radius: 50px;
        -o-border-radius: 50px;
        padding: 9px 12px;
        background-color: rgba(255, 255, 255, 0.15);
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-align-items: center;
        /* Safari 7.0+ */
        align-items: center;
        -webkit-transition: all 0.3s ease-in-out 0s;
        -o-transition: all 0.3s ease-in-out 0s;
        transition: all 0.3s ease-in-out 0s;
    }

    .btn-submit {
        font-size: 14px;
        display: inline-block;
        margin-right: 8px;
    }

    .btn-theme {
        color: #fff;
        background-color: #ff5a5f;
        border-color: #ff5a5f;
    }
</style>
<section style="background-color: black" class="banner-section">
    <div class="auto-container">
        <div class="inner-container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="content-box text-center">
                        <h2 class="text-warning">گروه مشاورین املاک ملک گستر</h2>
                        <hr class="hr text-white">
                        <h4 class="text-warning">بهترین املاک شهر و محل اقامت خود را پیدا کنید</h4>
                        <br>
                    </div>
                </div>
            </div>
            <div class="search-field">
                <div class="tabs-box">
                    <div class="tab-btn-box">
                        <ul class="tab-btns tab-buttons centred clearfix">
                            <li class="tab-btn active-btn" data-tab="#tab-1">خرید و فروش</li>
                            <li class="tab-btn" data-tab="#tab-2">رهن و اجاره</li>
                            <li class="tab-btn" data-tab="#tab-3">بر اساس قیمت</li>
                            <li class="tab-btn" data-tab="#tab-4">بر اساس کد</li>
                        </ul>
                    </div>
                    <div class="tabs-content info-group">
                        <div class="tab active-tab" id="tab-1">
                            <div class="inner-box">
                                <div class="top-search">
                                    <form action="{{ route('buy.property.search') }}" method="post"
                                        class="search-form">
                                        @csrf
                                        <div class="row p-2">
                                            <ul class="d-flex" style="flex-wrap: nowrap;">
                                                <li style="flex-grow: 1;">
                                                    <div class="form-group">
                                                        <div class="field-input">
                                                            <i class="fas fa-search"></i>
                                                            <input style="padding-right: 5px;"
                                                                class="form-control rounded-pill" type="search"
                                                                name="search" placeholder="اطلاعات ملک را وارد فرمایید"
                                                                required>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li style="flex-grow: 1;">
                                                    <div class="form-group">
                                                        <div class="select-box">
                                                            <select name="pType_id" class="form-control rounded-pill">
                                                                <option>لیست املاک</option>
                                                                @foreach ($ptypes as $type)
                                                                    <option value="{{ $type->type_name }}">
                                                                        {{ $type->type_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li style="flex-grow: 0;" class="pt-2">
                                                    <div class="form-group" style="height: 50px;">
                                                        <button type="submit"
                                                            class="btn-submit btn btn-theme btn-inverse rounded-pill">جست
                                                            و جو</button>
                                                    </div>
                                                </li>
                                            </ul>
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
                                        <div class="row p-2">
                                            <ul class="d-flex" style="flex-wrap: nowrap;">
                                                <li style="flex-grow: 1;">
                                                    <div class="form-group">
                                                        <div class="field-input">
                                                            <i class="fas fa-search"></i>
                                                            <input style="padding-right: 5px;"
                                                                class="form-control rounded-pill" type="search"
                                                                name="search" placeholder="اطلاعات ملک را وارد فرمایید"
                                                                required>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li style="flex-grow: 1;">
                                                    <div class="form-group">
                                                        <div class="select-box">
                                                            <select name="pType_id" class="form-control rounded-pill">
                                                                <option>لیست املاک</option>
                                                                @foreach ($ptypes as $type)
                                                                    <option value="{{ $type->type_name }}">
                                                                        {{ $type->type_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li style="flex-grow: 0;" class="pt-2">
                                                    <div class="form-group" style="height: 50px;">
                                                        <button type="submit"
                                                            class="btn-submit btn btn-theme btn-inverse rounded-pill">جست
                                                            و جو</button>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab" id="tab-3">
                            <div class="inner-box">
                                <div class="top-search pr-5 pl-5">
                                    <form action="{{ route('filter.property.search') }}" method="post"
                                        class="search-form">
                                        @csrf
                                        <div class="container">
                                            <div class="col">
                                                <header class="field d-flex align-items-center justify-content-center">
                                                    <h6>محدوده قیمت مورد نظر خود را بر اساس میلیون وارد فرمایید:
                                                        ( برای مثال اینجا 2.5 میلیارد تا 7.5 میلیارد تنظیم شده است)</h6>
                                                </header>
                                                <div class="price-input">
                                                    <div class="field d-flex align-items-center justify-content-center">
                                                        <div class="col-sm-1">
                                                            <span>حداقل</span>
                                                            <input for type="number" name="min" class="input-min text-nowrap"
                                                                value="25000">
                                                        </div>
                                                        <div class="separator">-</div>
                                                        <div class="col-sm-1">
                                                            <span>حداکثر</span>
                                                            <input type="number" name="max" class="input-max text-nowrap"
                                                                value="75000">
                                                        </div>
                                                        <div
                                                            class="col-sm-2 p-2 d-flex align-items-center justify-content-center">
                                                            <button type="submit"
                                                                class="btn-submit btn btn-theme btn-inverse rounded-pill">جست
                                                                و جو</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="slider">
                                                    <div class="progress"></div>
                                                </div>
                                                <div class="range-input">
                                                    <input type="range" class="range-min" min="0"
                                                        max="100000" value="25000" step="1">
                                                    <input type="range" class="range-max" min="0"
                                                        max="100000" value="75000" step="1">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab" id="tab-4">
                            <div class="inner-box">
                                <div class="top-search">
                                    <form action="{{ route('CodeSearch.property.search') }}" method="post"
                                        class="search-form">
                                        @csrf
                                        <div class="row p-2">
                                            <ul class="d-flex" style="flex-wrap: nowrap;">
                                                <li style="flex-grow: 1;">
                                                    <div class="form-group">
                                                        <div class="field-input">
                                                            <i class="fas fa-search"></i>
                                                            <input style="padding-right: 5px;"
                                                                class="form-control rounded-pill" type="search"
                                                                name="search" placeholder="کد ملک را وارد فرمایید"
                                                                required>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li style="flex-grow: 0;" class="pt-2">
                                                    <div class="form-group" style="height: 50px;">
                                                        <button type="submit"
                                                            class="btn-submit btn btn-theme btn-inverse rounded-pill">جست
                                                            و جو</button>
                                                    </div>
                                                </li>
                                            </ul>
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
    <script>
        const rangeInput = document.querySelectorAll(".range-input input"),
            priceInput = document.querySelectorAll(".price-input input"),
            range = document.querySelector(".slider .progress");
        const formatter = new Intl.NumberFormat('en-US');
        let priceGap = 100;
        priceInput.forEach(input => {
            input.addEventListener("input", e => {
                let minPrice = parseInt(priceInput[0].value),
                    maxPrice = parseInt(priceInput[1].value);
                let formattedMinPrice = formatter.format(minPrice),
                    formattedMaxPrice = formatter.format(maxPrice);
                if ((formattedMaxPrice - formattedMinPrice >= priceGap) && formattedMaxPrice <= rangeInput[
                        1].max) {
                    if (e.target.className === "input-min") {
                        rangeInput[0].value = formattedMinPrice;
                        range.style.left = ((formattedMinPrice / rangeInput[0].max) * 100) + "%";
                    } else {
                        rangeInput[1].value = formattedMaxPrice;
                        range.style.right = 100 - (formattedMaxPrice / rangeInput[1].max) * 100 + "%";
                    }
                }
            });
        });
        rangeInput.forEach(input => {
            input.addEventListener("input", e => {
                let minVal = parseInt(rangeInput[0].value),
                    maxVal = parseInt(rangeInput[1].value);
                if ((maxVal - minVal) < priceGap) {
                    if (e.target.className === "range-min") {
                        rangeInput[0].value = maxVal - priceGap;
                    } else {
                        rangeInput[1].value = minVal + priceGap;
                    }
                } else {
                    priceInput[0].value = minVal;
                    priceInput[1].value = maxVal;
                    range.style.right = ((minVal / rangeInput[0].max) * 100) + "%";
                    range.style.left = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
                }
            });
        });
    </script>
</section>
