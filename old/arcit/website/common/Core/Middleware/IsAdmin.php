<?php

namespace Common\Core\Middleware;

use Auth;
use Closure;
use Common\Core\Policies\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if ( ! Auth::check()) {
            throw new AuthenticationException();
        }

        if ( ! Auth::user()->hasPermission('admin')) {
            throw new AuthorizationException();
        }

        return $next($request);
    }
}
