<?php

namespace App\Http\Middleware;

use Closure;

class BeforeAdminZone
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $admin)
    {
        //dd($request->user()->getUserRole());
        if(in_array($request->user()->getUserRole(),[$admin],true)) {
            return $next($request);
        }
        else {
            return redirect('/home')->with(['error' =>trans('word.needs-admin-auth')]);
        }


    }
}
