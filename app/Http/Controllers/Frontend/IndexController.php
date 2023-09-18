<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\amenities;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\NumberFormatter;
// use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Property;
use App\Models\PropertyMessage;
use App\Models\PropertyType;
// use App\Models\State;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function PropertyDetails($id, $slug, Request $request)
    {
        // Retrieve a property by its ID
        $property = Property::findOrFail($id);
        // Retrieve a property by its ID using the where clause and get all results
        $property2 = Property::where('id', $id)->get();
        // Retrieve the amenities ID associated with the property
        $amenities = $property->amenities_id;
        // Retrieve the name of the amenity based on its ID
        $amenities2 = amenities::where('id', $amenities)->pluck('amenities_name')->first();
        // Retrieve the type name of the property
        $pType = $property->type->type_name;
        // Retrieve the ID of the property type based on its name
        $pType_id = PropertyType::where('type_name', $pType)->pluck('id')->first();
        // Retrieve the names of the amenities associated with the property
        $amenities_names = $property->amenities_name;
        // Split the amenities into an array based on commas
        $property_amen = explode(',', $amenities);
        // Split the amenity names into an array based on commas
        $amenities_name = explode(',', $amenities_names);
        // Retrieve the thumbnail image of the property
        $thumbnailImage = Property::where('id', $id)->select('property_thumbnail')->get();
        // Create the URL for the thumbnail image
        $imageUrl = '/' . $thumbnailImage[0]->property_thumbnail;
        // Retrieve the multi-images associated with the property
        //$multiImages = MultiImage::where('property_id', $id)->select('photo_name')->get();
        // Retrieve the first photo name of the multi-images
        // // $photoName = null;
        //// if ($multiImages->isNotEmpty()) {
        // //     $photoName = $multiImages[0]->photo_name;
        // // }
        // Convert the ID to a string
        $idString = strval($id);
        // Create the path for the multi-image
        // //$multiImage = $photoName ? $photoName . $idString : null;
        // Retrieve all JPEG images in the specified directory
        $x = 'upload/property/multi-image/' . $idString;
        $images = glob($x . '/*.jpg');
        // Retrieve all MP4 videos in the specified directory
        $y = 'upload/property/multi-image/' . $idString;
        $video = glob($y . '/*.mp4');
        // Convert the array of video paths into a string
        if (!empty($video)) {
            // Grab the first video path
            $firstVideo = $video[0];
        }
        $firstVideo = implode(' ', $video);
        // Retrieve the property type ID
        $type_id = $property->pType_id;
        // Retrieve the icon associated with the property type
        $pType1 = PropertyType::where('id', $type_id)->pluck('type_icon')->first();
        // Check if the property record exists and retrieve the property thumbnail
        $property_thumbnail = $property->property_thumbnail ?: null;
        // Retrieve related properties based on the property type ID, excluding the current property
        $relatedProperty = Property::where('pType_id', $type_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->limit(3)->get();
        // Return the view with the specified data
        return view(
            'frontend.property.property_details',
            compact(
                'pType1',
                'amenities2',
                'property2',
                //'videos',
                'firstVideo',
                //'multiImages',
                'y',
                'images',
                'property',
                'imageUrl',
                'property_amen',
                'relatedProperty',
                'property_thumbnail'
            )
        );
    } // End Method
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
    } // End Method
    public function AgentDetails($id)
    {
        $agent = User::findOrFail($id);
        $property = Property::where('agent_id', $id)->get();
        $featured = Property::where('featured', '1')->limit(3)->get();
        $rentProperty = Property::where('property_status', 'rent')->get();
        $buyProperty = Property::where('property_status', 'buy')->get();
        return view('frontend.agent.agent_details', compact('agent', 'property', 'featured', 'rentProperty', 'buyProperty'));
    } // End Method
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
    } // End Method
    public function buyProperty()
    {
        $property = Property::where('status', '1')->where('property_status', 'buy')->orderByDesc('id')->paginate(5);
        return view('frontend.property.buy_property', compact('property'));
    } // End Method
    public function PropertyType($id)
    {
        $property = Property::where('status', '1')->where('pType_id', $id)->orderByDesc('id')->paginate(5);
        return view('frontend.property.property_type', compact('property'));
    } // End Method
    public function rentProperty()
    {
        $property = Property::where('status', '1')->where('property_status', 'rent')->orderByDesc('id')->paginate(5);
        return view('frontend.property.rent_property', compact('property'));
    } // End Method    
    public function buyPropertySearch(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);
        $item = $request->search;
        $sType = $request->pType_id;
        //$property = Property::where('property_name', 'like', '%' . $item . '%')->where('property_status', 'buy')->get();
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
    } // End Method
    public function rentPropertySearch(Request $request)
    {
        $request->validate(['search' => 'required']);
        $item = $request->search;
        $sType = $request->pType_id;
        // $lowest_price = number_format($request->lowest_price, 0, '', ',');        
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
        //$property = Property::where('property_name', 'like', '%' . $item . '%')->where('property_status', 'rent')->get();
        return view('frontend.property.property_search', compact('property'));
    } // End Method
    public function AllPropertySearch(Request $request)
    {
        $request->validate(['search' => 'required']);
        $property_status = $request->property_status;
        $sType = $request->pType_id;
        // $sState = $request->state;
        $bedrooms = $request->bedrooms;
        $bathrooms = $request->bathrooms;
        $property = Property::where('status', '1')->where('bedrooms', $bedrooms)->where('bathrooms', 'like', '%' . $bathrooms . '%')->get();
        return view('frontend.property.property_search', compact('property'));
    } // End Method
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
        $types = PropertyType::latest()->get();

        return view('frontend.type.all_type', compact('types'));
    } // End Method

}