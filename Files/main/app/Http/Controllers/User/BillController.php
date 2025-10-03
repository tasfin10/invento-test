<?php

namespace App\Http\Controllers\User;

use App\Constants\ManageStatus;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillCategory;
use App\Models\Flat;

class BillController extends Controller
{
    function categories() {
        $pageTitle  = 'All Categories';
        $categories = BillCategory::houseOwnerCheck()->latest()->paginate(getPaginate());

        return view($this->activeTheme . 'user.bill.categories', compact('pageTitle', 'categories'));
    }

    function categoryStore($id = 0) {
        $this->validate(request(), [
            'name' => 'required|string|max:40',
        ]);

        if ($id) {
            $category = BillCategory::houseOwnerCheck()->find($id);

            if (!$category) {
                $toast[] = ['error', 'Category not found'];
                return back()->withToasts($toast);
            }

            $message = 'Category update success';
        } else {
            $category          = new BillCategory();
            $category->user_id = auth()->id();
            $message           = 'Category add success';
        }

        $category->name = request('name');
        $category->save();

        $toast[] = ['success', $message];
        return back()->withToasts($toast);
    }

    function billIndex($flatId) {
        $flat = Flat::houseOwnerCheck()->where('id', $flatId)->with('tenant')->first();

        if (!$flat) {
            $toast[] = ['error', 'You are not allowed for this operation'];
            return back()->withToasts($toast);
        }

        $pageTitle  = 'Bills for flat no : ' . $flat->flat_no;
        $categories = BillCategory::latest()->get(); 
        $bills      = Bill::houseOwnerCheck()->where('flat_id', $flat->id)->with('category')->latest()->paginate(getPaginate());

        return view($this->activeTheme . 'user.bill.index', compact('pageTitle', 'categories', 'bills', 'flat'));
    }

    function addBill($flatId) {
        $this->validate(request(), [
            'category_id' => 'required|exists:bill_categories,id',
            'amount'      => 'required|numeric|gt:0',
            'notes'       => 'nullable',
            'month'       => 'required|in:january,february,march,april,may,june,july,august,september,october,november,december'
        ]);

        $flat = Flat::houseOwnerCheck()->with('tenant')->where('id', $flatId)->first();

        if (!$flat) {
            $toast[] = ['error', 'You are not allowed for this operation'];
            return back()->withToasts($toast);
        }

        $bill              = new Bill();
        $bill->unique_id   = getTrx();
        $bill->user_id     = auth()->id();
        $bill->flat_id     = $flat->id;
        $bill->category_id = request('category_id');
        $bill->month       = request('month');
        $bill->amount      = request('amount');
        $bill->notes       = request('notes') ?? null;
        $bill->save();

        $flat->due_amount += $bill->amount;
        $flat->save();

        $status = 'Due';
        $this->emailSend($flat->tenant, 'BILL_CREATED', $bill, $flat, $status);

        $toast[] = ['success', 'Bill added successfully'];
        return back()->withToasts($toast);
    }

    function markPaid($billId) {
        $bill = Bill::houseOwnerCheck()->where('status', ManageStatus::UNPAID)->with('flat')->find($billId);

        if (!$bill) {
            $toast[] = ['error', 'You are not allowed for this operation'];
            return back()->withToasts($toast);
        }

        $bill->status = ManageStatus::PAID;
        $bill->save();

        $flat = $bill->flat;
        $flat->due_amount -= $bill->amount;
        $flat->save();

        $status = 'Paid';
        $this->emailSend($flat->tenant, 'BILL_PAID', $bill, $flat, $status);

        $toast[] = ['success', 'Bill marked as paid successfully'];
        return back()->withToasts($toast);
    }

    protected function emailSend($receiver, $act, $bill, $flat, $status) {
        notify($flat->tenant, 'BILL_CREATED', [
            'bill_id'   => $bill->unique_id,
            'flat_no'   => $flat->flat_no,
            'creator'   => $bill->user->fullname,
            'bill_type' => $bill->category->name,
            'month'     => keyToTitle($bill->month),
            'amount'    => showAmount($bill->amount),
            'status'    => $status,
            'total_due' => showAmount($flat->due_amount),
            'notes'     => $bill->notes ?? 'Empty',
        ],['email']);
    }
}
