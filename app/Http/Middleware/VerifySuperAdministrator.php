<?php

namespace App\Http\Middleware;

use Closure;

class VerifySuperAdministrator
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
        if (!auth()->user->hasRole('super-administrator')) {
            return redirect('/admin');
        }
        return $next($request);
    }
}
