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

//        Redirect to admin dashboard if admin tries to access home.
        if ($request->routeIs('dashboard') && $authGuard->user()->role == 'admin')
            return redirect()->route('admin.index');

//        Throw not found if the route is not allowed for the user
        if ($authGuard->user()->role != $role) abort(404);

        return $next($request);
    }
}
