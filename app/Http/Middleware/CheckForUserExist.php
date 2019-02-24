<?php

namespace App\Http\Middleware;

use Closure;

use App\User;

class CheckForUserExist
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
        if (User::checkForExist($request->post('email'))) {
            return response()->json('User ' . $request->post('email') . ' already exist!', 406);
        }

        return $next($request);
    }
}
