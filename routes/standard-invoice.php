<?php

/*
|--------------------------------------------------------------------------
| Standard Invoice Routes
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
                | Standard Invoice endpoints. Access url: /dashboard/invoices/
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

                # Standard Invoice
                Route::get('/standard-invoice', ['uses' => 'InvoiceController@standardInvoice', 'as' => 'standardInvoice']);

                # Save standard Invoice
                Route::post('/standardInvoice', ['uses'=>'StandardController@standardInvoiceSave', 'as' => 'standardInvoiceSave']);

                # Update standard Invoice page
                Route::get('/update-standard-invoice/{id}', ['uses' => 'StandardController@updateStandardInvoice','as' => 'updateStandardInvoice']);

                # Update standard Invoice
                Route::post('/update-standard-invoice/saveStandardInvoice', 'StandardController@standardInvoiceUpdate');

                # Get standard Invoice list
                Route::any('/standard-invoices-list', ['uses'=>'StandardController@standardInvoicesList', 'as' => 'standardInvoicesList']);
            });
        });
    });
});
