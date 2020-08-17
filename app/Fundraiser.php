<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fundraiser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'userID', 'description', 'accountNumber', 'isActive','target', 'amountRaised','numberOfContributors',
    ];
}
