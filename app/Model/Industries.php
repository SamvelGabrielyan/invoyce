<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Industries extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'industries';
}