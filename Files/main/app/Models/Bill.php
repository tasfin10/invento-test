<?php

namespace App\Models;

use App\Traits\UniversalStatus;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{   
    use UniversalStatus;
    
    public function flat() {
        return $this->belongsTo(Flat::class);
    }

    public function category() {
        return $this->belongsTo(BillCategory::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
