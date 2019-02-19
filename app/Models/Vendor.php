<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $guard = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function fields()
    {
        return $this->hasMany('App\Models\SoccerField');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}