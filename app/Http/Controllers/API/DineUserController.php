<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DineUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;

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
}
