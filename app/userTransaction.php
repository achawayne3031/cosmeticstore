<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userTransaction extends Model
{
    //
    protected $fillable = [
        'email', 'userID', 'amount', 'desc', 'status', 'ref', 'date_of_payment'
    ];
}
