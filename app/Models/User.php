<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'company_id',
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Hidden fields
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // User belongs to a company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // User votes
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    // Check if admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Check if voter
    public function isVoter()
    {
        return $this->role === 'voter';
    }
}