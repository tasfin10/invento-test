@extends('admin.layouts.master')

@section('master')
    <div class="col-12">
        <div class="table-responsive scroll">
            <table class="table table--striped table-borderless table--responsive--sm">
                <thead>
                    <tr>
                        <th>@lang('S.N.')</th>
                        <th>@lang('User')</th>
                        <th>@lang('Email') | @lang('Phone')</th>
                        <th>@lang('Country')</th>
                        <th>@lang('Joined')</th>
                        <th>@lang('Action')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $users->firstItem() + $loop->index }}</td>
                            <td>
                                <div>
                                    <p class="fw-semibold">{{ $user->fullname }}</p>
                                    <p class="fw-semibold">
                                        <a href="{{ route('admin.user.details', $user->id) }}"> <small>@</small>{{ $user->username }}</a>
                                    </p>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <p>{{ $user->email }}</p>
                                    <p>{{ $user->mobile }}</p>
                                </div>
                            </td>
                            <td><p class="fw-bold" title="{{ __($user->country_name) }}">{{ $user->country_code }}</p></td>
                            <td>
                                <div>
                                    <p>{{ showDateTime($user->created_at) }}</p>
                                    <p>{{ diffForHumans($user->created_at) }}</p>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.user.details', $user->id) }}" class="btn btn--sm btn-outline--base"><i class="ti ti-info-square-rounded"></i> @lang('Details')</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        @include('partials.noData')
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($users->hasPages())
            {{ paginateLinks($users) }}
        @endif
    </div>
    
    @if (request()->routeIs('admin.user.kyc.pending'))
        <div class="col-12 m-0">
            <div class="custom--offcanvas offcanvas offcanvas-end" tabindex="-1" id="kycDetails" aria-labelledby="kycDetailsLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="kycDetailsLabel">@lang('KYC Details')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <table class="table table-borderless mb-3">
                        <tbody class="kycData"></tbody>
                    </table>
                    <div class="d-flex justify-content-center gap-2 action-div"></div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('breadcrumb')
    <a href="{{ route('admin.user.add') }}" class="btn btn--sm btn--base">
        <i class="ti ti-circle-plus"></i> @lang('Add New')
    </a>
@endpush