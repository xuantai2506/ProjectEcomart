<?php

namespace App\Http\Middleware;
use Illuminate\Auth\Middleware\MemberAuthentication as Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
class MemberAuthentication
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
        if($request->session()->get('email') === null ) {
            return redirect('logins');
        }
        if($request->session()->get('product') == ''){
            return redirect('');
        }
        return $next($request);
    }
}
