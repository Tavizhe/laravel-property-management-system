<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\PropertyType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    public function AllTypes()
    {
        $types = PropertyType::latest()->get();

        return view('backend.type.all_type', compact('types'));
    } // End Method

    public function AddTypes()
    {
        return view('backend.type.add_type');
    } // End Method

    public function StoreTypes(Request $request)
    {
        // Validation
        $request->validate([
            'type_name' => 'required|unique:property_types|max:50',
            'type_icon' => 'required',
        ]);
        PropertyType::insert([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
        ]);
        $notification = [
            'message' => 'نوع ملک Create Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.type')->with($notification);
    }

    // End Method
    public function EditType($id)
    {
        $types = PropertyType::findOrFail($id);

        return view('backend.type.edit_type', compact('types'));
    } // End Method

    public function UpdateTypes(Request $request)
    {
        $pid = $request->id;
        PropertyType::findOrFail($pid)->update([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
        ]);
        $notification = [
            'message' => 'نوع ملک Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.type')->with($notification);
    } // End Method

    public function DeleteTypes($id)
    {
        PropertyType::findOrFail($id)->delete();
        $notification = [
            'message' => 'نوع ملک Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    } // End Method

    /* amenities All Methods */

    public function AllAmenity()
    {
        $amenities = Amenities::latest()->get();

        return view('backend.amenities.all_amenities', compact('amenities'));
    } // End Method

    public function AddAmenity()
    {
        return view('backend.amenities.add_amenities');
    }

    // End Method
    public function StoreAmenity(Request $request)
    {
        Amenities::insert([
            'amenities_name' => $request->amenities_name,
            'created_at' => Carbon::now(),
        ]);
        $notification = [
            'message' => 'amenities Create Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.amenity')->with($notification);
    } // End Method

    public function EditAmenity($id)
    {
        $amenities = Amenities::findOrFail($id);

        return view('backend.amenities.edit_amenities', compact('amenities'));
    } // End Method

    public function UpdateAmenity(Request $request)
    {
        $ame_id = $request->id;
        Amenities::findOrFail($ame_id)->update([
            'amenities_name' => $request->amenities_name,
        ]);
        $notification = [
            'message' => 'amenities Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.amenity')->with($notification);
    } // End Method

    public function DeleteAmenity($id)
    {
        Amenities::findOrFail($id)->delete();
        $notification = [
            'message' => 'amenities Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    } // End Method
}