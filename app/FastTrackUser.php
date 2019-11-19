<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FastTrackUser extends Model
{
    protected $table = "fast_track_users";
    protected $fillable = [
        'name', 'address',
        'alternate_address',
        'email',
        'gender',
        'phone',
    ];
}
