<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Paypal extends Model
{
    protected $table   = 'paypal_invoice_data';
    protected $guarded = [];
}
