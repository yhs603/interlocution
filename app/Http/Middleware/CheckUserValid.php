<?php

namespace Interlocution\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->status === 0)
                abort(403, '您的邮箱尚未激活，无法进行此操作');
            if ($user->status === -1)
                abort(403, '您的账号已被禁用');
        }

        return $next($request);
    }
}
