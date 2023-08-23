<?php

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\MultiImage;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\User;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Intervention\Image\Facades\Image;

class WishlistController extends Controller
{
    public function AddToWishList(Request $request, $property_id)
    {
        if (Auth::check()) {
            $exists = Wishlist::where('user_id', Auth::id())->where('property_id', $property_id)->first();
            if (!$exists){
                $wishlist::insert([
                    'user_id' => Auth::id(),
                    'property_id' => $property_id,
                    'created_at' => Carbon::now(),
                ]);
                return response()->json(['success' => 'Successfully On Your wishlist']);
            }else{
                return response()->json(['error' => 'This property is Already in your WishList']);
            }
        }else
            return response()->json(['error' => 'Please Login First']);
    } // End Method

    public function UserWishList()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.dashboard.wishlist',compact('userData')); 
    } // End Method

    public function GetWishlistProperty()
    {
        $wishlist = Wishlist::with('property')->where('user_id', Auth::id())->latest()->get();
        $wishQty = Wishlist::count();
        return response()->json(['wishlist' => $wishlist, 'wishQty' => $wishQty]);
    } // End Method

    public function WishlistRemove($id)
    {
        Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
        return response()->json(['success' => 'Successfully Remove From Your Wishlist']);
    } // End Method
}