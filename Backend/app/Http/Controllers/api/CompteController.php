<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller; 

use Illuminate\Http\Request;
use  App\Http\Controllers\Api;
use App\Compte; 
use Validator;
use DB;
use \Auth;

class CompteController extends Controller
{

    
    public function store_compte(Request $request){
        $validator = Validator::make($request->all(), [

            'code_compte'=>'required',
            'libellee' =>'required'

        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        
        }

  
        $userID = Auth::id();
        //$user = Auth::user();
        $input['user_id'] = $userID;
        $compte = Compte::create($request->all());
      //  return $this->sendResponse($post, 'Post added Successfully!' );
      if($compte){
        return response()->json(['compte' => $compte], 200); 
    }
    return response()->json(['error' => "Unable to create a compte"], 401);        





    }
    public function updatecompte(Request $request, $id)
    {

        $this->validate($request, [
           'code_compte'=> 'required',
        	'libellee'=> 'required'
             	
        ]);
    
        $compte=Compte::find($id);
    
            if(is_null($compte)){
                return response()->json(['message','Compte  Not Found'],404);
            }
    
             //$role = Role::find($id);
             $compte->update($request->all());
//             $compte->save();
     
     
            // $role->syncCompte($request->input('compte'));
     
     
             return response()->json(['success' => $compte], 200);
    }
    
    
   
    

    public function destroyCompte(Request $request , $id){
        $compte=Compte::find($id);
            if(is_null($compte)){
                return response()->json(['message','compte Not Found'],404);
            }
            $compte->delete();
            return response()->json('deleted successfuly',204);
        }
}
