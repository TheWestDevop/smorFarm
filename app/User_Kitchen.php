<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Kitchen extends Model
{
    //
    protected $table = "user_kitchens";
    protected $fillable = [
        'user',
        'kitchen_name', 
        'kitchen_location',
        'ticket',
        'ticket_out'
    ];
}