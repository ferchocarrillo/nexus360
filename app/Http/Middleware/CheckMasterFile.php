<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckMasterFile
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

        //dd($user);
        if($user){
            if(Auth::user()->hasRole('admin') || Auth::user()->hasPermissionTo('login.withoutmf')){
                return $next($request);
            }
            if(empty($user->masterfile())){
                Auth::logout();
                return redirect()->route('login')->with('masterfile','Your username is not in the system. Inform your supervisor.');
            }else{
                if($user->masterfile()->status != "Active"){
                    Auth::logout();
                    return redirect()->route('login')->with('masterfile','Your username is not active.');
                }
            }
        }   
        return $next($request);     
    }
}
