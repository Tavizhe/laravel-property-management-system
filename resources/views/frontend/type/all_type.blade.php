@extends('frontend.frontend_dashboard')
@section('main')
@section('title')
انواع ملک | املاک ملک گستر
@endsection


<div class="page-content">
    @php
    $ptype = App\Models\PropertyType::latest()->get();
    @endphp
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">نوع ملک All </h6>
                    <div class="row">
                        @foreach ($types as $key => $item)
                        @php
                        $property = App\Models\Property::where('ptype_id', $item->id)->get();
                        @endphp
                        <div class="col-md-2">
                            <ul class="category-list clearfix">
                                <div class="category-block-one">
                                    <div style="background-image: url('/{{ $item->type_icon }}');background-size: cover;"
                                        class="inner-box center">
                                        <h5 class="center" style="text-align: center"><a
                                                style="background-color: white;border-radius: 10px;width: 7ch;text-decoration: none;text-align: center"
                                                href="{{ route('property.type', $item->id) }}">{{ $item->type_name
                                                }}</a><hr><span>{{ count($property) }}</span></h5>
                                        
                                    </div>
                                </div>
                            </ul>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection