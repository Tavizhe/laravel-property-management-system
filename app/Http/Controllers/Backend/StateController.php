<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class StateController extends Controller
{
    public function AllState()
    {

    } // End Method

    public function AddState()
    {
        return view('backend.state.add_state');
    } // End Method

    public function StoreState(Request $request)
    {

        $image = $request->file('state_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(370, 275)->save('upload/state/'.$name_gen);
        $save_url = 'upload/state/'.$name_gen;

        State::insert([
            'state_name' => $request->state_name,
            'state_image' => $save_url,
        ]);

        $notification = [
            'message' => 'State Inserted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.state')->with($notification);

    }

    public function DeleteState($id)
    {

        $state = State::findOrFail($id);
        $img = $state->state_image;
        unlink($img);

        State::findOrFail($id)->delete();

        $notification = [
            'message' => 'State Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);

    }// End Method

}
