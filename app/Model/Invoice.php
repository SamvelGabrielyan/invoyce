<?php



namespace App\Model;



use Illuminate\Foundation\Auth\User as Authenticatable;

use Auth;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;



class Invoice extends Model

{

    // protected  $table = "invoices";

    protected $fillable = [

        'save_status',

        'schedule_type',

        'send_invoice_date',

        'send_invoice_days',

        'notification_status',

        'invoice_url',

        'user_id',

        'company_name',

        'email',

        'additional_email',

        'address',

        'city',

        'state',

        'zip_code',

        'phone',

        'invoice_title',

        'invoice_number',

        'invoice_message',

        'terms_conditions',

        'invoice_type',

        'total_amount',

        'view_status',

        'invoice_name',

        'invoice_customer',

        'subscription_id',

        'pay_count',

        'add_date'

    ];



    const CREATED_AT = null;



    const STATUS_PAY_INVOICE    = 3;

    const TYPE_STANDARD_INVOICE = 1;



    /*

     * Relations

     */



    public function user()

    {

        return $this->belongsTo('App\Model\User', 'user_id', 'id');

    }



    public function invoiceBilling()

    {

        return $this->hasMany('App\Model\InvoiceBilling', 'invoice_id', 'id');

    }



    public function scopeGetAveragePaid($query, $userId)

    {

        return $query->select(DB::raw('SUM(DATEDIFF(invoices.send_invoice_date,invoice_billing.pay_date)) AS average_paid'))

            ->join('invoice_billing', 'invoice_billing.invoice_id', '=', 'invoices.id')

            ->where(['invoices.user_id' => $userId, 'invoices.save_status' => self::STATUS_PAY_INVOICE])

            ->first();

    }



    public function scopeGetAverageTotal($query, $userId)

    {

        return $query->select(DB::raw('count(DATEDIFF(invoices.send_invoice_date,invoice_billing.pay_date)) AS average_total'))

            ->join('invoice_billing', 'invoice_billing.invoice_id', '=', 'invoices.id')

            ->where(['invoices.user_id' => $userId, 'invoices.save_status' => self::STATUS_PAY_INVOICE])

            ->first();

    }



    public function scopeGetInvoiceData($query, $userId)

    {

        return $query->where('user_id', $userId)

            ->where('save_status', '<', self::STATUS_PAY_INVOICE)

            ->where('save_status', '!=', self::TYPE_STANDARD_INVOICE)

            ->orderBy('id', 'desc');

    }



    public function scopeGetPaidInvoices($query, $userId, $preSevenDays, $currentData)

    {

        return $query->where('user_id', $userId)

            ->where('invoice_type', '=', self::TYPE_STANDARD_INVOICE)

            ->where('save_status', '=', self::STATUS_PAY_INVOICE)

            ->whereBetween('send_invoice_date', [$preSevenDays, $currentData])

            ->orderBy('id', 'desc');

    }



    public function scopeGetInvoiceForCron($query)

    {

        $query->where('save_status', '=', '0')

            ->where('schedule_type', '!=', '0')

            ->where('invoice_type', '=', '2')

            ->where('send_invoice_date', '=', date('Y-m-d'))

            ->limit(50);

    }



    public function updateInvoice($request, $additionalData, $invoiceType)

    {

        $dataToUpdate = [

            'save_status'         => $request->save_status ?? '0',

            'schedule_type'       => $additionalData['schedule_type'] ?? '0',

            'send_invoice_date'   => $additionalData['send_invoice_date'] ?? date('Y-m-d'),

            'send_invoice_days'   => $additionalData['send_invoice_days'] ?? '0',

            'user_id'             => Auth::user()->id,

            'company_name'        => $request->company_name ?? '',

            'email'               => $request->email ?? '',

            'additional_email'    => $request->additional_email ?? '',

            'address'             => $request->address ?? '',

            'city'                => $request->city ?? '',

            'state'               => $request->state ?? '',

            'zip_code'            => $request->zip_code ?? '',

            'phone'               => $request->phone ?? '',

            'invoice_title'       => $request->invoice_title ?? '',

            'invoice_number'      => $request->invoice_number ?? '',

            'invoice_message'     => $request->invoice_message ?? '',

            'terms_conditions'    => $request->terms_conditions ?? '',

            'invoice_type'        => $additionalData['invoice_type'] ?? '1',

            'notification_status' => $request->notification_status ?? '0',

            'paid_note'           => $request->paymentmethod ?? ''

        ];



        switch ($invoiceType) {

            case 'scheduled':

                $dataToUpdate['total_amount'] = $additionalData['total_amount'] ?? '0';

                break;

            case 'standard':

                $dataToUpdate['paid_note'] = $request->paid_note ?? '';

                $dataToUpdate['add_date']  = date('Y-m-d');

            case 'subscription':

                $dataToUpdate['total_amount'] = '0';

                break;

        }





        $this::where('id', $request->edit_id)

            ->update($dataToUpdate);



        return $request->edit_id;

    }



    public function storeInvoice($request, $additionalData)

    {

        $lastId = $this::insertGetId([

            'subscription_id'     => '',

            'invoice_name'        => '',

            'invoice_customer'    => '',

            'pay_count'           => '0',

            'invoice_url'         => '',

            'schedule_type'       => $additionalData['schedule_type'] ?? '',

            'save_status'         => $request->save_status ?? '0',

            'send_invoice_date'   => $additionalData['send_invoice_date'] ?? date('Y-m-d'),

            'send_invoice_days'   => $additionalData['send_invoice_days'] ?? '0',

            'notification_status' => $request->notification_status ?? '0',

            'user_id'             => Auth::user()->id,

            'company_name'        => $request->company_name ?? '',

            'email'               => $request->email ?? '',

            'additional_email'    => $request->additional_email ?? '',

            'address'             => $request->address ?? '',

            'city'                => $request->city ?? '',

            'state'               => $request->state ?? '',

            'zip_code'            => $request->zip_code ?? '',

            'phone'               => $request->phone ?? '',

            'invoice_title'       => $request->invoice_title ?? '',

            'invoice_number'      => $request->invoice_number ?? '',

            'invoice_message'     => $request->invoice_message ?? '',

            'terms_conditions'    => $request->terms_conditions ?? '',

            'invoice_type'        => $additionalData['invoice_type'] ?? '1',

            'invoice_type_code'   => $additionalData['invoice_type_code'] ?? '',

            'total_amount'        => '0',

            'add_date'            => date('Y-m-d'),

            'paid_note'           => $request->paymentmethod ?? ''

        ]);



        return $lastId;

    }

}

