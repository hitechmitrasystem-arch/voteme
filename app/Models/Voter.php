<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Voter extends Authenticatable
{
    protected $guarded = []; // <-- IMPORTANT

    protected $hidden = [
        'password',
        'remember_token',
    ];
}