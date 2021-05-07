<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Adjointcontroller extends Controller
{
    public function store_adjoint(Request $request){
        $validator = Validator::make($request->all(), [

            'code_compte'=>'required',
            'nom_compte' =>'required',
            'montant_actif'=>'required',
             'montant_passif' =>'required',
             'actif'=>'required',
             'passif'=>'required'
                     ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $input = $request->all();
        $adjoint = Adjoint::create($request->all());
        if($bilan){
            return response()->json(['Adjoint' => $bilan], 200); 
        }
        return response()->json(['error' => "Unable to create a Adjoint"], 401);        
    }

    public function getEListAdjoint(){

        return response()->json(Adjoint::all(),200);
    }



}
