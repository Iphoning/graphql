<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'Account';
    protected $primaryKey = 'accountId';
    public $incrementing = false;
}
