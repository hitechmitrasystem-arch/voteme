<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'title',
        'description',
        'start_time',
        'end_time',
        'is_active',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Election belongs to a company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Election has many candidates
    public function candidates()
    {
        return $this->hasMany(\App\Models\Candidate::class);
    }

    // Election has many votes
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}