<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MyRestrictedDocsAccess
{
    public function handle($request, \Closure $next)
    {
        if (app()->environment('local')) {
            return $next($request);
        }

        $user = $request->user();

        if (in_array($user->email, ['test.test@test.test'])) {
            return $next($request);
        }

        abort(403);
    }
}
