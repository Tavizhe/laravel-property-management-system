<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use Illuminate\support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
        $profileData = user::find($id);
        // Render the view file named 'admin_profile_view' located in the 'admin' directory
        // and pass the compacted variable '$profileData' to the view
        return view('admin.admin_profile_view', compact('profileData'));
    } // End Method

    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $Data = user::find($id);
        $Data->username = $request->username;
        $Data->name = $request->name;
        $Data->email = $request->email;
        $Data->phone = $request->phone;
        $Data->address = $request->address;
        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$Data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }

        $Data->save();
        $notification = [
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    } // End Method

    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = user::find($id);

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
        $allAgent = user::where('role', 'agent');

        return view('backend.agentUser.all_agent', compact('allAgent'));

    } // End Method

    public function AddAgent()
    {
        $allAgent = user::where('role', 'agent');

        return view('backend.agentUser.add_agent', compact('allAgent'));

    } // End Method

    public function StoreAgent(Request $request)
    {
        user::insert([
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
        user::findOrFail($id)->delete();
        $notification = [
            'message' => 'Agent Created Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    } // End Method

    public function ChangeStatus(Request $request)
    {
        $user = user::find($request->user_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success' => 'Status Change Successfully']);
    } // End Method

    public function EditAgent($id)
    {
        $allAgent = User::findOrFail($id);
    return view('backend.agentUser.edit_agent',compact('allAgent'));
        
        // $allAgent = user::findOrFail($id);
        // [
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'phone' => $request->phone,
        //     'address' => $request->address,
        //     'password' => Hash::make($request->password),
        //     'role' => 'agent',
        //     'status' => 'active',
        // ];
        // $notification = [
        //     'message' => 'Agent Created Successfully',
        //     'alert-type' => 'success',
        // ];

        // return view()->route('all.agent')->with($notification);
    } // End Method

    /////////// Admin User All Method ////////////

    public function AllAdmin()
    {

        $allAdmin = user::where('role', 'admin')->get();

        return view('backend.pages.admin.all_admin', compact('allAdmin'));

    }// End Method

    public function AddAdmin()
    {

        $roles = Role::all();

        return view('backend.pages.admin.add_admin', compact('roles'));

    }// End Method

    public function StoreAdmin(Request $request)
    {

        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        $notification = [
            'message' => 'New Admin User Inserted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.admin')->with($notification);

    }

    // End Method
    public function EditAdmin($id)
    {

        $user = user::findOrFail($id);
        $roles = Role::all();

        return view('backend.pages.admin.edit_admin', compact('user', 'roles'));

    }// End Method

    public function UpdateAdmin(Request $request, $id)
    {

        $user = user::findOrFail($id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        $notification = [
            'message' => 'New Admin User Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.admin')->with($notification);

    }// End Method

    public function DeleteAdmin($id)
    {

        $user = user::findOrFail($id);
        if (! is_null($user)) {
            $user->delete();
        }

        $notification = [
            'message' => 'New Admin User Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);

    }// End Method

}
