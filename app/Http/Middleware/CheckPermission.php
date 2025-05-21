<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, array $permission, string $message = 'You do not have permission to perform this action'): Response
    {
        if (!Auth::check() || !Auth::user()->can($permission)) {
            Session::flash('error', $message);
            return back();
        }
        return $next($request);
    }
}
