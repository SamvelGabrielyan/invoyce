<?php

namespace App\Helpers;

use App\Model\Invoice;
use App\Model\User;
use App\Model\InvoiceItem;
use Illuminate\Support\Facades\Session;
use Auth;

/**
 * Helper class for sending email for invoice type scheduled.
 *
 * Class ScheduledInvoiceMailHelper
 * @package App\Helpers
 */
class ScheduledInvoiceMailHelper {

    /**
     * Send email when saving scheduled invoice.
     *
     * @since 1.0.1
     *
     * @param $data
     */
    public static function sendEmail($data)
    {
        $invoiceData = Invoice::where('id', '=', $data['invoice_id'])->first();
        $profileInfo = User::where('id', '=', Auth::user()->id)->first();
        $data['last_id']      = $data['invoice_id'];
        $data['invoice_data'] = $invoiceData;

        if (trim($invoiceData->additional_email) != '') {
            $additionEmail = $invoiceData->email . ',' . $invoiceData->additional_email;
        } else {
            $additionEmail = $invoiceData->email;
        }

        $dataToEmail['item'] = InvoiceItem::where('invoice_id', '=', $data['invoice_id'])->get();

        Session::flash('email', $additionEmail);
        $additionEmail = explode(',', $additionEmail);

        if ($data['payment_method'] == 'paypal') {
            $data['paypalurl'] = $data['pay_pal_config']['paypal_invoice_link'] . $data['invoice_url'];
        } else {
            $data['paypalurl'] = url('') . '/pay/' . $data['invoice_url'];
        }
        
        
        $dataToEmail['profile_info'] = $profileInfo;
        $dataToEmail['invoice_data'] = $invoiceData;
        $dataToEmail['to']           = $invoiceData->email;
        $dataToEmail['subject']      = 'New Invoice from ' . $data['invoice_data']->company_name;
        $dataToEmail['body']         = view('emails.invoice', compact('data'));
        $dataToEmail['sender']       = env('NO_REPLY_EMAIL', 'noreply@invoyce.me');
        $dataToEmail['cc']           = $invoiceData->addition_email;

        $dataToEmailSecond['to']      = $profileInfo->email;
        $dataToEmailSecond['subject'] = 'Invoice Sent to ' . $data['invoice_data']->company_name;
        $dataToEmailSecond['body']    = view('emails.invoice_user', compact('data'));
        $dataToEmailSecond['sender']  = env('NO_REPLY_EMAIL', 'noreply@invoyce.me');
        if ($data['payment_method'] == 'paypal'){

        } else{
            _mail($dataToEmail);
        }

        _mail($dataToEmailSecond);
    }

    /**
     * Send email when updating scheduled invoice.
     *
     * @since 1.0.1
     *
     * @param $data
     */
    public static function sendUpdateEmail($data)
    {
        $invoiceData = $data['invoice_data'];
        if ($invoiceData->id != '') {
            $profileInfo = User::where('id', '=', Auth::user()->id)->first();
            $item        = InvoiceItem::where('invoice_id', '=', $data['edit_id'])->get();

            $dataToEmail['item']         = $item;
            $dataToEmail['profile_info'] = $profileInfo;
            $dataToEmail['invoice_data'] = $invoiceData;
            $dataToEmail['to']           = $data['email'];
            $dataToEmail['subject']      = 'Invoice Updated';
            $dataToEmail['body']         = view('emails.edited', compact('data'));
            $dataToEmail['sender']       = env('NO_REPLY_EMAIL', 'noreply@invoyce.me');
            $dataToEmail['paypalurl']    = url('') . '/pay/' . $data['invoice_url'];
            $dataToEmail['cc']           = $data['additional_email'];

            if ($data['payment_method'] == 'paypal') {}
            else {
                _mail($data);
            }

            _mail($data);

            return $dataToEmail['item'];
        }
    }
}
