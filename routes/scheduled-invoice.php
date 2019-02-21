<?php

/*
|--------------------------------------------------------------------------
| Subscription Invoice Routes
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
                | Subscription Invoice endpoints. Access url: /dashboard/invoices/
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

                # Get Scheduled Invoice
                Route::get('/scheduled-invoice', ['uses'=>'InvoiceController@scheduledInvoice', 'as' => 'scheduledInvoice']);

                # Save Scheduled Invoice
                Route::post('/scheduledSave', ['uses'=>'ScheduledController@scheduledInvoiceSave', 'as' => 'scheduledInvoiceSave']);
                
                # Save Rec Invoice
                Route::post('/schedurecSave', ['uses'=>'ScheduledController@scheduledRecSave', 'as' => 'scheduledInvoicerecSave']);

                # Update Scheduled Invoice page
                Route::get('/update-scheduled-invoice/{id}', ['uses' => 'ScheduledController@updateScheduledInvoice', 'as' => 'updateScheduledInvoice']);

                # Update Scheduled Invoice
                Route::post('/update-scheduled-invoice/scheduledUpdate', ['uses' => 'ScheduledController@scheduledInvoiceUpdate', 'as' => 'scheduledInvoiceUpdate']);

                # Get Scheduled Invoice list
                Route::any('/scheduled-invoices-list', ['uses'=>'ScheduledController@scheduledInvoicesList', 'as' => 'scheduledInvoicesList']);
            });
        });
    });
});
