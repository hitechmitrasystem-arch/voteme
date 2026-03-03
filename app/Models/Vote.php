<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
        'voter_id',
        'election_id',
        'candidate_id',
        'company_id',
    ];
}