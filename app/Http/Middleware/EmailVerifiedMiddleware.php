<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class EmailVerifiedMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (is_null(auth()->user()->email_verified_at)){
            throw new AccessDeniedHttpException();
        }
        return $next($request);
    }
}
