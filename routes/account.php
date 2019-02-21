<?php

/*
|--------------------------------------------------------------------------
| Account Routes
|--------------------------------------------------------------------------
|
| Here is where you can register user API routes. These routes are loaded
| by the RouteServiceProvider within a group which is assigned the "api" middleware group.
| Enjoy building your API!
|
*/
Route::group(['module' => 'Web', 'prefix' => '/'], function() {
    Route::group(['middleware' => ['auth']], function () {

        # Logout
        Route::get('logout', ['uses'=>'UserController@logout','as'=>'logout']);

        # Dashboard page
        Route::get('dashboard/index', ['uses'=>'DashboardController@index','as'=>'dashboard']);

        Route::group(['prefix' => 'dashboard'], function () {
            Route::group(['prefix' => 'account'], function () {
                /*
                |--------------------------------------------------------------------
                | Account endpoints. Access url: /dashboard/account/
                |--------------------------------------------------------------------
                */
                # Ping route for testing.
                Route::get('/ping', function () {
                    return response()->json([
                        'Code' => 200,
                        'Content' => [
                            'message' => date("D M d, Y G:i")
                        ]
                    ]);
                });

                # Account page
                Route::get('/account', ['uses' => 'AccountController@account','as' => 'account']);

                # Update profile
                Route::post('/updateProfile', ['uses' => 'AccountController@updateProfile','as' => 'updateProfile']);

                # Password page
                Route::get('/password', ['uses' => 'AccountController@password','as' => 'password']);

                # Update password
                Route::post('/updatePassword', ['uses' => 'AccountController@updatePassword','as' => 'updatePassword']);

                # Payment setting page
                Route::get('/payment-setting', ['uses' => 'DashboardController@paymentSetting','as' => 'paymentSetting']);

                # Update payment
                Route::post('/updatePayment', ['uses' => 'AccountController@updatePayment', 'as' => 'updatePayment']);
            });
        });
    });
});
