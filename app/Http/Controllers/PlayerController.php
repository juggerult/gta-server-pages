<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Promocode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
    public function checkPromo(Request $request)
    {
        try {
            $promo = $request->input('promocode');

            if (Promocode::where('promocode', $promo)->exists()) {
                return response()->json(['available' => true]);
            } else {
                return response()->json(['available' => false]);
            }
        } catch (\Exception $e) {
            Log::error('Ошибка при проверке промокода: ' . $e->getMessage());
            return response()->json(['available' => false]);
        }
    }



    public function deletePlayer(Request $request){
        $accountId = $request->input('accountId');

        Player::find($accountId)->delete();

    }


    public function getPlayerInfo($id){
        $player = Player::find($id);

        return response()->json($player);
    }
}
