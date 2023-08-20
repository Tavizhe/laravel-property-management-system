<?php

namespace App\Http\Controllers;

use App\Models\User;
use illuminate\Http\Request;
use illuminate\support\Facades\Auth;
use illuminate\support\Facades\Hash;

class UserController extends Controller
{
    public function Index()
    {
        return view('frontend.index');
    } // End method

    public function UserProfile()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);

        return view('frontend.dashboard.edit_profile', compact('userData'));
    } // End method

    public function UserProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $Data = User::find($id);
        $Data->username = $request->username;
        $Data->name = $request->name;
        $Data->email = $request->email;
        $Data->phone = $request->phone;
        $Data->address = $request->address;
        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/'.$data->photo));
            $filename = data('YmdHi').$file->getClientOriginalName();
            file->move(public_path('upload/user_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();
        $notification = [
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    } // End Method

    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = [
            'message' => 'User Logout Successfully',
            'alert-type' => 'success',
        ];

        return redirect('/login')->with($notification);
    } // End Method

    public function UserChangePassword()
    {
        return view('frontend.dashboard.change_password');
    } // End Method

    public function UserUpdatePassword(Request $request)
    {
        // Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Match The Old Password
        if (! hash::check($request->old_password, auth::user()->password)) {
            $notification = [
                'message' => 'Old password Does not match!',
                'alert-type' => 'error',
            ];

            return back()->with($notification);
        }
        // Update The New Password
        user::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        $notification = [
            'message' => 'Password Change Successfully',
            'alert-type' => 'success',
        ];

        return back()->with($notification);

    }// End Method
}
