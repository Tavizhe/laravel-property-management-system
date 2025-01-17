<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Mail\ScheduleMail;
use App\Models\Amenities;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\PackagePlan;
use App\Models\Property;
use App\Models\PropertyMessage;
use App\Models\PropertyType;
use App\Models\Schedule;
// use App\Models\State;
use App\Models\User;
use barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;

class AgentPropertyController extends Controller
{
    public function AgentAllProperty()
    {
        $id = Auth::user()->id;
        $property = Property::where('agent_id', $id)->first();

        return view('agent.property.all_property', compact('property'));
    } // End Method

    public function AgentAddProperty()
    {
        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        // $pState = State::latest()->get();

        // TODO:
        $id = Auth::user()->id;
        $property = user::where('role', 'agent')->where('id', $id)->first();
        $pCount = $property->credit;
        if ($pCount == 1 || $pCount == 7) {
            return redirect()->route('buy.package');
        } else {
            return view('agent.property.add_property', compact('propertyType', 'amenities'));
        }
        // TODO:

        // return view('agent.property.all_property', compact('propertyType', 'amenities'));
    } // End Method

    public function AgentStoreProperty(Request $request)
    {
        // TODO:
        $id = Auth::user()->id;
        $uid = user::findOFail($id);
        $nid = $uid->credit;
        // TODO:
        $amen = $request->amenities_id;
        $amenities = implode(',', $amen);

        $pCode = idGenerator::generate(['table' => 'properties', 'field' => 'property_code', 'length' => 5, 'prefix' => 'PC']);

        $image = $request->file('property_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save('upload/property/thumbnail/' . $name_gen);
        $save_url = 'upload/property/thumbnail/' . $name_gen;
        $property_id = Property::insertGetId([
            'pType_id' => $request->pType_id,
            'amenities_id' => $amenities,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_code' => $pCode,
            'property_status' => $request->property_status,
            'lowest_price' => $request->lowest_price,
            'house_mortgage' => $request->house_mortgage,
            'rent' => $request->rent,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'foundation_size' => $request->foundation_size,
            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'address' => $request->address,
            // 'city' => $request->city,
            // 'state' => $request->state,
            // 'postal_code' => $request->postal_code,
            // 'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'agent_id' => Auth::user()->id,
            'status' => 1,
            'property_thumbnail' => $save_url,
            'created_at' => Carbon::now(),
        ]);
        /* Multiple image Upload */

        $image = $request->file('multi_img');
        foreach ($image as $img) {
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            //Image::make($img)->resize(770, 520)->save('upload/property/multi-image/' . $make_name);
            //$uploadPath = 'upload/property/multi-image/' . $make_name;
            $latest_property = Property::select('id')->latest()->first();
            $id = (int) $latest_property->id;
            $folderPath = 'upload/property/multi-image/' . ($id + 1);
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0777, true);
            }
            $uploadName = 'upload/property/multi-image/' . $folderPath . '/' . $make_name;
            Image::make($img)->resize(770, 520)->save($folderPath . '/' . $make_name); 
            MultiImage::insert([
                'property_id' => $property_id,
                'photo_name' => $uploadName,
                'created_at' => Carbon::now(),
            ]);
        } // End Foreach

        /* Facilities Add */
        // $facilities = count($request->facility_name);
        // if ($facilities != null) {
        //     for ($i = 0; $i < $facilities; $i++) {
        //         $fCount = new Facility();
        //         $fCount->property_id = $property_id;
        //         $fCount->facility_name = $request->facility_name[$i];
        //         $fCount->distance = $request->distance[$i];
        //         $fCount->save();
        //     }
        //     // TODO:
        //     user::where('id', $id)->update([
        //         'credit' => DB::raw('1 + ' . $nid),
        //     ]);
        //     // TODO:
        // }
        $notification = [
            'message' => 'Property Inserted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('agent.all.property')->with($notification);

    } // End Method

    public function AgentEditProperty($id)
    {
        // $facilities = Facility::where('property_id', $id)->get();
        $property = Property::findOrFail($id);
        $type = $property->amenities_id;
        $property_ami = explode(',', $type);
        $MultiImage = MultiImage::where('property_id', $id)->get();
        // $pState = State::latest()->get();
        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();

        return view('agent.property.edit_property', compact('property', 'propertyType', 'amenities', 'property_ami', 'MultiImage'));
    } // End Method

    public function AgentUpdateProperty(Request $request)
    {
        $amen = $request->amenities_id;
        $amenities = implode(',', $amen);
        $property_id = $request->id;

        $property_id = $request->id;
        Property::findOrFail($property_id)->update([

            'pType_id' => $request->pType_id,
            'amenities_id' => $amenities,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_status' => $request->property_status,
            'lowest_price' => $request->lowest_price,
            'house_mortgage' => $request->house_mortgage,
            'rent' => $request->rent,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'foundation_size' => $request->foundation_size,
            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'address' => $request->address,
            // 'city' => $request->city,
            // 'state' => $request->state,
            // 'postal_code' => $request->postal_code,
            // 'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'agent_id' => Auth::user()->id,
            'updated_at' => Carbon::now(),

        ]);
        $notification = [
            'message' => 'Property Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('agent.all.property')->with($notification);

    } // End Method

    public function AgentUpdatePropertyThumbnail(Request $request)
    {
        $pro_id = $request->id;
        $oldImage = $request->old_img;

        $image = $request->file('property_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save('upload/property/thumbnail/' . $name_gen);
        $save_url = 'upload/property/thumbnail/' . $name_gen;

        if (file_exists($oldImage)) {
            unlink($oldImage);
        }
        Property::findOrFail($pro_id)->update([
            'property_thumbnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Property Image thumbnail Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);

    } // End Method

    public function AgentUpdatePropertyMultiImage(Request $request)
    {
        $imgs = $request->multi_img;

        foreach ($imgs as $id => $img) {
            $imgDel = MultiImage::findOrFail($id);
            unlink($imgDel->photo_name);

            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(770, 520)->save('upload/property/multi-image/' . $make_name);
            $folderPath = 'upload/property/multi-image/' . $make_name;
            MultiImage::where('id', $id)->update([
                'photo_name' => $folderPath,
                'updated_at' => Carbon::now(),
            ]);
        } // End Foreach

        $notification = [
            'message' => 'Property Multi Image Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);

    } // End Method

    public function AgentPropertyMultiImageDelete($id)
    {
        $oldImg = MultiImage::findOrFail($id);
        unlink($oldImg->photo_name);

        MultiImage::findOrFail($id)->delete();

        $notification = [
            'message' => 'Property Multi Image Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    } // End Method

    public function AgentStoreNewMultiImage(Request $request)
    {
        $new_multi = $request->imageId;
        $image = $request->file('multi_img');

        $make_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(770, 520)->save('upload/property/multi-image/' . $make_name);
        $uploadPath = 'upload/property/multi-image/' . $make_name;
        MultiImage::insert([
            'property_id' => $new_multi,
            'photo_name' => $uploadPath,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Property Multi Image Added Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    } // End Method

    // public function AgentUpdatePropertyFacilities(Request $request)
    // {
    //     $pid = $request->id;

    //     if ($request->facility_name == null) {
    //         return redirect()->back();
    //     } else {
    //         Facility::where('property_id', $pid)->delete();
    //         $facilities = count($request->facility_name);
    //         for ($i = 0; $i < $facilities; $i++) {
    //             $fCount = new Facility();
    //             $fCount->property_id = $pid;
    //             $fCount->facility_name = $request->facility_name[$i];
    //             $fCount->distance = $request->distance[$i];
    //             $fCount->save();
    //         } // End For
    //     }
    //     $notification = [
    //         'message' => 'Property Facilities Updated Successfully',
    //         'alert-type' => 'success',
    //     ];

    //     return redirect()->back()->with($notification);
    // } // End Method

    public function AgentDeleteProperty($id)
    {
        $property = Property::findOrFail($id);
        unlink($property->property_thumbnail);

        Property::findOrFail($id)->delete();

        $image = MultiImage::where('property_id', $id)->get();

        foreach ($image as $img) {
            unlink($img->photo_name);
            MultiImage::where('property_id', $id)->delete();
        }

        // $facilitiesData = Facility::where('property_id', $id)->get();
        // foreach ($facilitiesData as $item) {
        //     $item->facility_name;
        //     Facility::where('property_id', $id)->delete();
        // }
        $notification = [
            'message' => 'Property Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);

    } // End Method

    public function AgentDetailsProperty($id)
    {
        // $facilities = Facility::where('property_id', $id)->get();
        $property = Property::findOrFail($id);
        $type = $property->amenities_id;
        $property_ami = explode(',', $type);
        $MultiImage = MultiImage::where('property_id', $id)->get();
        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = user::where('status', 'active')->where('role', 'agent')->latest()->get();

        return view('agent.property.details_property', compact('property', 'propertyType', 'amenities', 'activeAgent', 'property_ami', 'MultiImage'));
    } // End Method

    public function AgentInactiveProperty(Request $request)
    {
        $pid = $request->id;
        Property::findOrFail($pid)->update([
            'status' => 0,
        ]);
        $notification = [
            'message' => 'Property Inactivated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.property')->with($notification);
    } // End Method

    public function AgentActiveProperty(Request $request)
    {
        $pid = $request->id;
        Property::findOrFail($pid)->update([
            'status' => 1,
        ]);
        $notification = [
            'message' => 'Property Activated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.property')->with($notification);
    } // End Method

    // TODO:
    public function BuyPackage()
    {
        return view('agent.package.buy_package');
    } // End Method

    public function BuyBusinessPlan()
    {
        $id = Auth::user()->id;
        $data = user::find($id);

        return view('agent.package.business_plan', compact('data'));
    } // End Method

    public function StoreBusinessPlan(Request $request)
    {
        $id = Auth::user()->id;
        $uid = user::findOrFail($id);
        $nid = $uid->credit;

        PackagePlan::insert([
            'user_id' => $id,
            'package_name' => 'Business',
            'package_credits' => '3',
            'invoice' => 'ERS' . mt_rand(10000000, 99999999),
            'package_amount' => '20',
            'created_at' => Carbon::now(),
        ]);

        user::where('id', $id)->update([
            'credit' => DB::raw('3 + ' . $nid),
        ]);

        $notification = [
            'message' => 'You Have Purchased basic Package Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('agent.all.property')->with($notification);
    } // End Method

    public function BuyProfessionalPlan()
    {
        $id = Auth::user()->id;
        $data = user::find($id);

        return view('agent.package.professional_plan', compact('data'));
    } // End Method

    public function StoreProfessionalPlan(Request $request)
    {
        $id = Auth::user()->id;
        $uid = user::findOrFail($id);
        $nid = $uid->credit;

        PackagePlan::insert([
            'user_id' => $id,
            'package_name' => 'Professional',
            'package_credits' => '10',
            'invoice' => 'ERS' . mt_rand(10000000, 99999999),
            'package_amount' => '50',
            'created_at' => Carbon::now(),
        ]);

        User::where('id', $id)->update([
            'credit' => DB::raw('10 + ' . $nid),
        ]);

        $notification = [
            'message' => 'You Have Purchased Professional Package Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('agent.all.property')->with($notification);
    } // End Method

    public function packageHistory()
    {
        $id = Auth::user()->id;
        $packageHistory = PackagePlan::where('user_id', $id)->get();

        return view('agent.package.package_history', compact('packageHistory'));
    } // End Method

    public function AgentPackageInvoice($id)
    {
        $packageHistory = PackagePlan::where('id', $id)->first();

        $pdf = Pdf::loadView('agent.package.package_history_invoice', compact('packageHistory'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);

        return $pdf->download('invoice.pdf');
    } // End Method
    // TODO:

    public function AgentPropertyMessage()
    {

        $id = Auth::user()->id;
        $userMsg = PropertyMessage::where('agent_id', $id)->get();

        return view('agent.message.all_message', compact('userMsg'));

    }

    // End Method
    public function AgentMessageDetails($id)
    {

        $uid = Auth::user()->id;
        $userMsg = PropertyMessage::where('agent_id', $uid)->get();

        $msgDetails = PropertyMessage::findOrFail($id);

        return view('agent.message.message_details', compact('userMsg', 'msgDetails'));

    } // End Method

    public function AgentScheduleRequest()
    {

        $id = Auth::user()->id;
        $userMsg = Schedule::where('agent_id', $id)->get();

        return view('agent.schedule.schedule_request', compact('userMsg'));

    } // End Method

    public function AgentDetailsSchedule($id)
    {

        $schedule = Schedule::findOrFail($id);

        return view('agent.schedule.schedule_details', compact('schedule'));

    }

    // End Method
    public function AgentUpdateSchedule(Request $request)
    {

        $sid = $request->id;

        Schedule::findOrFail($sid)->update([
            'status' => '1',

        ]);
        //// Start Send Email

        $sendmail = Schedule::findOrFail($sid);

        $data = [
            'tour_date' => $sendmail->tour_date,
            'tour_time' => $sendmail->tour_time,
        ];

        Mail::to($request->email)->send(new ScheduleMail($data));

        /// End Send Email

        $notification = [
            'message' => 'You have Confirm Schedule Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('agent.schedule.request')->with($notification);

    } // End Method

}