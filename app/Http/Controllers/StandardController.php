<?php



namespace App\Http\Controllers;



use App\Helpers\CommonHelper;

use App\Helpers\StandardInvoiceMailHelper;

use Illuminate\Http\Request;

use App\Model\User;

use App\Model\UserBillings;

use App\Model\Invoice;

use App\Model\InvoiceItem;

use App\Model\State;

use App\Model\Paypal;

use Cartalyst\Stripe\Stripe;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Mail\Mailer;



use View, HTML, Validator, Session, Input, Redirect, Auth, URL, Hash, Uuid;

use App\Http\Controllers\Paypal as pay;



class StandardController extends Controller

{

    public $_api_context;



    public function __construct()

    {

        parent::__construct();

    }



    const STANDARD_INVOICE_TYPE                  = '1';

    const STANDARD_INVOICE_SAVE_STATUS_SAVE_MODE = '1';



    /**

     * Edit Standard Invoice page.

     *

     * @since 1.0.1

     *

     * @param $id

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function updateStandardInvoice($id)

    {

        $data['invoice_data'] = Invoice::where('user_id', '=', Auth::User()->id)

            ->where('id', '=', $id)

            ->first();

        $data['state'] = State::get();

        $data['item']  = InvoiceItem::where('invoice_id', '=', $id)->get();

        //$data['paymentmethod'] =Paypal::where()

        $data['status'] = 'none';



        return view('dashboard.invoices.update-standard-invoice', compact('data'));

    }



    /**

     * List all Standard invoices.

     *

     * @since 1.0.1

     *

     * @param Request $request

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function standardInvoicesList(Request $request)

    {

        $filter_type = $request->filter_type;

        $query       = Invoice::where('user_id', Auth::user()->id)

            ->where('invoice_type', '=', self::STANDARD_INVOICE_TYPE)

            ->where('save_status', '!=', self::STANDARD_INVOICE_SAVE_STATUS_SAVE_MODE)
            ->orderby('id', 'desc');

        $data['sort_by'] = '';



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



        return view('dashboard.invoices.standard-invoices-list', compact('data'));



    }



    /**

     * Save standard invoice.

     *

     * @since 1.0.1

     *

     * @param Request $request

     * @return mixed

     */

    public function standardInvoiceSave(Request $request)

    {	
		
        # Check which payment gateway selected.		
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

        $totalInvoice  = $request->input('totalInvoice') ?? '1';

        $saveStatus    = $request->input('save_status') ?? '0';

        $invoice       = new Invoice();

        $lastId        = $invoice->storeInvoice($request, null);



        if ($lastId != '') {

            $invoiceItem    = new InvoiceItem();

            $itemsPayAmount = $invoiceItem->invoiceItemStoreOrUpdate($request, $totalInvoice, $lastId, 'store');

        }



        if ($paymentMethod == 'paypal'){

            $invoice    = $this->invoicePayment($lastId, $request, $itemsPayAmount);

            $payPalConf = \Config::get('paypal');

            $invoiceUrl = $invoice['invoice_id'];

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
                
                $item_disc_type=$request->input('item_dis_'.$i);
                
                $item_with_qty=$item_rate*$item_qty;
                
                if($item_disc_type=="no"){                    
                    $item_desc=$item_discount*$item_qty;     //200                 
                    $less_discount=$item_with_qty-$item_desc;
                    $unit_amt=$less_discount/$item_qty;                    
                } else{
                    $less_discount=$item_with_qty-$item_discount;
                    $unit_amt=$less_discount/$item_qty;                     
                }
                
                //echo $unit_amt; die();

                    $invoiceItem = $stripe->invoiceItems()->create($customer['id'], [

                        'currency' => 'USD',

                        'quantity' => $item_qty,

                        //'unit_amount' => (($item_rate - $item_discount) * 100),
                        'unit_amount' => $unit_amt*100,

                        'description' => $item_name . ' (' . $item_description . ')'

                    ]);

            }

            $invoice = $stripe->invoices()->create($customer['id'], [

                'billing' => 'send_invoice',

                'days_until_due' => 1,

                'description' => $invoice_message

            ]);
            
            $invoiceUrl = $invoice['id'];

        } else {

            $invoiceUrl = CommonHelper::makeUrl($lastId);

        }

		
        Invoice::where('id', $lastId)->update([
            'total_amount' => $itemsPayAmount,
            'invoice_url'  => $invoiceUrl,
            'stripe_cid' => $customer['id'],
            'stripe_invoice_id' => $invoice['id'],
        ]);

        //Session::flash('success', 'Invoice has been sent successfully.');



        Session::flash('email_send', '');

        Session::flash('pay_amount', $itemsPayAmount);
		
        if ($saveStatus == '0') {

            Session::flash('success', 'block');

            Invoice::where('id', $lastId)->update([

                'save_status' => '2',

                'paid_note'   => $paymentMethod

            ]);

            //Mail Send

            $emailData = [

                'user_id'        => $userId,

                'last_id'        => $lastId,

                'paypal_conf'    => $payPalConf,

                'payment_method' => $paymentMethod,

                'invoice_url'    => $invoiceUrl,

            ];

			
		
            StandardInvoiceMailHelper::sendSaveEmail($emailData);

        } else {

            Session::flash('save', 'block');

        }

        return Redirect::to(route('standardInvoice'));



    }



    /**

     * Update Standard invoice.

     *

     * @since 1.0.1

     *

     * @param Request $request

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function standardInvoiceUpdate(Request $request)

    {

        $invoice      = new Invoice();

        $userId       = Auth::user()->id;

        $editId       = $request->input('edit_id');

        $totalInvoice = $request->totalInvoice ?? '1';

        $saveStatus   = $request->save_status ?? '0';

        $preStatus    = Invoice::where('id', '=', $editId)->first();

        $updateId     = $invoice->updateInvoice($request, null, 'standard');

        if ($editId != '') {

            $invoiceItem    = new InvoiceItem();

            $itemsPayAmount = $invoiceItem->invoiceItemStoreOrUpdate($request, $totalInvoice, $editId, 'edit');

        }

        $paymentMethod = $request->input('paymentmethod');

        # Check if payPal invoice has been created.

        if ($paymentMethod == 'paypal') {

            $invoice    = $this->invoicePayment($editId, $request, $itemsPayAmount);

            $paypalConf = \Config::get('paypal');

            $invoiceUrl = $invoice['invoice_id'];

        }elseif ($paymentmethod == 'stripe') {
             $stripe = new Stripe(Auth::user()->stripe_access_token, '2018-08-23');

            if($preStatus->stripe_invoice_id){
                $customer['id'] = $preStatus->stripe_cid;
                $stripe_invoice = $stripe->invoices()->find($preStatus->stripe_invoice_id);
                foreach ($stripe_invoice['lines']['data'] as $line_item) {
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
                $stripe->invoices()->update($preStatus->stripe_invoice_id, [
                    'closed' => true,
                ]);
                
                $sinvoice = $stripe->invoices()->create($customer['id']);
            }
        } else {

            $invoiceUrl = CommonHelper::makeUrl($editId);

        }



        Invoice::where('id', $editId)

            ->update([

                'total_amount' => $itemsPayAmount,

                'invoice_url'  => $invoiceUrl,

                'stripe_invoice_id' => $sinvoice['id']

            ]);

        //Session::flash('success', 'Invoice has been updated successfully.');

        $invoiceData = Invoice::where('user_id', '=', $userId)

            ->where('id', '=', $editId)

            ->first();

        if ($invoiceData->id != '') {

            $emailData = [

                'save_status'      => $saveStatus,

                'edit_id'          => $editId,

                'invoice_url'      => $invoiceUrl,

                'user_id'          => $userId,

                'pre_status'       => $preStatus,

                'payment_method'   => $paymentMethod,

                'email'            => $request->input('email'),

                'additional_email' => $request->additional_email

            ];



            $data['item']         = StandardInvoiceMailHelper::sendUpdateEmail($emailData);

            $data['status']       = 'block';

            $data['invoice_data'] = $preStatus;



            return view('dashboard.invoices.update-standard-invoice', compact('data'));

        }

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

            $request['type'] = 'st';

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

}

