<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'account',
        'type'
    ];
    public function journals(){
        return $this->hasMany('App\Journal');
    }
}
