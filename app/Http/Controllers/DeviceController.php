<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use App\User;
use App\Equipment;
use Validator;

class DeviceController extends Controller
{
    public function signupDevice(Request $req)
    {
        $validator = Validator::make($req->all(),[ 
            'name' => 'required|string',
            'email'   => 'required|string',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(),400);
        }
    
        $deviceadd = new Device;
        $deviceadd->name=$req->name;
        $deviceadd->email=$req->email;
        $deviceadd->password=bcrypt($req->password);
        if($deviceadd->save()){
            return response()->json(['success'=>'true','message'=>'Device Create Sucessfully'],200);
        }else{
            return response()->json(['success'=>'false','message'=>'something Went Wrong'],200);
        }

    }
    public function login(Request $request)
    {
 
        $loginData = $request->validate([
            'email' => 'required|string',
            'password' => 'required'
        ]);
 
        if(!auth()->attempt($loginData)) {
            
            return response()->json(['success'=>false,'user'=>auth()->user(),'token'=>null,
            'message'=>'Sorry your email  or password wrong']);
        }
 
         $accessToken =auth()->user()->createToken('authToken')->accessToken;
 
         return response()->json(['success'=>true,'user' =>auth()->user(), 'token' => $accessToken]);
    } 
    
   
}
