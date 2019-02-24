<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Role;

class CheckIsUser
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

            if (Role::checkIsUser($userRole)) {
                return $next($request);
            }
        }

        return response()->json(null, 403);
    }
}
