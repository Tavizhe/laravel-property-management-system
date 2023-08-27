<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Compare;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompareController extends Controller
{
    public function AddToCompare(Request $request, $property_id)
    {
        if (Auth::check()) {
            $exists = Wishlist::where('user_id', Auth::id())->where('property_id', $property_id)->first();
            if (! $exists) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'property_id' => $property_id,
                    'created_at' => Carbon::now(),
                ]);

                return response()->json(['success', 'Property added to compare list']);
            } else {
                return response()->json(['error', 'Property already added to compare list']);
            }
        } else {
            return response()->json(['error', 'Please login to add property to compare list']);
        }
    }

    public function UserCompare(){ 
        return view('frontend.dashboard.compare');
    }// End Method 

    // End Method
    public function GetCompareProperty()
    {
        $compare = Compare::with('property')->where('user_id', Auth::id())->latest()->get();

        return response()->json($compare);
    } // End Method

    public function CompareRemoved($id)
    {
        Compare::where('user_id', Auth::id())->where('id', $id)->delete();

        return response()->json(['success', 'Property removed from compare list']);
    } // End Method

}
