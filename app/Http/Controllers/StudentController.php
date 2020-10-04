<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Validator;

class StudentController extends Controller
{
    public function create(Request $req)
    {
        $validator = Validator::make($req->all(),[ 
            'name' => 'required|string',
            'email'   => 'required|string',
            'section' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(),400);
        }
    
        $studentcreate = new Student;
        $studentcreate->name=$req->name;
        $studentcreate->email=$req->email;
        $studentcreate->section=$req->section;
        if($studentcreate->save()){
            return response()->json(['success'=>'true','message'=>'student Create Sucessfully'],200);
        }else{
            return response()->json(['success'=>'false','message'=>'something Went Wrong'],200);
        }
    }
}
