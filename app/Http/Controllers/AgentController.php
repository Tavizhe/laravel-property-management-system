<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use illuminate\support\Facades\Hash;

class AgentController extends Controller
{
    public function AgentDashboard()
    {
        return view('agent/agent_dashboard');
    } // End Method

    public function AgentLogin()
    {
        return view('agent.agent_login');
    } // End Method

    public function AgentRegister(Request $request)
    {
        $user = user::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'agent',
            'status' => 'inactive',
        ]);
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::AGENT);
    } // End Method

    public function AgentLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = [
            'message' => 'Agent Logout Successfully',
            'alert-type' => 'success',
        ];

        return redirect('/agent/login')->with($notification);
    } // End Method

    public function AgentProfile()
    {
        $id = Auth::user()->id;
        $profileData = user::find($id);
        // Render the view file named 'agent' located in the 'agent' directory
        // and pass the compacted variable '$profileData' to the view
        return view('agent.agent_profile_view', compact('profileData'));
    } // End Method

    public function AgentProfileStore(Request $request)
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
            @unlink(public_path('upload/agent_images/'.$data->photo));
            $filename = data('YmdHi').$file->getClientOriginalName();
            file->move(public_path('upload/agent_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();
        $notification = [
            'message' => 'Agent Profile Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    } // End Method

    public function AgentChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = user::find($id);

        return view('agent.agent_change_password', compact('profileData'));
    }// End Method

    public function AgentUpdatePassword(Request $request)
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

        return view('agent.agent_change_password', compact('profileData'));
    }// End Method

}
