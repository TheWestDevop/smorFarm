<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
    protected $fillable = [
        'name', 'email','post','api_token','password',
    ];
}
