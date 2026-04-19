<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckGroup
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ... $groups): Response
    {
        if (!($user = $request->user())) {
            return redirect('/login');
        }

        /** @var User $user */
        if (!$user->isAdmin() && !in_array($user->group->value, $groups)) {
            return abort(403, 'Access denied');
        }

        return $next($request);
    }
}
