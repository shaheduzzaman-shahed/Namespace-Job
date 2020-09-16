<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUser(){
        $user = auth()->user();
        return response()->json(new UserResource($user));
    }
    public function updateUser(Request $request){
        $request->validate([
            'image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'resume'=>'mimes:pdf|max:1000',
        ]);
        $user = User::find(auth()->user()->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->business_name = $request->business_name;
        $user->email = $request->email;
        $user->skills = $request->skills;
        if($file = $request->file('image')) {
            $path = $user->uploadUserImage($file);
            $user->image = $path;
        }
        if($file = $request->file('resume')) {
            $path = $user->uploadUserResume($file);
            $user->resume = $path;
        }
        $user->save();
        return response()->json($user);
    }

}
