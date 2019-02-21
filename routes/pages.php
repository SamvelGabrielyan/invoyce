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
    # Ping route for testing.
    Route::get('/ping', function () {
        return response()->json([
            'Code' => 200,
            'Content' => [
                'message' => date("D M d, Y G:i")
            ]
        ]);
    });

    # Error page
    Route::get('/404', function () {
        return abort(404);
    });

    # Main Page
    Route::get('/', ['uses' => 'PagesController@index','as' => 'index']);

    # Contact Us page
    Route::post('contact-us', ['uses' => 'PagesController@contactUsPost','as' => 'contactUsPost']);

    # Terms and conditions page
    Route::get('term-and-condition', ['uses' => 'PagesController@termCondition','as' => 'termsCondition']);

    # Privacy policy page
    Route::get('privacy-policy', ['uses' => 'PagesController@privacyPolicy','as' => 'privacyPolicy']);

    # Terms page
    Route::get('terms', ['uses' => 'PagesController@termCondition','as' => 'termsCondition']);

    # Privacy page
    Route::get('privacy', ['uses' => 'PagesController@privacyPolicy','as' => 'privacyPolicy']);

});
