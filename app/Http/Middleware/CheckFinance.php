<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckFinance
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
        $userRoles = Auth::user()->roles->pluck('name'); //get name of user roles
        if(!$userRoles->contains('finance')){
            return redirect('/home'); //create a page no permission
        }

        return $next($request);
    }
}
