@extends($activeTheme. 'layouts.auth')
@section('auth')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card custom--card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __($pageTitle) }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3 col-sm-6">
                                <div class="card stats-card p-3 d-flex flex-row align-items-center">
                                    <div class="icon-box bg-light text-primary me-3">
                                        <i class="ti ti-home"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">{{ $user->flats_count }}</h5>
                                        <small class="text-muted">@lang('Total Flats')</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="card stats-card p-3 d-flex flex-row align-items-center">
                                    <div class="icon-box bg-light text-info me-3">
                                        <i class="ti ti-users"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">{{ $user->tenants_count }}</h5>
                                        <small class="text-muted">@lang('Assigned Tenants')</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="card stats-card p-3 d-flex flex-row align-items-center">
                                    <div class="icon-box bg-light text-warning me-3">
                                        <i class="ti ti-category"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">{{ $user->categories_count }}</h5>
                                        <small class="text-muted">@lang('Total Catgories')</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="card stats-card p-3 d-flex flex-row align-items-center">
                                    <div class="icon-box bg-light text-danger me-3">
                                        <i class="ti ti-file-dollar"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-bold">{{ $user->bills_count }}</h5>
                                        <small class="text-muted">@lang('Total Bills')</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-style')
    <style>
        .stats-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            transition: 0.2s;
        }
        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        }
        .icon-box {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 22px;
        }
    </style>
@endpush