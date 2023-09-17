@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<div class="page-content">
    <div class="row profile-body">
        <!-- left wrapper start -->
        <!-- left wrapper end -->
        <!-- middle wrapper start -->
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">اضافه کردن ملک</h6>
                        <form method="post" action="{{ route('store.property') }}" id="myForm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">نام یا کد ملک</label>
                                        <input type="text" name="property_name" class="form-control">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">فروش یا اجاره</label>
                                        <select name="property_status" class="form-select"
                                            id="exampleFormControlSelect1">
                                            <option selected="" disabled="">انتخاب کنید</option>
                                            <option value="rent">برای رهن و کرایه</option>
                                            <option value="buy">برای خرید یا فروش</option>
                                        </select>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">مبلغ</label>
                                        <input type="text" name="lowest_price" class="form-control">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">رهن</label>
                                        <input type="text" name="house_mortgage" class="form-control">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">اجاره</label>
                                        <input type="text" name="rent" class="form-control">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">عکس اصلی</label>
                                        <input type="file" name="property_thumbnail" class="form-control"
                                            onChange="mainThamUrl(this)">
                                        <img src="" id="mainThmb">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">باقی عکس ها</label>
                                        <input type="file" name="multi_img[]" class="form-control" id="multiImg"
                                            multiple="">
                                        <div class="row" id="preview_img"> </div>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">تعداد خواب</label>
                                        <input type="text" name="bedrooms" class="form-control">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">سرویس</label>
                                        <input type="text" name="bathrooms" class="form-control">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">پارکینگ</label>
                                        <input type="text" name="garage" class="form-control">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">متراژ زیربنا</label>
                                        <input type="text" name="foundation_size" class="form-control">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">حدود آدرس</label>
                                        <input type="text" name="address" class="form-control">
                                    </div>
                                </div><!-- Col -->
                                {{-- <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text" name="city" class="form-control">
                                    </div>
                                </div><!-- Col --> --}}
                                {{-- <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">State</label>
                                        <select name="state" class="form-select" id="exampleFormControlSelect1">
                                            <option selected="" disabled="">Select State</option>
                                            @foreach ($pState as $state)
                                            <option value="{{ $state->id }}">{{ $state->state_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- Col --> --}}
                                {{-- <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Postal Code </label>
                                        <input type="text" name="postal_code" class="form-control">
                                    </div>
                                </div><!-- Col --> --}}
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">متراژ ملک</label>
                                        <input type="text" name="property_size" class="form-control">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">فیلم ملک</label>
                                        <input type="text" name="property_video" class="form-control">
                                    </div>
                                </div><!-- Col -->
                                {{-- <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Neighborhood</label>
                                        <input type="text" name="neighborhood" class="form-control">
                                    </div>
                                </div><!-- Col --> --}}
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">عرض ملک</label>
                                        <input type="text" name="latitude" class="form-control">
                                        <a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                            target="_blank">Go here to get عرض ملک from address</a>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">طول ملک</label>
                                        <input type="text" name="longitude" class="form-control">
                                        <a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                            target="_blank">Go here to get طول ملک from address</a>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">نوع ملک </label>
                                        <select name="pType_id" class="form-select" id="exampleFormControlSelect1">
                                            <option selected="" disabled="">Select Type</option>
                                            @foreach ($propertyType as $ptype)
                                            <option value="{{ $ptype->id }}">{{ $ptype->type_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">امکانات ملک </label>
                                        <select name="amenities_id[]" class="js-example-basic-multiple form-select"
                                            multiple="multiple" data-width="100%">
                                            @foreach ($amenities as $ameni)
                                            <option value="{{ $ameni->amenities_name }}">
                                                {{ $ameni->amenities_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label"> Agent </label>
                                        <select name="agent_id" class="form-select" id="exampleFormControlSelect1">
                                            <option selected="" disabled="">Select Agent</option>
                                            @foreach ($activeAgent as $agent)
                                            <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">خلاصه توضیحات</label>
                                    <textarea name="short_desc" class="form-control" id="exampleFormControlTextarea1"
                                        rows="3"></textarea>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">توضیحات کامل</label>
                                    <textarea name="long_desc" class="form-control" name="tinymce" id="tinymceExample"
                                        rows="10"></textarea>
                                </div>
                            </div><!-- Col -->
                            <hr>
                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="featured" value="1" class="form-check-input"
                                        id="checkInline1">
                                    <label class="form-check-label" for="checkInline1">
                                        امکانات بیشتر
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="hot" value="1" class="form-check-input"
                                        id="checkInline">
                                    <label class="form-check-label" for="checkInline">
                                        املاک فوق العاده
                                    </label>
                                </div>
                            </div>
                            <!--   //////////// Facilities Option /////////////// -->
                            {{-- <div class="row add_item">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="facility_name" class="form-label">Facilities </label>
                                        <select name="facility_name[]" id="facility_name" class="form-control">
                                            <option value="">Select Facility</option>
                                            <option value="Hospital">Hospital</option>
                                            <option value="SuperMarket">Super Market</option>
                                            <option value="School">School</option>
                                            <option value="Entertainment">Entertainment</option>
                                            <option value="Pharmacy">Pharmacy</option>
                                            <option value="Airport">Airport</option>
                                            <option value="Railways">Railways</option>
                                            <option value="Bus Stop">Bus Stop</option>
                                            <option value="Beach">Beach</option>
                                            <option value="Mall">Mall</option>
                                            <option value="Bank">Bank</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="distance" class="form-label"> Distance </label>
                                        <input type="text" name="distance[]" id="distance" class="form-control"
                                            placeholder="Distance (Km)">
                                    </div>
                                </div>
                                <div class="form-group col-md-4" style="padding-top: 30px;">
                                    <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add
                                        More..</a>
                                </div>
                            </div> --}}
                            <!---end row-->
                            <button type="submit" class="btn btn-primary">Save Changes </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- middle wrapper end -->
        <!-- right wrapper start -->
        <!-- right wrapper end -->
    </div>
</div>
<!--========== Start of add multiple class with ajax ==============-->
{{-- <div style="visibility: hidden">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="whole_extra_item_delete" id="whole_extra_item_delete">
            <div class="container mt-2">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="facility_name">Facilities</label>
                        <select name="facility_name[]" id="facility_name" class="form-control">
                            <option value="">Select Facility</option>
                            <option value="Hospital">Hospital</option>
                            <option value="SuperMarket">Super Market</option>
                            <option value="School">School</option>
                            <option value="Entertainment">Entertainment</option>
                            <option value="Pharmacy">Pharmacy</option>
                            <option value="Airport">Airport</option>
                            <option value="Railways">Railways</option>
                            <option value="Bus Stop">Bus Stop</option>
                            <option value="Beach">Beach</option>
                            <option value="Mall">Mall</option>
                            <option value="Bank">Bank</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="distance">Distance</label>
                        <input type="text" name="distance[]" id="distance" class="form-control"
                            placeholder="Distance (Km)">
                    </div>
                    <div class="form-group col-md-4" style="padding-top: 20px">
                        <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
                        <span class="btn btn-danger btn-sm removeeventmore"><i
                                class="fa fa-minus-circle">Remove</i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!----For Section-------->
<script type="text/javascript">
    $(document).ready(function() {
            var counter = 0;
            $(document).on("click", ".addeventmore", function() {
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click", ".removeeventmore", function(event) {
                $(this).closest("#whole_extra_item_delete").remove();
                counter -= 1
            });
        });
</script>
<!--========== End of add multiple class with ajax ==============-->
<script type="text/javascript">
    $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    property_name: {
                        required: true,
                    },
                    property_status: {
                        required: true,
                    },
                    lowest_price: {
                        required: false,
                    },
                    house_mortgage: {
                        required: false,
                    },
                    rent: {
                        required: false,
                    },
                    
                    pType_id: {
                        required: true,
                    },
                },
                messages: {
                    property_name: {
                        required: 'Please Enter Property Name',
                    },
                    property_status: {
                        required: 'Please Select Property Status',
                    },
                    lowest_price: {
                        required: 'Please Enter Lowest Price',
                    },
                    house_mortgage: {
                        required: 'Please Enter Lowest Price',
                    },
                    rent: {
                        required: 'Please Enter Lowest Price',
                    },
                   
                    pType_id: {
                        required: 'Please Select نوع ملک',
                    },
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
<script type="text/javascript">
    function mainThamUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThmb').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
<script>
    $(document).ready(function() {
            $('#multiImg').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data
                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file
                                .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                            e.target.result).width(100)
                                        .height(80); //create image element 
                                    $('#preview_img').append(
                                        img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });
                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
</script>
@endsection