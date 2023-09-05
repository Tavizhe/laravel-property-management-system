@extends('agent.agent_dashboard')
@section('agent')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<div class="page-content">
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Property Details </h6>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Property Name </td>
                                    <td><code>{{ $property->property_name }}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Status </td>
                                    <td><code>{{ $property->property_status }}</code></td>
                                </tr>
                                <tr id="buy">
                                    <td>مبلغ</td>
                                    <td><code>{{ $property->lowest_price }}</code></td>
                                </tr>
                                <tr id="rent-1">
                                    <td>رهن</td>
                                    <td><code>{{ $property->house_mortgage }}</code></td>
                                </tr>
                                <tr id="rent-2">
                                    <td>اجاره</td>
                                    <td><code>{{ $property->rent }}</code></td>
                                </tr>
                                <tr>
                                    <td>BedRooms </td>
                                    <td><code>{{ $property->bedrooms }}</code></td>
                                </tr>
                                <tr>
                                    <td>Bathrooms </td>
                                    <td><code>{{ $property->bathrooms }}</code></td>
                                </tr>
                                <tr>
                                    <td>Garage </td>
                                    <td><code>{{ $property->garage }}</code></td>
                                </tr>
                                <tr>
                                    <td>Garage Size </td>
                                    <td><code>{{ $property->foundation_size }}</code></td>
                                </tr>
                                <tr>
                                    <td>Address </td>
                                    <td><code>{{ $property->address }}</code></td>
                                </tr>
                                {{-- <tr>
                                    <td>City </td>
                                    <td><code>{{ $property->city }}</code></td>
                                </tr> --}}
                                {{-- <tr>
                                    <td>State </td>
                                    <td><code>{{ $property['pState']['state_name'] }}</code></td>
                                </tr> --}}
                                {{-- <tr>
                                    <td>Postal Code </td>
                                    <td><code>{{ $property->postal_code }}</code></td>
                                </tr> --}}
                                <tr>
                                    <td>Main Image </td>
                                    <td>
                                        <img src="{{ asset($property->property_thumbnail) }}"
                                            style="width:100px; height:70px;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status </td>
                                    <td>
                                        @if ($property->status == 1)
                                        <span class="badge rounded-pill bg-success">Active</span>
                                        @else
                                        <span class="badge rounded-pill bg-danger">InActive</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Property Code </td>
                                    <td><code>{{ $property->property_code }}</code></td>
                                </tr>
                                <tr>
                                    <td>متراژ ملک </td>
                                    <td><code>{{ $property->property_size }}</code></td>
                                </tr>
                                <tr>
                                    <td>فیلم ملک</td>
                                    <td><code>{{ $property->property_video }}</code></td>
                                </tr>
                                {{-- <tr>
                                    <td>Neighborhood </td>
                                    <td><code>{{ $property->neighborhood }}</code></td>
                                </tr> --}}
                                <tr>
                                    <td>عرض ملک </td>
                                    <td><code>{{ $property->latitude }}</code></td>
                                </tr>
                                <tr>
                                    <td>طول ملک </td>
                                    <td><code>{{ $property->longitude }}</code></td>
                                </tr>
                                <tr>
                                    <td>نوع ملک </td>
                                    <td><code>{{ $property['type']['type_name'] }}</code></td>
                                </tr>
                                <tr>
                                    <td>امکانات ملک </td>
                                    <td>
                                        <select name="amenities_id[]" class="js-example-basic-multiple form-select"
                                            multiple="multiple" data-width="100%">
                                            @foreach ($amenities as $ameni)
                                            <option value="{{ $ameni->amenities_name }}" {{ in_array($ameni->
                                                amenities_name, $property_ami) ? 'selected' : '' }}>
                                                {{ $ameni->amenities_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Agent </td>
                                    @if ($property->agent_id == null)
                                    <td><code> Admin </code></td>
                                    @else
                                    <td><code> {{ $property['user']['name'] }} </code></td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var buy = document.getElementById("buy");
    if ({{ $property->lowest_price }} == 0) {
      buy.style.display = "none";
    } else {
      buy.style.display = "block";
    }
    
    var rent_1 = document.getElementById("rent-1");
    if ({{ $property->house_mortgage }} == 0) {
        rent_1.style.display = "none";
    } else {
        rent_1.style.display = "block";
    }

    var rent_2 = document.getElementById("rent-2");
    if ( {{ $property->rent }} == 0) {
        rent_2.style.display = "none";
    } else {
        rent_2.style.display = "block";
    }
</script>
@endsection