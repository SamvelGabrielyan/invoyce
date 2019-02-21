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


use View, HTML, Validator, Session, Input, Redirect, Auth, URL, Hash, Uuid;

class InvoiceController extends Controller
{
    const STATUS_SAVE_MODE     = '1';
    const VIEW_STATUS_NOT_VIEW = '0';

    public function __construct()
    {
        parent::__construct();
    }

    function paymentGateway()
    {

        $paypalurl = new \App\Http\Controllers\PaypalController();

        if (isset($_GET['code'])) {
            $paypalaccesstoken = $paypalurl->getaccesstoken($_GET['code']);

            return redirect()->to(url()->current());
        }

        $paypalurl = $paypalurl->invoiceconsentcheck();

        return view('dashboard.paymentgateway')->with(['paypalloginurl' => $paypalurl]);
    }

    /**
     * Choose invoice page.
     *
     * @since 1.0.1
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function invoices()
    {
        return view('dashboard.invoices.choose');
    }

    /**
     * List all Invoices.
     *
     * @since 1.0.1
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function allInvoice(Request $request)
    {
        if ($request->input('start') != '') {
            list($month, $day, $year) = preg_split('/\//', $request->input('start'));
            $start = $year . '-' . $month . '-' . $day;

            list($month, $day, $year) = preg_split('/\//', $request->input('end'));
            $end = $year . '-' . $month . '-' . $day;

            $allInvoice = Invoice::where('user_id', Auth::user()->id)
                ->where('save_status', '!=', '1')
                ->whereBetween('send_invoice_date', array($start, $end))
                ->orderBy('id', 'desc')->get();
        } else {
            $allInvoice = Invoice::where('user_id', Auth::user()->id)
                ->where('save_status', '!=', '1')
                ->orderBy('id', 'desc')
                ->paginate(20);
        }
        return view('dashboard.invoices.invoices', compact('allInvoice'));
    }

    /**
     * Standard Invoice page.
     *
     * @since 1.0.1
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function standardInvoice() {		
        $data['profile_info'] = Auth::user();
        $data['state']        = State::get();
        $invoice              = Invoice::orderBy('id', 'desc')->first();
        $id                   = 1;
        $randomNumber         = mt_rand(100000, 999999);

        if (count($invoice) > 0) {
            $no              = $invoice->id + 1;
            $data['rand_no'] = $randomNumber . $no;
        } else {
            $data['rand_no'] = $randomNumber . $id;
        }

        return view('dashboard.invoices.standard-invoice', compact('data'));
    }

    /**
     * Scheduled Invoice page
     *
     * @since 1.0.1
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function scheduledInvoice()
    {
        $data['profile_info'] = Auth::user();
        $data['state']        = State::get();
        $invoice              = Invoice::orderBy('id', 'desc')->first();
        $id                   = 1;
        $randomNumber         = mt_rand(100000, 999999);

        if (count($invoice) > 0) {
            $no              = $invoice->id + 1;
            $data['rand_no'] = $randomNumber . $no;
        } else {
            $data['rand_no'] = $randomNumber . $id;
        }

        return view('dashboard.invoices.scheduled-invoice', compact('data'));
    }

    /**
     * Recurring Invoice page
     *
     * @since 1.0.1
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function recurringInvoice()
    {
        $data['profile_info'] = Auth::user();
        $data['state']        = State::get();
        $invoice              = Invoice::orderBy('id', 'desc')->first();
        $id                   = 1;
        $randomNumber         = mt_rand(100000, 999999);

        if (count($invoice) > 0) {
            $no              = $invoice->id + 1;
            $data['rand_no'] = $randomNumber . $no;
        } else {
            $data['rand_no'] = $randomNumber . $id;
        }

        return view('dashboard.invoices.recurring-invoice', compact('data'));
    }

    /**
     * Subscription Invoice page.
     *
     * @since 1.0.1
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function subscriptionInvoice()
    {
        $data['profile_info'] = Auth::user();
        $data['state']        = State::get();
        $invoice              = Invoice::orderBy('id', 'desc')->first();
        $id                   = 1;
        $randomNumber         = mt_rand(100000, 999999);

        if (count($invoice) > 0) {
            $no              = $invoice->id + 1;
            $data['rand_no'] = $randomNumber . $no;
        } else {
            $data['rand_no'] = $randomNumber . $id;
        }

        return view('dashboard.invoices.subscription-invoice', compact('data'));
    }

    /**
     * Saved Invoice List page.
     *
     * @since 1.0.1
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function saveAllInvoice(Request $request){		
        if ($request->input('start') != '') {
            list($month, $day, $year) = preg_split('/\//', $request->input('start'));
            $start                    = $year. '-' . $month. '-' . $day;

            list($month, $day, $year) = preg_split('/\//', $request->input('end'));
            $end                      = $year . '-' . $month. '-' . $day;

            $data['allInvoices'] = Invoice::where('user_id', Auth::user()->id)
                ->where('save_status', '=', '1')
                ->whereBetween('send_invoice_date', [$start, $end])
                ->orderBy('id', 'desc')
                ->paginate(20);
        } else {
            $data['allInvoices'] = Invoice::where('user_id', Auth::user()->id)
                ->where('save_status', '=', '1')
                ->orderBy('id', 'desc')
                ->paginate(20);
        }

        return view('dashboard.invoices.saved-invoices', compact('data'));
    }

    /**
     * Preview/View Invoice based on invoice Id.
     *
     * @since 1.0.1
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function preview($id)
    {
        $data['invoice_data'] = Invoice::where('user_id', '=', Auth::user()->id)
            ->where('id', $id)
            ->first();
        $data['profile_info'] = Auth::user();
        $data['item']         = InvoiceItem::where('invoice_id', '=', $id)->get();

        return view('dashboard.invoices.preview', compact('data'));
    }

    /**
     * Get Invoice URL.
     *
     * @param $id
     * @return string
     */
    public function getInvoiceUrl($id)
    {
        $invoice_data = Invoice::where('id', $id)->first();

        if ($invoice_data != '') {
            $base_url = url('/');

            return $base_url . '/pay/' . $invoice_data->invoice_url;
        } else {
            return Redirect::to(route('index'));
        }
    }

    /**
     * Invoice Cancellation
     *
     * @since 1.0.1
     *
     * @uses InvoiceController::getRedirectUrl()
     *
     * @param $id
     * @param $type
     * @return mixed
     */
    public function cancelInvoice($id, $type)
    {
        $invoices             = Invoice::where('id', '=', $id)->first();
        $user                 = User::where('id', '=', $invoices->user_id)->first();
        $data['invoice_data'] = Invoice::where('user_id', '=', Auth::user()->id)
            ->where('id', '=', $id)
            ->first();

        if ($data['invoice_data']->id != '') {
            $rand                 = rand(0, 1000);
            $invoiceUrl           = md5($rand . '@@@@@' . $id);
            $data['profile_info'] = Auth::user();
            // $data['to'] = $profile_info->email;
            $data['subject']      = 'Cancelled Invoice';
            $data['body']         = View::make('emails.cancelled', compact('data'))->render();
            $data['sender']       = env('NO_REPLY_EMAIL');

            if (!empty($invoices['subscription_id'])) {
                require app_path('Components/stripe/init.php');
                //debug($user_data3,1);
                \Stripe\Stripe::setApiKey($user->stripe_access_token);
                $subscription = \Stripe\Subscription::retrieve($invoices['subscription_id']);
                $subscription->cancel();
            }
            if ($data['invoice_data']->save_status == '2') {
                /*if(trim($data['invoice_data']->additional_email)!=''){
                $addition_email = $data['invoice_data']->email.','.$data['invoice_data']->additional_email;
                }else{
                $addition_email=$data['invoice_data']->email;
                }*/
                $addition_email = $data['invoice_data']->additional_email;
                //$addition_email = explode(',', $addition_email);
                $data['to'] = $data['invoice_data']->email;
                $data['cc'] = $addition_email;

                _mail($data);
                /*foreach ($addition_email as $email) {
                $data['to'] = $email;
                _mail($data);
                }*/
            }

            Invoice::where('id', $id)
                ->update([
                    'save_status' => '4',
                    'view_status' => '0',
                    'invoice_url' => $invoiceUrl
                ]);

            Session::flash('success_cancel', 'block');
            //  return view('dashboard/invoices/saved-invoices',compact('allinvoice'));
        } else {
            return Redirect::to(route('login'));
        }

        $redirectTo = $this->getRedirectRoute($type);

        return Redirect::to(route($redirectTo));
    }

    /**
     * Returning redirect route name based on invoice type.
     *
     * @since 1.0.1
     *
     * @internal
     * @used-by InvoiceController::cancelInvoice()
     *
     * @param $type
     * @return string
     */
    private function getRedirectRoute($type)
    {
        switch ($type) {
            case '1':
                return 'dashboard';
                break;
            case '2':
                return 'standardInvoicesList';
                break;
            case '3':
                return 'scheduledInvoicesList';
                break;
            case '4':
                return 'subscriptionInvoicesList';
                break;
            default:
                return 'allInvoice';
        }
    }

    /**
     * Send Reminder email
     *
     * @since 1.0.1
     *
     * @uses InvoiceController::getRedirectUrl()
     *
     * @param $id
     * @param $type
     * @return mixed
     */
    public function sendReminderMail($id, $type)
    {
        $user    = Auth::user();
        $invoice = Invoice::where('id', '=', $id)
            ->where('user_id', '=', $user->id)
            ->first();

        Invoice::where('id', $id)->update(['view_status' => '0']);

        if (count($invoice) > 0) {
            $item = InvoiceItem::where('invoice_id', '=', $id)->get();

            if (trim($invoice->additional_email) != '') {
                $additionEmail = $invoice->email . ',' . $invoice->additional_email;
            } else {
                $additionEmail = $invoice->email;
            }

            $additionEmail        = explode(',', $additionEmail);
            $data['profile_info'] = $user;
            $data['invoice_data'] = $invoice;
            $data['to']           = $invoice->email;
            $data['subject']      = 'Pending Invoice Reminder';
            $data['body']         = View::make('emails.reminder', compact('data'))->render();
            $data['sender']       = 'noreply@invoyce.me';
            $data['cc']           = $invoice->additional_email;
            _mail($data);

            Session::flash('valid', 'block');

            $redirectTo = $this->getRedirectRoute($type);

            return Redirect::to(route($redirectTo));
        } else {
            return Redirect::to(route('login'));
        }

    }

    /**
     * Duplicate Invoice.
     *
     * @since 1.0.1
     *
     * @uses InvoiceController::getUpdateInvoiceBackRoute()
     *
     * @param $id
     * @return mixed
     */
    public function duplicate($id)
    {
        $item       = '';
        $addDate    = date("Y-m-d");
        $invoice    = Invoice::where('id', '=', $id)->first();
        $item       = InvoiceItem::where('invoice_id', '=', $id)->get();
        $saveStatus = self::STATUS_SAVE_MODE;
        $lastId     = Invoice::insertGetId([
            'invoice_url'         => '',
            'schedule_type'       => $invoice->schedule_type,
            'save_status'         => $saveStatus,
            'send_invoice_date'   => $invoice->send_invoice_date,
            'send_invoice_days'   => $invoice->send_invoice_days,
            'user_id'             => $invoice->user_id,
            'notification_status' => $invoice->notification_status,
            'company_name'        => $invoice->company_name,
            'email'               => $invoice->email,
            'additional_email'    => $invoice->additional_email,
            'address'             => $invoice->address,
            'city'                => $invoice->city,
            'state'               => $invoice->state,
            'zip_code'            => $invoice->zip_code,
            'phone'               => $invoice->phone,
            'invoice_title'       => $invoice->invoice_title,
            'invoice_number'      => $invoice->invoice_number,
            'invoice_message'     => $invoice->invoice_message,
            'terms_conditions'    => $invoice->terms_conditions,
            'invoice_type'        => $invoice->invoice_type,
            'total_amount'        => $invoice->total_amount,
            'view_status'         => self::VIEW_STATUS_NOT_VIEW,
            'add_date'            => $addDate
        ]);

        if ($lastId != '') {
            $rand         = rand(0, 1000);
            $invoiceUrl   = md5($rand . '@@@@@' . $lastId);
            $randomNumber = mt_rand(100000, 999999);

            if ($lastId != '') {
                $no     = $lastId;
                $randNo = $randomNumber . $no;
            }

            $sql = Invoice::where('id', $lastId)
                ->update([
                    'invoice_url'    => $invoiceUrl,
                    'invoice_number' => $randNo
                ]);

            if ($item != '') {
                foreach ($item as $itemValue) {
                    if ($itemValue->id != '') {
                        $insert = InvoiceItem::insertGetId([
                            'invoice_id'    => $lastId,
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

        $redirectTo = $this->getUpdateInvoiceBackRoute($invoice->invoice_type);

        return Redirect::to(route($redirectTo, $lastId));
    }

    /**
     * Returning redirect route name after duplicating invoice.
     *
     * @internal
     *
     * @used-by InvoiceController::duplicate()
     *
     * @param $type
     * @return string
     */
    private function getUpdateInvoiceBackRoute($type)
    {
        switch ($type) {
            case 1:
                return 'updateStandardInvoice';
                break;
            case 2:
                return 'updateScheduledInvoice';
                break;
            case 3:
                return 'updateSubscriptionInvoice';
                break;
        }
    }

    /**
     * Delete Invoice based on Id.
     *
     * @since 1.0.1
     *
     * @param $id
     * @return mixed
     */
    public function deleteInvoice($id)
    {
        $allinvoice = Invoice::where('user_id', Auth::user()->id)
            ->where('save_status', '=', '1')
            ->orderBy('id', 'desc')
            ->get();
        $invoices = Invoice::where('user_id', Auth::user()->id)
            ->where('id', '=', $id)
            ->first();

        if ($invoices->id != '') {
            Invoice::where('id', '=', $id)
                ->where('user_id', Auth::user()->id)
                ->delete();
            InvoiceItem::where('invoice_id', $id)->delete();

            Session::flash('success', 'block');
            //  return view('dashboard/invoices/saved-invoices',compact('allinvoice'));
            return Redirect::to(route('saveAllInvoice'));
        } else {
            //return view('dashboard/invoices/saved-invoices',compact('allinvoice'));
            return Redirect::to(route('saveAllInvoice'));

        }
    }

    /**
     * Mark invoice as paid.
     *
     * @since 1.0.1
     *
     * @uses InvoiceController::getRouteAfterMarkingPaid()
     *
     * @return mixed
     */
    public function standardInvoiceAsPaid()
    {
        //$request->input('id');
        $id       = input::get('id');
        $markPaid = input::get('mark_paid');
        $invoice  = Invoice::where('id', '=', $id)->first();
        $userData = User::where('id', '=', $invoice->user_id)->first();
        $data['invoice_data'] = Invoice::where('user_id', '=', Auth::user()->id)
            ->where('id', '=', $id)
            ->first();
        $type = $data['invoice_data']->invoice_type;

        if ($data['invoice_data']->id != '') {
            $rand                 = rand(0, 1000);
            $invoiceUrl           = md5($rand . '@@@@@' . $id);
            $data['profile_info'] = Auth::user();
            $item                 = InvoiceItem::where('invoice_id', '=', $id)->get();
            // $data['to'] = $profile_info->email;
            $data['subject']      = 'Paid Invoice';
            $data2['subject']     = 'Paid Invoice Receipt';
            $data['body']         = View::make('emails.mark_paid', compact('data'))->render();
            $data2['body']        = View::make('emails.mark_paid_receipt', [
                'invoice_data' => $data['invoice_data'],
                'item'         => $item,
                'profile_info' => $data['profile_info']
            ])->render();

            $data['sender']  = env('NO_REPLY_EMAIL');
            $data2['sender'] = env('NO_REPLY_EMAIL');

            if ($data['invoice_data']->save_status == '2') {
                $data['to']     = $data['profile_info']->email;
                $addition_email = $data['invoice_data']->additional_email;
                $data2['to']    = $data['invoice_data']->email;
                $data2['cc']    = $addition_email;

                _mail($data);
                _mail($data2);
                /*foreach ($addition_email as $email) {
                $data['to'] = $email;
                _mail($data);
                }*/
            }
            $sql = Invoice::where('id', $id)
                ->update([
                    'add_date'    => date("Y-m-d"),
                    'save_status' => '3',
                    'view_status' => '1',
                    'paid_note'   => $markPaid
                ]);

            Session::flash('success', 'block');
        } else {
            return Redirect::to(route('login'));
        }

        $redirectTo = $this->getRouteAfterMarkingPaid($type);

        return Redirect::to(route($redirectTo));
    }

    /**
     * Getting route name after marking invoice as paid.
     *
     * @since 1.0.1
     *
     * @internal
     * @used-by InvoiceController::standardInvoiceAsPaid()
     *
     * @param $type
     * @return string
     */
    private function getRouteAfterMarkingPaid($type)
    {
        switch ($type) {
            case '1':
                return 'standardInvoicesList';
                break;
            case '2':
                return 'scheduledInvoicesList';
                break;
            case '3':
                return 'subscriptionInvoicesList';
            default:
                return 'allInvoice';
        }
    }
}
