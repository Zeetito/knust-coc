<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role_level): Response
    {
        if ($role_level == 'preacher_level') {
            $roles = Role::preacher_level()->get();
            if ((auth()->user()->hasAnyOf($roles)) == true) {
                return $next($request);
            } else {
                abort(code: 401);
            }

        } elseif ($role_level == 'ministry_members_level') {
            $roles = Role::ministry_members_level()->get();
            if ((auth()->user()->hasAnyOf($roles)) == true) {
                return $next($request);
            } else {
                abort(code: 401);
            }

        } elseif ($role_level == 'zone_reps_level') {
            $roles = Role::zone_reps_level()->get();
            if ((auth()->user()->hasAnyOf($roles)) == true) {
                return $next($request);
            } else {
                abort(code: 401);
            }

        } elseif ($role_level == 'residence_reps_level') {
            $roles = Role::residence_reps_level()->get();
            if ((auth()->user()->hasAnyOf($roles)) == true) {
                return $next($request);
            } else {
                abort(code: 401);
            }
        }

    }
}
