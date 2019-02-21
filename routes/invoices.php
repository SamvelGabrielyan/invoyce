<?php

/*
|--------------------------------------------------------------------------
| Common Invoice Routes
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

            Route::get('/sendReminder/{id}/{type}', ['uses' => 'InvoiceController@sendReminderMail','as' => 'sendReminderMail']);

            Route::group(['prefix' => 'invoices'], function () {
                /*
                |--------------------------------------------------------------------
                | Invoice endpoints. Access url: /dashboard/invoices/
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

                # Recurring invoices
                Route::get('/recurring-invoice', ['uses' => 'InvoiceController@recurringInvoice', 'as' => 'recurring-invoice']);

                # Update recurring invoice page.
                Route::get('/update-recurring-invoice/{id}', ['uses' => 'ScheduledController@updateRecurringInvoice', 'as' => 'update-recurring-invoice']);

                # Update recurring invoice.
                Route::post('/update-recurring-invoice/scheduledUpdate', ['uses' => 'ScheduledController@scheduledInvoiceUpdate', 'as' => 'scheduledInvoiceUpdate']);

                # Recurring invoices
                Route::any('/recurring-invoices', ['uses' => 'ScheduledController@recurringInvoices', 'as' => 'recurringInvoices']);

                # All invoices
                Route::any('/invoices', ['uses' => 'InvoiceController@allInvoice', 'as' => 'allInvoice']);

                # Preview Invoice based on invoice ID
                Route::get('/preview/{id}', ['uses' => 'InvoiceController@preview', 'as' => 'preview']);

                # Save all invoices
                Route::any('/saved-invoices', ['uses' => 'InvoiceController@saveAllInvoice', 'as' => 'saveAllInvoice']);

                # Delete Invoice
                Route::get('/delete-invoice/{id}',['uses' => 'InvoiceController@deleteInvoice', 'as' => 'deleteInvoice']);

                # Cancel Invoice based on id
                Route::get('/cancel/{id}/{type}', ['uses' => 'InvoiceController@cancelInvoice', 'as' => 'cancelInvoice']);

                # Duplicate Invoice based on id
                Route::get('/duplicate/{id}', ['uses' => 'InvoiceController@duplicate', 'as' => 'duplicate']);

                # Mark invoice as paid.
                Route::post('/standardInvoiceAsPaid', ['uses' => 'InvoiceController@standardInvoiceAsPaid', 'as' => 'standardInvoiceAsPaid']);

                # Choose Invoice
                Route::get('/choose',['uses'=>'InvoiceController@invoices', 'as'=>'invoices']);

                # Invoice Reports.
                Route::any('reports',['uses'=>'InvoiceReportController@reports', 'as' => 'reports']);
            });

            # Pay Invoice page
            Route::get('/pay/{id}', ['uses' => 'DashboardController@payInvoiceView','as' => 'payInvoiceView']);

            # Get Invoice URL
            Route::get('/getInvoiceUrl/{id}', ['uses' => 'InvoiceController@getInvoiceUrl', 'as' => 'getInvoiceUrl']);
        });

        # Search Invoice
        Route::get('/search', ['uses' => 'InvoiceSearchController@searchInvoice','as' => 'search']);
    });
});
