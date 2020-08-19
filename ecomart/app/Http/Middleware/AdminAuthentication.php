<?php

namespace App\Http\Middleware;
use Illuminate\Auth\Middleware\AdminAuthenticate as Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
class AdminAuthentication
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
        if(Auth::check() && Auth::user()->level == 0) {
            return $next($request);
        }else {
            return redirect('/admin/logout');
        }
    }
}
