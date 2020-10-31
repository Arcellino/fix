<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$level)
    {
        if (is_array($level)) {
            foreach ($level as $level) {
                if (Auth::user()->level == $level) {
                    return $next($request);
                }
            }
            return abort(401, 'Unauthorized');
        }
    }
}
