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
	Route::get('/404', function () {
		return abort(404);
	});
	Route::get('/',['uses'=>'PagesController@index','as'=>'index']);

	Route::get('term-and-condition',['uses'=>'PagesController@termCondition','as'=>'termsCondition']);
	Route::get('privacy-policy',['uses'=>'PagesController@privacyPolicy','as'=>'privacyPolicy']);

	Route::get('terms',['uses'=>'PagesController@termCondition','as'=>'termsCondition']);
	Route::get('privacy',['uses'=>'PagesController@privacyPolicy','as'=>'privacyPolicy']);

	Route::post('contact-us',['uses'=>'PagesController@contactUsPost','as'=>'contactUsPost']);
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
	Route::post('dashboard/paypal', array('as' => 'paypal','uses' => 'PaypalController@postPaymentWithpaypal',));
	// route for check status responce
	Route::get('dashboard/paypalsample', array('as' => 'paypalsample','uses' => 'PaypalController@paypalsample',));
	Route::get('dashboard/invoiceconsentcheck', array('as' => 'invoiceconsentcheck','uses' => 'PaypalController@invoiceconsentcheck',));
    Route::post('dashboard/postinvoicedata', array('as' => 'postinvoice','uses' => 'PaypalController@postinvoicedata',));
    Route::get('dashboard/sendinvoice', array('as' => 'sendinvoice','uses' => 'PaypalController@SendInvoiceInterval',));


	Route::get('dashboard/strip-response',['uses'=>'DashboardController@stripeResponse','as'=>'stripeResponse']);
	Route::post('dashboard/strip-billing',['uses'=>'DashboardController@stripeResponseBillingPost','as'=>'stripeResponseBillingPost']);

	Route::any('webhook/event',['uses'=>'PagesController@webhook','as'=>'eventsWebhook']);
	Route::any('webhook/paypaipndata',['uses'=>'PagesController@paypaipndata','as'=>'paypaipndata']);

	Route::get('pay/invoice_payment/{invoiceId}',['uses'=>'DashboardController@invoice_pay', 'as'=>'invoice_pay']);

	Route::post('pay/invoice_payment/post/{invoiceId}',['uses'=>'DashboardController@invoice_pay_post', 'as'=>'invoicePayPost']);

	Route::get('pay/{id}', ['uses'=>'DashboardController@payInvoiceView','as' =>'payInvoiceView']);


	Route::post('/dashboard/hide-notification',['uses'=>'PagesController@hideNotification', 'as' => 'hideSubscriptionNotification']);

	Route::group(['middleware' => ['guest']], function () {
		Route::any('register',['uses'=>'UserController@register','as'=>'register']);
		//Route::post('getstarted',['uses'=>'UserController@getstarted','as'=>'getstarted']);
		Route::any('register-post',['uses'=>'UserController@registerPost','as'=>'registerPost']);

		Route::get('login',['uses'=>'UserController@login','as'=>'login']);
		Route::post('login-post',['uses'=>'UserController@loginPost','as'=>'loginPost']);

		Route::get('forgot-password',['uses'=>'UserController@forgotPassword','as'=>'forgotPassword']);
		Route::post('forgot-password',['uses'=>'UserController@forgotPasswordPost','as'=>'forgotPasswordPost']);

		Route::get('password-reset/{token}',['uses'=>'UserController@forgotPasswordresetLink','as'=>'resetLink']);
		Route::post('password-reset/{token}',['uses'=>'UserController@forgotPasswordresetLinkPost','as'=>'resetPasswordPost']);


	});

	Route::group(['middleware' => ['auth']], function () {
		//Route::controller('users', 'UsersController');
		Route::get('logout',['uses'=>'UserController@logout','as'=>'logout']);
		Route::get('dashboard/index',['uses'=>'DashboardController@index','as'=>'dashboard']);
		Route::any('/members/{url}/{id}', ['uses'=>'DashboardController@loadMenuAgain','as'=>'loadMenuAgain']);
		Route::get('dashboard/apps',['uses'=>'DashboardController@paymentGateway','as'=>'paymentGateway']);
		Route::get('dashboard/billing',['uses'=>'DashboardController@billing','as'=>'billing']);
		Route::get('dashboard/invoices/choose',['uses'=>'DashboardController@invoices','as'=>'invoices']);

		/*****************Standard Invoice********************/
//		Route::get('dashboard/invoices/standard-invoice',['uses'=>'DashboardController@standardInvoice', 'as' => 'standardInvoice']);
//		Route::get('dashboard/invoices/preview/{id}',['uses'=>'DashboardController@preview', 'as' => 'preview']);
//		Route::post('dashboard/invoices/standardInvoice',['uses'=>'StandardController@standardInvoiceSave', 'as' => 'standardInvoiceSave']);

		/*****************Scheduled Invoice********************/
//		Route::get('dashboard/invoices/scheduled-invoice',['uses'=>'DashboardController@scheduledInvoice' , 'as' => 'scheduledInvoice']);
//		Route::post('dashboard/invoices/scheduledSave',['uses'=>'ScheduledController@scheduledInvoiceSave', 'as' => 'scheduledInvoiceSave']);

		/*****************Subscription Invoice********************/
//		Route::get('dashboard/invoices/subscription-invoice',['uses'=>'DashboardController@subscriptionInvoice','as' => 'subscriptionInvoice']);
//		Route::post('dashboard/invoices/subscriptionSave',['uses'=>'SubscriptionController@subscriptionInvoiceSave','as' => 'subscriptionInvoiceSave']);
		/**************************Update Invoice***********************/

//		Route::get('dashboard/invoices/update-standard-invoice/{id}', ['uses'=>'DashboardController@updateStandardInvoice','as' => 'updateStandardInvoice']);
//		Route::post('dashboard/invoices/update-standard-invoice/saveStandardInvoice', 'StandardController@standardInvoiceUpdate');

//		Route::get('dashboard/invoices/update-scheduled-invoice/{id}', ['uses' => 'DashboardController@updateScheduledInvoice','as' => 'updateScheduledInvoice']);
//		Route::post('dashboard/invoices/update-scheduled-invoice/scheduledUpdate',  ['uses' => 'ScheduledController@scheduledInvoiceUpdate','as' => 'scheduledInvoiceUpdate']);

//		Route::get('dashboard/invoices/update-subscription-invoice/{id}', ['uses'=>'DashboardController@updateSubscriptionInvoice','as' => 'updateSubscriptionInvoice']);
//
//		Route::post('dashboard/invoices/update-subscription-invoice/subscriptionUpdate', ['uses'=>'SubscriptionController@subscriptionInvoiceUpdate','as' => 'subscriptionInvoiceUpdate']);

		/******************************All Invoice*************/

//		Route::any('dashboard/invoices/standard-invoices-list',['uses'=>'StandardController@standardInvoicesList', 'as' => 'standardInvoicesList']);
//		Route::any('dashboard/invoices/scheduled-invoices-list', ['uses'=>'ScheduledController@scheduledInvoicesList', 'as' => 'scheduledInvoicesList']);
//        Route::any('dashboard/invoices/subscription-invoices-list',['uses'=>'SubscriptionController@subscriptionInvoicesList', 'as' => 'subscriptionInvoicesList']);
        Route::any('dashboard/reports/reports',['uses'=>'DashboardController@reports', 'as' => 'reports']);
//		Route::any('dashboard/invoices/recurring-invoices',['uses'=>'DashboardController@recurringInvoices', 'as' => 'recurringInvoices']);
//		Route::any('dashboard/invoices/invoices',['uses'=>'DashboardController@allInvoice', 'as' => 'allInvoice']);
//
//		Route::any('dashboard/invoices/saved-invoices', ['uses'=>'DashboardController@saveAllInvoice','as' => 'saveAllInvoice']);
//
//		Route::get('dashboard/invoices/delete-invoice/{id}',['uses'=>'DashboardController@deleteInvoice','as' => 'deleteInvoice']);
//		Route::get('dashboard/invoices/cancel/{id}/{type}', ['uses'=>'DashboardController@cancelInvoice','as' => 'cancelInvoice']);
//		Route::post('dashboard/invoices/standardInvoiceAsPaid', ['uses'=>'DashboardController@standardInvoiceAsPaid','as' => 'standardInvoiceAsPaid']);

		/*****************ACOUNT SETTING*******************************/
        # start done
//		Route::get('dashboard/account/account', ['uses'=>'DashboardController@account','as' => 'account']);
//		Route::post('dashboard/account/updateProfile',['uses'=>'AccountController@updateProfile','as' => 'updateProfile']);
//		Route::get('dashboard/account/password', ['uses'=>'DashboardController@password','as' => 'password']);
//		Route::post('dashboard/account/upadtePassword', ['uses'=>'AccountController@upadtePassword','as' => 'upadtePassword']);
//		Route::get('dashboard/account/payment-setting',['uses'=>'DashboardController@paymentSetting','as' => 'paymentSetting']);
//		Route::post('dashboard/account/updatePayment', ['uses'=>'AccountController@updatePayment', 'as' => 'updatePayment']);
        # end done
		/*******************PAY Invoice********************************/


		Route::get('dashboard/pay/{id}', ['uses' => 'DashboardController@payInvoiceView','as' => 'payInvoiceView']);
		Route::get('dashboard/getInvoiceUrl/{id}', ['uses' => 'DashboardController@getInvoiceUrl','as' => 'getInvoiceUrl']);

		/************************Send Reminder Mail*************************/
		Route::get('dashboard/sendReminder/{id}/{type}', ['uses' => 'DashboardController@sendReminderMail','as' => 'sendReminderMail']);

		/**********************duplicate Invoice*****************************/
		Route::get('dashboard/invoices/duplicate/{id}', ['uses' => 'DashboardController@duplicate','as' => 'duplicate']);
		/************************Search Invoice*************************/
		Route::get('/search', ['uses' => 'DashboardController@searchInvoice','as' => 'search']);
		/************************Search Invoice*************************/

		Route::post("dashboard/account/cancel", ['uses' => 'DashboardController@cancelSubscriptionNew','as' => 'cancelUserSubscription']);

       /****************  Paypal invoice routes************/

       Route::get('dashboard/invoiceform',['uses'=>'PaypalController@invoiceform','as'=>'invoiceform']);


	});
});