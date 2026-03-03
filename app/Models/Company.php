<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
    ];

    // Company has many users
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Company has many elections
    public function elections()
    {
        return $this->hasMany(Election::class);
    }

    // Company has many candidates
    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }

    // Company has many votes
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}