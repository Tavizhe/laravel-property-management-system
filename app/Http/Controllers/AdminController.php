<?php

namespace App\Http\Controllers;

use App\Models\User;
use illuminate\Http\Request;
use illuminate\support\Facades\Auth;
use illuminate\support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin/admin_dashboard');
    } // End Method

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = [
            'message' => 'User Logout Successfully',
            'alert-type' => 'success',
        ];

        return redirect('/admin/login')->with($notification);
    } // End Method

    public function AdminLogin()
    {
        return view('admin.admin_login');
    } // End Method

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        // Render the view file named 'admin_profile_view' located in the 'admin' directory
        // and pass the compacted variable '$profileData' to the view
        return view('admin.admin_profile_view', compact('profileData'));
    } // End Method

    public function AdminProfileStore(Request $request)
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
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = data('YmdHi').$file->getClientOriginalName();
            file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();
        $notification = [
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    } // End Method

    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('admin.admin_change_password', compact('profileData'));
    } // End Method

    public function AdminUpdatePassword(Request $request)
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

        return view('admin.admin_change_password', compact('profileData'))->with($notification);
    } // End Method

    /* Agent User All Methods */

    public function AllAgent(Request $request)
    {
        $allAgent = User::where('role', 'agent');

        return view('backend.agentUser.all_agent', compact('allAgent'));

    } // End Method

    public function AddAgent()
    {

        return view('backend.agentUser.add_agent', compact('allAgent'));

    } // End Method

    public function StoreAgent(Request $request)
    {
        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => 'agent',
            'status' => 'active',
        ]);
        $notification = [
            'message' => 'Agent Created Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.agent')->with($notification);
    } // End Method

    public function DeleteAgent($id)
    {
        User::findOrFail($id)->delete();
        $notification = [
            'message' => 'Agent Created Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    } // End Method

    public function ChangeStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success'=>'Status Change Successfully']);
    } // End Method
}
