<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CMSChecker
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
        if (Auth::check()
            && (in_array(Auth::user()->role->slug,['admin','dev']))
        )
            return $next($request);
        else {
            if (!$request->isJson()) {
                Auth::logout();
                return redirect()->route('login');
            } else {
                return response()->json(['message' => 'not authorized'], 401);
            }

        }
    }
}
