<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Equipment;

class EquipmentController extends Controller
{
    public function index(Request $req)
    {
        $validator = Validator::make($req->all(),[ 
            'equipment_name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),400);
        }
    
        $equipmentadd = new Equipment;
        $equipmentadd->equipment_name=$req->equipment_name;
        if($equipmentadd->save()){
            return response()->json(['success'=>'true','message'=>'equipmentadd Create Sucessfully'],200);
        }else{
            return response()->json(['success'=>'false','message'=>'something Went Wrong'],200);
        }

    }
}
