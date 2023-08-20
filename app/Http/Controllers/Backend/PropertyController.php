<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Property;

class PropertyController extends Controller
{
    public function AllProperty()
    {
        $property = Property::latest()->get();

        return view('backend.property.all_property', compact('property'));
    } // End Method
}
