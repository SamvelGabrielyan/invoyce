<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\User;
use App\Model\UserBillings;
use App\Model\Invoice;
use App\Model\State;
use App\Model\InvoiceItem;
use App\Model\PaymentSetting;
use App\Model\InvoiceBilling;
use App\Http\Controllers\Controller;
use Cartalyst\Stripe\Stripe;
use View,HTML,Validator,Session,Input,Redirect,Auth,URL,Hash,Uuid;

class DashboardController extends Controller {

    public function __construct() {

        parent::__construct();
    }

    function paymentGateway() {
        $paypalurl = new \App\Http\Controllers\PaypalController();
        if (isset($_GET['code'])) {
            $paypalaccesstoken = $paypalurl->getaccesstoken($_GET['code']);
            return redirect()->to(url()->current());
        }
        $paypalurl = $paypalurl->invoiceconsentcheck();
        return view('dashboard.paymentgateway')->with(['paypalloginurl' => $paypalurl]);
    }

    /**

     * Showing invoice page with invoice and additional data.

     *

     * @since 1.0.1

     *

     * @uses DashboardController::getMostBenefitClient()

     * @uses DashboardController::getLastSevenDaySales()

     *

     * @return $this

     */
    public function index() {
		$preSevenDays = date('Y-m-d', strtotime('-7 days'));

        $currentDate = date('Y-m-d');

        $averagePaid = Invoice::getAveragePaid(Auth::user()->id);

        $averageTotal = Invoice::getAverageTotal(Auth::user()->id);

        $data['average_time'] = ($averageTotal->average_total * 30) - $averagePaid->average_paid;

        $data['invoicedata'] = Invoice::getInvoiceData(Auth::user()->id)->paginate(20);

        $data['paid_invoices'] = Invoice::getPaidInvoices(Auth::user()->id, $preSevenDays, $currentDate)->paginate(2000);

        $allPendingQuery = Invoice::select(DB::raw('sum(total_amount) as total_sum_amount'))
                ->where('user_id', Auth::user()->id)
                ->where('save_status', '<', '3')
                ->where('save_status', '!=', '1')
                ->get()
                ->toArray();



        $data['all_pending'] = $allPendingQuery[0]['total_sum_amount'];
        $invoice_list = Invoice::where('user_id', Auth::user()->id)
                ->where('save_status', '2')
                ->orderBy('id', 'desc')
                ->limit(10)
                ->get();


		
        $lastSevenDaySales = $this->getLastSevenDaySales($preSevenDays, $currentDate);
        $data['all_paid'] = $lastSevenDaySales['all_paid'];
        $data['per_amount'] = $lastSevenDaySales['per_amount'];
		
        # Most Benefit Client
        $clientWithMostBenefits = $this->getMostBenefitClient();
        $data['most_paid'] = $clientWithMostBenefits['most_paid'];
        $data['most_profitable_client'] = $clientWithMostBenefits['most_profitable_client'];
        return view('dashboard.index')->with(['data' => $data]);
    }

    /**

     * Getting last seven day sales.

     *

     * @since 1.0.1

     *

     * @internal

     * @used-by DashboardController::index()

     *

     * @param $preSevenDays

     * @param $currentDate

     * @return array

     */
    protected function getLastSevenDaySales($preSevenDays, $currentDate) {
        $allAmount = 0;
        $allPaid = 0;
        $perAmount = 0;
        $invoice_paid = Invoice::where('user_id', Auth::user()->id)
                ->whereBetween('send_invoice_date', [$preSevenDays, $currentDate])
                ->get();

        if (count($invoice_paid) > 0) {
            foreach ($invoice_paid as $key => $paid_data) {
                if ($paid_data->save_status == '3') {
                    $allPaid = $allPaid + $paid_data->total_amount;
                }
                if ($paid_data->save_status == '2') {
                    $allAmount = $allAmount + $paid_data->total_amount;
                }
            }

            if ($allAmount > 0) {
                $perAmount = ($allPaid / $allAmount) * 100;
            } elseif ($allPaid > 0) {
                $perAmount = 100;
            }
        }



        return [
            'all_paid' => $allPaid,
            'per_amount' => $perAmount
        ];
    }

    /**

     * Getting most profitable client.

     *

     * @since 1.0.1

     *

     * @internal

     * @used-by DashboardController::index()

     *

     * @return mixed

     */
    protected function getMostBenefitClient() {

        $allPay = 0;

        $mostPaid = 0;

        $mostProfitableClient = '';

        $pay_status = 3;



        $invoicesPaid = Invoice::where('user_id', Auth::user()->id)
                ->groupBy('email')
                ->get();



        if (count($invoicesPaid) > 0) {

            foreach ($invoicesPaid as $key => $invoicePaid) {

                $allPay = 0;

                $emailPaid = Invoice::where('user_id', Auth::user()->id)
                        ->where('email', $invoicePaid->email)
                        ->where('save_status', $pay_status)
                        ->get();



                if (count($emailPaid) > 0) {

                    foreach ($emailPaid as $index => $mostData) {

                        $allPay = $allPay + $mostData->total_amount;
                    }

                    if ($allPay > $mostPaid) {

                        $mostPaid = $allPay;

                        $mostProfitableClient = $invoicePaid->company_name;
                    }
                }
            }
        }



        return [
            'most_paid' => $mostPaid,
            'most_profitable_client' => $mostProfitableClient
        ];
    }

    public function connectStripe() {

        /*        $stripe = new Stripe('sk_test_6fuP0z43LmRolFyQdWPg32zF', '2018-08-23');

          $customers = $stripe->customers()->all();



          foreach ($customers['data'] as $customer) {

          print_r($customer['email']);

          }

          die(); */

        $userId = Auth::user()->id;

        $userEmail = Auth::user()->email;

        $userFirstName = Auth::user()->first_name;

        $userLastName = Auth::user()->last_name;

        $userCompany = Auth::user()->company;

        $redirectedURL = "https://connect.stripe.com/oauth/authorize?response_type=code&client_id=" .
                \Config::get('constants.STRIPE_CLIENT_ID') .
                "&state=" . $userId . "&stripe_user[email]=" .
                urlencode($userEmail) . "&stripe_user[first_name]=" .
                urlencode($userFirstName) . "&stripe_user[last_name]=" .
                urlencode($userLastName) . "&stripe_user[business_name]=" .
                urlencode($userCompany) . "&scope=read_write&stripe_user[country]=US&stripe_user[currency]=usd";



        return redirect()->to($redirectedURL);
    }

    public function stripeResponse() {



        $post = Input::all();

        //debug($post,1);

        $user_id = $post['state'];

        $responeCode = isset($post['code']) ? $post['code'] : '';

        if (isset($responeCode) && !empty($responeCode)) {



            $stripVerification = stripeOathValidate($responeCode);

            //debug($stripVerification,1);

            if (isset($stripVerification['access_token']) && !empty($stripVerification['access_token']) && isset($stripVerification['stripe_publishable_key']) && !empty($stripVerification['stripe_publishable_key']) && isset($stripVerification['stripe_user_id']) && !empty($stripVerification['stripe_user_id'])) {

                $dataUpdate = [];

                $dataUpdate['stripe_connected'] = 'Yes';

                $dataUpdate['stripe_access_token'] = $stripVerification['access_token'];

                $dataUpdate['stripe_publishable_key'] = $stripVerification['stripe_publishable_key'];

                $dataUpdate['stripe_user_id'] = $stripVerification['stripe_user_id'];



                if (Auth::user()->status == 'Pending-Payment') {

                    $dataUpdate['status'] = 'Active';
                }



                User::where('id', '=', $user_id)->update($dataUpdate);

                Session::flash('valid', 'block');

                //return Redirect::to(route('paymentGateway'));

                return Redirect::to(route('account'));
            }
        }

        Session::flash('error', 'block');



        return Redirect::to(route('paymentGateway'));
    }

    public function billing() {

        $stripe_customer_id = Auth::user()->stripe_customer_id;

        if (empty($stripe_customer_id)) {

            require app_path('Components/stripe/init.php');

            \Stripe\Stripe::setApiKey(\Config::get('constants.STRIPE_SECRET_KEY'));

            $stripeCustomer = \Stripe\Customer::create(array(
                        "description" => Auth::user()->first_name . ' ' . Auth::user()->last_name,
                        "email" => Auth::user()->email
            ));

            $stripeCustomerId = $stripeCustomer['id'];

            User::where('id', '=', Auth::user()->id)->update(['stripe_customer_id' => $stripeCustomerId]);
        }

        $title = "Billing | Invoyce";

        return view('dashboard.billing')->with(['title' => $title]);
    }

    public function stripeResponseBillingPost() {

        $post = Input::all();
        $cc = substr($post['card-number'], -4);
        $error_mes = 'Sorry! Payment cannot processed.';
        $stripe = new Stripe(\Config::get('constants.STRIPE_SECRET_KEY'), '2018-08-23');
        if (isset($post['stripeToken']) && !empty($post['stripeToken'])) {

            $stripeToken = $post['stripeToken'];

            //require app_path('Components/stripe/init.php');

            $customer_id = Auth::user()->stripe_customer_id;

            if (empty($customer_id)) {

                $customer = $stripe->customers()->create([
                    'email' => $email,
                    'shipping' => array(
                        'name' => $company_name,
                        'address' => array('line1' => $address, 'city' => $city, 'state' => $state, 'postal_code' => $zip_code),
                        'phone' => $phone
                    )
                ]);

                $customer_id = $customer['id'];
            }
            $card = $stripe->cards()->create($customer_id, $stripeToken);
            $arraySubscription = ["plan" => "monthly"];

            //prod_CenCH9butQBTIM
            //\Stripe\Stripe::setApiKey(\Config::get('constants.STRIPE_SECRET_KEY'));



            if (isset($_POST['coupon_code']) && !empty($_POST['coupon_code'])) {

                try {

                    //$checkCoupon = \Stripe\Coupon::retrieve($_POST['coupon_code']);

                    $checkCoupon = $stripe->coupons()->find($_POST['coupon_code']);

                    if (isset($checkCoupon['id'])) {

                        $arraySubscription['coupon'] = $_POST['coupon_code'];

                        $arraySubscription = [
                            "plan" => "monthly",
                            "coupon" => $_POST['coupon_code']
                        ];
                    }
                } catch (\Exception $e) {

                    Session::flash('error', $e->getMessage());

                    return Redirect::back()->with($e->getMessage());
                }
            }



            try {

                //$cu = $stripe->customers()->find($customer_id);

                $charge = $stripe->Subscriptions()->create($customer_id, $arraySubscription);

                $subscription_id = $charge['id'];

                $success = "true";
            } catch (\Exception $e) {

                $success = "false";

                $body = $e->getMessage();

                $err = $body['error'];

                $error = $err['message'];
            }



            if ($success == 'true') {

                $data['to'] = Auth::user()->email;

                $data['subject'] = 'Billing Update';

                $data['body'] = View::make('emails.billing')->render();

                $data['sender'] = 'noreply@invoyce.me';

                $data['cc'] = '';

                _mail($data);



                $isAlreadyBilling = UserBillings::where('user_id', '=', Auth::user()->id)->first();

                if (empty($isAlreadyBilling)) {

                    $finalDate = date('Y-m-d', strtotime('+1 months'));

                    UserBillings::insert(['user_id' => Auth::user()->id, 'billing_from' => 'Stripe', 'billing_amount' => '19', 'billing_date' => date('Y-m-d'), 'billing_expire_date' => $finalDate, 'subscription_id' => $subscription_id, 'cc' => $cc]);
                } else {



                    $previousDate = strtotime($isAlreadyBilling->billing_expire_date);

                    $finalDate = date("Y-m-d", strtotime("+1 month", $previousDate));

                    UserBillings::where('id', '=', $isAlreadyBilling->id)->update(['billing_expire_date' => $finalDate, 'subscription_id' => $subscription_id, 'cc' => $cc]);
                }



                $data['to'] = Auth::user()->email;

                $data['subject'] = 'Your Invoyce Receipt';

                $data['body'] = View::make('emails.billing_receipt', ['billing_from' => date('Y-m-d'), 'billing_to' => $finalDate, 'billing_total' => '19'])->render();

                $data['sender'] = 'noreply@invoyce.me';

                $data['cc'] = '';

                _mail($data);



                Session::flash('success', 'block');

                return Redirect::to(route('billing'));
            } else {

                Session::flash('error', 'block');

                $error_mes = "Stripe Payment Status : " . $error;
            }
        }

        return Redirect::to(route('billing'))->with($error_mes);
    }

    /*     * *************************Pay Invoice Preview************* */

    public function payInvoiceView($id) {

        $data['invoice_data'] = Invoice::where('invoice_url', '=', $id)->first();

        $cur_date = date("Y-m-d");

        //$data['profile_info'] = Invoice::where('id','=', $data['invoice_data']->id)->first();

        if (count($data['invoice_data']) > 0) {

            //if($data['invoice_data']->save_status < 3){

            $data['item'] = InvoiceItem::where('invoice_id', $data['invoice_data']->id)->get();

            $invoice_detail = $data['invoice_data'];



            $profile_info = User::where('id', '=', $invoice_detail->user_id)->first();

            $invoice_data = Invoice::where('id', '=', $invoice_detail->id)->first();

            $data['item'] = InvoiceItem::where('invoice_id', '=', $invoice_detail->id)->get();

            $data['profile_info'] = $profile_info;

            $data['invoice_data'] = $invoice_data;



            if ($invoice_detail->view_status == 0) {

                Invoice::where('invoice_url', $id)->update(['view_status' => '1']);

                //Mail send to sender who send invoice

                $data_email['to'] = $profile_info->email;

                $data_email['subject'] = 'Invoice Viewed';

                $data_email['body'] = View::make('emails.viewed', ['data' => $data, 'profile_info' => $profile_info, 'invoice_data' => $invoice_data])->render();

                $data_email['sender'] = 'noreply@invoyce.me';

                $data_email['cc'] = '';

                _mail($data_email);
            }

            /*             * ******Invoice Paypal method Check********** */

            
			
			if($invoice_data->stripe_invoice_id):
            
			$stripe = new Stripe(Auth::user()->stripe_access_token, '2018-08-23');
			$stripe_invoice = $stripe->invoices()->find($invoice_data->stripe_invoice_id);
			return Redirect::to($stripe_invoice['hosted_invoice_url']);
			
            elseif ($paypalinvoicecheck):
            $paypal_conf = \Config::get('paypal');

            $paypalinvoicecheck = \App\Http\Controllers\PaypalController::Payalinvoicecheck($invoice_detail->id);
			return Redirect::to($paypal_conf['paypal_invoice_link'] . $id);
			
			endif;
			
            //}else{
            //	return view('dashboard/pay/invalid_invoice',['error'=>'Invoice Not able to pay.']);
            //}

            return view('dashboard/pay/invoice', compact('data'));
        } else {

            return view('dashboard/pay/invalid_invoice');
        }
    }

    public function invoice_pay($invoice_id) {

        $data['invoice_id'] = $invoice_id;

        $data['getInvoiceInfo'] = Invoice::where('invoice_url', '=', $invoice_id)->first();

        if (empty($data['getInvoiceInfo'])) {

            return Redirect::to(route('invalid'));
        }

        if ($data['getInvoiceInfo']->save_status < 3) {

            // Do Nothing
        } else {

            return Redirect::to(route('invalid'));
        }

        $data['getUserInfo'] = User::where('id', $data['getInvoiceInfo']->user_id)->first();

        $data['total'] = 0;

        $select = InvoiceItem::where('invoice_id', $data['getInvoiceInfo']->id)->orderBy('id', 'asc')->get()->toArray();

        if (count($select) != 0) {

            foreach ($select as $row) {

                $row = (array) $row;

                $data['total'] += ($row['rate'] * $row['qty']);
            }
        }



        $data['amount_paid'] = $data['getInvoiceInfo']->total_amount;



        $data['amount_val'] = number_format((float) $data['amount_paid'], 2, '.', '');

        $data['recid'] = $data['getInvoiceInfo']->id;



        if ($data['getInvoiceInfo']->id == '') {

            return Redirect::to(route('invalid'));
        }

        return view('dashboard.invoices.invoices_pay', compact('data'));
    }

    public function invoice_pay_post($invoice_id) {

        $post = Input::all();

        $invoiceRow = Invoice::where('invoice_url', '=', $invoice_id)->first();



        if (isset($post['stripeToken']) && !empty($post['stripeToken']) && !empty($invoiceRow)) {



            $amount_val = number_format($invoiceRow->total_amount, 0, '.', '');



            $amount_cents = $amount_val * 100;



            $invoiceid = $description = $recid = $invoiceRow->id;



            $getInvoiceInfo = $invoiceRow->toArray();

            //debug($getInvoiceInfo,1);

            $result = "success";



            $invoiceCreatedUserInfo = User::where('id', $getInvoiceInfo['user_id'])->first();

            require app_path('Components/stripe/init.php');

            //\Stripe\Stripe::setApiKey(\Config::get('constants.STRIPE_SECRET_KEY'));

            \Stripe\Stripe::setApiKey($invoiceCreatedUserInfo->stripe_access_token);

            try {

                if ($getInvoiceInfo['invoice_type'] == '3') {

                    $product = \Stripe\Product::create([
                                //'name' => 'Charge Schedule Invoice',

                                'name' => $invoiceRow->invoice_title,
                                'type' => 'service',
                    ]);

                    $charge2 = \Stripe\Plan::create(array(
                                //"nickname" => "Charge Schedule Invoice"

                                "nickname" => $invoiceRow->invoice_title,
                                "id" => $getInvoiceInfo["invoice_name"] . 'T' . time(),
                                "interval" => "day",
                                "interval_count" => $getInvoiceInfo["send_invoice_days"],
                                "currency" => "usd",
                                "amount" => $amount_cents,
                                'product' => $product['id'],
                    ));

                    $plan_name = $charge2['id'];

                    if ($getInvoiceInfo["invoice_customer"] == '') {

                        $customer = \Stripe\Customer::create(array(
                                    "description" => $getInvoiceInfo['company_name'],
                                    "email" => $getInvoiceInfo['email']
                        ));

                        $customer_id = $customer['id'];

                        Invoice::where('id', '=', $getInvoiceInfo["id"])->update(['invoice_customer' => $customer_id, 'pay_count' => '1']);
                    } else {

                        $customer_id = $getInvoiceInfo["invoice_customer"];
                    }

                    //Create subscription

                    $endtime = time() + 120;

                    $charge = \Stripe\Subscription::create(array(
                                "customer" => $customer_id,
                                "plan" => $plan_name,
                                "trial_end" => $endtime,
                    ));

                    $cu = \Stripe\Customer::retrieve($customer_id); // stored in your application

                    $cu->source = $post['stripeToken']; // obtained with Checkout

                    $cu->save();

                    $updateArray = ['subscription_id' => $charge->id];

                    Invoice::where('id', '=', $getInvoiceInfo["id"])->update($updateArray);
                } else {

                    $charge = \Stripe\Charge::create(array(
                                "amount" => $amount_cents,
                                "currency" => "usd",
                                "source" => $post['stripeToken'],
                                "description" => 'Paid amount for invoice # ' . $invoiceRow->invoice_number));
                }



                $result = "success";

                if (isset($charge->card->address_zip_check) && $charge->card->address_zip_check == "fail") {

                    throw new Exception("zip_check_invalid");
                } else if (isset($charge->card->address_line1_check) && $charge->card->address_line1_check == "fail") {

                    throw new Exception("address_check_invalid");
                } else if (isset($charge->card->cvc_check) && $charge->card->cvc_check == "fail") {

                    throw new Exception("cvc_check_invalid");
                }

                // Payment has succeeded, no exceptions were thrown or otherwise caught
            } catch (Stripe_CardError $e) {



                $error = $e->getMessage();

                $result = "declined";
            } catch (Stripe_InvalidRequestError $e) {

                $result = "declined";
            } catch (Stripe_AuthenticationError $e) {

                $result = "declined3";
            } catch (Stripe_ApiConnectionError $e) {

                $result = "declined";
            } catch (Stripe_Error $e) {

                $result = "declined";
            } catch (Exception $e) {



                if ($e->getMessage() == "zip_check_invalid") {

                    $result = "declined";
                } else if ($e->getMessage() == "address_check_invalid") {

                    $result = "declined";
                } else if ($e->getMessage() == "cvc_check_invalid") {

                    $result = "declined";
                } else {

                    $result = "declined";
                }
            }



            if ($result == 'success') {

                $date = date("Y-m-d");

                if ($charge['balance_transaction'] != '') {

                    $txn = '';
                } else {

                    $txn = $charge['balance_transaction'];
                }

                $dataInsert = ['invoice_id' => $getInvoiceInfo['id'], 'fname' => $_POST['fname'], 'lname' => $_POST['lname'], 'txn_no' => $txn, 'pay_date' => $date];

                InvoiceBilling::insert($dataInsert);

                Invoice::where('id', '=', $getInvoiceInfo['id'])->update(['save_status' => '3']);



                /* $data['to'] = $invoiceCreatedUserInfo['email'];

                  $data['subject'] = 'Your Invoyce has been Paid';

                  $invoice_number = $getInvoiceInfo['invoice_number'];

                  $data['body'] = View::make('emails.invoice_pay_success', ['invoice_number'=>$invoice_number])->render();

                  $data['sender']= 'noreply@invoyce.me';

                  $data['cc']= '';

                  _mail($data); */

                return Redirect::to(route('invoicePaySuccess', $getInvoiceInfo['invoice_url']));
            } else {

                $error_mes = "Stripe Payment Status : " . $result;

                return Redirect::back()->withErrors([$error_mes]);
            }
        }

        return Redirect::back()->withErrors(['Invalid Post']);
    }

    public function paySuccess($invoice_url) {



        $value = Invoice::where('invoice_url', '=', $invoice_url)->first();

        $invoice_data = $value;

        if ($value != '' && $value->save_status == '3') {

            if ($value->invoice_type == '2' && $value->schedule_type == '2' && $invoice_data['send_paid_email'] == '0') {

                $item = InvoiceItem::where('invoice_id', '=', $value->id)->get();

                $send_invoice_days = $value->send_invoice_days;

                $send_invoice_date = date('Y-m-d', strtotime('+' . $send_invoice_days . ' days'));

                $save_status = '0';

                $last_id = '';

                $add_date = date("Y-m-d");

                $last_id = Invoice::insertGetId(
                                ['invoice_url' => '', 'schedule_type' => $value->schedule_type, 'save_status' => $save_status, 'send_invoice_date' => $send_invoice_date,
                                    'send_invoice_days' => $send_invoice_days, 'user_id' => $value->user_id, 'notification_status' => $value->notification_status,
                                    'company_name' => $value->company_name, 'email' => $value->email, 'additional_email' => $value->additional_email,
                                    'address' => $value->address, 'city' => $value->city, 'state' => $value->state, 'zip_code' => $value->zip_code, 'phone' => $value->phone,
                                    'invoice_title' => $value->invoice_title, 'invoice_number' => $value->invoice_number,
                                    'invoice_message' => $value->invoice_message, 'terms_conditions' => $value->terms_conditions,
                                    'invoice_type' => $value->invoice_type, 'total_amount' => $value->total_amount, 'view_status' => '0', 'add_date' => $add_date]
                );

                if ($last_id != '') {

                    $invoice_url = '';

                    $ranno = rand(0, 1000);

                    $invoice_url = md5($ranno . '@@@@@' . $last_id);

                    $random_number = mt_rand(100000, 999999);

                    if ($last_id != '') {

                        $no = $last_id;

                        $rand_no = $random_number . $no;
                    }

                    $sql = Invoice::where('id', $last_id)->update(array('invoice_url' => $invoice_url, 'invoice_number' => $rand_no));

                    if ($item != '') {

                        foreach ($item as $itemValue) {

                            if ($itemValue->id != '') {

                                $insert = InvoiceItem::insertGetId(
                                                ['invoice_id' => $last_id, 'item' => $itemValue->item, 'description' => $itemValue->description,
                                                    'rate' => $itemValue->rate, 'qty' => $itemValue->qty, 'discount' => $itemValue->discount, 'discount_type' => $itemValue->discount_type, 'total_amount' => $itemValue->total_amount]
                                );
                            }
                        }
                    }
                }
            }



            //Mail send to sender who send invoice

            $profile_info = User::where('id', '=', $value->user_id)->first();



            $item = InvoiceItem::where('invoice_id', '=', $value->id)->get();

            /* Mail::send('dashboard.emails.paid', ['invoice_data' => $invoice_data, 'item' => $item, 'profile_info'=> $profile_info], function ($message) use ($profile_info)

              {

              $message->from('noreply@invoyce.me', 'Invoice Paid');

              $message->to($profile_info->email)->subject('Invoice Paid');

              }); */

            if ($invoice_data['send_paid_email'] == '0') {

                $data['to'] = $profile_info->email;

                $data['subject'] = 'Invoice Paid';

                $data['body'] = View::make('emails.paid', ['invoice_data' => $invoice_data, 'item' => $item, 'profile_info' => $profile_info])->render();

                $data['sender'] = 'noreply@invoyce.me';

                $data['cc'] = '';

                _mail($data);



                $data['to'] = $invoice_data->email;

                //$data['subject'] = 'Invoice Payment Receipt';

                $data['subject'] = 'Receipt for Invoice # ' . $invoice_data->invoice_number . '-' . $profile_info->company;

                $data['body'] = View::make('emails.receipt', ['invoice_data' => $invoice_data, 'item' => $item, 'profile_info' => $profile_info])->render();

                $data['sender'] = 'noreply@invoyce.me';

                $data['cc'] = '';

                _mail($data);
            }

            Invoice::where('id', '=', $invoice_data['id'])->update(['send_paid_email' => '1']);

            return view('dashboard/pay/success', compact('invoice_data', 'profile_info'));
        } else {



            return view('dashboard/pay/invalid_invoice');
        }
    }

    public function invalid() {

        return view('dashboard/pay/invalid_invoice');
    }

    public function paymentSetting() {

        $billing_data = PaymentSetting::where('user_id', '=', Auth::user()->id)->first();

        if ($billing_data == '') {

            $api_login_id = '';

            $trans_key = '';
        } else {

            $api_login_id = $billing_data->api_login_id;

            $trans_key = $billing_data->trans_key;
        }

        return view('dashboard/account/payment-setting', compact('api_login_id', 'trans_key'));
    }

    public function cancelSubscriptionNew() {

        $post = Input::all();





        $getProfileInfo = Auth::user();

        $user_id = $getProfileInfo->id;



        $getBillingInfo = UserBillings::where('user_id', $user_id)->first();

        require app_path('Components/stripe/init.php');

        \Stripe\Stripe::setApiKey(\Config::get('constants.STRIPE_SECRET_KEY'));



        $subscription = \Stripe\Subscription::retrieve($getBillingInfo->subscription_id);

        $check = $subscription->cancel();



        $allPendingInvoice = Invoice::where('user_id', '=', Auth::user()->id)->where('save_status', '<', '3')->get()->toArray();



        if (count($allPendingInvoice) > 0) {



            foreach ($allPendingInvoice as $allPendingInvoiceRow) {

                $data = [];

                $id = $allPendingInvoiceRow['id'];

                $data['invoice_data'] = Invoice::where('user_id', '=', Auth::user()->id)->where('id', '=', $id)->first();

                $data['profile_info'] = Auth::user();

                $ranno = rand(0, 1000);

                $invoice_url = md5($ranno . '@@@@@' . $id);

                $data['subject'] = 'Cancelled Invoice';

                $data['body'] = View::make('emails.cancelled', compact('data'))->render();

                $data['sender'] = 'noreply@invoyce.me';



                if (!empty($user_data1['subscription_id'])) {

                    require app_path('Components/stripe/init.php');

                    //debug($user_data3,1);

                    \Stripe\Stripe::setApiKey($user_data3->stripe_access_token);

                    $subscription = \Stripe\Subscription::retrieve($user_data1['subscription_id']);

                    $subscription->cancel();
                }

                if ($data['invoice_data']['save_status'] == '2') {

                    $addition_email = $data['invoice_data']['additional_email'];

                    $data['to'] = $data['invoice_data']['email'];

                    $data['cc'] = $addition_email;

                    _mail($data);
                }

                Invoice::where('id', $id)->update(array('save_status' => '4', 'view_status' => '0', 'invoice_url' => $invoice_url));
            }
        }

        User::where('id', $user_id)->update(['Status' => 'Subscription_cancel']);

        UserBillings::where('user_id', '=', $user_id)->delete();

        Auth::logout();

        return Redirect::to(route('index'));
    }

    /*     * *******************Load afetr billing********************* */

    public function loadAgain($id) {

        $user_data3 = User::table('users')->where('id', $id)->first();

        if (count($user_data3) > 0) {

            return Redirect::to(route('dashboard'));
        } else {

            return Redirect::to(route('login'));
        }
    }

    /*     * *******************Load after billing********************* */

    public function loadMenuAgain($url, $id) {



        $user_data3 = User::where('id', $id)->first();

        if (count($user_data3) > 0) {

            if ($url == 1) {

                return Redirect::to(route('dashboard'));
            }

            if ($url == 2) {

                return Redirect::to(route('invoices'));
            }



            if ($url == '3') {

                return Redirect::to(route('standardInvoicesList'));
            }

            if ($url == '4') {

                return Redirect::to(route('scheduledInvoicesList'));
            }

            if ($url == '5') {



                return Redirect::to(route('subscriptionInvoicesList'));
            }

            if ($url == 6) {

                return Redirect::to(route('saveAllInvoice'));
            }





            if ($url == 7) {

                return Redirect::to(route('reports'));
            }



            if ($url == 8) {

                return Redirect::to(route('account'));
            }



            if ($url == 9) {

                return Redirect::to(route('password'));
            }
        } else {

            return Redirect::to(route('login'));
        }
    }

}
