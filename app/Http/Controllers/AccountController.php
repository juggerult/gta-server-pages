<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AccountController extends BaseController
{

    public function getCharacters(){
        $data = Player::where('user_id', Auth::user()->id)->get();

        return response()->json($data);
    }

    public function getAuth(){
        $data = Auth::user();

        return response()->json($data);
    }

    public function updateInfoEmail(Request $request)
    {
        try {
            $data = $request->input('email');

            if (User::where('email', $data)->exists()) {
                return response()->json(['message' => 'Такая почта уже занята'], 400);
            } else {
                $this->service->updateEmail($data);
                return response()->json(['message' => 'Изменения успешно сохранены'], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ошибка при сохранении данных', 'error' => $e->getMessage()], 500);
        }
    }
    public function updateInfoPassword(Request $request)
    {
        try{
            $data = $request->input('password');

            $this->service->updatePassword($data);
            return response()->json(['message' => 'Изменения успешно сохранены'], 201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Ошибка при сохранении данных', 'error' => $e->getMessage()], 500);
        }
    }

}
