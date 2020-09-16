<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function applications(){
        return $this->hasMany(Application::class);
    }
    public function company(){
        return $this->belongsTo(User::class,'user_id');
    }
}
