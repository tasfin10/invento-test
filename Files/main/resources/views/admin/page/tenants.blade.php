@extends('admin.layouts.master')

@section('master')
    <div class="col-12">
        <div class="table-responsive scroll">
            <table class="table table--striped table-borderless table--responsive--sm">
                <thead>
                    <tr>
                        <th>@lang('S.N.')</th>
                        <th>@lang('Name')</th>
                        <th>@lang('Email')</th>
                        <th>@lang('Contact')</th>
                        <th>@lang('Status')</th>
                        <th>@lang('Assigned To')</th>
                        <th>@lang('Actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tenants as $tenant)
                        <tr>
                            <td>{{ $tenants->firstItem() + $loop->index }}</td>
                            <td>{{ $tenant->name }}</td>
                            <td>{{ $tenant->email }}</td>
                            <td>{{ $tenant->contact }}</td>
                            <td>
                                @if ($tenant->status == ManageStatus::ASSIGNED)
                                    <span class="badge badge--primary">Assigned</span>
                                @else
                                    <span class="badge badge--warning">Unassigned</span>
                                @endif
                            </td>
                            <td>
                                @if ($tenant->user)
                                    <a href="{{ route('admin.user.details', $tenant->user) }}">{{ $tenant->user->fullname }}</a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="button" class="btn btn--sm btn-outline--base editBtn" 
                                        data-resource="{{ $tenant }}" 
                                        data-action="{{ route('admin.tenant.store', $tenant->id) }}">
                                        <i class="ti ti-edit"></i> @lang('Edit')
                                    </button>
                                    
                                    <div class="custom--dropdown">
                                        <button class="btn btn--icon btn--sm btn--base" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical"></i></button>

                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="#details" role="button" class="dropdown-item text--info detailsBtn" data-bs-toggle = "offcanvas" data-tenant="{{ $tenant }}">
                                                    <span class="dropdown-icon">
                                                        <i class="ti ti-info-square-rounded"></i>
                                                    </span> @lang('Details')
                                                </a>
                                            </li>

                                            @if ($tenant->status == ManageStatus::UNASSIGNED)    
                                                <li>
                                                    <button type="button" class="dropdown-item text--base assignBtn" data-id={{ $tenant->id }}>
                                                        <span class="dropdown-icon">
                                                            <i class="ti ti-home text--base"></i>
                                                        </span> @lang('Assign')
                                                    </button>
                                                </li>
                                            @endif

                                            <li>
                                                <button type="button" class="dropdown-item text--danger decisionBtn" 
                                                data-question="@lang('Are you confirming the removal of this tenant')?" 
                                                data-action="{{ route('admin.tenant.remove', $tenant->id) }}">
                                                    <span class="dropdown-icon">
                                                        <i class="ti ti-trash"></i> @lang('Remove')
                                                    </span>
                                                </button>
                                            </li>
                                        </ul> 
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        @include('partials.noData')
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if ($tenants->hasPages())
            {{ paginateLinks($tenants) }}
        @endif
    </div>

    {{-- Tenant Add and update Modal --}}
    <div class="custom--modal modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="addModalLabel">@lang('Add New Tenant')</h2>
                    <button type="button" class="btn btn--sm btn--icon btn-outline--secondary modal-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form--label required">@lang('Name')</label>
                                <input type="text" class="form--control" name="name" required>
                            </div>
                            <div class="col-12">
                                <label class="form--label required">@lang('Email')</label>
                                <input type="email" class="form--control" name="email" required>
                            </div>
                            <div class="col-12">
                                <label class="form--label required">@lang('Contact')</label>
                                <input type="text" class="form--control" name="contact" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer gap-2">
                        <button type="button" class="btn btn--sm btn-outline--base" data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--sm btn--base">@lang('Save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Details Canvas --}}
    <div class="col-12 m-0">
        <div class="custom--offcanvas offcanvas offcanvas-end" tabindex="-1" id="details" aria-labelledby="detailsLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="detailsLabel">@lang('Tenant Details')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <table class="table table-borderless mb-3">
                    <tbody class="tenantData"></tbody>
                </table>
                <div class="d-flex justify-content-center gap-2 action-div"></div>
            </div>
        </div>
    </div>

    {{-- Tenant Assign Modal --}}
    <div class="custom--modal modal fade" id="assignModal" tabindex="-1" aria-labelledby="assignModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="assignModalLabel">@lang('Assign Tenant')</h2>
                    <button type="button" class="btn btn--sm btn--icon btn-outline--secondary modal-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form method="POST" action="{{ route('admin.tenant.assign') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <input type="hidden" name="tenant_id">
                            <div class="col-12">
                                <label class="form--label required">@lang('Avaiable User')</label>
                                <select class="form--control" name="user_id" required>
                                    <option value="0">Select One</option>

                                    @foreach ($availavleUsers as $user)
                                        <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer gap-2">
                        <button type="button" class="btn btn--sm btn-outline--base" data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--sm btn--base">@lang('Save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-decisionModal />
@endsection

@push('breadcrumb')
    <button type="button" class="btn btn--sm btn--base addBtn">
        <i class="ti ti-circle-plus"></i> @lang('Add New')
    </button>
@endpush

@push('page-script')
    <script>
        (function ($) {
            'use strict';

            let modal = $('#addModal');

            $('.addBtn').on('click', function() {
                let actionRoute = `{{ route('admin.tenant.store') }}`;

                modal.find('.modal-title').text('Add New Tenant');
                modal.find('form')[0].reset();
                modal.find('form').attr('action', actionRoute);
                modal.modal('show');
            });

            $('.editBtn').on('click', function() {
                let resource    = $(this).data('resource');
                let actionRoute = $(this).data('action');

                modal.find('.modal-title').text('Update Tenant');
                modal.find('[name=name]').val(resource.name);
                modal.find('[name=email]').val(resource.email);
                modal.find('[name=contact]').val(resource.contact);
                modal.find('form').attr('action', actionRoute);

                modal.modal('show');
            });

            $('.detailsBtn').on('click', function () {
                let tenantData  = $(this).data('tenant');
                let infoHtml = ``;
                
                infoHtml += `<tr>
                                <td class="fw-bold">Name</td>
                                <td>${tenantData.name}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Email</td>
                                <td>${tenantData.email}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Contact</td>
                                <td>${tenantData.contact}</td>
                            </tr>`;

                $('.tenantData').html(infoHtml);  
            });

            $('.assignBtn').on('click', function() {
                let assignModal = $('#assignModal');
                let tenantId    = $(this).data('id');

                assignModal.find('[name=tenant_id]').val(tenantId);
                assignModal.modal('show');
            });
        })(jQuery)
    </script>
@endpush