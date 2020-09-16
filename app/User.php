<?php

namespace App;

use App\Models\Post;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }


    public function uploadUserImage($image){
        $name = $image->getClientOriginalName();
        $this->deleteOldImage();
        $image->storeAs('images/profile',$name,'public');
        $path = asset('storage/images/profile/'.$name);
        return $path;
    }
    protected function deleteOldImage(){
        if($this->image){
            $file=explode('/',$this->image);
            Storage::delete('public/images/profile/'.$file[count($file)-1]);
        }
    }
    public function uploadUserResume($file){
        $name = $file->getClientOriginalName();
        $this->deleteOldResume();
        $file->storeAs('document/resume',$name,'public');
        $path = asset('storage/document/resume/'.$name);
        return $path;
    }
    protected function deleteOldResume(){
        if($this->resume){
            $file=explode('/',$this->resume);
            Storage::delete('public/document/resume/'.$file[count($file)-1]);
        }
    }
}
