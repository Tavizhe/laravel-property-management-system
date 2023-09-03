@php
$ptype = App\Models\PropertyType::latest()->limit(5)->get();
@endphp

<head>
	<style>
		.container1 {
			display: flex;
			justify-content: center;
		}

		.box1 {
			width: 200px;
			margin: 10px;
			padding: 10px;
			border: 1px solid black;
			text-align: center;
		}

		.feature1 {
			font-weight: bold;
			margin-bottom: 10px;
		}

		.image1 {
			width: 100px;
			height: 100px;
			margin-bottom: 10px;
		}
	</style>
</head>
<section class="category-section centred">
	<div class="auto-container">
		<div class="inner-container wow slideInLeft animated" data-wow-delay="00ms" data-wow-duration="1500ms">
			<ul class="category-list clearfix">
				@foreach($ptype as $item)
				@php
				$property = App\Models\Property::where('pType_id',$item->id)->get();
				@endphp
				<li>
					{{-- <div class="category-block-one">
						<div class="inner-box">
							<div class="icon-box"><i class="{{ $item->type_icon }}"></i></div>
							<h5><a href="{{ route('property.type',$item->id) }}">{{ $item->type_name }}</a></h5>
							<span>{{ count($property) }}</span>
						</div>
					</div> --}}

					<div class="category-block-one">
						<div class="inner-box">
							<i class="{{ $item->type_icon }}"></i>
							<h5><a href="{{ route('property.type',$item->id) }}">{{ $item->type_name }}</a></h5>
							<span>{{ count($property) }}</span>
						</div>
					</div>

				</li>
				@endforeach
			</ul>
			<div class="more-btn"><a href="categories.html" class="btn btn-primary">دسته بندی املاک</a></div>
		</div>
	</div>
</section>