@extends('admin.layouts.master')

@section('master')
    <div class="col-12">
        <div class="row g-lg-4 g-3">
            <div class="col-xl-3 col-sm-6">
                <div class="dashboard-widget-1">
                    <div class="dashboard-widget-1__icon">
                        <i class="ti ti-home"></i>
                    </div>
                    <div class="dashboard-widget-1__content">
                        <h3 class="dashboard-widget-1__number">{{ $widget['totalUsers'] }}</h3>
                        <p class="dashboard-widget-1__txt">@lang('Total Users')</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="dashboard-widget-1 dashboard-widget-1__info">
                    <div class="dashboard-widget-1__icon">
                        <i class="ti ti-user-check"></i>
                    </div>
                    <div class="dashboard-widget-1__content">
                        <h3 class="dashboard-widget-1__number">{{ $widget['totalTenants'] }}</h3>
                        <p class="dashboard-widget-1__txt">@lang('Total Tenants')</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="dashboard-widget-1 dashboard-widget-1__primary">
                    <div class="dashboard-widget-1__icon">
                        <i class="ti ti-home"></i>
                    </div>
                    <div class="dashboard-widget-1__content">
                        <h3 class="dashboard-widget-1__number">{{ $widget['totalFlats'] }}</h3>
                        <p class="dashboard-widget-1__txt">@lang('Total Flats')</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="dashboard-widget-1 dashboard-widget-1__base">
                    <div class="dashboard-widget-1__icon">
                        <i class="ti ti-invoice"></i>
                    </div>
                    <div class="dashboard-widget-1__content">
                        <h3 class="dashboard-widget-1__number">{{ $widget['totalBills'] }}</h3>
                        <p class="dashboard-widget-1__txt">@lang('Total Bills')</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection