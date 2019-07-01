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
        $id = @\Auth::User()->id_user_role;
        if($id < 3 && $id > 0){
            return $next($request);
        }
        return redirect('login/adm')->with('error','You have not admin access');
    }
}
