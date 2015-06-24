<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GetUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Auth::user()) {

            $authUser = Auth::user();

            $authRole = $authUser->getUserRole();

            $authId = $authUser->id;

            Session::put('role', $authRole);

            Session::put('auth.id', $authId);

            if (Session::get('role') === 'Admin') {

                Session::put('role.admin', rand(50, 32098));

            } elseif (Session::get('role') === 'Editor') {

                Session::put('role.editor', rand(3, 42098));

            }
        }

        return $next($request);
    }
}
