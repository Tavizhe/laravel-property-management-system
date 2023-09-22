@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
ملک گستر | ثبت ملک جدید
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


<!--Page Title-->
<section class="page-title-two cta-section bg-color-2 centred">
    <div class="pattern-layer"
        style="pointer-events: none; background-image: url({{ asset('frontend/assets/images/shape/shape-9.png') }})">
    </div>
    <div class="auto-container">
        <div class="content-box clearfix">
            <a style="font-size: 24px;" href="#">فرم درخواست ثبت ملک</a>
            <div class="text-center">
                <nav aria-label="bread-crumb">
                    <ol class="bread-crumb">
                        <li><a href="{{ route('home') }}">خانه</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="property-page-section property-list">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <img src="/upload/request-form.jpg" class="card-img-top" alt="Image">
                <div class="card-body">
                    <h5 class="card-title text-center">درخواست ثبت ملک</h5>
                    <hr>
                    <form id="myForm" method="POST" action="{{ route('formForUs') }}" class="forms-sample">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="owner" class="form-label"></label>نام مالک یا معرف :</label>
                                    <input type="string" name="owner" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="phone" class="form-label"></label>شماره موبایل:</label>
                                    <input type="string" name="phone" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">

                            <h5 class="card-title text-center">اطلاعات مربوط به ملک</h5>
                            <hr>
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="onvan" class="form-label"></label>عنوان ملک:</label>
                                    <input type="string" name="onvan" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="status" class="form-label"></label>وضعیت ملک:</label>
                                    <input type="string" name="status" class="form-control"
                                        placeholder="برای فروش یا رهن و اجاره">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="price" class="form-label"></label>قیمت:</label>
                                    <input type="string" name="price" class="form-control"
                                        placeholder="مبلغ یا رهن و اجاره رو بنویسید">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="rooms" class="form-label"></label>تعداد اتاق ها</label>
                                    <input type="string" name="rooms" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mb-6">
                                    <label for="tozihat" class="form-label"></label>توضیحات ملک:</label> <textarea
                                        type="text" name="tozihat" class="form-control resizable"></textarea>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="masahat" class="form-label"></label>متراژ مساحتی زمین</label>
                                    <input type="string" name="masahat" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="zirbana" class="form-label"></label>متراژ زیربنای ساختمان</label>
                                    <input type="string" name="zirbana" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="jahat" class="form-label"></label>جهت ملک</label>
                                    <input type="string" name="jahat" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="nama" class="form-label"></label>نمای ساختمان</label>
                                    <input type="string" name="nama" class="form-control"
                                        placeholder="ساخت کامل آجر یا...">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="sanad" class="form-label"></label>نوع سند</label>
                                    <input type="string" name="sanad" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="adress" class="form-label"></label>آدرس ملک</label>
                                    <input type="string" name="adress" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mb-6">
                                    <label for="tozihat2" class="form-label"></label>توضیحات اضافی
                                    ملک:</label>
                                    <textarea type="text" name="tozihat2" class="form-control resizable"></textarea>
                                </div>
                            </div>

                            <br>
                            <br>
                            <br>
                            <br>
                            <p>لطفاً عکسای های مربوط به ملک خودتون را به همراه برگه قیمت برای ما به شماره ی
                                ۰۹۱۳۳۳۱۰۳۳۷
                                در تلگرام یا واتس آپ یا ایتا ارسال نمایید</p>
                            <br>
                            <button type="submit" class="btn btn-primary w-100">ارسال درخواست</button>
                        </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                name: {
                    required: true,
                },
                pType: {
                    required: true,
                },
                phone: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: 'لطفا فامیل خود را وارد فرمایید',
                },
                pType: {
                    required: 'لطفا یک مورد را انتخاب فرمایید',
                },
                phone: {
                    required: 'لطفا شماره موبایل خود را وارد فرمایید',
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
    </script>
    @endsection