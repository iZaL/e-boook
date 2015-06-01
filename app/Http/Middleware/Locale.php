<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class Locale
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
        if(!Session::get('locale')) {
            Session::put('locale','en');
        }
        else {
            app()->setLocale(Session::get('locale'));
        }
        return $next($request);
    }
}
