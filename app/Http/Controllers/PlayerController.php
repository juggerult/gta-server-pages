<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Promocode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerController extends BaseController
{


    public function registration(Request $request){
        $data = $request->validate([
            'nickname' => 'required',
            'promocode' => 'required',
            'server' => 'required',
            'gender' => 'required',
        ]);

        $this->service->playerRegister($data);

        return response()->json(['error' => 'Вход успешен'], 201);
    }
    public function checkNickname(Request $request){
        $nickName = $request->input('nickname');

        $player = Player::where('nickname', $nickName)->exists();

        return response()->json(['available' => !$player]);
    }
    public function checkPromo(Request $request){
        $promo = $request->input('promocode');

        if($promo == null){
            return response()->json(['available' => true]);
        }else{
            if(Promocode::where('promocode', $promo)->exists()){
                return response()->json(['available' => true]);
            }else{
                return response()->json(['available' => false]);
            }
        }
    }
}
