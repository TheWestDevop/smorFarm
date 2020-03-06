<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Owner extends Model
{
    protected $table = "deliver_to";
    protected $fillable = [
        'order_id',
        'name',
        'address',
        'apartment',
        'email',
        'gender',
        'phone',
        'note'
    ];
}
