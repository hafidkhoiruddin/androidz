<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $guard = [];
    protected $fillable = [
        'user_id', 'vendor_id', 'soccer_field_id',
        'date', 'start_time', 'end_time', 'price'
    ];
    public $timestamps = false;
    protected $dates = ['deleted_at'];

    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}