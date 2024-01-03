<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends BaseController
{


    public function checkUsername(Request $request){
        $username = $request->input('username');

        $user = User::where('username', $username)->first();

        return response()->json(['available' => !$user]);
    }

    public function checkEmail(Request $request){
        $email = $request->input('email');

        $user = User::where('email', $email)->first();

        return response()->json(['available' => !$user]);
    }

    public function confirmRegistration(Request $request){

        $data = $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $this->service->registrationAccount($data);

        return response()->json(['error' => 'Вход успешен'], 201);
    }

    public function confirmLogin(Request $request){

        $data = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt($data)){
            if(!Auth::user()->active){
                Auth::logout();
                return response()->json(['error' => 'Данный аккаунт заблокирован'], 500);
            }else{
                return response()->json(['error' => 'Вход успешен'], 201);
            }
        }else{
            return response()->json(['error' => 'Аккаунт с такими данными не зарегистрирован'], 500);
        }
    }

    public function logout(){
        Auth::logout();

        return redirect('/');
    }


    public function login(){
        if(Auth::check()){
            return response()->json(['error' => 'Вход успешен'], 201);
        }
        return response()->json(['error' => 'Ошибка'], 500);

    }

}
