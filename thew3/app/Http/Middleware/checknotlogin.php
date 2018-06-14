<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class checknotlogin
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



        return $next($request);
    }
}
