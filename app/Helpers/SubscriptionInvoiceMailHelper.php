<?php

namespace App\Helpers;

use App\Model\Invoice;
use App\Model\User;
use App\Model\InvoiceItem;
use Illuminate\Support\Facades\Session;
use Auth;
use App\Model\State;

class SubscriptionInvoiceMailHelper {

    public static function sendSaveEmail($data)
    {
        $profileInfo          = User::where('id', Auth::user()->id)->first();
        $invoiceData          = Invoice::where('id', '=', $data['inserted_id'])->first();
        $item                 = InvoiceItem::where('invoice_id', '=', $data['inserted_id'])->get();
        $invoiceUrl           = $data['invoice_url'];
        $data['last_id']      = $data['inserted_id'];
        $data['invoice_data'] = $invoiceData;
		
        if (trim($data['invoice_data']->additional_email) != '') {
            $additionEmail = $invoiceData . ',' . $invoiceData->additional_email;
        } else {
            $additionEmail = $invoiceData->email;
        }

        $data['profile_info'] = $profileInfo;
        $data['invoice_data'] = $invoiceData;

        Session::flash('email', $additionEmail);
        # Invoice payment
        $paymentMethod = $data['payment_method'];
        $additionEmail = explode(',', $additionEmail);
        $data['to']    = $invoiceData->email;
        $payPalConf    = \Config::get('paypal');

        if ($paymentMethod == 'paypal') {
            $data['paypalurl'] = $payPalConf['paypal_invoice_link'] . $invoiceUrl;

        } else {
            $data['paypalurl'] = url('') . '/pay/' . $invoiceUrl;
        }
        
        $dataToEmail['paypalurl'] = url('') . '/pay/' . $invoiceUrl;
        $dataToEmail['subject']   = 'New Invoice from ' . $data['invoice_data']->company_name;
        $dataToEmail['body']      = view('emails.invoice', compact('data'));
        $dataToEmail['sender']    = env('NO_REPLY_EMAIL', 'noreply@invoyce.me');
        $dataToEmail['cc']        = $invoiceData->addition_email;

        $dataToEmailSecond['to']      = $profileInfo->email;
        $dataToEmailSecond['subject'] = 'Invoice Sent to ' . $data['invoice_data']->company_name;
        $dataToEmailSecond['body']    = view('emails.invoice_user', compact('data'));
        $dataToEmailSecond['sender']  = env('NO_REPLY_EMAIL', 'noreply@invoyce.me');

        _mail($dataToEmail);
        _mail($dataToEmailSecond);
    }

    public static function sendUpdateEmail($data)
    {
        $data['state']  = State::get();
        $data['item']   = InvoiceItem::where('invoice_id', '=', $data['edit_id'])->get();
        $data['status'] = 'block';
        if ($data['save_status'] == '0') {
            $invoiceUrl = CommonHelper::makeUrl($data['edit_id']);
            Invoice::where('id', $data['edit_id'])->update([
                'invoice_url' => $invoiceUrl,
                'view_status' => '0',
                'save_status' => '2'
            ]);

            $data['profile_info'] = User::where('id', '=', Auth::user()->id)->first();
            $data['invoice_data'] = Invoice::where('id', $data['edit_id'])->first();
            $data['item']         = InvoiceItem::where('invoice_id', $data['edit_id'])->get();

            if (trim($data['invoice_data']->additional_email) != '') {
                $additionEmail = $data['invoice_data']->email . ',' . $data['invoice_data']->additional_email;
            } else {
                $additionEmail = $data['invoice_data']->email;
            }

            $addition_email  = explode(',', $additionEmail);
            $data['to']      = $data['invoice_data']->email;
            $data['subject'] = 'New Invoice from ' . $data['profile_info']->company;
            $data['body']    = view('emails.invoice', compact('data'));
            $data['sender']  = env('NO_REPLY_EMAIL', 'noreply@invoyce.me');
            $data['cc']      = $data['invoice_data']->additional_email;

            _mail($data);

            Session::flash('success', 'block');

            return $data['item'];
        } else if ($data['save_status'] == '2') {
            Session::flash('send', 'block');
        } else {
            Session::flash('save', 'block');
        }
    }
}
