<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

// return [
//     'mode'    => 'sandbox', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
//     'sandbox' => [
//         'username'    => 'jon2_api1.invoyce.me',
//         'password'    => 'EQ5246ZYJVBNLHER',
//         'secret'      => 'EOSSieirpA82MrxsDOnsKskDmWI5dZ9U1sKkwgXHD5RhE7zrkrAPMSmykn2Dd8TxH_AP3cY85uFfDEIm',
//         'certificate' => 'AWtbsfOh.AspQBD5MxJnEc1oMg1HAsKzZXDv49i09EqJtd9jNKx0d4il',
//         'app_id'      => 'APP-80W284485P519543T', // Used for testing Adaptive Payments API in sandbox mode
//     ],
//     'live' => [
//         'username'    => env('PAYPAL_LIVE_API_USERNAME', ''),
//         'password'    => env('PAYPAL_LIVE_API_PASSWORD', ''),
//         'secret'      => env('PAYPAL_LIVE_API_SECRET', ''),
//         'certificate' => env('PAYPAL_LIVE_API_CERTIFICATE', ''),
//         'app_id'      => '', // Used for Adaptive Payments API
//     ],

//     'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
//     'currency'       => 'USD',
//     'notify_url'     => '', // Change this accordingly for your application.
//     'locale'         => '', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
//     'validate_ssl'   => true, // Validate SSL when creating api client.
// ];



return array(

    /**
     * Set our Sandbox and Live credentials
     */
    'sandbox_client_id' => 'ASdMJ1aAtK8XbCK2AOyyfnqClOp3XzV-9QReilX0T8as0EAYhmj25m41CV1UFmj6wjuM6hxc-CuZkJAs',
    'sandbox_secret' => 'EOSSieirpA82MrxsDOnsKskDmWI5dZ9U1sKkwgXHD5RhE7zrkrAPMSmykn2Dd8TxH_AP3cY85uFfDEIm',
    'live_client_id' => env('PAYPAL_LIVE_CLIENT_ID', 'AQFi9USykTYF4M_yjCfu8PwI6lJTHq8OhRTxdey01YlUTq_r_3Q6cYpyoH9fxDE0x2QZNwCt_6RMW0wz'),
    'live_secret' => env('PAYPAL_LIVE_SECRET', 'ENIiS9DLxw5cC59mAqWmkvh18OLLDyTVvuf5qXLF3ZC3tlcCE1CCzkWlkZa1LNb0Ly_xNJULWhfaWUkJ'), 
    'paypal_invoice_link'=>'https://www.paypal.com/invoice/payerView/details/',


    /**
     * SDK configuration settings
     */
    'settings' => array(
        /** 
         * Payment Mode
         *
         * Available options are 'sandbox' or 'live'
         */
        'mode' => env('PAYPAL_MODE', 'sandbox'),
        // Specify the max connection attempt (3000 = 3 seconds)
        'http.ConnectionTimeOut' => 3000,
        // Specify whether or not we want to store logs
        'log.LogEnabled' => true,
        // Specigy the location for our paypal logs
        'log.FileName' => storage_path() . '/logs/paypal.log',
        /** 
         * Log Level
         *
         * Available options: 'DEBUG', 'INFO', 'WARN' or 'ERROR'
         * 
         * Logging is most verbose in the DEBUG level and decreases 
         * as you proceed towards ERROR. WARN or ERROR would be a 
         * recommended option for live environments.
         * 
         */

        'log.LogLevel' => 'DEBUG'
    ),
);