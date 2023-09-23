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
            <div class="col-12">
                <div class="content-box text-center">
                    <h2 class="text-warning">گروه مشاورین املاک ملک گستر</h2>
                    <hr class="hr text-white">
                    <h4 class="text-warning">بهترین املاک شهر و محل اقامت خود را پیدا کنید</h4>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <div class="search-field">
        <div class="tabs-box">
            <div class="tab-btn-box">
                <ul class="tab-btns tab-buttons">
                    <li class="tab-btn active-btn" data-tab="#tab-1">خرید و فروش</li>
                    <li class="tab-btn" data-tab="#tab-2">رهن و اجاره</li>
                </ul>
            </div>
            <div class="tab active-tab" id="tab-1">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-lg-4">
                            <div class="top-search rounded-pill
                        ">
                                <form action="search.php" method="post">
                                    @csrf
                                    <div class="d-flex justify-content-center align-items-center">
                                        <ul class="col-md-6 col-lg-4 d-flex" style="flex-wrap: nowrap;">
                                            <li>
                                                <div class="form-group">
                                                    <div class="field-input">
                                                        <i class="fas fa-search"></i>
                                                        <input class="form-control rounded-pill" type="search"
                                                            name="search" placeholder="اطلاعات ملک را وارد فرمایید"
                                                            required>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-group">
                                                    <div class="select-box">
                                                        <select name="pType_id" class="form-control rounded-pill">
                                                            <option>لیست املاک</option>
                                                            @foreach ($ptypes as $type)
                                                            <option value="{{ $type->type_name }}">{{ $type->type_name
                                                                }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary rounded-pill">جست و
                                                        جو</button>
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
</section>