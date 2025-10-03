@extends($activeTheme. 'layouts.auth')
@section('auth')
    <div class="py-5 ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="text-end mb-4">
                        <button class="btn btn-sm btn-primary addBtn" type="button"><i class="ti ti-circle-plus"></i> @lang('Add New')</button>
                    </div>
                    <div class="card custom--card">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table custom--table">
                                    <thead>
                                        <tr>
                                            <th>@lang('S.N.')</th>
                                            <th>@lang('Bill Id')</th>
                                            <th>@lang('Month')</th>
                                            <th>@lang('Tenant')</th>
                                            <th>@lang('Category')</th>
                                            <th>@lang('Amount')</th>
                                            <th>@lang('Status')</th>
                                            <th>@lang('Action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($bills as $bill)
                                            <tr>
                                                <td>{{ $bills->firstItem() + $loop->index }}</td>
                                                <td>{{ $bill->unique_id }}</td>
                                                <td>{{ keyToTitle($bill->month) }}</td>
                                                <td>{{ $flat->tenant->name }}</td>
                                                <td>{{ $bill->category->name }}</td>
                                                <td>{{ showAmount($bill->amount) }}</td>
                                                <td>
                                                    @if ($bill->status)
                                                        <span class="badge text-bg-info">Paid</span>
                                                    @else
                                                        <span class="badge text-bg-warning">Due</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($bill->status)
                                                        @lang('N/A')
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-outline-primary payBtn"
                                                            data-action="{{ route('user.bill.mark.paid', $bill->id) }}">
                                                            <i class="ti ti-credit-card-pay"></i> @lang('Mark as paid')
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                @include('partials.noData')
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @if($bills->hasPages())
                            <div class="card-footer">
                                {{ $bills->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Modal --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{ route('user.bill.add', $flat->id) }}">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addModalLabel">Add Bill For Flat No : {{ $flat->flat_no }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="col-form-label required">Category</label>
                        <select name="category_id" class="form-control" required>
                            <option value="0">Select One</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label required">Month</label>
                        <select name="month" class="form-control" required>
                            <option value="january">January</option>
                            <option value="february">February</option>
                            <option value="march">March</option>
                            <option value="april">April</option>
                            <option value="may">May</option>
                            <option value="june">June</option>
                            <option value="july">July</option>
                            <option value="august">August</option>
                            <option value="september">September</option>
                            <option value="october">October</option>
                            <option value="november">November</option>
                            <option value="december">December</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label required">Amount</label>
                        <input type="number" step="any" class="form-control" name="amount" required>
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Notes</label>
                        <textarea class="form-control" name="notes"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!--Remove Modal -->
    <div class="modal fade" id="payModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="payModalLabel">Make Your Decision</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you confirming to mark this bill as paid?
                </div>

                <form method="POST">
                    @csrf
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-sm btn-primary">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('page-script')
    <script>
        (function ($) {
            'use strict';
            
            $('.addBtn').on('click', function() {
                let modal = $('#addModal');
                modal.find('form')[0].reset();
                modal.modal('show');
            });

            $('.payBtn').on('click', function() {
                let payModal = $('#payModal');
                let actionRoute = $(this).data('action');

                payModal.find('form').attr('action', actionRoute);
                payModal.modal('show');
            });
        })(jQuery)
    </script>
@endpush