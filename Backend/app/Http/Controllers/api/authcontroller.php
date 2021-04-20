<?php

namespace App\Http\Controllers\api;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class authcontroller extends Controller
{
    public function register (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails())
        {
            return response(['error'=>$validator->errors()->all()], 422);
        }
        $request['password']=Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $user = User::create($request->toArray());
       // $user->notify(new RegisterNotify());
    
        $user->sendEmailVerificationNotification();
    
        $accessToken = $user->createToken('authToken')->accessToken;
    
        return response(['user'=> $user, 'access_token'=> $accessToken]);
    }


    /*
    public function register(Request $request)
   {
        $validatedData = $request->validate([
            'name'=>'required|max:55',
            'email' => ['required' , 'regex:/(.+)@(.+)\.(.+)/i', 'string', 'email', 'max:255', 'unique:users'],
            'password'=>'required|confirmed'
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);
       // $user->sendEmailVerificationNotification();

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user'=> $user, 'access_token'=> $accessToken]);
       
   }
   */
// login
   public function login(Request $request)
   {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
       
        if(!auth()->attempt($loginData)) {
            return response(['error'=>'Invalid credentials']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);

   }

   
}
