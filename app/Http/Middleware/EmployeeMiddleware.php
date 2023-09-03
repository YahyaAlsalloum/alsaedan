<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EmployeeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->user()->role->slug) {
            return response()->json(['message' => 'you are not an employee'], 401);
        }

        return $next($request);
    }
}
