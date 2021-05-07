<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller; 

use Illuminate\Http\Request;
use  App\Http\Controllers\Api;
use App\Bilan; 
use Validator;
use DB;


class BilanController extends Controller
{
    public function store_bilan(Request $request){
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
        $bilan = Bilan::create($request->all());
        if($bilan){
            return response()->json(['bilan' => $bilan], 200); 
        }
        return response()->json(['error' => "Unable to create a bilan"], 401);        
    }

/*
    public function destroyBilan($id)
{
    $bilan=Bilan::find($id);

    if(is_null($bilan)){
        return response()->json(['error','MouvementComptable Not Found'],404);
    }
    DB::table("bilan")->where('id',$id)->delete();
    return response(['data'=>'deleted seccessfuly']);
}*/

public function getEListBilan(){

    return response()->json(Bilan::all(),200);
}


public function destroyBilan(Request $request , $id){
    $bilan=Bilan::find($id);
        if(is_null($bilan)){
            return response()->json(['message','bialn Not Found'],404);
        }
        $bilan->delete();
        return response()->json('deleted successfuly',204);
    }
    
   public function updatebilan(Request $request, $id)
{

    $this->validate($request, [
        'code_compte' => 'required',
        'nom_compte'=> 'required',
        'montant_actif'=> 'required',
        'montant_passif'=> 'required',
       'passif'=> 'required',
       'actif'=>'required'
           ]);

    $bilan=Bilan::find($id);

        if(is_null($bilan)){
            return response()->json(['message','biallan Not Found'],404);
        }

         //$role = Role::find($id);
         $bilan->update($request->all());
        // $bilan->save();
 
 
        // $role->syncBilan($request->input('bilan'));
 
 
         return response()->json(['success' => $bilan],200);
}
public function updatebilann(Request $request, $id)
{

    $this->validate($request, [
        'nom_compte' => 'required',
        'montant_actif' => 'required',
        'montant_passif' => 'required',
        'actif' => 'required',
        'passif' => 'required'
       // 'bilan' => 'required',
    ]);

    $permission=Permission::find($id);

        if(is_null($permission)){
            return response()->json(['message','role Not Found'],404);
        }

         //$role = Role::find($id);
         $permission->name = $request->input('name');
         $permission->save();
 
 
        // $role->syncPermissions($request->input('permission'));
 
 
         return response()->json(['success' => $permission], $this-> successStatus);
}




}
