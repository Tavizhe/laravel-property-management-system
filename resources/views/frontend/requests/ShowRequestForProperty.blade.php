@extends('frontend.frontend_dashboard')
@section('title')
MellkGostar Real Estate
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
@section('main')
<!--Page Title-->
<section class="page-title-two cta-section bg-color-2 centred">
    <div class="pattern-layer"
        style="pointer-events: none; background-image: url({{ asset('frontend/assets/images/shape/shape-9.png') }})">
    </div>
    <div class="auto-container">
        <div class="content-box clearfix">
            <a style="font-size: 24px;" href="#">فرم درخواست ملک</a>
            <div class="text-center">
                <nav aria-label="bread-crumb">
                    <ol class="bread-crumb">
                        <li><a href="{{ route('home') }}">خانه</a></li>
                        <li>فرم درخواست ملک</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <img src="/upload/request-form.jpg" class="card-img-top" alt="Image">
                <div class="card-body">
                    <h5 class="card-title text-center">درخواست ملک</h5>
                    <hr>
                    <form id="myForm" method="POST" action="{{ route('RequestForProperty.Store') }}"
                        class="forms-sample">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="maxPrice" class="form-label">مبلغ سقف خرید</label>
                                    <input type="string" name="maxPrice" class="form-control">
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="maxMortgage" class="form-label">مبلغ سقف رهن</label>
                                    <input type="string" name="maxMortgage" class="form-control">
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="maxRent" class="form-label">مبلغ سقف اجاره
                                    </label>
                                    <input type="string" name="maxRent" class="form-control">
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="pType" class="form-label">نوع ملک مورد نظر</label>
                                    <select name="pType" class="form-select" id="exampleFormControlSelect1">
                                        <option selected="" disabled="">انتخاب کنید</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">اسم و فامیل شما</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label"></label>ایمیل(اختیاری)</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="phone" class="form-label">شماره موبایل</label>
                                    <input type="string" name="phone" class="form-control">
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="Description" class="form-label">توضیحات</label></label>
                                    <textarea type="text" name="Description" class="form-control resizable"></textarea>
                                </div>
                            </div><!-- Col -->
                            <button type="submit" class="btn btn-primary w-100">ارسال درخواست</button>
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