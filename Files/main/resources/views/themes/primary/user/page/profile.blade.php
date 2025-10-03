@extends($activeTheme. 'layouts.auth')
@section('auth')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card custom--card">
                    <div class="card-header">
                        <h5 class="card-title">@lang('Profile')</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4 fw-bold">Name :</div>
                            <div class="col-sm-8">{{ $user->fullname }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 fw-bold">E-mail Address :</div>
                            <div class="col-sm-8">{{ $user->email }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 fw-bold">Country :</div>
                            <div class="col-sm-8">{{ $user->country_name }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 fw-bold">Mobile Number :</div>
                            <div class="col-sm-8">{{ $user->mobile }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4 fw-bold">City :</div>
                            <div class="col-sm-8">{{ $user->address?->city ?? '---' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection