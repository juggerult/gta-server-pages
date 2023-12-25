<?php

namespace App\Services\Post;

use App\Models\User;

class Service{

    public function registrationAccount($data){
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

}
