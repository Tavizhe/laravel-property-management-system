@php
    $ptype = App\Models\PropertyType::latest()
        ->limit(5)
        ->get();
@endphp
<section class="category-section centred">
    <div class="auto-container">
        <div class="sec-title centred">
            <h5 style="color: #FFD700" class="fw-bold text-center mt-4 mb-3 border p-2 rounded-pill bg-color-2">دسته بندی املاک</h5></h5>
        </div>
        <div class="inner-container wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="800ms">
            <ul class="category-list clearfix">
                @foreach ($ptype as $item)
                    @php
                        $property = App\Models\Property::where('ptype_id', $item->id)->get();
                    @endphp
                    <li>
                        <div class="category-block-one">
                            <div style="background-image: url('{{ $item->type_icon }}');background-size: cover;"
                                class="inner-box">
                                <h5><a style="background-color: white;border-radius: 10px;width: 7ch;text-decoration: none"
                                        href="{{ route('property.type', $item->id) }}">{{ $item->type_name }}</a></h5>
                                <span>{{ count($property) }}</span>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="more-btn"><a href="{{ route('rent.property') }}" class="btn btn-primary">لیست کامل
                                املاک برای
                                رهن</a></div>
                    </div>
                    <div class="col-md-6">
                        <div class="more-btn"><a href="{{ route('buy.property') }}" class="btn btn-primary">لیست کامل
                                املاک برای
                                خرید</a></div>
                    </div>
                </div>
            </div>
        </div>
</section>
