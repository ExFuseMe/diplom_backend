<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class AccessToDashboardsMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $dashboardCredentials = Config::get('access.horizon');


        if ($request->getUser() !== $dashboardCredentials['email'] ||
            $request->getPassword() !== $dashboardCredentials['password']
        ) {
            return response('Unauthorized.', 401, [
                'WWW-Authenticate' => 'Basic realm="Horizon"',
            ]);
        }

        return $next($request);
    }
}
