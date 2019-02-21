<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Model\User, App\Model\UserBillings, App\Model\Invoice, App\Model\State, App\Model\InvoiceItem, App\Model\PaymentSetting, App\Model\InvoiceBilling;
use App\Http\Controllers\Controller;


use View, HTML, Validator, Session, Input, Redirect, Auth, URL, Hash, Uuid;

class InvoiceReportController extends Controller
{
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
     * Show all Invoices
     *
     * @since 1.0.1
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reports(Request $request)
    {
        $data['all_invoices'] = '';
        $query                = Invoice::where('user_id', Auth::user()->id);
        $data['sort_by']      = '';

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
            $query->whereBetween('send_invoice_date', [$dates['start'], $dates['end']]);
        }

        $query->orderBy('send_invoice_date', 'desc');

        $data['all_invoices'] = $query->get();

        return view('dashboard.reports.reports', compact('data'));
    }
}