<?php

namespace App\Services\Post;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Service{

    public function registrationAccount($data){
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    public function updateEmail($data){
        $user = Auth::user();

        $user->email = $data;
        $user->save();
    }
    public function updatePassword($data){
        $user = Auth::user();

        $user->password = bcrypt($data);
        $user->save();
    }

}
