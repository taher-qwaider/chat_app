<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function view(){
        return response()->view('auth.login');
    }

    public function login(Request $request){
        $validator=Validator($request->all(), [
            'email'=>'required|email|exists:users,email',
            'password'=>'required|string|min:3',
            'remember_me'=>'boolean'
        ]);
        $credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];
        if(!$validator->fails()){
            if(Auth::guard('user')->attempt($credentials, $request->get('remember_me'))){
                User::where('email', $request->get('email'))->update(['isConnected'=>true]);
                return response()->json(['message'=>'Login Successfully'], 200);
            }else{
                return response()->json(['message'=>'Failed to Login'], 400);
            }
        }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()], 400);
        }
    }
    public function logout(Request $request){
        User::where('id', $request->user('user')->id)->update(['isConnected'=>false]);
        Auth('user')->logout();
        return redirect()->route('login');
    }
}
