<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DineUser;
// use App\Models\HouseDetails;
use App\Models\Hundred;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class DineUserController extends Controller
{
    //
    public function storeUser(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'first_name'=>'required|max:30',
            'last_name'=>'required|max:30',
            'email'=>'required|email|max:50',
            'phone'=>'required|max:15',
            'password'=>'required|max:191',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'validate_err'=> $validator->getMessageBag(),

            ]);
        }
        else
        {
        $user = new DineUser;

            if($request->hasFile('image'))
            {
                $image = $request->file('image');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('users/', $filename);
            }
            $user->image = $filename;

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->phone = $request->input('phone');
        $user->user_type = 1;
        $user->save();

        return response()->json([
            'status'=> 200,
            'message'=> 'Account created successfully'
        ]);
    }
    }


    public function storeVenturer(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'first_name'=>'required|max:30',
            'last_name'=>'required|max:30',
            'email'=>'required|email|max:50',
            'phone'=>'required|max:15',
            'password'=>'required|max:191',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'validate_err'=> $validator->getMessageBag(),

            ]);
        }
        else
        {
        $user = new DineUser;
        if($request->hasFile('image'))
            {
                $image = $request->file('image');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('users/', $filename);
            }
            $user->image = $filename;
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->phone = $request->input('phone');
        $user->user_type = 2;
        $user->save();

        return response()->json([
            'status'=> 200,
            'message'=> 'Account created successfully'
        ]);
    }
    }


    public function getIn(Request $req)
    {

        $admin= DineUser::where('email',$req->email)->first();
        if(!$admin || !Hash::check($req->password, $admin->password))
        {
            return response()->json([
                'status'=> 404,
                "error"=>"username or password is not matched"
            ]);
        }
        return response()->json([
            'status'=> 200,
            'data'=>$admin
        ]);

    }


    public function getHostDetails($id)
    {
        $DineUser = DineUser::find($id);

        if($DineUser)
        {
            return response()->json([
                'status'=> 200,
                'host'=>$DineUser
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

    public function getHostSpecificDetails($id)
    {
        $DineUser = DineUser::find($id);

        if($DineUser)
        {
            return response()->json([
                'status'=> 200,
                'hostSpecific'=>$DineUser
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

    public function updateCustomerProfileDetails(Request $request, $user_id)
    {
        $DineUser = DineUser::where('id', $user_id)->first();
        if($DineUser)
        {
            if($request->hasFile('image'))
            {
                $path = 'users/'.$DineUser->image;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('image');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('users/', $filename);
                $DineUser->image = $filename;
            }
            $DineUser->first_name = $request->input('first_name');
            $DineUser->last_name = $request->input('last_name');
            $DineUser->email = $request->input('email');
            $DineUser->phone = $request->input('phone');
            $DineUser->password = Hash::make($request->input('password'));
            $DineUser->update();

            return response()->json([
                'status'=> 200,
                'message'=> 'Profile updated successfully',
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

    public function getAllHostDetails($id)
    {
        $DineUser = DineUser::where('user_type', $id)->get();
        if($DineUser)
        {
            return response()->json([
                'status'=> 200,
                'allHost'=>$DineUser
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

    public function getOneHostDetails($id)
    {
        $DineUser = DineUser::where('id', $id)->get();
        if($DineUser)
        {
            return response()->json([
                'status'=> 200,
                'oneHost'=>$DineUser
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

    public function deleteHost($id)
    {
        $DineUser = DineUser::find($id);

        $path1 = 'users/'.$DineUser->image;
        if(File::exists($path1))
        {
        File::delete($path1);
        }

        $DineUser->delete();

        return response()->json([
            'status'=> 200,
            'message'=>"account deleted successfully",
        ]);
    }

    public function deleteCustomer($id)
    {
        $DineUser = DineUser::find($id);

        $path1 = 'users/'.$DineUser->image;
        if(File::exists($path1))
        {
        File::delete($path1);
        }

        $DineUser->delete();

        return response()->json([
            'status'=> 200,
            'message'=>'account deleted Successfully',
        ]);
    }

    public function getHostJoinDetails($id)
    {
        $DineUser = DB::table('dineusers')
        ->join('house_details','dineusers.id',"=",'house_details.user_id')
        ->where('house_details.id',"=",$id)
        ->select('dineusers.*')
        ->get();

        return response()->json([
            'status'=> 200,
            'hostJoin'=>$DineUser,
        ]);
    }
}
