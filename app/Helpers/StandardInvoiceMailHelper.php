<?php

namespace App\Helpers;

use App\Model\Invoice;
use App\Model\User;
use App\Model\InvoiceItem;
use Illuminate\Support\Facades\Session;
use App\Model\State;

/**
 * Helper class for sending emails for invoice type standard.
 *
 * Class StandardInvoiceMailHelper
 * @package App\Helpers
 */
class StandardInvoiceMailHelper {

    /**
     * Send Email when saving standard invoice.
     *
     * @since 1.0.1
     *
     * @param $data
     */
    public static function sendSaveEmail($data)
    {
        $profileInfo          = User::where('id', $data['user_id'])->first();
        $invoiceData          = Invoice::where('id', '=', $data['last_id'])->first();
        $item                 = InvoiceItem::where('invoice_id', '=', $data['last_id'])->get();
        $data['invoice_data'] = $invoiceData;

        if (trim($invoiceData->additional_email) != '') {
            $additionEmail = $invoiceData->email . ',' . $invoiceData->additional_email;
        } else {
            $additionEmail = $invoiceData->email;
        }

        Session::flash('email_send', $additionEmail);

        $additionEmail               = explode(',', $additionEmail);
        $dataToEmail['profile_info'] = $profileInfo;

        if ($data['payment_method'] == 'paypal') {
            $dataToEmail['paypalurl'] = $data['paypal_conf']['paypal_invoice_link'] . $data['invoice_url'];
        } else {
            $dataToEmail['paypalurl'] = url('') . '/pay/' . $data['invoice_url'];
        }
	
        $dataToEmail['paypalurl'] = url('') . '/pay/' . $data['invoice_url'];
        $dataToEmail['invoice_data'] = $invoiceData;
        $dataToEmail['to']           = $invoiceData->email;
        $dataToEmail['subject']      = 'New Invoice from ' . $profileInfo->company;
        $dataToEmail['body']         = view('emails.invoice', compact('data'));
        $dataToEmail['sender']       = env('NO_REPLY_EMAIL', 'noreply@invoyce.me');
        $dataToEmail['cc']           = $invoiceData->additional_email;

        $dataToEmailSecond['to']      = $profileInfo->email;
        $dataToEmailSecond['subject'] = 'Invoice Sent to ' . $profileInfo->company;
        $dataToEmailSecond['body']    = view('emails.invoice_user', compact('data'));
        $dataToEmailSecond['sender']  = env('NO_REPLY_EMAIL', 'noreply@invoyce.me');
        //_mail($data);
        _mail($dataToEmailSecond);
    }

    /**
     * Send email when updating standard invoice.
     *
     * @since 1.0.1
     *
     * @param $data
     */
    public static function sendUpdateEmail($data)
    {
        $editId              = $data['editId'];
        $preStatus           = $data['pre_status'];
        $emailData['state']  = State::get();
        $emailData['item']   = InvoiceItem::where('invoice_id', '=', $data['edit_id'])->get();
        $emailData['status'] = 'block';
        if ($data['save_status'] == '0') {
            Session::flash('success', 'Invoice has been updated successfully.');
            $sql = Invoice::where('id', $editId)->update(['save_status' => '2', 'view_status' => '0']);
            //Mail Send
            $emailData['profile_info'] = User::where('id', '=', $data['user_id'])->first();
            $emailData['invoice_data'] = Invoice::where('id', '=', $editId)->first();
            $emailData['item']         = InvoiceItem::where('invoice_id', '=', $editId)->get();
            $emailData['paypalurl']    = url('') . '/pay/' . $data['invoice_url'];

            /*if(trim($data['invoice_data']->additional_email)!='')
            {
                $addition_email=$data['invoice_data']->email.','.$data['invoice_data']->additional_email;
            }else
            {
                $addition_email=$data['invoice_data']->email;
            }
             $addition_email = explode(',', $addition_email);*/
            if ($preStatus->save_status == '1') {
                $emailData['subject'] = 'New Invoice from ' . $emailData['profile_info']->company;
                $emailData['body']    = view('emails.invoice', compact('emailData'));
            } else {
                $emailData['subject'] = 'Invoice Updated';
                $emailData['body']    = view('emails.edited', compact('emailData'));
            }
            $emailData['to']     = $data['email'];
            $emailData['sender'] = env('NO_REPLY_EMAIL', 'noreply@invoyce.me');
            $emailData['cc']     = $data['additional_email'];

            if ($data['payment_method'] == 'paypal') {
            } else {
                _mail($data);
            }

            return $emailData['item'];
        } else {
            Session::flash('save', 'Invoice has been save successfully.');
        }
    }
}
