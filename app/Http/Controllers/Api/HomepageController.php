<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    public function getAllPost(){
        $postsWithApplicant = DB::table('posts')
            ->leftJoin('applications','posts.id','=','applications.applicant_id')
            ->select('posts.*','applications.applicant_id')
            ->get();
        return response()->json($postsWithApplicant);
    }
}
