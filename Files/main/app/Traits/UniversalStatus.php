<?php

namespace App\Traits;

use App\Constants\ManageStatus;

trait UniversalStatus
{
    public function scopeHouseOwnerCheck($query) { return $query->where('user_id', auth()->id()); }

    /**
     * Scope a query to only include active plans.
     */
    public function scopeActive($query): void
    {
        $query->where('status', ManageStatus::ACTIVE);
    }

    /**
     * Scope a query to only include inactive plans.
     */
    public function scopeInactive($query): void
    {
        $query->where('status', ManageStatus::INACTIVE);
    }
}