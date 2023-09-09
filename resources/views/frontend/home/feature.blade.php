@php
    $property = App\Models\Property::where('status', '1')
        ->limit(3)
        ->latest()
        ->get();
    
@endphp
<section class="feature-section sec-pad bg-color-1">
    <div class="auto-container">
        <div class="sec-title centred">
            <h5>آخرین املاک ثبت شده</h5>
            {{-- <h2>مشاهده کلیه املاک</h2> --}}
            {{-- <p>با انتخاب مشاهده املاک از آخرین وضعیت املاک مورد نظر خود با خبر شوید.</p> --}}
        </div>
        <div class="row clearfix">
            @foreach ($property as $item)
                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="{{ asset($item->property_thumbnail) }}" alt="">
                                </figure>
                                <div class="batch"><i class="icon-11"></i></div>
                                <span class="category">جدید</span>
                            </div>
                            <div class="lower-content">
                                <div class="title-text">
                                    <h4><a
                                            href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}">{{ $item->property_name }}</a>
                                    </h4>
                                </div>
                                <div class="price-box clearfix">
                                    <div class="price-info pull-left">
                                        <h6>مبلغ</h6>
                                        <?php
                                        $lowestPrice = $item->lowest_price;
                                        $formattedLowestPrice = number_format($lowestPrice, 0, '.', ',');
                                        ?>
                                        <h4 id="buy-a">
                                            <?php echo $formattedLowestPrice; ?> تومان
                                        </h4>
                                    </div>
                                    <div class="price-info pull-left">
                                        <h6>رهن</h6>
                                        <?php
                                        $houseMortgage = $item->house_mortgage;
                                        $formattedhouseMortgage = number_format($houseMortgage, 0, '.', ',');
                                        ?>
                                        <h4>
                                            <h4 id="rent-1-a">
                                                <?php echo $formattedhouseMortgage; ?> تومان
                                            </h4>
                                    </div>
                                    <div class="price-info pull-left">
                                        <h6 id="rent-2">اجاره</h6>
                                        <?php
                                        $Rent = $item->rent;
                                        $formattedRent = number_format($Rent, 0, '.', ',');
                                        ?>
                                        <h4 id="rent-2-a">
                                            <?php echo $formattedRent; ?> تومان
                                        </h4>
                                    </div>
                                    <ul class="other-option pull-right clearfix">
                                        <li><a aria-label="Compare" class="action-btn" id="{{ $item->id }}"
                                                onclick="addToCompare(this.id)"><i class="icon-12"></i></a></li>
                                        <li><a aria-label="Add To Wishlist" class="action-btn" id="{{ $item->id }}"
                                                onclick="addToWishList(this.id)"><i class="icon-13"></i></a></li>
                                    </ul>
                                </div>
                                <p>{{ $item->short_desc }}</p>
                                <ul class="more-details clearfix">
                                    <li><i class="icon-14"></i>{{ $item->bedrooms }} تعداد خواب</li>
                                    <li><i class="icon-15"></i>{{ $item->bathrooms }} دارای سرویس</li>
                                    <li><i class="icon-16"></i>{{ $item->property_size }} متراژ مساحت</li>
                                </ul>
                                <div class="btn-box"><a
                                        href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}"
                                        class="theme-btn btn-two">نمایش اطلاعات بیشتر</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{-- <div class="more-btn centred"><a href="property-list.html" class="theme-btn btn-one">مشاهده املاک</a></div>
        --}}
    </div>
    <script>
        var users = @json($property);


        var elements = [{
                id: "buy",
                property: "lowest_price"
            },
            {
                id: "rent-1",
                property: "house_mortgage"
            },
            {
                id: "rent-2",
                property: "rent"
            },
            {
                id: "buy-a",
                property: "lowest_price"
            },
            {
                id: "rent-1-a",
                property: "house_mortgage"
            },
            {
                id: "rent-2-a",
                property: "rent"
            }
        ];

        for (var i = 0; i < elements.length; i++) {
            var element = document.getElementById(elements[i].id);

            if (users[0][elements[i].property] == 0) {
                element.style.display = "none";
            } else {
                element.style.display = "block";
            }
        }
    </script>
</section>
