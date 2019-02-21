<?php

/*
|--------------------------------------------------------------------------
| Login and Registration Routes
|--------------------------------------------------------------------------
|
| Here is where you can register user API routes. These routes are loaded
| by the RouteServiceProvider within a group which is assigned the "api" middleware group.
| Enjoy building your API!
|
*/
Route::group(['module' => 'Web', 'prefix' => '/'], function() {
    Route::group(['middleware' => ['guest']], function () {

        # Ping route for testing.
        Route::get('/ping', function () {
            return response()->json([
                'Code' => 200,
                'Content' => [
                    'message' => date("D M d, Y G:i")
                ]
            ]);
        });

        # Register user page
        Route::any('register', ['uses'=>'UserController@showRegister','as'=>'register']);

        //Route::post('getstarted',['uses'=>'UserController@getstarted','as'=>'getstarted']);

        # Register user
        Route::any('register-post', ['uses'=>'UserController@registerPost','as'=>'registerPost']);

        # User login page
        Route::get('login', ['uses'=>'UserController@login','as'=>'login']);

        # User login
        Route::post('login-post', ['uses'=>'UserController@loginPost','as'=>'loginPost']);

        # User forgot password page
        Route::get('forgot-password', ['uses'=>'UserController@forgotPassword','as'=>'forgotPassword']);

        # User forgot password
        Route::post('forgot-password', ['uses'=>'UserController@forgotPasswordPost','as'=>'forgotPasswordPost']);

        # Password reset page.
        Route::get('password-reset/{token}', ['uses'=>'UserController@forgotPasswordResetLink','as'=>'resetLink']);

        # Password reset
        Route::post('password-reset/{token}', ['uses'=>'UserController@forgotPasswordResetLinkPost','as'=>'resetPasswordPost']);
    });
});
