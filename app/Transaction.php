<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'accountNumber','phoneNumber','transID','transAmount','transTime','paybill','fullName','organizationAccountBalance',
    ];
}
