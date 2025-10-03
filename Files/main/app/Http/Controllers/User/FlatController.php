<?php

namespace App\Http\Controllers\User;

use App\Constants\ManageStatus;
use App\Http\Controllers\Controller;
use App\Models\Flat;
use App\Models\Tenant;

class FlatController extends Controller
{
    function index() {
        $pageTitle = "All Flats";
        $flatQuery = Flat::houseOwnerCheck();
        $flats     = clone $flatQuery->with('tenant')->latest()->paginate(getPaginate());

        $assignedFlatTenants   = clone $flatQuery->pluck('tenant_id');
        $assignedToUserTenants = auth()->user()->tenants->pluck('id');
        $availableTenantsId    = array_diff($assignedToUserTenants->toArray(), $assignedFlatTenants->toArray()) ;
        $availableTenants      = Tenant::whereIn('id', $availableTenantsId)->get();

        return view($this->activeTheme . 'user.page.flats', compact('pageTitle', 'flats', 'availableTenants'));
    }

    function store($id = 0) {
        $this->validate(request(), [
            'flat_no'   => 'required|string|max:40',
            'details'   => 'required|string|max:65535'
        ]);

        if ($id) {
            $flat = Flat::houseOwnerCheck()->find($id);

            if (!$flat) {
                $toast[] = ['error', 'Flat not found'];
                return back()->withToasts($toast);
            }

            $message = ' Flat update success';
        } else {
            $flat          = new Flat();
            $flat->user_id = auth()->id();
            $message       = ' Flat add success';

            $user = auth()->user();
            $user->flat_count += 1;
            $user->save();
        }

        $flat->flat_no   = request('flat_no');
        $flat->details   = request('details');
        $flat->save();

        $toast[] = ['success', $message];
        return back()->withToasts($toast);
    }

    function remove($id) {
        $flat = Flat::houseOwnerCheck()->with(['user', 'tenant'])->find($id);

        if (!$flat) {
            $toast[] = ['error', 'Flat not found'];
            return back()->withToasts($toast);
        }

        // Checking that the user asigneed a tenant on that flat or not
        if ($flat->tenant) {
            $flat->tenant->user_id = 0;
            $flat->tenant->status  = ManageStatus::UNASSIGNED;
            $flat->tenant->save();
        }

        // Delete all related bills first
        $flat->bills()->delete();

        // Count down the flats for the user
        $flat->user->flat_count -= 1;
        $flat->user->assigned_tenant_count -= 1;
        $flat->user->save();

        $flat->delete();

        $toast[] = ['success', 'Flat removal success'];
        return back()->withToasts($toast);
    }

    function assignTenantToFlat($id) {
        $this->validate(request(), [
            'tenant_id' => 'required|int|gt:0'
        ]);

        $flat = Flat::houseOwnerCheck()->where('tenant_id', 0)->find($id);

        if (!$flat) {
            $toast[] = ['error', 'Flat is not available'];
            return back()->withToasts($toast);
        }

        $tenant = Tenant::where('id', request('tenant_id'))->first();

        if (!$tenant) {
            $toast[] = ['error', 'Tenant is not available'];
            return back()->withToasts($toast);
        }

        $flat->tenant_id = $tenant->id;
        $flat->save();

        $toast[] = ['success', 'Tenant successfully added to your flat'];
        return back()->withToasts($toast);
    }
}
