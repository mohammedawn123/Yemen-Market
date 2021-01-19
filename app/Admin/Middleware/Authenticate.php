<?php

namespace App\Admin\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {/*
        if (! $request->expectsJson()) {
            if(Request::is('admin/*'))
                return route('admin.getLogin'); // return to admin login
            else
                return route('shop.home'); // return to shop login
        }*/
    }

    /**
     * Determine if the request has a URI that should pass through verification.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected function shouldPassThrough($request)
    {

        $routeName = $request->path();
        $excepts = [
             'admin/login',
            'admin/logout',
        ];
        return in_array($routeName, $excepts);

    }
}
