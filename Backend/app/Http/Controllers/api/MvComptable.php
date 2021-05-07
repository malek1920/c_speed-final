<?php

namespace App\Http\Controllers\Api;
use  App\Http\Controllers\Api;
use App\Http\Controllers\Controller; 
use App\MouvementComptable; 
use App\Compte; 
use Illuminate\Http\Request;
use Validator;
use DB;

use \Auth;
class MvComptable extends Controller
{
    
    



    public function store_mvt(Request $request){   
            $input = $request->all();
             $validator = Validator::make($input,[
                'num_piece'=>'required',
                'ref_piece' =>'required',
                 'montant_debit'=>'required',
                 'montant_credit' =>'required',
                'tva'=>'required'
             ]);
             if ($validator->fails()) {
                // return $this->sendError('Validate Error',$validator->errors() );
                return response(['error'=>$validator->errors()->all()], 422);      
     
                   }
           //  $userID = 
             //$user = Auth::user();
             $input['user_id'] = Auth::id();
             $mouvementComptable = MouvementComptable::create($input);
           //  return $this->sendResponse($post, 'Post added Successfully!' );
           return response()->json(['data','Post added Successfully'],200);
     
      
    }



 public function updatemouvementComptable(Request $request, $id)
{

    $this->validate($request, [  
    'num_piece'=> 'required',
    'ref_piece'=> 'required',
    'montant_debit'=> 'required',
    'montant_credit'=> 'required',
    'tva'=> 'required'
    ]);

    $mouvementComptable=MouvementComptable::find($id);

        if(is_null($mouvementComptable)){
            return response()->json(['message','MouvementComptable Not Found'],404);
        }

         //$role = Role::find($id);
         $mouvementComptable->name = $request->input('name');
         $mouvementComptable->save();
 
 
        // $role->syncMouvementComptable($request->input('mouvementComptable'));
 
 
         return response()->json(['success' => $mouvementComptable], $this-> successStatus);
}


public function destroyMouvementComptable($id)
{
    $mouvementComptable=MouvementComptable::find($id);

    if(is_null($mouvementComptable)){
        return response()->json(['error','MouvementComptable Not Found'],404);
    }
    DB::table("mouvementComptable")->where('id',$id)->delete();
    return response(['data'=>'deleted seccessfuly']);
}








}
