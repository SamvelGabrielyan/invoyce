<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

////////////dashbbard routing start here////////////////////////////////////////////////////////////////////////////////////////
Route::group(['module' => 'Web', 'prefix' => '/'], function() {
	/****************************MAil View Status Update*************************/
	Route::get('/track/{id}', 'DashboardController@InvoiceViewStatusUpdate');
	Route::get('/pay/success/{id}', ['uses'=>'DashboardController@paySuccess','as'=>'invoicePaySuccess']);

	Route::any('/member/{id}', ['uses'=>'DashboardController@loadAgain','as'=>'loadMenuAgain']);
	Route::get('dashboard/pay/invalid_invoice',['uses'=>'DashboardController@invalid','as'=>'invalid']);

	Route::get('dashboard/connect/stripe',['uses'=>'DashboardController@connectStripe','as'=>'connectStripe']);

	Route::get('dashboard/paywithpaypal',['uses'=>'PaypalController@payWithPaypal','as'=>'paywithpaypal']);
	Route::get('dashboard/getinvoiceform',['uses'=>'PaypalController@getinvoiceform','as'=>'getinvoiceform']);

	Route::get('dashboard/getconsent',['uses'=>'PaypalController@getconsent','as'=>'getconsent']);
	Route::get('dashboard/paypalsubscriptionagreement',['uses'=>'PaypalController@paypalsubscriptionagreement','as'=>'paypalsubscriptionagreement']) ;

    Route::get('/cronjob/autosendinvoices',['uses'=>'ScheduledController@scheduledSendEmailCron','as'=>'scheduledSendEmailCron']);
    Route::get('/cronjob/cancelsubscription',['uses'=>'ScheduledController@cronCancelPendingInvoiceOfNonPaidUsers','as'=>'cronCancelPendingInvoiceOfNonPaidUsers']);


	// route for view/blade file
	// Route::get('dashboard/paywithpaypal', array('as' => 'paywithpaypal','uses' => 'PaypalController@payWithPaypal',));
	// route for post request
	Route::post('dashboard/paypal', ['as' => 'paypal','uses' => 'PaypalController@postPaymentWithpaypal']);
	// route for check status responce
	Route::get('dashboard/paypalsample', ['as' => 'paypalsample','uses' => 'PaypalController@paypalsample']);
	Route::get('dashboard/invoiceconsentcheck', ['as' => 'invoiceconsentcheck','uses' => 'PaypalController@invoiceconsentcheck']);
    Route::post('dashboard/postinvoicedata', ['as' => 'postinvoice','uses' => 'PaypalController@postinvoicedata']);
    Route::get('dashboard/sendinvoice', ['as' => 'sendinvoice','uses' => 'PaypalController@SendInvoiceInterval']);


	Route::get('dashboard/strip-response',['uses'=>'DashboardController@stripeResponse','as'=>'stripeResponse']);
	Route::post('dashboard/strip-billing',['uses'=>'DashboardController@stripeResponseBillingPost','as'=>'stripeResponseBillingPost']);

	Route::any('webhook/event',['uses'=>'PagesController@webhook','as'=>'eventsWebhook']);
	Route::any('webhook/paypaipndata',['uses'=>'PagesController@paypaipndata','as'=>'paypaipndata']);

	Route::get('pay/invoice_payment/{invoiceId}',['uses'=>'DashboardController@invoice_pay', 'as'=>'invoice_pay']);

	Route::post('pay/invoice_payment/post/{invoiceId}',['uses'=>'DashboardController@invoice_pay_post', 'as'=>'invoicePayPost']);

	Route::get('pay/{id}', ['uses'=>'DashboardController@payInvoiceView','as' =>'payInvoiceView']);


	Route::post('/dashboard/hide-notification',['uses'=>'PagesController@hideNotification', 'as' => 'hideSubscriptionNotification']);

	Route::group(['middleware' => ['auth']], function () {
		//Route::controller('users', 'UsersController');
		Route::any('/members/{url}/{id}', ['uses'=>'DashboardController@loadMenuAgain','as'=>'loadMenuAgain']);
		Route::get('dashboard/apps',['uses'=>'DashboardController@paymentGateway','as'=>'paymentGateway']);
		Route::get('dashboard/billing',['uses'=>'DashboardController@billing','as'=>'billing']);
//        Route::any('dashboard/reports/reports',['uses'=>'DashboardController@reports', 'as' => 'reports']);

		/************************Send Reminder Mail*************************/

		Route::post("dashboard/account/cancel", ['uses' => 'DashboardController@cancelSubscriptionNew','as' => 'cancelUserSubscription']);

       /****************  Paypal invoice routes************/

       Route::get('dashboard/invoiceform',['uses'=>'PaypalController@invoiceform','as'=>'invoiceform']);
	});
});