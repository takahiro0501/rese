<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RoleMiddleware
{
    //権限照合
    public function handle($request, Closure $next, $perm)
    {
        if ($request->user()->can($perm)) {
            return $next($request);
        } 
        return response(view('errors.role-error'));
    }
}
