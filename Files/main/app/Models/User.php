<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', 'remember_token', 'ver_code', 'balance', 'kyc_data'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'address'           => 'object',
        'ver_code_send_at'  => 'datetime'
    ];

    public function fullname(): Attribute
    {
        return new Attribute(
            get: fn () => $this->firstname . ' ' . $this->lastname,
        );
    }

    public function flats() {
        return $this->hasMany(Flat::class);
    }

    public function tenants() {
        return $this->hasMany(Tenant::class);
    }

    public function bills() {
        return $this->hasMany(Bill::class);
    }

    public function categories() {
        return $this->hasMany(BillCategory::class);
    }
}
