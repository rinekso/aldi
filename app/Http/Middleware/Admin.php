<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        // dd(Auth::check());
        if(@auth()->user()->id_user_role == '1'){
            return $next($request);
        }
        return redirect('login')->with('error','You have not admin access');
    }
}
