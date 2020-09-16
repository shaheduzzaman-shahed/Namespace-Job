<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicationResource;
use App\Models\Application;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function getCompanyApplications(){
        $applications = Application::where('company_id', auth()->user()->id)->get();
        return response()->json(ApplicationResource::collection($applications));
    }
}
