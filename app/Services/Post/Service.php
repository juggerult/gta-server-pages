<?php

namespace App\Services\Post;

use App\Models\Player;
use App\Models\Promocode;
use App\Models\User;
use Carbon\Carbon;
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


    public function createPromo($data){
        $promocode = Promocode::create([
            'promocode' => $data,
            'user_id' => Auth::user()->id,
        ]);
    }


    public function playerRegister($data){

        if($data['promocode'] == null){
            $this->registerWithoutPromo($data);
        }else{
            $this->registerWithPromo($data);
        }

    }
    public function registerWithoutPromo($data){
        Player::create([
            'nickname' => $data['nickname'],
            'promocode' => null,
            'gender' => $data['gender'],
            'server' => $data['server'],
            'user_id' => Auth::user()->id,
        ]);

    }
    public function registerWithPromo($data){
        Player::create([
            'nickname' => $data['nickname'],
            'promocode' => $data['promocode'],
            'gender' => $data['gender'],
            'server' => $data['server'],
            'user_id' => Auth::user()->id,
            'balance_bank' => 10000,
            'active_vip' => true,
            'time_active_vip' => Carbon::now()->addDays(7),
        ]);

        $promocodeOwner = Promocode::where('promocode', $data['promocode'])->first();
        $promocodeOwner->increment('count_entered_promo');
        $promocodeOwner->save();
    }

}
