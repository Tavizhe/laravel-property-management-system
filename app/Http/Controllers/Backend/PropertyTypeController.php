<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\PropertyType;

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
            'message' => 'Property Type Create Successfully',
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
            'message' => 'Property Type Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.type')->with($notification);
    } // End Method

    public function DeleteTypes()
    {
        PropertyType::findOrFail($id)->delete();
        $notification = [
            'message' => 'Property Type Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    } // End Method

    /* Amenities All Methods */

    public function AllAmenitie()
    {
        $amenities = Amenities::latest()->get();

        return view('backend.amenities.all_amenities', compact('amenities'));
    } // End Method

    public function AddAmenitie()
    {
        return view('backend.amenities.add_amenities');
    }

    // End Method
    public function StoreAmenitie(Request $request)
    {
        Amenities::insert([
            'amenities_name' => $request->amenitis_name,
        ]);
        $notification = [
            'message' => 'Amenities Create Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.amenitie')->with($notification);
    } // End Method

    public function EditAmenitie($id)
    {
        $amenities = Amenities::findOrFail($id);

        return view('backend.amenities.edit_amenities', compact('amenities'));
    } // End Method

    public function UpdateAmenitie(Request $request)
    {
        $ame_id = $request->$id;
        Amenities::findOrFail($ame_id)->update([
            'amenitis_name' => $request->amenities_name,
        ]);
        $notification = [
            'message' => 'Amenities Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.amenitie')->with($notification);
    } // End Method

    public function DeleteAmenitie($id)
    {
        Amenities::findOrFail($id)->delete();
        $notification = [
            'message' => 'Amenities Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    } // End Method
}
