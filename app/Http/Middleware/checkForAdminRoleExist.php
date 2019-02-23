<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

use App\Role;

class checkForAdminRoleExist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, Role $role)
    {
        $userRole = Auth::user()->role_id;

        if ($role->checkIsAdmin($userRole)) {
            return $next($request);
        }

        Abort(403);

    }
}
