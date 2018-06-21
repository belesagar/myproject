<?php

namespace App\Http\Middleware;

use Closure;

class CheckNotLogin
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
        //dd(session('franchise_users'));
        if ($request->session()->has('channel_partner_users')) {
            
           return redirect('dashboard');
        }
        return $next($request);
    }
}
