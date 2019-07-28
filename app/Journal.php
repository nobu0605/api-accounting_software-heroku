<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $fillable = [
        'date',
        'debit',
        'debit_sub_account',
        'credit',
        'credit_sub_account',
        'amount',
        'remark',
        'user_id'
    ];
    public function account()
    {
        return $this->belongsto('App\Account');
    }
}
