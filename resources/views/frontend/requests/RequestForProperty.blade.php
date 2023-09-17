@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
MellkGostar Real Estate
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<div class="col-md-8 col-xl-8 middle-wrapper">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">درخواست ملک</h6>
                <form id="myForm" method="POST" action="{{ route('RequestForProperty.GetRequest') }}"
                    class="forms-sample">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1" class="form-label">مبلغ سقف خرید</label>
                        <input type="string" name="maxPrice" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1" class="form-label">مبلغ سقف رهن</label>
                        <input type="string" name="maxMortgage" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1" class="form-label">مبلغ سقف اجاره
                        </label>
                        <input type="string" name="maxRent" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1" class="form-label">نوع ملک مورد نظر</label>
                        <select name="pType" class="form-select" id="exampleFormControlSelect1">
                            <option selected="" disabled="">انتخاب کنید</option>
                            <option value="1">1</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1" class="form-label">Admin Address </label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1" class="form-label">Admin Password </label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1" class="form-label">Admin Password </label>
                        <input type="string" name="phone" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1" class="form-label">Admin Password </label>
                        <input type="text" name="Description" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">ارسال درخواست</button>
                </form>
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