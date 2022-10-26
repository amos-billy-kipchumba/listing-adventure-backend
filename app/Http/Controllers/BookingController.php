<?php

namespace App\Http\Controllers;

use App\Models\BookingInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class BookingController extends Controller
{
    //
    public function storeBookingInfo(Request $request) {
        $bookingInfo = new BookingInfo;
        $bookingInfo->user_id = $request->input('user_id');
        $bookingInfo->house_id = $request->input('house_id');
        $bookingInfo->start_date = $request->input('start_date');
        $bookingInfo->end_date = $request->input('end_date');
        $bookingInfo->number_of_guests = $request->input('number_of_guests');
        $bookingInfo->number_of_days = $request->input('number_of_days');
        $bookingInfo->number_of_hours = $request->input('number_of_hours');
        $bookingInfo->total_price = $request->input('total_price');
        $bookingInfo->paid = "yes";
        $bookingInfo->mpesa_message = "paid jjskdfgjkk";
        $bookingInfo->bank_message = "paid received ssdhkkjhjhrj";
        $bookingInfo->booking_phone = $request->input('booking_phone');
        $bookingInfo->save();
        return response()->json([
            'status'=> 200,
            'joinThousand'=> "Booked",
        ]);
    }

    public function getBookedDates($id)
    {
        $BookingInfo = BookingInfo::where('house_id', $id)->get();

        if($BookingInfo)
        {
            return response()->json([
                'status'=> 200,
                'selectedDates'=>$BookingInfo
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message'=> 'No record with such id found!',
            ]);
        }
    }

    public function getBookedInfo($id) {
        $BookingInfo = DB::table('booking_info')
        ->rightJoin('house_details','booking_info.house_id',"=",'house_details.id')
        ->where('booking_info.user_id','=',$id)
        ->select('*', 'booking_info.id as bid')
        ->orderBy('booking_info.start_date', 'desc')
        ->get();

        return response()->json([
            'status'=> 200,
            'bookingInfo'=> $BookingInfo,
        ]);
    }

    public function getTotalBooked($id)
    {
        $BookingInfo = BookingInfo::where('user_id', $id)->get();

        if($BookingInfo)
        {
            return response()->json([
                'status'=> 200,
                'totalBooked'=>$BookingInfo
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message'=> 'No record with such id found!',
            ]);
        }
    }


    public function getTotalBookedForHost($id)
    {
        $BookingInfo = DB::table('booking_info')
        ->join('house_details','booking_info.house_id',"=",'house_details.id')
        ->join('dineusers','dineusers.id','=','house_details.user_id')
        ->where('house_details.user_id','=',$id)
        ->get();

        return response()->json([
            'status'=> 200,
            'bookingInfoForHost'=> $BookingInfo,
        ]);
    }

    public function deleteCustomerBooking($id)
    {
        $BookingInfo = BookingInfo::find($id);

        $BookingInfo->delete();

        return response()->json([
            'status'=> 200,
            'message'=>'booking cancelled Successfully',
        ]);
    }
}