<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
    use HasFactory;
    protected $fillable = ['id','promocode', 'money', 'count_entered_promo', 'user_id'];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
