<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class InvoiceBilling extends Model
{
    //
     protected $table = 'invoice_billing';

     public function invoice()
     {
         return $this->belongsTo('App\Model\Invoice', 'invoice_id', 'id');
     }
}
