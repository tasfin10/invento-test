<?php

namespace App\Models;

use App\Traits\UniversalStatus;
use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{   
    use UniversalStatus;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tenant() {
        return $this->belongsTo(Tenant::class);
    }

    public function bills() {
        return $this->hasMany(Bill::class);
    }
}
