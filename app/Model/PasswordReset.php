<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
     protected $table = 'password_resets';
}
