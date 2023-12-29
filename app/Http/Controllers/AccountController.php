<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{

    public function getCharacters(){
        $data = Player::where('user_id', Auth::user()->id)->get();

        return response()->json($data);
    }

    public function getAuth(){
        $data = Auth::user();

        return response()->json($data);
    }
}
