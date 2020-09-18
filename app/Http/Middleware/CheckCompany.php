<?php

namespace App\Http\Middleware;

use Closure;

class CheckCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->is_company){
            return $next($request);
        }else{
            abort(403,'You are not authorized for this operation!');
        }
    }
}
