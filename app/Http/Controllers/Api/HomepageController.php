<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HomePageResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    public function getAllPost(){
        $postsWithApplicant = DB::table('posts')
            ->leftJoin('applications','posts.id','=','applications.post_id')
            ->select('posts.*','applications.applicant_id')
            ->get();
        $postsWithApplicant = Post::all();
        return response()->json(HomePageResource::collection($postsWithApplicant));
    }
}
