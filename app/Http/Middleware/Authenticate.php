<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        if(Auth::check()){

            $userStatus = Auth::user()->status;
            if($userStatus == 'In-active' || $userStatus == 'Subscription_cancel'){
                Auth::logout();
                return response('Unauthorized.', 401);
            }
            if($userStatus == 'Pending-Payment' && \Route::currentRouteName() != 'paymentGateway' && \Route::currentRouteName() != 'logout'){

//                return redirect()->to(route('paymentGateway'));
            }
        }
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }

        return $next($request);
    }
}
