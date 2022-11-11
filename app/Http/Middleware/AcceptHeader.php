<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AcceptHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return RedirectResponse|Response|mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
