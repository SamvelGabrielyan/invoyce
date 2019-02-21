<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Invoice;

use Auth;

class InvoiceSearchController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Perform global search for invoices.
     *
     * @since 1.0.1
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchInvoice(Request $request)
    {
        if ($request->ajax()) {
            $response = [];
            $invoices = Invoice::where('user_id', Auth::user()->id)
                ->where(function ($query) use ($request) {
                    $query->where('invoice_title', 'like', '%' . $request->search . '%')
                        ->orWhere('email', 'like', '%' . $request->search . '%')
                        ->orWhere('invoice_name', 'like', '%' . $request->search . '%')
                        ->orWhere('phone', 'like', '%' . $request->search . '%');
                })->get();

            if ($invoices->count() !== 0) {
                $baseUrl = url('/');

                foreach ($invoices as $key => $invoice) {
                    $date = date('M d Y', strtotime($invoice->send_invoice_date));
                    if ($invoice->save_status == '3') {
                        $paidStatus = 'PAID';
                    } else {
                        $paidStatus = 'UNPAID';
                    }

                    $response[] = [
                        'base_url'      => $baseUrl,
                        'invoice_id'    => $invoice->id,
                        'invoice_title' => $invoice->invoice_title,
                        'sent_date'     => $date,
                        'paid_status'   => $paidStatus,
                        'company_name'  => $invoice->company_name
                    ];
                }

                return response()->json($response, 200);
            }

            return response()->json([
                'error' => 'No record found.'
            ], 404);
        }
    }
}