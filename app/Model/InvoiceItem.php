<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = [
        'invoice_id',
        'item',
        'description',
        'rate',
        'qty',
        'discount',
        'discount_type',
        'total_amount'
    ];

    /**
     * Inserting Invoice Items.
     *
     * @since 1.0.1
     *
     * @used-by ScheduledController::scheduledInvoiceSave()
     *
     * @param $data
     * @param $totalInvoice
     * @param $invoiceId
     * @param $perform
     * @return float|int|string
     */
    public function invoiceItemStoreOrUpdate($data, $totalInvoice, $invoiceId, $perform)
    {
        if ($perform == 'edit') {
            $this::where('invoice_id', '=', $invoiceId)->delete();
        }

        $payAmount = 0;
        for ($i = 1; $i <= $totalInvoice; $i++) {
            $itemType       = '';
            $discountAmount = 0;
            $totalAmount    = 0;
            $itemName       = $data->input('item_name_' . $i) ?? '';
            $itemDesc       = $data->input('item_description_' . $i) ?? '';
            $itemRate       = $data->input('item_rate_' . $i) ?? '';
            $itemQty        = $data->input('item_qty_' . $i) ?? '';
            $itemDiscount   = $data->input('item_discount_' . $i) ?? '';
            $itemDis        = $data->input('item_dis_' . $i) ?? '';
            $itemPrice      = $itemRate * $itemQty;

            if ($itemDiscount != "" && $itemDiscount != 0) {
                if ($itemDis == 'yes') {
                    $itemType       = 'yes';
                    $discountAmount = $itemDiscount;
                } else {
                    $itemType       = 'no';
                    $discountAmount = ($itemPrice * $itemDiscount) / 100;
                }
            }
            $totalAmount = $itemPrice - $discountAmount;
            $payAmount   = $payAmount + $totalAmount;

            $this::insertGetId([
                'invoice_id'    => $invoiceId,
                'item'          => $itemName,
                'description'   => $itemDesc,
                'rate'          => $itemRate,
                'qty'           => $itemQty,
                'discount'      => $itemDiscount,
                'discount_type' => $itemType,
                'total_amount'  => $totalAmount
            ]);
        }

        return $payAmount;
    }
}
