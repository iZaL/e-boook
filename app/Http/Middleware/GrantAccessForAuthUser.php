<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GrantAccessForAuthUser
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
        $authId = Auth::user()->id;

        if($authId == $request->segment(3) || Session::get('role.admin')) {

            return $next($request);
        }
        return redirect('/')->with(['error'=>trans('word.no-auth')]);
    }
}
