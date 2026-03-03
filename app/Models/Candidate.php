<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'election_id',
        'name',
        'description',
        'photo',
        'vote_count',
    ];

    // Candidate belongs to company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Candidate belongs to election
    public function election()
    {
        return $this->belongsTo(Election::class);
    }

    // Candidate has many votes
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}