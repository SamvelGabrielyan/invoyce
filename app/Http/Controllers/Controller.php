<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use Redirect, Auth, View;

use App\Model\UserBillings;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
    //protected $getBillings,$userRegisterDate,$hoursSinceCreated,$daysCreated,$remainingDays,$lasBillingDate;
    public function __construct(){
		$showSubscribeButton = 'true';

		if (Auth::check()) {

			$getBillings = UserBillings::where('user_id','=',Auth::user()->id)
                ->orderby('id','desc')
                ->first();

			View::share('authUserBillingRow', $getBillings);

			if (empty($getBillings)) {

				$userRegisterDate  = Auth::user()->created_at;
				$hoursSinceCreated = calculate_time_span($userRegisterDate);
				$daysCreated       = abs(round($hoursSinceCreated/24));
				$remainingDays     = 7 - $daysCreated;
				$remainingDays     = $remainingDays < 1 ? 0 : $remainingDays;

				View::share('remainingDaysOfBilling', $remainingDays);

				if ($hoursSinceCreated > '168' && \Route::currentRouteName() != 'billing') {
					return Redirect::to(route('billing'))->withErrors([
					    'Sorry Your Free Account has been expire. Please subscribe for continue access your account. Thanks'
                    ])->send();
					exit;
				}
			}else{
				$showSubscribeButton = 'false';
				$lasBillingDate      = $getBillings->billing_expire_date;
				$date_now            = date("Y-m-d"); // this format is string comparable
				$date1               = date_create(date('Y-m-d'));
				$date2               = date_create(date('Y-m-d',strtotime($lasBillingDate)));

				//difference between two dates
				$diff                   = date_diff($date1,$date2);
				$remainingDaysOfBilling = $diff->format("%a");

				if($remainingDaysOfBilling < 0){
					$remainingDaysOfBilling = '0';
				}

				View::share('remainingDaysOfBilling',$remainingDaysOfBilling);

				if ($date_now > $lasBillingDate && \Route::currentRouteName() != 'billing') {

					return Redirect::to(route('billing'))->withErrors([
					    'Sorry Your Previous billing has been expire. Please subscribe again for continue access your account. Thanks'
                    ])->send();
				}
			}

			View::share('showSubscribeButton', $showSubscribeButton);
		}
	}
}