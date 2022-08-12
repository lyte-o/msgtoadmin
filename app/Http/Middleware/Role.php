<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param string $role
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $role): Response|RedirectResponse
    {
        $authGuard = Auth::guard();

        if ($authGuard->guest()) {
            abort(403, "Log in to your account!");
        }

        if ($authGuard->user()->role != $role) {
            abort(404);
        }

        return $next($request);
    }
}
