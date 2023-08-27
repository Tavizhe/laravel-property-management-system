<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\SmtpSetting;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    public function SmtpSetting() //Simple Mail Transfer Protocol
    {$setting = SmtpSetting::find(1);

        return view('backend.setting.smtp_update', compact('setting'));

    }// End Method

    public function UpdateSmtpSetting(Request $request)
    {

        $sMtp_id = $request->id;

        SmtpSetting::findOrFail($sMtp_id)->update([

            'mailer' => $request->mailer,
            'host' => $request->host,
            'post' => $request->post,
            'username' => $request->username,
            'password' => $request->password,
            'encryption' => $request->encryption,
            'from_address' => $request->from_address,
        ]);

        $notification = [
            'message' => 'Smtp Setting Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);

    }

    // End Method
    public function SiteSetting()
    {

        $siteSetting = SiteSetting::find(1);

        return view('backend.setting.site_update', compact('siteSetting'));

    }// End Method

    public function UpdateSiteSetting(Request $request)
    {

        $site_id = $request->id;

        if ($request->file('logo')) {
            $image = $request->file('logo');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(1500, 386)->save('upload/logo/'.$name_gen);
            $save_url = 'upload/logo/'.$name_gen;

            SiteSetting::findOrFail($site_id)->update([
                'support_phone' => $request->support_phone,
                'company_address' => $request->company_address,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'copyright' => $request->copyright,
                'logo' => $save_url,
            ]);

            $notification = [
                'message' => 'SiteSetting Updated with Image Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);

        } else {

            SiteSetting::findOrFail($site_id)->update([
                'support_phone' => $request->support_phone,
                'company_address' => $request->company_address,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'copyright' => $request->copyright,
            ]);

            $notification = [
                'message' => 'SiteSetting Updated without Image Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);

        }

    }// End Method

}
