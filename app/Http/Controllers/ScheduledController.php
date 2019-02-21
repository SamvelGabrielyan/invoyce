<?php



namespace App\Http\Controllers;



use App\Helpers\CommonHelper;

use App\Helpers\ScheduledInvoiceMailHelper;

use ClassPreloader\Config;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;



use App\Model\User;

use App\Model\UserBillings;

use App\Model\Invoice;

use App\Model\State;

use App\Model\InvoiceItem;

use App\Model\Paypal;

use Cartalyst\Stripe\Stripe;

use App\Http\Controllers\Controller;



use View, HTML, Validator, Session, Input, Redirect, Auth, URL, Hash, Uuid;



class ScheduledController extends Controller

{

    public function __construct()

    {

        parent::__construct();

    }



    const SCHEDULED_INVOICE_TYPE   = '2';

    const SCHEDULED_TYPE_DATE_TYPE = '1';

    const SCHEDULED_TYPE_DAYS      = '2';



    /**

     * Scheduled Invoice Edit page.

     *

     * @param $id

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function updateScheduledInvoice($id)

    {

        $invoices = Invoice::where('user_id', '=', Auth::user()->id)

            ->where('id', '=', $id)

            ->first();

        $invoices->send_invoice_date = date('m/d/Y', strtotime($invoices->send_invoice_date));

        $data['invoice_data']        = $invoices;

        $data['state']               = State::get();

        $data['item']                = InvoiceItem::where('invoice_id', '=', $id)->get();

        $data['status']              = 'none';



        return view('dashboard.invoices.update-scheduled-invoice', compact('data'));

    }



    /**

     * Scheduled Invoice Edit page.

     *

     * @param $id

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function updateRecurringInvoice($id)

    {

        $invoices = Invoice::where('user_id', '=', Auth::user()->id)

            ->where('id', '=', $id)

            ->first();

        $invoices->send_invoice_date = date('m/d/Y', strtotime($invoices->send_invoice_date));

        $data['invoice_data']        = $invoices;

        $data['state']               = State::get();

        $data['item']                = InvoiceItem::where('invoice_id', '=', $id)->get();

        $data['status']              = 'none';



        return view('dashboard.invoices.update-recurring-invoice', compact('data'));

    }



    /**

     * List all scheduled invoices.

     *

     * @since 1.0.1

     *

     * @param Request $request

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function scheduledInvoicesList(Request $request)

    {

        $data['all_invoices'] = '';

        $data['sort_by']      = '';

        $filter_type          = $request->filter_type;

        $query                = Invoice::where('user_id', Auth::user()->id)

            ->where('invoice_type', '=', self::SCHEDULED_INVOICE_TYPE)

            ->where('invoice_type_code', 'sch')

            ->where('save_status', '!=', '1');



        if ($filter_type != '') {

            $data['sort_by'] = invoiceFilter($query, $filter_type);

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



        return view('dashboard.invoices.scheduled-invoices-list', compact('data'));

    }



    /**

     * Recurring Invoices list.

     *

     * @since 1.0.1

     *

     * @param Request $request

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function recurringInvoices(Request $request){
		
        $data['allinvoice'] = '';

        if ($request->input('start') != '') {			

            list($m, $d, $y) = preg_split('/\//', $request->input('start'));

            $start = $y . '-' . $m . '-' . $d;

            list($m, $d, $y) = preg_split('/\//', $request->input('end'));

            $end = $y . '-' . $m . '-' . $d;

            $data['allinvoice'] = Invoice::where('user_id', '=', Auth::user()->id)

                ->where('schedule_type', '=', '2')

                ->where('invoice_type_code', 'rec')

                ->where('save_status', '!=', '1')

                ->whereBetween('send_invoice_date', [$start, $end])

                ->orWhere('invoice_type', '=', '3')

                ->orderBy('id', 'desc')->paginate(20);

        } else {			
			
			$data['allinvoice'] = Invoice::where('user_id', '=', Auth::user()->id)

                ->where('schedule_type', '=', '2')

                ->where('invoice_type_code', 'rec')

                ->where('save_status', '!=', '1')

                ->Where('invoice_type', '=', '3')

                ->orderBy('id', 'desc')

                ->paginate(20);

        }

        return view('dashboard.invoices.recurring-invoices', compact('data'));

    }



    /**

     * Scheduled Invoice and invoice items save.

     *

     * @since 1.0.1

     *

     * @param Request $request

     * @return mixed

     */

    public function scheduledInvoiceSave(Request $request)

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

        $invoice       = new Invoice();
        
        
        $totalInvoice    = ($request->input('totalInvoice') != '0') ? $request->input('totalInvoice') : '1';

        $saveStatus      = $request->input('save_status') ?? '0';

        $email           = $request->input('email') ?? '';

        $additionalEmail = $request->input('additional_email') ?? '';

        $sendInvoiceDays = '0';

		
		

        if ($request->input('start_date') != '') {
			
			$date            = explode("/", $request->input('start_date'));

            $month           = $date[0];

            $days            = $date[1];

            $year            = $date[2];

            $sendInvoiceDate = $year . '-' . $month . '-' . $days;

            $scheduleType    = self::SCHEDULED_TYPE_DATE_TYPE;

        } else {
			

            $scheduleType    = self::SCHEDULED_TYPE_DAYS;

            $sendInvoiceDays = $request->input('time_periods') ?? '7';

            $sendInvoiceDate = date('Y-m-d', strtotime('+' . $sendInvoiceDays . ' days'));

        }



        $additionalData = [

            'schedule_type'     => $scheduleType,

            'send_invoice_date' => $sendInvoiceDate,

            'send_invoice_days' => $sendInvoiceDays,

            'save_status'       => $saveStatus,

            'invoice_type'      => self::SCHEDULED_INVOICE_TYPE,

            'invoice_type_code' => $request->invoice_type_code ?? '',

        ];



        $invoice = new Invoice();

        $lastId  = $invoice->storeInvoice($request, $additionalData);         //Insert Data
		


        if ($lastId != '') {

            $invoiceItem    = new InvoiceItem();

            $itemsPayAmount = $invoiceItem->invoiceItemStoreOrUpdate($request, $totalInvoice, $lastId, 'store');

        }



        # Invoice payments.

        $paymentMethod = $request->input('paymentmethod');

        if ($paymentMethod == 'paypal') {

            $invoicePayment = $this->invoicePayment($lastId, $request, $itemsPayAmount);

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



            /*$invoice = $stripe->invoices()->create($customer['id'], [

                'billing' => 'send_invoice',

                'days_until_due' => 1,

                'description' => $invoice_message

            ]);*/





            //echo $invoiceItem['id'];

           /* echo "<pre>";

            print_r($request->all());

            print_r($invoice);

            die('test');*/

        } else {

            $invoiceUrl = CommonHelper::makeUrl($lastId);

        }



        $sql = Invoice::where('id', $lastId)

            ->update([

                'total_amount' => $itemsPayAmount,

                'invoice_url'  => $invoiceUrl,

                'stripe_cid'   => $customer['id']

            ]);



        Session::flash('email', '');





        if ($scheduleType == self::SCHEDULED_INVOICE_TYPE) {

            $data = [

                'invoice_id'     => $lastId,

                'invoice_url'    => $invoiceUrl,

                'payment_method' => $paymentMethod,

                'pay_pal_config' => $payPalConf

            ];



            ScheduledInvoiceMailHelper::sendEmail($data);

        } else {

            if (trim($additionalEmail) != '') {

                $addition_email = $email . ',' . $additionalEmail;

            } else {

                $addition_email = $email;

            }

            Session::flash('email', $addition_email);

        }



        if ($saveStatus == '0') {

            Session::flash('success', 'block');

            if ($scheduleType == self::SCHEDULED_INVOICE_TYPE) {

                Session::flash('success_msg', 'your invoice has been sent to');

            } else {

                Session::flash('success_msg', 'your invoice will be sent on ' . $request->input('start_date') . ' to ');

            }

        } else {

            Session::flash('save', 'block');

        }

		
		if ($request->invoice_type_code == 'sch') {

            return Redirect::to(route('scheduledInvoice'));

        }



        return Redirect::to(route('recurring-invoice'));

    }
    
    
    
    
    
    
    
    public function scheduledRecSave(Request $request)

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

        $invoice       = new Invoice();

        
        $totalInvoice    = ($request->input('totalInvoice') != '0') ? $request->input('totalInvoice') : '1';

        $saveStatus      = $request->input('save_status') ?? '0';

        $email           = $request->input('email') ?? '';

        $additionalEmail = $request->input('additional_email') ?? '';

        $sendInvoiceDays = '0';



        if ($request->input('start_date') != '') {

            $date            = explode("/", $request->input('start_date'));

            $month           = $date[0];

            $days            = $date[1];

            $year            = $date[2];

            $sendInvoiceDate = $year . '-' . $month . '-' . $days;

            $scheduleType    = 3;

        } else {

            $scheduleType    = 3;

            $sendInvoiceDays = $request->input('time_periods') ?? '7';

            $sendInvoiceDate = date('Y-m-d', strtotime('+' . $sendInvoiceDays . ' days'));

        }



        $additionalData = [

            'schedule_type'     => $scheduleType,

            'send_invoice_date' => $sendInvoiceDate,

            'send_invoice_days' => $sendInvoiceDays,

            'save_status'       => $saveStatus,

            'invoice_type'      => 3,

            'invoice_type_code' => $request->invoice_type_code ?? '',

        ];



        $invoice = new Invoice();

        $lastId  = $invoice->storeInvoice($request, $additionalData);



        if ($lastId != '') {

            $invoiceItem    = new InvoiceItem();

            $itemsPayAmount = $invoiceItem->invoiceItemStoreOrUpdate($request, $totalInvoice, $lastId, 'store');

        }



        # Invoice payments.

        $paymentMethod = $request->input('paymentmethod');

        if ($paymentMethod == 'paypal') {

            $invoicePayment = $this->invoicePayment($lastId, $request, $itemsPayAmount);

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
            
        } else {

            $invoiceUrl = CommonHelper::makeUrl($lastId);

        }



        $sql = Invoice::where('id', $lastId)

            ->update([

                'total_amount' => $itemsPayAmount,

                'invoice_url'  => $invoiceUrl,

                'stripe_cid'   => $customer['id']

            ]);



        Session::flash('email', '');





        if ($scheduleType == 3) {

            $data = [

                'invoice_id'     => $lastId,

                'invoice_url'    => $invoiceUrl,

                'payment_method' => $paymentMethod,

                'pay_pal_config' => $payPalConf,       

            ];



            ScheduledInvoiceMailHelper::sendEmail($data);

        } else {

            if (trim($additionalEmail) != '') {

                $addition_email = $email . ',' . $additionalEmail;

            } else {

                $addition_email = $email;

            }

            Session::flash('email', $addition_email);

        }

		
		$success_msg="and will be sent to your client every ".$sendInvoiceDays." days.";
		
		if ($saveStatus == '0') {

            Session::flash('success', 'block');

            if ($scheduleType == 3) {

                Session::flash('success_msg', 'your invoice has been sent to');
                
                Session::flash('success_msg1', $success_msg);

            } else {

                Session::flash('success_msg', 'your invoice will be sent on ' . $request->input('start_date') . ' to ');

            }

        } else {

            Session::flash('save', 'block');

        }



        if ($request->invoice_type_code == 'sch') {

            return Redirect::to(route('scheduledInvoice'));

        }

        return Redirect::to(route('recurring-invoice'));

    }



    /**

     * Perform Invoice payment.

     *

     * @since 1.0.1

     *

     * @param null $invoiceId

     * @param $request

     * @param $itemsAmount

     * @return array

     */

    private function invoicePayment($invoiceId = null, $request, $itemsAmount)

    {

        if (!is_null($invoiceId)) {

            $payPalObject = new PaypalController();
            $request['type'] = 'sch';
            $invoice      = $payPalObject->paypal_invoice_create($request, $itemsAmount, true);



            try {

                #Save PayPal Invoice data.

                $payPalPay = Paypal::firstOrCreate([

                    'paypal_invoice_id'     => $invoice->getId(),

                    'paypal_invoice_number' => $invoice->getNumber(),

                    'paypal_invoice_status' => $invoice->getStatus(),

                    'paypal_invoice_amount' => $request->input('totalInvoice'),

                    'invoice_id'            => $invoiceId

                ]);

            } catch (\Illuminate\Database\QueryException $ex) {

                dd($ex->getMessage());

            }



            return [

                'invoice_id' => $invoice->getId(),

            ];

        }

    }



    /**

     * Update Scheduled Invoice.

     *

     * @since 1.0.1

     *

     * @param Request $request

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function scheduledInvoiceUpdate(Request $request)

    {

        $totalInvoice    = $request->input('totalInvoice') ?? '1';

        $saveStatus      = $request->input('save_status') ?? '0';

        $userId          = Auth::user()->id;

        $email           = $request->input('email') ?? '';

        $editId          = $request->input('edit_id');

        $preStatus    = Invoice::where('id', '=', $editId)->first();

        $invoiceType     = self::SCHEDULED_INVOICE_TYPE;

        $sendInvoiceDays = '0';



        if ($request->input('start_date') != '') {

            $date  = explode("/", $request->input('start_date'));

            $month = $date[0];

            $days  = $date[1];

            $year  = $date[2];

            $sendInvoiceDate = $year . '-' . $month . '-' . $days;

            $scheduleType    = self::SCHEDULED_TYPE_DATE_TYPE;

        } else {

            $scheduleType    = self::SCHEDULED_TYPE_DAYS;

            $sendInvoiceDays = ($request->input('time_periods') != '') ? $request->input('time_periods') : '7';

            $sendInvoiceDate = date('Y-m-d', strtotime('+' . $sendInvoiceDays . ' days'));

        }



        $additionalData = [

            'schedule_type'     => $scheduleType,

            'send_invoice_date' => $sendInvoiceDate,

            'send_invoice_days' => $sendInvoiceDays,

            'invoice_type'      => $invoiceType,

            'total_amount'      => '0',

        ];



        $invoice   = new Invoice();

        $updatedId = $invoice->updateInvoice($request, $additionalData, 'scheduled');



        if ($editId != '') {

            $invoiceItem = new InvoiceItem();

            $payAmount   = $invoiceItem->invoiceItemStoreOrUpdate($request, $totalInvoice, $editId, 'edit');

        }



        Invoice::where('id', $editId)->update(['total_amount' => $payAmount]);



        $data['invoice_data'] = Invoice::where('user_id', '=', $userId)->where('id', '=', $editId)->first();

        $data['invoice_data']->send_invoice_date = date('m/d/Y', strtotime($data['invoice_data']->send_invoice_date));

        // print_r($update_id);exit();

        if ($data['invoice_data']->id != '') {

            $data['state'] = State::get();

            $data['item']  = InvoiceItem::where('invoice_id', '=', $editId)->get();

            $data['status'] = 'block';

            if ($saveStatus == '0') {

                Session::flash('success', 'Invoice has been updated successfully.');

            } else if ($saveStatus == '2') {

                #Invoice payment

                $paymentMethod = $request->input('paymentmethod');

                if ($paymentMethod == 'paypal') {

                    $invoicePayment = $this->invoicePayment($editId, $request, $payAmount);

                    $payPalConf     = \Config::get('paypal');

                    $invoiceUrl     = $invoicePayment['invoice_url'];

                } elseif ($paymentmethod == 'stripe') {
                 $stripe = new Stripe(Auth::user()->stripe_access_token, '2018-08-23');

                if($preStatus->stripe_cid){
                    $customer['id'] = $preStatus->stripe_cid;
                    $stripe_invoice = $stripe->invoiceItems()->all();
                    print_r($stripe_invoice);
                    die();
                    foreach ($stripe_invoice['data'] as $line_item) {
                        $stripe->invoiceItems()->delete($line_item['id']);
                    }

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

                }
        }else {

                    $invoiceUrl = CommonHelper::makeUrl($updatedId);

                }



                Invoice::where('id', $editId)->update([

                    'invoice_url' => $invoiceUrl,

                    'view_status' => '0'

                ]);



                $invoiceData = $data['invoice_data'] = Invoice::where('id', '=', $editId)

                    ->where('send_invoice_date', '<=', $sendInvoiceDate)

                    ->first();



                if ($data['invoice_data']->id != '') {

                    $dataToEmail = [

                        'invoice_data'     => $invoiceData,

                        'edit_id'          => $editId,

                        'payment_method'   => $paymentMethod,

                        'email'            => $email,

                        'additional_email' => $request->additional_email,

                        'invoice_url'      => $invoiceUrl

                    ];



                    $data['item'] = ScheduledInvoiceMailHelper::sendUpdateEmail($dataToEmail);

                    Session::flash('send', 'Invoice has been sent successfully.');

                } else {

                    Session::flash('save', 'Invoice has been save successfully.');

                }

            } else {

                Session::flash('save', 'Invoice has been save successfully.');

            }



            if ($scheduleType == self::SCHEDULED_INVOICE_TYPE) {

                Session::flash('success_msg', 'your invoice has been send to');

            } else {

                Session::flash('success_msg', 'your invoice will be sent on ' . $request->input('start_date') . ' to ');

            }



            return view('dashboard.invoices.update-scheduled-invoice', compact('data'));

        }

    }



    /**

     * Sending email by cron job.

     *

     * @since 1.0.1

     *

     * @return string

     */

    public function scheduledSendEmailCron()

    {

        $invoicesToSend = Invoice::getInvoiceForCron()->get();

        if (sizeof($invoicesToSend)) {

            foreach ($invoicesToSend as $invoiceToSend) {

                if ($invoiceToSend->id != '') {

                    $item = '';

                    $invoiceData = Invoice::where('id', '=', $invoiceToSend->id)->first();

                    $item        = InvoiceItem::where('invoice_id', '=', $invoiceToSend->id)->get();

                    $profileInfo = User::select('users.*')

                        ->where('users.id', '=', $invoiceToSend->user_id)

                        ->where('users.status', '=', 'Active')

                        ->first();



                    if (count($profileInfo) > 0) {

                        if ($invoiceToSend->invoice_type == '2' && $invoiceToSend->schedule_type == '2') {

                            $send_invoice_days = $invoiceToSend->send_invoice_days;

                            $send_invoice_date = date('Y-m-d', strtotime('+' . $send_invoice_days . ' days'));

                            $save_status       = '0';

                            $add_date          = date("Y-m-d");

                            $schedule_type     = '2';



                            $last_id = Invoice::insertGetId([

                                'invoice_url'         => '',

                                'schedule_type'       => $invoiceToSend->schedule_type,

                                'save_status'         => $save_status,

                                'send_invoice_date'   => $send_invoice_date,

                                'send_invoice_days'   => $send_invoice_days,

                                'user_id'             => $invoiceToSend->user_id,

                                'notification_status' => $invoiceToSend->notification_status,

                                'company_name'        => $invoiceToSend->company_name,

                                'email'               => $invoiceToSend->email,

                                'additional_email'    => $invoiceToSend->additional_email,

                                'address'             => $invoiceToSend->address,

                                'city'                => $invoiceToSend->city,

                                'state'               => $invoiceToSend->state,

                                'zip_code'            => $invoiceToSend->zip_code,

                                'phone'               => $invoiceToSend->phone,

                                'invoice_title'       => $invoiceToSend->invoice_title,

                                'invoice_number'      => $invoiceToSend->invoice_number,

                                'invoice_message'     => $invoiceToSend->invoice_message,

                                'terms_conditions'    => $invoiceToSend->terms_conditions,

                                'invoice_type'        => $invoiceToSend->invoice_type,

                                'total_amount'        => $invoiceToSend->total_amount,

                                'view_status'         => '0',

                                'add_date'            => $add_date

                            ]);



                            if ($last_id != '') {

                                $rand          = rand(0, 1000);

                                $invoiceUrl    = md5($rand . '@@@@@' . $last_id);

                                $random_number = mt_rand(100000, 999999);

                                if ($last_id != '') {

                                    $no       = $last_id;

                                    $rand_no = $random_number . $no;

                                }



                                Invoice::where('id', $last_id)->update([

                                    'invoice_url'    => $invoiceUrl,

                                    'invoice_number' => $rand_no

                                ]);



                                if ($item != '') {

                                    foreach ($item as $itemValue) {

                                        if ($itemValue->id != '') {

                                            $insert = InvoiceItem::insertGetId([

                                                'invoice_id'    => $last_id,

                                                'item'          => $itemValue->item,

                                                'description'   => $itemValue->description,

                                                'rate'          => $itemValue->rate,

                                                'qty'           => $itemValue->qty,

                                                'discount'      => $itemValue->discount,

                                                'discount_type' => $itemValue->discount_type,

                                                'total_amount'  => $itemValue->total_amount

                                            ]);

                                        }

                                    }

                                }

                            }

                        }



                        Invoice::where('id', $invoiceData->id)->update(['save_status' => '2']);


                        //stripe send invice
                        if($invoiceData->paid_note == 'stripe'):
                            $stripe = new Stripe(Auth::user()->stripe_access_token, '2018-08-23');
                            if ($invoiceData->stripe_cid) {
                              $invoice = $stripe->invoices()->create($invoiceData->stripe_cid, [
                                'billing' => 'send_invoice',
                                'days_until_due' => 1,
                                'description' => $invoiceData->invoice_message,
                                'stripe_invoice_id' => $invoice['id']
                                ]);
                            }
                        endif;

                        $data['invoice_data'] = $invoiceData;

                        $data['item']         = $item;

                        $data['profile_info'] = $profileInfo;

                        # Invoice PayPal method Check.

                        $payPalInvoiceCheck = PaypalController::Payalinvoicecheck($invoiceData->id);



                        if ($payPalInvoiceCheck) {

                            $payPalConf        = \Config::get('paypal');

                            $data['paypalurl'] = $payPalConf['paypal_invoice_link'] . $invoiceUrl;



                        } else {

                            $data['paypalurl'] = url('') . '/pay/' . $invoiceUrl;

                        }



                        $data['paypalurl'] = url('') . '/pay/' . $invoiceUrl;

                        $data['to']        = $invoiceData->email;

                        $data['subject']   = 'New Invoice from ' . $data['profile_info']->company;

                        $data['body']      = View::make('emails.invoice', compact('data'))->render();

                        $data['sender']    = env('NO_REPLY_EMAIL', 'noreply@invoyce.me');

                        $data['cc']        = $invoiceData->additional_email;



                        if ($payPalInvoiceCheck) {

                            $this->Payalscheduledinvoicesend($invoiceData->id);

                        } else {

                            _mail($data);

                        }



                        $dataClientEmail['to']      = $profileInfo->email;

                        $dataClientEmail['subject'] = 'Invoice Sent';

                        $dataClientEmail['body']    = View::make('emails.invoice_sent', [

                            'profile_info' => $profileInfo,

                            'invoice_data' => $invoiceData

                        ])->render();

                        $dataClientEmail['sender'] = env('NO_REPLY_EMAIL', 'noreply@invoyce.me');

                        _mail($dataClientEmail);

                    }

                }

            }

            return 'Sent';

        } else {

            return 'Empty';

        }

    }



    /**

     * Cancel pending Invoice of non paid users.

     */

    public function cronCancelPendingInvoiceOfNonPaidUsers()

    {

        $expireAfter3days      = date('Y-m-d', strtotime('-3 days'));

        $getUsersWhichAreNoPay = UserBillings::where('billing_expire_date', '<', $expireAfter3days)

            ->get()

            ->toArray();



        foreach ($getUsersWhichAreNoPay as $expireUsers) {



            $userId         = $expireUsers['user_id'];

            $getBillingInfo = UserBillings::where('user_id', $userId)->first();

            require app_path('Components/stripe/init.php');

            \Stripe\Stripe::setApiKey(\Config::get('constants.STRIPE_SECRET_KEY'));



            $subscription = \Stripe\Subscription::retrieve($getBillingInfo->subscription_id);

            $check        = $subscription->cancel();



            $allPendingInvoice = Invoice::where('user_id', '=', $userId)

                ->where('save_status', '<', '3')

                ->get()

                ->toArray();



            if (count($allPendingInvoice) > 0) {

                foreach ($allPendingInvoice as $allPendingInvoiceRow) {

                    $data                 = [];

                    $id                   = $allPendingInvoiceRow['id'];

                    $data['invoice_data'] = Invoice::where('user_id', '=', $userId)->where('id', '=', $id)->first();

                    $data['profile_info'] = User::where('id', '=', $userId)->first();

                    $ranno                = rand(0, 1000);

                    $invoiceUrl           = md5($ranno . '@@@@@' . $id);

                    $data['subject']      = 'Cancelled Invoice';

                    $data['body']         = View::make('emails.cancelled', compact('data'))->render();

                    $data['sender']       = env('NO_REPLY_EMAIL', 'noreply@invoyce.me');



                    if (!empty($user_data1['subscription_id'])) {

                        require app_path('Components/stripe/init.php');

                        //debug($user_data3,1);

                        \Stripe\Stripe::setApiKey($user_data3->stripe_access_token);

                        $subscription = \Stripe\Subscription::retrieve($user_data1['subscription_id']);

                        $subscription->cancel();

                    }

                    if ($data['invoice_data']['save_status'] == '2') {

                        $addition_email = $data['invoice_data']['additional_email'];

                        $data['to']     = $data['invoice_data']['email'];

                        $data['cc']     = $addition_email;

                        _mail($data);

                    }



                    Invoice::where('id', $id)->update([

                        'save_status' => '4',

                        'view_status' => '0',

                        'invoice_url' => $invoiceUrl

                    ]);

                }

            }

            User::where('id', $userId)->update(['Status' => 'Subscription_cancel']);

            UserBillings::where('user_id', '=', $userId)->delete();

        }

    }

}

