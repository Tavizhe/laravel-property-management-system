<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\amenities;
use App\Models\formForUs;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\NumberFormatter;
use App\Models\MultiImage;
use App\Models\Property;
use App\Models\PropertyMessage;
use App\Models\PropertyType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function PropertyDetails($id, Request $request)
    {
        $property = Property::findOrFail($id);
        $property2 = Property::where('id', $id)->get();
        $amenities = $property->amenities_id;
        $amenities2 = amenities::where('id', $amenities)->pluck('amenities_name')->first();
        $pType = $property->type->type_name;
        $pType_id = PropertyType::where('type_name', $pType)->pluck('id')->first();
        $amenities_names = $property->amenities_name;
        $property_amen = explode(',', $amenities);
        $amenities_name = explode(',', $amenities_names);
        $idString = strval($id);
        $x = 'upload/property/multi-image/' . $idString;
        $images = glob($x . '/*.jpg');
        if (!empty($images)) {
            $imageUrl = $images[0];
            $property_thumbnail = $images[0];
        } else {
            $imageUrl = 'upload/no_image.jpg';
            $property_thumbnail = 'upload/no_image.jpg';
        }
        $y = 'upload/property/multi-image/' . $idString;
        $video = glob($y . '/*.mp4');
        if (!empty($video)) {
            $firstVideo = $video[0];
        }
        $firstVideo = implode(' ', $video);
        $type_id = $property->pType_id;
        $pType1 = PropertyType::where('id', $type_id)->pluck('type_icon')->first();
        $relatedProperty = Property::where('pType_id', $type_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->limit(3)->get();
        return view(
            'frontend.property.property_details',
            compact(
                'pType1',
                'amenities2',
                'property2',
                'firstVideo',
                'y',
                'images',
                'property',
                'imageUrl',
                'property_amen',
                'relatedProperty',
                'property_thumbnail'
            )
        );
    }
    public function PropertyMessage(Request $request)
    {
        $pid = $request->property_id;
        $aid = $request->agent_id;
        if (Auth::check()) {
            PropertyMessage::insert([
                'user_id' => Auth::user()->id,
                'agent_id' => $aid,
                'property_id' => $pid,
                'msg_name' => $request->msg_name,
                'msg_email' => $request->msg_email,
                'msg_phone' => $request->msg_phone,
                'message' => $request->message,
                'created_at' => Carbon::now(),
            ]);
            $notification = [
                'message' => 'Send Message Successfully',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'message' => 'Plz Login Your Account First',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
    public function AgentDetails($id)
    {
        $agent = User::findOrFail($id);
        $property = Property::where('agent_id', $id)->get();
        $featured = Property::where('featured', '1')->limit(3)->get();
        $rentProperty = Property::where('property_status', 'rent')->get();
        $buyProperty = Property::where('property_status', 'buy')->get();
        return view('frontend.agent.agent_details', compact('agent', 'property', 'featured', 'rentProperty', 'buyProperty'));
    }
    public function AgentDetailsMessage(Request $request)
    {
        $aid = $request->agent_id;
        if (Auth::check()) {
            PropertyMessage::insert([
                'user_id' => Auth::user()->id,
                'agent_id' => $aid,
                'msg_name' => $request->msg_name,
                'msg_email' => $request->msg_email,
                'msg_phone' => $request->msg_phone,
                'message' => $request->message,
                'created_at' => Carbon::now(),
            ]);
            $notification = [
                'message' => 'Send Message Successfully',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'message' => 'Plz Login Your Account First',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
    public function buyProperty()
    {
        $property = Property::where('status', '1')->where('property_status', 'buy')->orderByDesc('id')->paginate(5);
        $count = Property::where('property_status', 'buy')->count();
        return view('frontend.property.buy_property', compact('property', 'count'));
    }
    public function PropertyType($id)
    {
        $property = Property::where('status', '1')->where('pType_id', $id)->orderByDesc('id')->paginate(5);
        $id = Property::where('status', '1')->where('pType_id', $id)->get();
        return view('frontend.property.property_type', compact('property', 'id'));
    }
    public function rentProperty()
    {
        $property = Property::where('status', '1')->where('property_status', 'rent')->orderByDesc('id')->paginate(5);
        $count = Property::where('property_status', 'rent')->count();
        return view('frontend.property.rent_property', compact('property', 'count'));
    }
    public function buyPropertySearch(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);
        $item = $request->search;
        $sType = $request->pType_id;
        $property = Property::where('property_name', 'like', '%' . $item . '%')
            ->where('property_status', 'buy')
            ->get();
        if ($property->isEmpty()) {
            $property = Property::where('address', 'like', '%' . $item . '%')
                ->where('property_status', 'buy')
                ->get();
        } else if ($property->isEmpty()) {
            $property = Property::where('long_desc', 'like', '%' . $item . '%')
                ->where('property_status', 'buy')
                ->get();
        } else if ($property->isEmpty()) {
            $property = Property::where('short_desc', 'like', '%' . $item . '%')
                ->where('property_status', 'buy')
                ->get();
        }

        return view('frontend.property.property_search', compact('property'));
    }
    public function pricePropertySearch(Request $request)
    {
        $priceRange = $request->input('price_range');
        $maxPrice = intval($priceRange);
        $property = Property::whereBetween('lowest_price', [100000, $maxPrice])
            ->get()->sortByDesc('lowest_price');


        return view('frontend.property.priceFilter_property', compact('property'));
    }
    public function rentPropertySearch(Request $request)
    {
        $request->validate(['search' => 'required']);
        $item = $request->search;
        $sType = $request->pType_id;
        $property = Property::where('property_name', 'like', '%' . $item . '%')
            ->where('property_status', 'rent')
            ->get();
        if ($property->isEmpty()) {
            $property = Property::where('address', 'like', '%' . $item . '%')
                ->where('property_status', 'rent')
                ->get();
        } else if ($property->isEmpty()) {
            $property = Property::where('long_desc', 'like', '%' . $item . '%')
                ->where('property_status', 'rent')
                ->get();
        } else if ($property->isEmpty()) {
            $property = Property::where('short_desc', 'like', '%' . $item . '%')
                ->where('property_status', 'rent')
                ->get();
        }
        return view('frontend.property.property_search', compact('property'));
    }
    public function AllPropertySearch(Request $request)
    {
        $request->validate(['search' => 'required']);
        $property_status = $request->property_status;
        $sType = $request->pType_id;
        $bedrooms = $request->bedrooms;
        $bathrooms = $request->bathrooms;
        $property = Property::where('status', '1')->where('bedrooms', $bedrooms)->where('bathrooms', 'like', '%' . $bathrooms . '%')->get();
        return view('frontend.property.property_search', compact('property'));
    }
    public function showTeam()
    {
        return view(
            'frontend.team'
        );
    }
    public function kojanajafabad()
    {
        return view(
            'frontend.kojanajafabad'
        );
    }
    public function FrontEndAllTypes()
    {
        $properties = Property::orderByDesc('id')->paginate(5);
        $types = PropertyType::latest()->get();
        $count = Property::count();

        return view('frontend.type.all_type', compact('types', 'properties', 'count'));
    }
    public function formForUsShow()
    {
        return view('frontend.formForUsShow');
    }
    public function formForUs(Request $request)
    {
        $formForUs = formForUs::insert([
            'id' => $request->id,
            'owner' => $request->owner,
            'phone' => $request->phone,
            'onvan' => $request->onvan,
            'status' => $request->status,
            'price' => $request->price,
            'rooms' => $request->rooms,
            'tozihat' => $request->tozihat,
            'masahat' => $request->masahat,
            'zirbana' => $request->zirbana,
            'jahat' => $request->jahat,
            'nama' => $request->nama,
            'sanad' => $request->sanad,
            'adress' => $request->adress,
            'tozihat2' => $request->tozihat2,
            'created_at' => Carbon::now(),
        ]);
        return view('frontend.formForUsShow', compact('formForUs'));
    }
}