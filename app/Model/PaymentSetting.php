<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
     protected $fillable = [
         'user_id',
         'api_login_id',
         'trans_key'
     ];
}
