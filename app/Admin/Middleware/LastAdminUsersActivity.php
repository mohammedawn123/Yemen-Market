<?php

namespace App\Admin\Middleware;

use App\Admin\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Closure;

use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class LastAdminUsersActivity
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
    public function handle(Request $request, Closure $next)
    {

        // This works only if users are logged in
        if(Auth::check()) {
            // Get the array of users from the cache
            $users = Cache::get('online-users');
            // If it's empty create it with the user who triggered this middleware call
            if(empty($users)) {
                $expiresAt = Carbon::now()->addMinutes(10);
                Cache::put('online-users', [['id' => Auth::user()->id, 'last_activity_at' =>  Carbon::now()->settings(['timezone' => 'America/Los_Angeles'])]], $expiresAt);
            } else {
                // Otherwise iterate over the users stored in the cache array
                foreach ($users as $key => $user) {

                    // If the current iteration matches the logged in user, unset it because it's old
                    // and we want only the last user interaction to be stored (and we'll store it below)
                    if($user['id'] === Auth::user()->id) {
                        unset($users[$key]);
                        continue;
                    }

                    // If the user's last activity was more than 10 minutes ago remove it
                    if ($user['last_activity_at'] < now()->subMinutes(10)) {
                        unset($users[$key]);
                        continue;
                    }
                }

                // Add this last activity to the cache array
                $users[] = ['id' => Auth::user()->id, 'last_activity_at' => now()->setTimezone(Cookie::get('timezone_user'))];

                // Put this array in the cache
                Cache::put('online-users', $users, now()->setTimezone(Cookie::get('timezone_user'))->addMinutes(10) );
            }
        }
        return $next($request);
    }



}
