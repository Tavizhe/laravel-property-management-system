<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\amenities;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\PackagePlan;
use App\Models\Property;
use App\Models\PropertyMessage;
use App\Models\PropertyType;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PropertyController extends Controller
{
    public function AllProperty()
    {
        $property = Property::latest()->get();
        return view('backend.property.all_property', compact('property'));
    }
    public function AddProperty()
    {
        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = user::where('status', 'active')->where('role', 'agent')->latest()->get();
        return view('backend.property.add_property', compact('propertyType', 'amenities', 'activeAgent'));
    }
    public function StoreProperty(Request $request)
    {
        $amen = $request->amenities_id;
        $amenities = implode(',', $amen);
        $pCode = idGenerator::generate(['table' => 'properties', 'field' => 'property_code', 'length' => 5, 'prefix' => 'PC']);
        $image = $request->file('property_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save('upload/property/thumbnail/' . $name_gen);
        $save_url = 'upload/property/thumbnail/' . $name_gen;
        $property_id = Property::insert([
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
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'agent_id' => $request->agent_id,
            'status' => 1,
            'property_thumbnail' => $save_url,
            'created_at' => Carbon::now(),
        ]);
        /* Multiple image Upload */
        $image = $request->file('multi_img');
        foreach ($image as $img) {
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
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
        }
        /* Facilities Add */
        $notification = [
            'message' => 'Property Inserted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.property')->with($notification);
    }
    public function EditProperty($id)
    {
        $property = Property::findOrFail($id);
        $type = $property->amenities_id;
        $property_ami = explode(',', $type);
        $MultiImage = MultiImage::where('property_id', $id)->get();
        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = user::where('status', 'active')->where('role', 'agent')->latest()->get();
        return view('backend.property.edit_property', compact('property', 'propertyType', 'amenities', 'activeAgent', 'property_ami', 'MultiImage'));
    }
    public function UpdateProperty(Request $request)
    {
        $property_id = $request->id;
        Property::findOrFail($property_id)->update([
            'pType_id' => $request->pType_id,
            'amenities_id' => $request->amenities_id,
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
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'agent_id' => $request->agent_id,
            'updated_at' => Carbon::now(),
        ]);
        $notification = [
            'message' => 'Property Updated Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.property')->with($notification);
    }
    public function UpdatePropertyThumbnail(Request $request, $id)
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
    }
    public function UpdatePropertyMultiImage(Request $request)
    {
        $imgs = $request->multi_img;
        foreach ($imgs as $id => $img) {
            $imgDel = MultiImage::findOrFail($id);
            unlink($imgDel->photo_name);
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(770, 520)->save('upload/property/multi-image/' . $make_name);
            $uploadPath = 'upload/property/multi-image/' . $make_name;
            MultiImage::where('id', $id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),
            ]);
        }
        $notification = [
            'message' => 'Property Multi Image Updated Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }
    public function PropertyMultiImageDelete($id)
    {
        $oldImg = MultiImage::findOrFail($id);
        unlink($oldImg->photo_name);
        MultiImage::findOrFail($id)->delete();
        $notification = [
            'message' => 'Property Multi Image Deleted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }
    public function StoreNewMultiImage(Request $request)
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
    }
    public function DeleteProperty($id)
    {
        $property = Property::findOrFail($id);
        unlink($property->property_thumbnail);
        Property::findOrFail($id)->delete();
        $image = MultiImage::where('property_id', $id)->get();
        foreach ($image as $img) {
            unlink($img->photo_name);
            MultiImage::where('property_id', $id)->delete();
        }
        $notification = [
            'message' => 'Property Deleted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }
    public function DetailsProperty($id)
    {
        $property = Property::findOrFail($id);
        $type = $property->amenities_id;
        $property_ami = explode(',', $type);
        $MultiImage = MultiImage::where('property_id', $id)->get();
        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = user::where('status', 'active')->where('role', 'agent')->latest()->get();
        return view('backend.property.details_property', compact('property', 'propertyType', 'amenities', 'activeAgent', 'property_ami', 'MultiImage'));
    }
    public function InactiveProperty(Request $request)
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
    }
    public function ActiveProperty(Request $request)
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
    }
    public function AdminPackageHistory()
    {
        $packageHistory = PackagePlan::latest()->get();
        return view('backend.package.package_history', compact('packageHistory'));
    }
    public function PackageInvoice($id)
    {
        $packageHistory = PackagePlan::where('id', $id)->first();
        $pdf = Pdf::loadView('backend.package.package_history_invoice', compact('packageHistory'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }
    public function AdminPropertyMessage()
    {
        $userMsg = PropertyMessage::latest()->get();
        return view('backend.message.all_message', compact('userMsg'));
    }
    public function AgentDetails($id)
    {
        $agent = user::findOrFail($id);
        return view('frontend.agent.agent_details', compact('agent'));
    }
}