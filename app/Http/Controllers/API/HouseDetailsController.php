<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HouseDetails;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Str;

class HouseDetailsController extends Controller
{
    //
    public function storeHouseDetails(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'houseTitle'=>'required|max:191',
            'location'=>'required|max:191',
            'price'=>'required|max:191',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=> 422,
                'errors'=> $validator->messages(),
            ]);
        }

        else
        {
            $HouseDatails = new HouseDetails;

            if($request->hasFile('image'))
            {
                $image = $request->file('image');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('uploads/', $filename);
            }
            $HouseDatails->cover = $filename;
            $HouseDatails->title = $request->input('houseTitle');
            $HouseDatails->description = $request->input('description');
            $HouseDatails->location = $request->input('location');
            $HouseDatails->price = $request->input('price');
            $HouseDatails->user_id = $request->input('userId');
            $HouseDatails->save();

            return response()->json([
                'status'=> 200,
                'message'=> 'House details added Successfully',
            ]);
        }

    }

    public function getHouseDetails()
    {
        $HouseDetails = HouseDetails::all();

        return response()->json([
            'status'=> 200,
            'house_details'=> $HouseDetails
        ]);
    }
}
