<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public function applicant(){
        return $this->belongsTo(User::class, 'applicant_id');
    }
    public function company(){
        return $this->belongsTo(User::class, 'company_id');
    }
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
