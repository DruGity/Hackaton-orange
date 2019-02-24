<?php

namespace App\Http\Middleware;

use Closure;
use App\Role;
use Illuminate\Support\Facades\Auth;

class checkForAdminRoleExist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if($user) {
            $userRole = $user->role_id;

            if (Role::checkIsAdmin($userRole)) {
                return $next($request);
            }
        }

        return response()->json(null, 403);

    }
}
