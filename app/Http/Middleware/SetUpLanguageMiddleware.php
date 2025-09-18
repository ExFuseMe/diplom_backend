<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetUpLanguageMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $language = match($request->header('Accept-Language', 'ru')){
            'en' => 'en',
            default => 'ru',
        };

        app()->setLocale($language);

        return $next($request);
    }
}
