<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LogoutUsers
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
        $user = Auth::user();

        if(!empty($user->logout)){
            $user->logout = false;
            $user->save();

            Auth::logout();

            return redirect()->route('login');
        }


        return $next($request);
    }
}
