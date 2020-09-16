<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Post;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function applyJob($id){
        $post = Post::find($id);
        $application = new Application();
        $application->applicant_id = auth()->user()->id;
        $application->company_id = $post->company->id;
        $application->post_id = $post->id;
        $application->save();
        return response()->json($application->post);
    }
}
