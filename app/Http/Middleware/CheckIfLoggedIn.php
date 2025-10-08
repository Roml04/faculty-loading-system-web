<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!(session('isSameBranch'))) {
            abort(403);
        }

        if(!(session('role') === 'Teacher' or session('role') === 'Student')) {
            abort(403);
        }

        return $next($request);
    }
}
