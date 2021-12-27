<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Request;

class GuestAuth
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
        $cookie_name = "guestId";
        if(!isset($_COOKIE[$cookie_name]) && empty($_COOKIE[$cookie_name])) {
            $cookie_value = date('Ymdhis');
            // echo "<pre>"; print_r($cookie_value); die;
            setcookie($cookie_name, $cookie_value, time() + (86400), "/"); // 86400 = 1 day
            return $next($request);

        }
        return $next($request);
    }
}
