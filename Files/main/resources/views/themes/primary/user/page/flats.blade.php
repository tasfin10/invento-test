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
                                            <th>@lang('Flat No')</th>
                                            <th>@lang('Tenant')</th>
                                            <th>@lang('Email')</th>
                                            <th>@lang('Contact')</th>
                                            <th>@lang('Total Due')</th>
                                            <th>@lang('Tenant Status')</th>
                                            <th>@lang('Actions')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($flats as $flat)
                                            <tr>
                                                <td>{{ $flats->firstItem() + $loop->index }}</td>
                                                <td>{{ $flat->flat_no }}</td>
                                                <td>{{ $flat->tenant ? $flat->tenant->name : '--' }}</td>
                                                <td>{{ $flat->tenant ? $flat->tenant->email : '--' }}</td>
                                                <td>{{ $flat->tenant ? $flat->tenant->contact : '--' }}</td>
                                                <td>{{ showAmount($flat->due_amount) }}</td>
                                                <td>
                                                    @if ($flat->tenant)
                                                        <span class="badge text-bg-info">Assigned</span>
                                                    @else
                                                        <span class="badge text-bg-warning">Not Assigned</span>
                                                    @endif
                                                </td>
                                                
                                                <td>
                                                    <div class="d-flex flex-wrap justify-content-end gap-2">
                                                        <button type="button" class="btn btn-sm btn-outline-primary editBtn" 
                                                            data-resource="{{ $flat }}" 
                                                            data-action="{{ route('user.flat.store', $flat->id) }}">
                                                            <i class="ti ti-edit"></i> @lang('Edit')
                                                        </button>

                                                        @if(!$flat->tenant)
                                                            <button type="button" class="btn btn-sm btn-outline-info assignnBtn" 
                                                                data-id="{{ $flat->id }}"
                                                                data-action="{{ route('user.flat.assign', $flat->id) }}">
                                                                <i class="ti ti-transfer-in"></i> @lang('Assign')
                                                            </button>
                                                        @endif

                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                More
                                                            </button>

                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <button type="button" class="dropdown-item text-primary detailsBtn " data-details="{{ $flat->details }}">Details</button>
                                                                </li>
                                                                <li>
                                                                    <button type="button" class="dropdown-item text-danger removeBtn" data-action="{{ route('user.flat.remove', $flat->id) }}">Remove</button>
                                                                </li>

                                                                @if ($flat->tenant)    
                                                                    <li>
                                                                        <a href="{{ route('user.bill.index', $flat->id) }}" class="dropdown-item">Bills</a>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
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

                        @if($flats->hasPages())
                            <div class="card-footer">
                                {{ $flats->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Update Modal --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="col-form-label required">Flat No</label>
                        <input type="text" class="form-control" name="flat_no" required>
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label required">Details</label>
                        <textarea class="form-control" name="details" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Details Modal --}}
    <div class="modal fade" id="detailsModal" tabindex="-1" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Flat Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!--Remove Modal -->
    <div class="modal fade" id="removeModal" tabindex="-1" aria-labelledby="removeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="removeModalLabel">Make Your Decision</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you confirming the removal of this Flat?
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

    {{-- Assign Tenant Modal --}}
    <div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="assignModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="assignModalLabel">Assign Tenant to Flat</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="col-form-label required">Tenant</label>
                        <select name="tenant_id" class="form-control" required>
                            <option value="0">Select One</option>
                            @foreach ($availableTenants as $tenant)                                
                                <option value="{{ $tenant->id }}">{{ $tenant->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('page-script')
    <script>
        (function ($) {
            'use strict';

            let modal = $('#addModal');

            $('.addBtn').on('click', function() {
                let actionRoute = `{{ route('user.flat.store') }}`;

                modal.find('.modal-title').text('Add New Flat');
                modal.find('form')[0].reset();
                modal.find('form').attr('action', actionRoute);
                modal.modal('show');
            });

            $('.editBtn').on('click', function() {
                let resource    = $(this).data('resource');
                let actionRoute = $(this).data('action');

                modal.find('.modal-title').text('Update Flat');
                modal.find('[name=flat_no]').val(resource.flat_no);
                modal.find('[name=tenant_id]').val(resource.tenant_id);
                modal.find('[name=details]').val(resource.details);
                modal.find('form').attr('action', actionRoute);

                modal.modal('show');
            });

            $('.detailsBtn').on('click', function () {
                let details = $(this).data('details');
                let detailsModal = $('#detailsModal');

                detailsModal.find('.modal-body').html(`<p>${details}</p>`);

                detailsModal.modal('show');
            });

            $('.removeBtn').on('click', function () {
                let removeModal = $('#removeModal');
                let actionRoute = $(this).data('action');

                removeModal.find('form').attr('action', actionRoute);
                removeModal.modal('show');
            });

            $('.assignnBtn').on('click', function() {
                let assignModal = $('#assignModal');
                let actionRoute = $(this).data('action');

                assignModal.find('form')[0].reset();
                assignModal.find('form').attr('action', actionRoute);
                assignModal.modal('show');
            });
        })(jQuery)
    </script>
@endpush