<?php

namespace App\Admin\Middleware;

use App\Admin\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Permission
{
     /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param array                    $args
     *
     * @return mixed
     */
    public function handle(Request $request, \Closure $next, ...$args)
    {

        if (Admin::user() && Admin::user()->isAdministrator()) {
              return $next($request);
        }


        // Allow access route
        if ($this->routeDefaultPass($request)) {
            return $next($request);
        }


        //Group view all
        // this group can view all path, but cannot change data
        if ( Admin::user()  && Admin::user()->isViewAll()) {
            if ($request->method() === 'GET' ) {
                return $next($request);
            } else {
                if (!request()->ajax()) {
                    return redirect()->route('admin.deny')->with(['url' => $request->url(), 'method' => $request->method()]);
                } else {
                    return self::error();
                }
            }
        }

 // if not found permissions
        if ( Admin::user() && !Admin::user()->allPermissions()->first(function ($permission) use ($request ) {
                 return $permission->shouldPassThrough($request);
        })) {
            if (!request()->ajax()) {
                return redirect()->route('admin.deny')->with(['url' => $request->url(), 'method' => $request->method()]);
            } else {
                return self::error();
            }
        }


        return $next($request);
    }


    public function routeDefaultPass($request)
    {
        $routeName = $request->route()->getName();
        $allowRoute = ['admin.deny' , 'admin.home2' ];
        return in_array($routeName, $allowRoute);
    }



    public static function error()
    {
        $uriCurrent = request()->fullUrl();

        $methodCurrent = request()->method();
        if(strtoupper($methodCurrent) ==='GET'){
            return redirect()->route('admin.deny')->with(['method' => $methodCurrent, 'url' => $uriCurrent]);
        } else {
            return response()->json([
                'error' => '1',
                'msg' => 'Access denied!',
                'detail' => [
                    'method' => $methodCurrent,
                    'url' => $uriCurrent
                ]
            ]);
        }
    }




}
