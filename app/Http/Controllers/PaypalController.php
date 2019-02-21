<?php

namespace App\Http\Controllers;

  

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;



use App\Model\User, App\Model\UserBillings, App\Model\Invoice, App\Model\State, App\Model\InvoiceItem, App\Model\PaymentSetting, App\Model\InvoiceBilling,App\Model\Paypal;

use App\Http\Controllers\Controller;



use App\Http\Requests;

use Validator;

use URL;

use Session;

use Redirect;

use Input;

use Auth; 



/** All Paypal Details class **/

use PayPal\Rest\ApiContext;

use PayPal\Auth\OAuthTokenCredential;

use PayPal\Api\Amount;

use PayPal\Api\Details;

use PayPal\Api\Item;

use PayPal\Api\ItemList;

use PayPal\Api\Payer;

use PayPal\Api\Payment;

use PayPal\Api\RedirectUrls;

use PayPal\Api\ExecutePayment;

use PayPal\Api\PaymentExecution;

use PayPal\Api\Transaction;

use Paypal\API\InvoiceService;

use Paypal\API\InvoiceType;

use Paypal\API\InvoiceItemType;

use Paypal\API\InvoiceItemListType;

use PayPal\Api\InvoiceAddress;

use PayPal\Api\Address;

use PayPal\Api\BillingInfo;

use PayPal\Api\Cost;

use PayPal\Api\Currency; 

use PayPal\Api\MerchantInfo;

use PayPal\Api\PaymentTerm;

use PayPal\Api\Phone;

use PayPal\Api\ShippingInfo;

use Paypal\API\ResultPrinter;

use PayPal\Api\OpenIdSession;

use PayPal\Api\Agreement;

use PayPal\Api\Plan;

use PayPal\Api\ShippingAddress;

use Paypal\API\MerchantPreferences;

use PayPal\Api\Patch;

use PayPal\Api\PatchRequest;

use PayPal\Common\PayPalModel; 

use Paypal\API\PPSignatureCredential;

use PayPal\Api\OpenIdTokeninfo;

use PayPal\Api\OpenIdUserinfo;

use PayPal\Exception\PayPalConnectionException;







class PaypalController extends Controller

{

    private $_api_context;

    /**

     * Create c a new controller instance.

     *

     * @return void

     */

    public function __construct()
    {
        parent::__construct();
        if(config('paypal.settings.mode') == 'live'){
            $this->client_id = \config('paypal.live_client_id');
            $this->secret = \config('paypal.live_secret');
        } else {
            $this->client_id = \config('paypal.sandbox_client_id');
            $this->secret = \config('paypal.sandbox_secret');
        }
        // Set the Paypal API Context/Credentials
         $paypal_conf = \Config::get('paypal');

        $this->_api_context = new ApiContext(new OAuthTokenCredential($this->client_id, $this->secret));
        $this->_api_context->setConfig($paypal_conf['settings']); 

    }



    /**

     * Show the application paywith paypalpage.

     *

     * @return \Illuminate\Http\Response

     */

   

    function invoiceconsentcheck()

    {

         $baseUrl = url()->current() . '?success=true';



  

            // ### Get User Consent URL

            // The clientId is stored in the bootstrap file

            //Get Authorization URL returns the redirect URL that could be used to get user's consent

            $redirectUrl = OpenIdSession::getAuthorizationUrl(

                $baseUrl,

                array('openid', 'profile', 'address', 'email', 'phone',

                    'https://uri.paypal.com/services/paypalattributes',

                  

                    'https://uri.paypal.com/services/invoicing'),

                null,

                null,

                null,

               $this->_api_context

            );

              

     return $redirectUrl;

 

    }

    public function payWithPaypal()

    {

        

        return view('paypal.paypalform');   

    }

/******** Paypal sample edits***********/

    public function paypalsample()

    {

       

        

    }

     /****** paypal Invoice operations*********/

     function paypal_invoice_create($invoice_data,$totalamount,$intervalset=false)

     {  

         

          $invoice = new \PayPal\Api\Invoice();    

          

                

            // ### Invoice Info

            $invoice

                ->setMerchantInfo( new MerchantInfo() )

                ->setBillingInfo( array( new BillingInfo() ) )

                ->setPaymentTerm( new PaymentTerm() )

                ->setShippingInfo( new ShippingInfo() );

            // ### Merchant Info

        

            $invoice->getMerchantInfo()

                ->setEmail( Session::get('paypalemail')) 

                ->setFirstName(Session::get('paypalname'))

                ->setbusinessName( "Taggart Media Group")  

                ->setAddress( new Address() );  

            // The address used for creating the invoice

            $invoice->getMerchantInfo()->getAddress()

                ->setLine1( $invoice_data->input('address'))

                ->setCity(  $invoice_data->input('city')) 

                ->setState(  $invoice_data->input('state')) 

                ->setPostalCode( $invoice_data->input('zip_code') )

                ->setCountryCode( "US" );

            // ### Billing Information

            // Set the email address for each billing

            $billing = $invoice->getBillingInfo();

            $billing[0]

                ->setEmail( $invoice_data->input('email'))

                ->setFirstName($invoice_data->input('FirstName'))

                ->setLastName($invoice_data->input('Lastname'))

                ->setbusinessName($invoice_data->input('company_name'));

            // ### Items List

            $items    = array();

            $totalInvoice = ($invoice_data->input('totalInvoice')!='0')?$invoice_data->input('totalInvoice'):'1';

           /****** loop invoice with paypal*********/

           $start = 0;

          for($i=1;$i<=$totalInvoice;$i++){

            $items[$start] = new \PayPal\Api\InvoiceItem();

            

            /***** Item discount check ******/

            $item_discount = $invoice_data->input('item_discount_'.$i);

            $item_dis      = $invoice_data->input('item_dis_'.$i);



            if($item_discount!="" && $item_discount!=0){

                    if($item_dis=='yes'){

                   

                    $discountAmount = ( $item_discount/$invoice_data->input('item_rate_'.$i))*100;

                 

                    } else{ 

                   

                    $discountAmount = $item_discount;    

                    }

                    

                    $itemdiscount = new Cost(); 

                    $itemdiscount->setPercent($discountAmount);       

                    $items[$start]

                    ->setName($invoice_data->input('item_name_'.$i) )

                    ->setDescription($invoice_data->input('item_description_'.$i))

                    ->setQuantity($invoice_data->input('item_qty_'.$i))

                    ->setDiscount($itemdiscount)   

                    ->setUnitPrice( new Currency() );

                  }

                  else

                  {

                         

                      $items[$start]

                        ->setName($invoice_data->input('item_name_'.$i) )

                        ->setDescription($invoice_data->input('item_description_'.$i))

                        ->setQuantity($invoice_data->input('item_qty_'.$i))  

                        ->setUnitPrice( new Currency() );



                  }





            

        

            $items[$start]->getUnitPrice()  

                ->setCurrency( "USD" ) 

                ->setValue($invoice_data->input('item_rate_'.$i) * $invoice_data->input('item_qty_'.$i));    

            if( $tax ) {

                $tax = new \PayPal\Api\Tax();

                $tax->setPercent( 4 )->setName( "Local Tax" );

                $items[$start]->setTax('0');  

            }

              $start++;

            }





/************ Getting User Uploaded Logo************/

            $user_logo_data = User::where('id', Auth::user()->id)->first();

            

            if(isset($user_logo_data->image) and !empty($user_logo_data->image)):

               $invoicelogo = asset( 'profile/').'/'.$user_logo_data->image;

            else:

               $invoicelogo = asset( 'profile/').'/logo-white-paypal.png'; 

            endif;

            $invoice->getPaymentTerm()

                ->setTermType( "DUE_ON_RECEIPT" );

            $invoice->setItems( $items );

            if ($invoice_data->input('type') == 'sch') {
	            $invoice_date  = explode("/", $invoice_data->input('start_date'));
	            $month = $invoice_date[0];
	            $days  = $invoice_date[1];
	            $year  = $invoice_date[2];
	           $sendInvoiceDate = $year . '-' . $month . '-' . $days . ' PDT';
	           $sendStatus = $invoice->setInvoiceDate($sendInvoiceDate);
	           $invoice->setStatus('SENT');
            }


            $invoice->setLogoUrl($invoicelogo); 

            
                        

            try {

               $userresettoken = Session::get('paypalrefreshkey');

             

               $invoice->updateAccessToken($userresettoken,$this->_api_context);   

                // ### Create Invoice

                // Create an invoice by calling the invoice->create() method

                // with echo "I am coming here ";
                $in = $invoice->create($this->_api_context);

                if($invoice_data->input('type') == 'st'){
                	$sendStatus = $invoice->send($this->_api_context);
                }
                /*elseif ($invoice_data->input('type') == 'sch') {
                	//$invoice = Invoice::get($in, $this->_api_context);
                	$sendStatus = $invoice->setStatus('SENT');
                	//$invoice->update($this->_api_context);
                	//die('aaaaaaa');
                }*/
                
                 /*****setting Invoice Status******/

                 //$invoice->setStatus('PAYMENT_PENDING');

 

                if(!$intervalset): 

                 



                   $invoice->send($this->_api_context);     

                

                endif;

              //  echo "Invoice has been created , Please let me know if i need to create ";

               

            } catch (PayPal\Exception\PayPalConnectionException $e ) {

                // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY

               // ResultPrinter::printError( "Create Invoice", "Invoice", null, $request, $ex );

                print_r($ex->getData()); 

                exit( 1 );

            }

           

            return $invoice;







     }



/********* paypal Scheduled invoice Sent**********/

     static function Payalscheduledinvoicesend($id)

     {

             $invoice = new \PayPal\Api\Invoice();   

             $invoice->setId($id);

             $invoice->send($this->_api_context); 



     }    



        /***************** check if invoice is created for paypal********/

   static  function Payalinvoicecheck($invoiceid) 

     {

          $paypaldata = paypal::where('invoice_id', '=', $invoiceid)->count();

          return $paypaldata; 

     }





    function getAuthenticationPermission()

    {

          $config = array(

       'mode' => 'sandbox',

       'acct1.UserName' => 'jb-us-seller_api1.paypal.com',

       'acct1.Password' => 'WX4WTU3S8MY44S7F'

      

    );



          $request = new RequestPermissionsRequest($scope, $returnURL);

          $request->requestEnvelope = $requestEnvelope;



        

        $permissions = new PermissionsService($config);

        $response = $permissions->RequestPermissions($request);

        

        if($strtoupper($response->responseEnvelope->ack) == 'SUCCESS') {

          // Success

        }





    }





     /********** Get Invoice and Send*******/

     function SendInvoiceInterval()

     {

            $invoice = new \PayPal\Api\Invoice(); 

            $getinvoicedetail =  $invoice->get('INV2-HEFR-WAF7-45R8-JF8A',$this->_api_context);

            print_r($getinvoicedetail->get($this->_api_context));

            







     }

    /******** Get post invoice data*******/

    function postinvoicedata(Request $request) 

    {

        

           $invoice = new \PayPal\Api\Invoice(); 

          

                

            // ### Invoice Info

            $invoice

                ->setMerchantInfo( new MerchantInfo() )

                ->setBillingInfo( array( new BillingInfo() ) )

                ->setNote( "Thank you, customer!" )

                ->setPaymentTerm( new PaymentTerm() )

                ->setShippingInfo( new ShippingInfo() )

                ->setTerms( "By paying your invoice you are agreeing ... set your terms here");

            // ### Merchant Info

            $invoice->getMerchantInfo()

                ->setEmail( "jon2@invoyce.me" ) 

                ->setFirstName( "John" )

                ->setLastName( "johnnathan" )

                ->setbusinessName( "John invoicing" )

                ->setAddress( new Address() );

            // The address used for creating the invoice

            $invoice->getMerchantInfo()->getAddress()

                ->setLine1( "1111 Somewhere Circle" )

                ->setCity( "CityName" )

                ->setState( "AK" )

                ->setPostalCode( "12345" )

                ->setCountryCode( "US" );

            // ### Billing Information

            // Set the email address for each billing

            $billing = $invoice->getBillingInfo();

            $billing[0]

                ->setEmail( $request->input('payerEmail') )

                ->setFirstName($request->input('FirstName'))

                ->setLastName($request->input('Lastname'));

            // ### Items List

            $items    = array();

            $items[0] = new \PayPal\Api\InvoiceItem();

            

            $items[0]

                ->setName( $request->input('title') )

                ->setQuantity( 1 )

                ->setUnitPrice( new Currency() );

            $items[0]->getUnitPrice()

                ->setCurrency( "USD" ) 

                ->setValue($request->input('item_unitPrice1'));

            if( $tax ) {

                $tax = new \PayPal\Api\Tax();

                $tax->setPercent( 4 )->setName( "Local Tax" );

                $items[0]->setTax( $request->input('tax') );

            }

            $invoice->getPaymentTerm()

                ->setTermType( "DUE_ON_RECEIPT" );

            $invoice->setItems( $items ); 

            try {

                // ### Create Invoice

                // Create an invoice by calling the invoice->create() method

                // with echo "I am coming here ";

               

                $invoice->create($this->_api_context);







                echo "Invoice has been created , Please let m e know if i need to create ";

               

            } catch ( Exception $ex ) {

                // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY

                ResultPrinter::printError( "Create Invoice", "Invoice", null, $request, $ex );

                exit( 1 );

            }

             // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY

            ResultPrinter::printResult("Create Invoice", "Invoice", $invoice->getId(), $request, $invoice);



            print_r($invoice->getId());



          

           // $config = array(

           // 'mode' => 'sandbox',

           // 'acct1.UserName' => 'jon2_api1.invoyce.me',

           // 'acct1.Password' => 'EQ5246ZYJVBNLHER',

           // 'acct1.Signature'=>'AWtbsfOh.AspQBD5MxJnEc1oMg1HAsKzZXDv49i09EqJtd9jNKx0d4il',

           // 'acct1.AppId'



           // );

     

           //  $invoice = new \PayPal\Types\PT\InvoiceType($request->input('merchantEmail'),$request->input('payerEmail'), array($request->input('item_name1'), $request->input('item_quantity1'), $request->input('item_unitPrice1')), $request->input('currencyCode'), $request->input('paymentTerms'));

           //  $requestEnvelope = new \PayPal\Types\Common\RequestEnvelope("en_US");

           //  $createInvoiceRequest = new  \PayPal\Types\PT\CreateInvoiceRequest($requestEnvelope, $invoice);

           //  $invoiceService = new \PayPal\Service\InvoiceService(); 

           //  $createInvoiceResponse = $invoiceService->CreateInvoice($createInvoiceRequest);

           //  if(strtoupper($createInvoiceResponse->responseEnvelope->ack) == 'SUCCESS') {  

           //      // Success

           //          echo "<table>";

           //          echo "<tr><td>Ack :</td><td><div id='Ack'>". $createAndSendInvoiceResponse->responseEnvelope->ack ."</div> </td></tr>";

           //          echo "<tr><td>InvoiceID :</td><td><div id='InvoiceID'>". $createAndSendInvoiceResponse->invoiceID ."</div> </td></tr>";

           //          echo "</table>"; 

                   

           //          echo "<pre>";

           //          var_dump($createAndSendInvoiceResponse);  

           //          echo "</pre>";

           //  }   

           //  else

           //  {

           //     echo "error coming here";

           //     die;



           //  }



    }



    /**

     * Store a details of payment with paypal.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function postPaymentWithpaypal(Request $request)

    {

        $payer = new Payer();

        $payer->setPaymentMethod('paypal');



      $item_1 = new Item();



        $item_1->setName('Item 1') /** item name **/

            ->setCurrency('USD')

            ->setQuantity(1)

            ->setPrice($request->get('amount')); /** unit price **/



        $item_list = new ItemList();

        $item_list->setItems(array($item_1));



        $amount = new Amount();

        $amount->setCurrency('USD')

            ->setTotal($request->get('amount'));



        $transaction = new Transaction();

        $transaction->setAmount($amount)

            ->setItemList($item_list)

            ->setDescription('Your transaction description');



        $redirect_urls = new RedirectUrls();

        $redirect_urls->setReturnUrl(URL::route('status')) /** Specify return URL **/

            ->setCancelUrl(URL::route('status'));



        $payment = new Payment();

        $payment->setIntent('Sale')

            ->setPayer($payer)

            ->setRedirectUrls($redirect_urls)

            ->setTransactions(array($transaction));

            /** dd($payment->create($this->_api_context));exit; **/

        try {

            $payment->create($this->_api_context);

        } catch (\PayPal\Exception\PPConnectionException $ex) {

            if (\Config::get('app.debug')) {

                \Session::put('error','Connection timeout');

                return Redirect::route('paywithpaypal');

                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/

                /** $err_data = json_decode($ex->getData(), true); **/

                /** exit; **/

            } else {

                \Session::put('error','Some error occur, sorry for inconvenient');

                return Redirect::route('paywithpaypal');

                /** die('Some error occur, sorry for inconvenient'); **/

            }

        }



        foreach($payment->getLinks() as $link) {

            if($link->getRel() == 'approval_url') {

                $redirect_url = $link->getHref();

                break;

            }

        }



        /** add payment ID to session **/

        Session::put('paypal_payment_id', $payment->getId());



        if(isset($redirect_url)) {

            /** redirect to paypal **/

            return Redirect::away($redirect_url);

        }



        \Session::put('error','Unknown error occurred');

      return Redirect::route('paywithpaypal');

    }



    public function getPaymentStatus()

    {

        /** Get the payment ID before session clear **/

        $payment_id = Session::get('paypal_payment_id');

        /** clear the session payment ID **/

        Session::forget('paypal_payment_id');

        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            \Session::put('error','Payment failed');

            return Redirect::route('paywithpaypal');

        }

        $payment = Payment::get($payment_id, $this->_api_context);

        /** PaymentExecution object includes information necessary **/

        /** to execute a PayPal account payment. **/

        /** The payer_id is added to the request query parameters **/

        /** when the user is redirected from paypal back to your site **/

        $execution = new PaymentExecution();

        $execution->setPayerId(Input::get('PayerID'));

        /**Execute the payment **/

        $result = $payment->execute($execution, $this->_api_context);

        /** dd($result);exit; /** DEBUG RESULT, remove it later **/

        if ($result->getState() == 'approved') { 

            

            /** it's all right **/

            /** Here Write your database logic like that insert record or value in database if you want **/



            \Session::put('success','Payment success');

            return Redirect::route('paywithpaypal');

        }

        \Session::put('error','Payment failed');



    return Redirect::route('paywithpaypal');

    }



    /******* Paypal  Subscription Agreement*****/

    function paypalsubscriptionagreement()

    {  

        

        if (isset( $_GET['token']) ) {

              $token = $_GET['token'];

              $agreement = new \PayPal\Api\Agreement();

              try {

                  $agreement->execute($token, $this->_api_context);

                  echo  $agreement->getId(); 

                  die;

              } catch (Exception $ex) {





                  ResultPrinter::printError("Executed an Agreement", "Agreement", $agreement->getId(), $_GET['token'], $ex);

                  exit(1);

              }



              try {

                  $agreement = \PayPal\Api\Agreement::get($agreement->getId(), $this->_api_context);

              } catch (Exception $ex) {



                  ResultPrinter::printError("Get Agreement", "Agreement", null, null, $ex);

                  exit(1);

              }



           die;     

          }





        $agreement = new Agreement();

        $agreement->setName('plane123')

          ->setDescription('Basic Agreement')

          ->setStartDate('2019-06-17T9:45:04Z'); 



        // Merchant Prefrences

        $MerchantPreferences = new \PayPal\Api\MerchantPreferences(); 

        $MerchantPreferences->setReturnUrl(url("/dashboard/getinvoiceform"))

        ->setCancelUrl(url("/dashboard/getinvoiceform"))

        ->setAutoBillAmount("yes")

        ->setInitialFailAmountAction("CONTINUE")

        ->setMaxFailAttempts("0") 

        ->setSetupFee(new Currency(array('value' => 0, 'currency' => 'USD')));



        /******** Payment defination***********/

        $setPaymentDefinitions = new \PayPal\Api\PaymentDefinition();

          $setPaymentDefinitions->setName('Regular Payments')

          ->setType('REGULAR') 

          ->setFrequency('Month')

          ->setFrequencyInterval('1')

          ->setCycles('1')

          ->setAmount(new Currency(array('value' => 100, 'currency' => 'USD')));





        // Set plan id  

        $plan = new Plan();

        $plan->setMerchantPreferences( $MerchantPreferences);

        $plan->setName("Plan145");

        $plan->setType('FIXED');

        $plan->setState('ACTIVE'); 

        $plan->setDescription('Server Updates');  

        $plan->setPaymentDefinitions(array($setPaymentDefinitions));

        $userresettoken = Session::get('paypalrefreshkey');

        $plan->updateAccessToken($userresettoken,$this->_api_context);   

        

       $createdPlan = $plan->create($this->_api_context); 

       

       /*********** Plan Update **********/

       $value = new PayPalModel('{

         "state":"ACTIVE"

       }');

        $patch = new Patch();

        $patch->setOp('replace')

            ->setPath('/')

            ->setValue($value);

        $patchRequest = new PatchRequest();

        $patchRequest->addPatch($patch);



        $createdPlan->update($patchRequest, $this->_api_context);

        $plan       = Plan::get($createdPlan->getId(), $this->_api_context);





        /****** Agreement Request ************/  

        $newplan = new Plan();



        $newplan->setId($createdPlan->getId());      

        $agreement->setPlan($newplan);       

        $payerInfo = new \PayPal\Api\PayerInfo();

        $payerInfo->setEmail('jon-buyer@invoyce.me')

        ->setFirstName('jon')

        ->setLastName('buyer');

        $payer = new Payer();

        $payer->setPaymentMethod('paypal'); 

        $payer->setPayerInfo($payerInfo);

        $agreement->setPayer($payer);

        // Adding shipping details

        $shippingAddress = new ShippingAddress();

        $shippingAddress->setLine1('111 First Street')

          ->setCity('Saratoga')

          ->setState('CA')

          ->setPostalCode('95070')

          ->setCountryCode('US');

           $agreement->setShippingAddress($shippingAddress);

       

           try {

            $agreement->updateAccessToken($userresettoken,$this->_api_context);  

            $agreement = $agreement->create($this->_api_context);

            $approvalUrl = $agreement->getApprovalLink();

            echo $approvalUrl;

            die;  

          } catch (PayPal\Exception\PayPalConnectionException $ex) {

            echo $ex->getCode();

            echo $ex->getData();

            die($ex);

          } catch (Exception $ex) {

            die($ex);

          }



      }

  /********* 

   * Get Third Party Access Token to Generate invoice

   ***********/

   

   public function getaccesstoken($token)

   {

       try {

         

                        // Obtain Authorization Code from Code, Client ID and Client Secret

                        $accessToken = OpenIdTokeninfo::createFromAuthorizationCode(array('code' => $token), null, null, $this->_api_context);

                        $tokenInfo = new OpenIdTokeninfo();

                        $tokenInfo = $tokenInfo->createFromRefreshToken(array('refresh_token' =>  $accessToken->getRefreshToken()), $this->_api_context);

                       $params = array('access_token' => $tokenInfo->getAccessToken());

                       $userInfo = OpenIdUserinfo::getUserinfo($params, $this->_api_context);





                       /********* set all Paypal User Sessions*********/

                       Session::put('paypalrefreshkey',$accessToken->getRefreshToken());

                       Session::put('paypalemail', $userInfo->getEmail());

                       Session::put('paypalname', $userInfo->getName());

           

             

          } catch (PayPalConnectionException $ex) {

                        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY

                        echo $ex->getMessage();

                        die;

                        //return null;

        }

        

        return $accessToken->getRefreshToken();

       

       

   }

   



     /**

     * Invoice  Detail Get Form .

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function getinvoiceform()

    {

        

       return view('paypalinvoiceform');



    }  

/******* get consent detail ******/

    public function getconsent()

    {

       

        $plan = new Plan();

        // # Basic Information

        // Fill up the basic information that is required for the plan

        $plan->setName('T-Shirt of the Month Club Plan')

            ->setDescription('Template creation.')

            ->setType('fixed');

        // # Payment definitions for this billing plan.

        $paymentDefinition = new \PayPal\Api\PaymentDefinition();

        // The possible values for such setters are mentioned in the setter method documentation.

        // Just open the class file. e.g. lib/PayPal/Api/PaymentDefinition.php and look for setFrequency method.

        // You should be able to see the acceptable values in the comments.

        $paymentDefinition->setName('Regular Payments')

            ->setType('REGULAR')

            ->setFrequency('Month')

            ->setFrequencyInterval("2")

            ->setCycles("12")

            ->setAmount(new Currency(array('value' => 100, 'currency' => 'USD')));

        // Charge Models

        $chargeModel = new \PayPal\Api\ChargeModel();

        $chargeModel->setType('SHIPPING')

            ->setAmount(new Currency(array('value' => 10, 'currency' => 'USD')));

        $paymentDefinition->setChargeModels(array($chargeModel));

        $merchantPreferences = new \PayPal\Api\MerchantPreferences();

      

        // ReturnURL and CancelURL are not required and used when creating billing agreement with payment_method as "credit_card".

        // However, it is generally a good idea to set these values, in case you plan to create billing agreements which accepts "paypal" as payment_method.

        // This will keep your plan compatible with both the possible scenarios on how it is being used in agreement.

        $merchantPreferences->setReturnUrl(url("/dashboard/getinvoiceform"))

            ->setCancelUrl(url("/dashboard/getinvoiceform"))

            ->setAutoBillAmount("yes")

            ->setInitialFailAmountAction("CONTINUE")

            ->setMaxFailAttempts("0")

            ->setSetupFee(new Currency(array('value' =>0, 'currency' => 'USD')));

        $plan->setPaymentDefinitions(array($paymentDefinition));

        $plan->setMerchantPreferences($merchantPreferences);

        // For Sample Purposes Only.

        $request = clone $plan;

        // ### Create Plan

        try {

            $output = $plan->create($this->_api_context);

            $agreement = new Agreement();

            $agreement->setPlan($plan->getId());

            $payer = new Payer();

            $payer->setPaymentMethod('paypal');

            $agreement->setPayer($payer);

            $shippingAddress = new ShippingAddress();

            $shippingAddress->setLine1('111 First Street')

                ->setCity('Saratoga')

                ->setState('CA')

                ->setPostalCode('95070')

                ->setCountryCode('US');

             $agreement->setShippingAddress($shippingAddress);

             $request = clone $agreement; 

             $agreement = $agreement->create($this->_api_context); 

        } catch (Exception $ex) {

            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY

             $ex->getMessage();

            //ResultPrinter::printError("Created Plan", "Plan", null, $request, $ex);

            exit(1);

        }



               echo "i am coming here bro";

               die;



            }  

}