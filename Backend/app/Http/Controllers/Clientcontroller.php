<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Clientcontroller extends Controller
{
    public function store_client(Request $request){
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
        $client = Client::create($request->all());
        if($client){
            return response()->json(['client' => $client], 200); 
        }
        return response()->json(['error' => "Unable to create a client"], 401);        
    }
    public function getEListclient(){

        return response()->json(Client::all(),200);
    }

    public function destroyClient(Request $request , $id){
        $client=Client::find($id);
            if(is_null($client)){
                return response()->json(['message','client Not Found'],404);
            }
            $client->delete();
            return response()->json('deleted successfuly',204);
        }

        public function updateclient(Request $request, $id)
{

    $this->validate($request, [
        'nom_compte' => 'required',
        'montant_actif' => 'required',
        'montant_passif' => 'required',
        'actif' => 'required',
        'passif' => 'required'
       // 'bilan' => 'required',
    ]);

    $client=Client::find($id);

        if(is_null($client)){
            return response()->json(['message','role Not Found'],404);
        }

         //$role = Role::find($id);
         $client->name = $request->input('name');
         $client->save();
 
 
        // $role->syncClient($request->input('client'));
 
 
         return response()->json(['success' => $client], $this-> successStatus);
}

}
