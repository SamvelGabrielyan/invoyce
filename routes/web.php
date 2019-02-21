<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/clear-cache', function() {
	$exitCode = Artisan::call('cache:clear');
	// return what you want
});

/************Landing Page**********************/
Route::get('/', function () {
	return view('index');
});

Route::get('/terms', function () {
	return view('terms');
});

Route::get('/terms', function () {
	return view('terms');
});

Route::get('/privacy', function () {
	return view('privacy');
});

Route::get('/dashboard/account/billing', function () {
	return view('dashboard.account.billing');
});

/************Login**********************/
Route::get('/login', function () {     return view('login');});
Route::post('/login', 'RegisterController@logonUser');

/*************Forgot Password*****************/
Route::get('/forgot-password', function () {     return view('forgot-password');});
Route::post('/forgot', 'RegisterController@forgot');
Route::any('/reset_pass/{id}', 'RegisterController@resetpassView');
Route::any('/resetpassword', 'RegisterController@resetpassword');
/************Register**********************/
Route::any('/register', 'RegisterController@showPage');
Route::post('/registerForm', 'RegisterController@registerUser');
Route::post('/contact', 'RegisterController@contact');
//Route::post('/contacts', 'RegisterController@contacts');

/************DASHBOARD**********************/

Route::any('/members/{url}/{id}', 'DashboardController@loadMenuAgain');
Route::any('/member/{id}', 'DashboardController@loadAgain');
Route::get('/dashboard/index', 'DashboardController@loadHome');
Route::get('/dashboard/invoices/choose', 'DashboardController@invoices');

/*****************Standard Invoice********************/
Route::get('/dashboard/invoices/standard-invoice', 'DashboardController@standardIinvoice');
Route::get('/dashboard/invoices/preview/{id}', 'DashboardController@preview');
Route::post('/dashboard/invoices/standardInvoice', 'StandardController@standardInvoiceSave');


/*****************Scheduled Invoice********************/
Route::get('/dashboard/invoices/scheduled-invoice', 'DashboardController@scheduledIinvoice');
Route::post('/dashboard/invoices/scheduledSave', 'ScheduledController@scheduledInvoiceSave');
Route::post('/dashboard/invoices/schedurecSave', 'ScheduledController@scheduledRecSave');
/*****************Subscription Invoice********************/
Route::get('/dashboard/invoices/subscription-invoice', 'DashboardController@subscriptionInvoice');
Route::post('/dashboard/invoices/subscriptionSave', 'SubscriptionController@subscriptionInvoiceSave');


/******************************All Invoice*************/

Route::any('/dashboard/invoices/standard-invoices-list', 'StandardController@standardInvoicesList');
Route::any('/dashboard/invoices/scheduled-invoices-list', 'ScheduledController@scheduledInvoicesList');
Route::any('/dashboard/invoices/subscription-invoices-list', 'SubscriptionController@subscriptionInvoicesList');
Route::any('/dashboard/invoices/recurring-invoices', 'DashboardController@recurringInvoices');
Route::any('/dashboard/invoices/invoices', 'DashboardController@allInvoice');
Route::any('/dashboard/reports/reports', 'DashboardController@reports');

Route::any('/dashboard/invoices/saved-invoices', 'DashboardController@saveAllInvoice');

Route::get('/dashboard/invoices/delete-invoice/{id}', 'DashboardController@deleteInvoice');
Route::get('/dashboard/invoices/cancel/{id}/{type}', 'DashboardController@cancelInvoice');

/**********************duplicate Invoice*****************************/
Route::get('/dashboard/invoices/duplicate/{id}', 'DashboardController@duplicate');

/************************Send Reminder Mail*************************/
Route::get('/dashboard/sendReminder/{id}/{type}', 'DashboardController@sendReminderMail');

/**************************Update Invoice***********************/

Route::get('/dashboard/invoices/update-standard-invoice/{id}', 'DashboardController@updateStandardInvoice');
Route::post('/dashboard/invoices/update-standard-invoice/saveStandardInvoice', 'StandardController@standardInvoiceUpdate');

Route::get('/dashboard/invoices/update-scheduled-invoice/{id}', 'DashboardController@updateScheduledInvoice');
Route::post('/dashboard/invoices/update-scheduled-invoice/scheduledUpdate', 'ScheduledController@scheduledInvoiceUpdate');

Route::get('/dashboard/invoices/update-subscription-invoice/{id}', 'DashboardController@updateSubscriptionInvoice');
Route::post('/dashboard/invoices/update-subscription-invoice/subscriptionUpdate', 'SubscriptionController@subscriptionInvoiceUpdate');

/*****************ACOUNT SETTING*******************************/


Route::get('/dashboard/account/account', 'DashboardController@account');
Route::post('/dashboard/account/updateProfile', 'AccountController@updateProfile');
Route::get('/dashboard/account/password', 'DashboardController@password');
Route::post('/dashboard/account/upadtePassword', 'AccountController@upadtePassword');
Route::get('/dashboard/account/payment-setting', 'DashboardController@paymentSetting');
Route::post('/dashboard/account/updatePayment', 'AccountController@updatePayment');
Route::get('/dashboard/logout', 'DashboardController@logout');
Route::get('/dashboard/mail', 'DashboardController@mail');


/*******************PAY Invoice********************************/

Route::get('/dashboard/pay/{id}', 'DashboardController@payInvoiceView');
Route::get('/pay/{id}', 'DashboardController@payInvoiceView');
Route::get('/dashboard/getInvoiceUrl/{id}', 'DashboardController@getInvoiceUrl');



/************************Search Invoice*************************/
Route::get('/search', [
	'uses' => 'DashboardController@searchInvoice',
	'as' => 'search'
]);


/****************************MAil View Status Update*************************/
Route::get('/track/{id}', 'DashboardController@InvoiceViewStatusUpdate');
Route::get('/pay/success/{id}', 'DashboardController@paySuccess');
Route::get('/dashboard/pay/invalid_invoice', 'DashboardController@invalid');

/************************Billing Routs*************************/
Route::get('/dashboard/account/billing/{membership}', 'AccountController@billingView');

/************************Invoicing Pay Routs*************************/
Route::get('/pay/invoice_payment/{invoiceId}', 'DashboardController@invoice_pay');


Route::get('/404', function () {
	return abort(404);
});
