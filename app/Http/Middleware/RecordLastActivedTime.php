<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RecordLastActivedTime
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return RedirectResponse|Response|mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        // 如果时登录用户的话
        if (Auth::check()) {
            if (Auth::user()->last_actived_at->diffInHours(now()) !== 0) {
                // 记录最后登录时间
                Auth::user()->recordLastActivedAt();
            }
        }

        return $next($request);
    }
}
