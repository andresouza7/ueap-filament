<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Illuminate\Support\Facades\Log;

class LogThrottle
{
    public function handle($request, Closure $next)
    {
        $limiter = app(RateLimiter::class);

        $key = strtolower($request->input('email')) . '|' . $request->ip();

        if ($limiter->tooManyAttempts($key, 3)) {
            Log::warning('Login throttled (too many attempts)', [
                'email'      => $request->input('email'),
                'ip'         => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        return $next($request);
    }
}
