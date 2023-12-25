<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    protected $fillable = ['nickname', 'server', 'level', 'experience', 'gender', 'promocode', 'balance_money', 'balance_bank', 'active_vip', 'time_active_vip', 'active_warns', 'time_active_warns', 'active_bans', 'time_active_ban', 'password'];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
