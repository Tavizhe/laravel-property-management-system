<?php

namespace App\Http\Controllers;

use App\Models\RequestForProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class RequestForPropertyController extends Controller
{

    public function GetRequest()
    {
        return view('frontend.requests.RequestForProperty');
    }

    public function ShowRequest()
    {
        //$requestForProperty = RequestForProperty::latest()->get();
        return view('frontend.requests.ShowRequestForProperty');
        //, compact('requestForProperty')
    }

    public function RequestForPropertyStore(Request $request)
    {
        $RequestGet = RequestForProperty::insert([
            'maxPrice' => $request->maxPrice,
            'maxMortgage' => $request->maxMortgage,
            'maxRent' => $request->maxRent,
            'pType' => $request->pType,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'Description' => $request->Description,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        $notification = [
            'message' => 'درخواست شما ثبت شد',
            'alert-type' => 'success',
        ];
        return redirect()->route('ShowRequestForProperty.ShowRequest')->with($notification);
    }
}