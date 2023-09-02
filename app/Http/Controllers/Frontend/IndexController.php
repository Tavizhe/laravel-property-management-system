<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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
    public function PropertyDetails($id, $slug)
    {
        $property = Property::findOrFail($id);
        $amenities = $property->amenities_id;
        $property_amen = explode(',', $amenities);
        $MultiImage = MultiImage::where('property_id', $id)->get();
        // $facility = Facility::where('property_id', $id)->get();
        $type_id = $property->pType_id;
        $relatedProperty = Property::where('pType_id', $type_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->limit(3)->get();
        return view('frontend.property.property_details', compact('property', 'MultiImage', 'property_amen', 'relatedProperty'));
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
        $property = Property::where('status', '1')->where('property_status', 'buy')->get();
        return view('frontend.property.buy_property', compact('property'));
    } // End Method
    public function PropertyType($id)
    {
        $property = Property::where('status', '1')->where('pType_id', $id)->get();
        $pBread = PropertyType::where('id', $id)->first();
        return view('frontend.property.property_type', compact('property', 'pBread'));
    } // End Method
    public function rentProperty()
    {
        $property = Property::where('status', '1')->where('property_status', 'rent')->paginate(3);
        return view('frontend.property.rent_property', compact('property'));
    } // End Method
    // public function StateDetails($id)
    // {
    //     $property = Property::where('status', '1')->where('state', $id)->get();
    //     $bState = State::where('id', $id)->first();
    //     return view('frontend.property.state_property', compact('property', 'bState'));
    // } // End Method
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
        $property_status = $request->property_status;
        $sType = $request->pType_id;
        // $sState = $request->state;
        $bedrooms = $request->bedrooms;
        $bathrooms = $request->bathrooms;
        $property = Property::where('status', '1')->where('bedrooms', $bedrooms)->where('bathrooms', 'like', '%' . $bathrooms . '%')->get();
        return view('frontend.property.property_search', compact('property'));
    } // End Method
}