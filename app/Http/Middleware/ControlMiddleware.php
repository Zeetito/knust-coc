<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use App\Models\Accessory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ControlMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $accessory): Response
    {
        if ($accessory == 'system_online') {
            $roles = Role::zone_reps_level()->get();
            if (Accessory::where('name',$accessory)->first()->value == 1 || (auth()->user()->hasAnyOf($roles)) == true) {
                return $next($request);
            } else {
                return redirect(route('system_offline'));
            }

        }
    }
}
