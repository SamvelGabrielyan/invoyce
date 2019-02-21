<?php

/*
|--------------------------------------------------------------------------
| Scheduled Invoice Routes
|--------------------------------------------------------------------------
|
| Here is where you can register user API routes. These routes are loaded
| by the RouteServiceProvider within a group which is assigned the "api" middleware group.
| Enjoy building your API!
|
*/
Route::group(['module' => 'Web', 'prefix' => '/'], function() {
    Route::group(['middleware' => ['auth']], function () {
        Route::group(['prefix' => 'dashboard'], function () {
            Route::group(['prefix' => 'invoices'], function () {
                /*
                |--------------------------------------------------------------------
                | Scheduled Invoice endpoints. Access url: /dashboard/invoices/
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

                # Get Subscription Invoice
                Route::get('/subscription-invoice',['uses' => 'InvoiceController@subscriptionInvoice', 'as' => 'subscriptionInvoice']);

                # Save Subscription Invoice
                Route::post('/subscriptionSave',['uses'=>'SubscriptionController@subscriptionInvoiceSave', 'as' => 'subscriptionInvoiceSave']);

                # Get Subscription update page
                Route::get('/update-subscription-invoice/{id}', ['uses' => 'SubscriptionController@updateSubscriptionInvoice', 'as' => 'updateSubscriptionInvoice']);

                # Update Subscription
                Route::post('/update-subscription-invoice/subscriptionUpdate', ['uses' => 'SubscriptionController@subscriptionInvoiceUpdate','as' => 'subscriptionInvoiceUpdate']);

                # Get Subscription invoice list.
                Route::any('/subscription-invoices-list', ['uses'=>'SubscriptionController@subscriptionInvoicesList', 'as' => 'subscriptionInvoicesList']);
            });
        });
    });
});
