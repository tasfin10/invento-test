<?php

namespace App\Http\Controllers\Admin;

use App\Constants\ManageStatus;
use App\Http\Controllers\Controller;
use App\Models\Flat;
use App\Models\Tenant;
use App\Models\User;

class TenantController extends Controller
{
    function index() {
        $pageTitle = 'All Tenants';
        $tenants   = Tenant::latest()->with('user')->paginate(getPaginate());
        
        // A user’s assign tenant capacity check
        $availavleUsers = User::whereColumn('flat_count', ">" , 'assigned_tenant_count')->get();

        return view('admin.page.tenants', compact('pageTitle', 'tenants', 'availavleUsers'));
    }

     function store($id = 0) {
        $this->validate(request(), [
            'name'    => 'required|string|max:40',
            'email'   => 'required|email|max:255|unique:tenants,email,' . $id,
            'contact' => 'required|string|max:255'
        ]);

        if ($id) {
            $tenant = Tenant::find($id);

            if (!$tenant) {
                $toast[] = ['error', 'Tenant not found'];
                return back()->withToasts($toast);
            }

            $message = ' Tenant update success';
        } else {
            $tenant = new Tenant();
            $message  = ' Tenant add success';
        }

        $tenant->name    = request('name');
        $tenant->email   = request('email');
        $tenant->contact = request('contact');
        $tenant->save();

        $toast[] = ['success', $message];
        return back()->withToasts($toast);
    }

    function remove($id) {
        $tenant = Tenant::find($id);

        if (!$tenant) {
            $toast[] = ['error', 'Tenant not found'];
            return back()->withToasts($toast);
        }

        $assignedFlat = Flat::where('tenant_id', $tenant->id)->with('user')->first();

        if ($assignedFlat) {
            $assignedFlat->tenant_id = 0;
            $assignedFlat->save();

            // Count down the assigned tenants for users
            $assignedFlat->user->assigned_tenant_count -= 1;
            $assignedFlat->user->save();
        }

        $tenant->delete();

        $toast[] = ['success', 'Tenant removal success'];
        return back()->withToasts($toast);
    }

    function assign() {
        $this->validate(request(), [
            'user_id'   => 'required|int|gt:0',
            'tenant_id' => 'required|int|gt:0'
        ]);

        $tenant = Tenant::where('id', request('tenant_id'))->where('status', ManageStatus::UNASSIGNED)->first();

        if (!$tenant) {
            $toast[] = ['error', 'This tenant is not available'];
            return back()->withToasts($toast);
        }

        // A user’s assign tenant capacity check
        $user = User::where('id', request('user_id'))->whereColumn('flat_count', '>' , 'assigned_tenant_count')->first();

        if (!$user) {
            $toast[] = ['error', 'This user has no available flats'];
            return back()->withToasts($toast);
        }

        // Marking tenant as assigned
        $tenant->status  = ManageStatus::ASSIGNED;
        $tenant->user_id = $user->id;
        $tenant->save();

        // Count up the assigned tenants for users
        $user->assigned_tenant_count += 1;
        $user->save();

        $toast[] = ['success', 'Tenant assign successfull'];
        return back()->withToasts($toast);
    }
}
