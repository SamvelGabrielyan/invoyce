<?php



namespace App\Http\Controllers;



use App\Helpers\CommonHelper;

use App\Helpers\SubscriptionInvoiceMailHelper;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Cartalyst\Stripe\Stripe;

use App\Model\User;

use App\Model\UserBillings;

use App\Model\Invoice;

use App\Model\State;

use App\Model\InvoiceItem;

use App\Http\Controllers\Controller;



use View, HTML, Validator, Session, Input, Redirect, Auth, URL, Hash, Uuid;



class SubscriptionController extends Controller

{

    public function __construct()

    {

        parent::__construct();

    }



    const SUBSCRIPTION_INVOICE_TYPE                  = '3';

    const SUBSCRIPTION_INVOICE_SAVE_STATUS_SAVE_MODE = '1';

    const DEFAULT_TIME_PERIODS                       = '7';



    /**

     * Show Subscription Invoice edit page.

     *

     * @since 1.0.1

     *

     * @param $id

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function updateSubscriptionInvoice($id)

    {

        $data['invoice_data'] = Invoice::where('user_id', Auth::user()->id)

            ->where('id', $id)

            ->first();

        $data['state'] = State::get();

        $data['item']  = InvoiceItem::where('invoice_id', $id)->get();

        $status        = 'none';



        return view('dashboard.invoices.update-subscription-invoice', compact('data'));

    }



    /**

     * List subscriptions invoices.

     *

     * @since 1.0.1

     *

     * @param Request $request

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function subscriptionInvoicesList(Request $request)

    {

        $data['all_invoices'] = '';

        $query                = Invoice::where('user_id', '=', Auth::user()->id)

            ->where('invoice_type', '=', self::SUBSCRIPTION_INVOICE_TYPE)

            ->where('save_status', '!=', self::SUBSCRIPTION_INVOICE_SAVE_STATUS_SAVE_MODE)
            ->orderby('id','desc');



        $data['sort_by'] = '';



        $filterType = $request->filter_type;



        if ($filterType != '') {

            $data['sort_by'] = invoiceFilter($query, $filterType);

        }



        $data['start_date'] = '';

        $data['end_date']   = '';



        if (!empty($request->start_date) && !empty($request->end_date)) {

            $data['start_date'] = $request->start_date;

            $data['end_date']   = $request->end_date;

            $dates              = dateConversion($request->start_date, $request->end_date);

            $query->whereBetween('send_invoice_date', array($dates['start'], $dates['end']));

        }



        $query->orderBy('send_invoice_date', 'desc');



        $data['all_invoices'] = $query->paginate(20);



        return view('dashboard.invoices.subscription-invoices-list', compact('data'));



    }



    /**

     * Save subscription Invoice.

     *

     * @since 1.0.1

     *

     * @param Request $request

     * @return mixed

     */

    public function subscriptionInvoiceSave(Request $request)

    {

        $paymentMethod = $request->input('paymentmethod');

        $email = $request->input('email');

        $company_name = $request->input('company_name');

        $address = $request->input('address');

        $city = $request->input('city');

        $zip_code = $request->input('zip_code');

        $state = $request->input('state');

        $phone = $request->input('phone');

        $invoice_message = $request->input('invoice_message');

        $userId        = Auth::user()->id;





        $totalInvoice    = $request->input('totalInvoice') ?? '1';

        $saveStatus      = $request->input('save_status') ?? '0';

        $invoiceType     = self::SUBSCRIPTION_INVOICE_TYPE;

        $scheduleType    = '2';

        $sendInvoiceDays = $request->input('time_periods') ?? self::DEFAULT_TIME_PERIODS;

        $sendInvoiceDate = date('Y-m-d', strtotime('+' . $sendInvoiceDays . ' days'));



        $additionalData = [

            'schedule_type'     => $scheduleType,

            'send_invoice_date' => $sendInvoiceDate,

            'send_invoice_days' => $sendInvoiceDays,

            'invoice_type'      => $invoiceType,

            'invoice_type_code' => 'sub',

        ];



        $invoice    = new Invoice();

        $insertedId = $invoice->storeInvoice($request, $additionalData);



        if ($insertedId != '') {

            $invoiceItem = new InvoiceItem();

            $payAmount   = $invoiceItem->invoiceItemStoreOrUpdate($request, $totalInvoice, $insertedId, 'store');

        }



         # Invoice payments.

        $paymentMethod = $request->input('paymentmethod');

        if ($paymentMethod == 'paypal') {

            $invoicePayment = $this->invoicePayment($insertedId, $request, $itemsPayAmount);

            $payPalConf = \Config::get('paypal');

            $invoiceUrl = $invoicePayment['invoice_id'];

        }elseif ($paymentMethod == 'stripe') {

            if (empty(Auth::user()->stripe_access_token)) {

                Session::flash('error_msg', 'Please Connect your Stripe Account');

                return Redirect::to(route('paymentGateway'));

            }

            //$stripe = new Stripe(\Config::get('constants.STRIPE_SECRET_KEY'), '2018-08-23');

            $stripe = new Stripe(Auth::user()->stripe_access_token, '2018-08-23');

                $customer = $stripe->customers()->create([

                    'email' => $email,

                    'shipping' => array(

                        'name' => $company_name,

                        'address' => array('line1' => $address, 'city' => $city, 'state' => $state, 'postal_code' => $zip_code),

                        'phone' => $phone

                    )

                ]);


            $plan_id = 'weekly_'.$customer['id'].'_'.$insertedId;



             $plan = $stripe->plans()->create([

                'id'                    => $plan_id,

                'product[name]'         => 'weekly ($'.$payAmount.')',

                'amount'                => $payAmount,

                'currency'              => 'USD',

                'interval'              => 'day',

                'interval_count'        => $sendInvoiceDays,

                'product[statement_descriptor]' => $sendInvoiceDays . ' Days Subscription',

            ]);

             $subscription = $stripe->subscriptions()->create($customer['id'], [

                'plan' => $plan_id,
                'trial_end' => strtotime('+1 day', time())

            ]);



            for ($i=1; $i <= $totalInvoice; $i++) {

                $item_name = $request->input('item_name_'.$i);

                $item_description = $request->input('item_description_'.$i);

                $item_qty = $request->input('item_qty_'.$i);

                $item_discount = $request->input('item_discount_'.$i);

                $item_rate = $request->input('item_rate_'.$i);

                $invoiceItem = $stripe->invoiceItems()->create($customer['id'], [

                    'currency' => 'USD',

                    'quantity' => $item_qty,

                    'unit_amount' => (($item_rate - $item_discount) * 100),

                    'description' => $item_name . ' (' . $item_description . ')'

                ]);

            }



            //print_r($invoiceItem);

            //die();



            

            /* print_r($subscription);

             die('aaaaa');*/

            $invoice = $stripe->invoices()->create($customer['id'], [

                'billing' => 'send_invoice',

                //'items' => [['plan' => 'monthly']],

                'subscription' => $subscription['id'],

                'days_until_due' => 1,

                'description' => $invoice_message

            ]);





            //echo $invoiceItem['id'];

           /* echo "<pre>";

            print_r($request->all());

            print_r($invoice);

            die('test');*/

        } else {

            $invoiceUrl = CommonHelper::makeUrl($insertedId);

        }



        $invoiceName = 'Invoice_schedule_' . $insertedId;

        $invoiceUrl  = CommonHelper::makeUrl($insertedId);

        Invoice::where('id', $insertedId)->update([

            'total_amount' => $payAmount,

            'invoice_url'  => $invoiceUrl,

            'invoice_name' => $invoiceName

        ]);



        Session::flash('email', '');

        //Session::flash('success', 'Invoice has been sent successfully.');

        if ($saveStatus == '0') {

            $dataToEmail = [

                'inserted_id'    => $insertedId,

                'payment_method' => $request->payment_method,

                'invoice_url'    => $invoiceUrl

            ];



            SubscriptionInvoiceMailHelper::sendSaveEmail($dataToEmail);

            Session::flash('success', 'block');

        } else {

            Session::flash('save', 'block');

        }

        return Redirect::to(route('subscriptionInvoice'));

    }



    /**

     * Update Subscription invoice.

     *

     * @since 1.0.1

     *

     * @param Request $request

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function subscriptionInvoiceUpdate(Request $request)

    {

        $totalInvoice    = $request->input('totalInvoice') ?? '1';

        $saveStatus      = $request->input('save_status') ?? '0';

        $editId          = $request->input('edit_id');

        $invoiceType     = self::SUBSCRIPTION_INVOICE_TYPE;

        $scheduleType    = '2';

        $sendInvoiceDays = $request->input('time_periods') ?? self::DEFAULT_TIME_PERIODS;

        $sendInvoiceDate = date('Y-m-d', strtotime('+' . $sendInvoiceDays . ' days'));



        $additionalData = [

            'schedule_type'     => $scheduleType,

            'send_invoice_date' => $sendInvoiceDate,

            'send_invoice_days' => $sendInvoiceDays,

            'invoice_type'      => $invoiceType,

        ];



        $invoice = new Invoice();

        $invoice->updateInvoice($request, $additionalData, 'subscription');



        if ($editId != '') {

            $invoiceItem = new InvoiceItem();

            $payAmount   = $invoiceItem->invoiceItemStoreOrUpdate($request, $totalInvoice, $editId, 'edit');

        }



        Invoice::where('id', $editId)->update([

            'total_amount' => $payAmount

        ]);

        //Session::flash('success', 'Invoice has been updated successfully.');



        $data['invoice_data'] = Invoice::where('user_id', Auth::user()->id)->where('id', '=', $editId)->first();

        if ($data['invoice_data']->id != '') {

            $dataToEmail = [

                'save_status'  => $saveStatus,

                'invoice_data' => $data['invoice_data'],

                'edit_id'      => $editId,

            ];

            $data['item']   = SubscriptionInvoiceMailHelper::sendUpdateEmail($dataToEmail);

            $data['status'] = 'block';



            return view('dashboard.invoices.update-subscription-invoice', compact('data'));



        } else {

            return Redirect::to(route('login'));

        }

    }

}

