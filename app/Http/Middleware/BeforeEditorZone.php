<?php

namespace App\Http\Middleware;

use Closure;

class BeforeEditorZone
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $editor)
    {
        if (in_array($request->user()->getUserRole(), [$editor], true)) {
            return $next($request);
        } else {
            return redirect('/home')->with(['error' => trans('word.needs-editor-auth')]);
        }
    }
}
