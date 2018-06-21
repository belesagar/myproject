<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
        // dd(session('franchise_users'));
        if (session('franchise_users')['role'] == "USER") {
            
            return redirect('dashboard');
        }
        return $next($request);
    }
}
