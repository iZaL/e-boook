<?php

namespace App\Http\Middleware;

use Closure;

class BeforeCreateBook
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $admin,$editor)
    {
        if(in_array($request->user()->getRole()->name,[$admin,$editor],true)) {
            return $next($request);
        }
        else {
            return redirect('/home')->with('errors',trans('word.not-auth'));
        }


    }
}
