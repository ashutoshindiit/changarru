<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserAuth
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
       
        if(!Auth::guard('user')->check()){
            $dataUrl = \Request::fullUrl();
            $input = $request->path();
            $result = explode('/',$input);
            $slug = $result[0];
            $resultNew = explode($result[0],$dataUrl);
            $newUrlGet = $resultNew[0].$slug;

            return redirect($newUrlGet);
        }

        return $next($request);
    }
}

