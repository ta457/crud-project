<?php

namespace App\Http\Middleware\Users;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ViewUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Gate::allows('view-users')) {
            abort(Response::HTTP_FORBIDDEN);
        }
        return $next($request);
    }
}