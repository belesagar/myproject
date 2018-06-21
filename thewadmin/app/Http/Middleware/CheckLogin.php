<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
        $sessionName = \Config::get('constant.SESSION_NAME');
        if (!$request->session()->has($sessionName)) {
            
           return redirect('login');
        }
        return $next($request);
    }
}
