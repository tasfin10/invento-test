@extends('admin.layouts.master')

@section('master')
    @if ($user)    
        <div class="col-12">
            <div class="row g-lg-4 g-3">
                <div class="col-xl-3 col-sm-6">
                    <div class="dashboard-widget-4">
                        <div class="dashboard-widget-4__content">
                            <div class="dashboard-widget-4__icon">
                                <i class="ti ti-coins"></i>
                            </div>
                            <p class="dashboard-widget-4__txt">@lang('Total Flats')</p>
                        </div>
                        <h3 class="dashboard-widget-4__number">{{ $user->flats_count }}</h3>
                        <div class="dashboard-widget-4__vector">
                            <i class="ti ti-coins"></i>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="dashboard-widget-4 dashboard-widget-4__success">
                        <div class="dashboard-widget-4__content">
                            <div class="dashboard-widget-4__icon">
                                <i class="ti ti-wallet"></i>
                            </div>
                            <p class="dashboard-widget-4__txt">@lang('Assigned Tenants')</p>
                        </div>
                        <h3 class="dashboard-widget-4__number">{{ $user->tenants_count }}</h3>
                        <div class="dashboard-widget-4__vector">
                            <i class="ti ti-wallet"></i>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="dashboard-widget-4 dashboard-widget-4__warning">
                        <div class="dashboard-widget-4__content">
                            <div class="dashboard-widget-4__icon">
                                <i class="ti ti-cash-banknote"></i>
                            </div>
                            <p class="dashboard-widget-4__txt">@lang('Total Catgories')</p>
                        </div>
                        <h3 class="dashboard-widget-4__number">{{ $user->categories_count }}</h3>
                        <div class="dashboard-widget-4__vector">
                            <i class="ti ti-cash-banknote"></i>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="dashboard-widget-4 dashboard-widget-4__info">
                        <div class="dashboard-widget-4__content">
                            <div class="dashboard-widget-4__icon">
                                <i class="ti ti-transform"></i>
                            </div>
                            <p class="dashboard-widget-4__txt">@lang('Total Bills')</p>
                        </div>
                        <h3 class="dashboard-widget-4__number">{{ $user->bills_count }}</h3>
                        <div class="dashboard-widget-4__vector">
                            <i class="ti ti-transform"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="col-12">
        <div class="custom--card">
            <div class="card-header">
                <h3 class="title">
                    @if ($user)
                        @lang('Information About')  {{ $user->fullname }}
                    @else
                        @lang('Provide User Information')
                    @endif
                </h3>
            </div>
            <form action="{{ route('admin.user.update', $user?->id ?? 0) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-md-6">
                            <div class="row g-2 align-items-center">
                                <div class="col-lg-4">
                                    <label class="col-form--label required">@lang('Username')</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" class="form--control checkUser" name="username" value="{{ $user?->username ?? old('username') }}" required>
                                    <small class="text-danger usernameExist"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row g-2 align-items-center">
                                <div class="col-lg-4">
                                    <label class="col-form--label required">@lang('Email')</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="email" class="form--control checkUser" name="email" value="{{ $user?->email  ?? old('email') }}" required>
                                    <small class="text-danger emailExist"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row g-2 align-items-center">
                                <div class="col-lg-4">
                                    <label class="col-form--label required">@lang('First Name')</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" class="form--control" name="firstname" value="{{ $user?->firstname ?? old('firstname') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row g-2 align-items-center">
                                <div class="col-lg-4">
                                    <label class="col-form--label required">@lang('Last Name')</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" class="form--control" name="lastname" value="{{ $user?->lastname ?? old('lastname') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row g-2 align-items-center">
                                <div class="col-lg-4">
                                    <label class="col-form--label required">@lang('Country')</label>
                                </div>
                                <div class="col-lg-8">
                                    <select class="form--control form-select select-2" name="country" required>
                                        @foreach($countries as $key => $country)
                                            <option data-mobile_code="{{ $country?->dial_code }}" value="{{ $key }}">{{ __($country?->country) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row g-2 align-items-center">
                                <div class="col-lg-4">
                                    <label class="col-form--label required">@lang('Mobile')</label>
                                </div>
                                <div class="col-lg-8">
                                    <div class="input--group">
                                        <span class="input-group-text mobile-code"></span>
                                        <input type="number" class="form--control" name="mobile" id="mobile" required>
                                    </div>
                                    <small class="text-danger mobileExist"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row g-2 align-items-center">
                                <div class="col-lg-4">
                                    <label class="col-form--label {{ $user ? '' : 'required' }}">@lang('Password')</label>
                                </div>
                                <div class="col-lg-8">
                                    <div class="input--group">
                                        <input type="password" class="form--control" name="password" {{ $user ? '' : 'required' }}>
                                        <button type="button" class="btn btn--base btn-generate-password" >
                                            @lang('Generate')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row g-2 align-items-center">
                                <div class="col-lg-4">
                                    <label class="col-form--label">@lang('City')</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" class="form--control" name="city" value="{{ $user?->address?->city  ?? old('city') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top">
                    <div class="d-flex justify-content-center">
                        <button class="btn btn--base px-4" type="submit">@lang('Submit')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@push('breadcrumb')
    <a href="{{route('admin.user.index')}}" class="btn btn--sm btn--base">
        <span class="dropdown-icon"><i class="ti ti-chevrons-left"></i></span> @lang('Back')
    </a>
    @if ($user)
        <a href="{{route('admin.user.login', $user->id)}}" target="_blank" class="btn btn--sm btn--base">
            <span class="dropdown-icon"><i class="ti ti-login-2"></i></span> @lang('Login as User')
        </a>
    @endif
@endpush

@push('page-script')
    <script>
        (function($){
            "use strict";
            let mobileElement = $('.mobile-code');

            $('[name=country]').on('change', function () {
                mobileElement.text(`+${$('[name=country] :selected').data('mobile_code')}`);
            }).change();

            $('[name=country]').val('{{ $user ? $user->country_code : 'AF' }}');

            let dialCode     = $('[name=country] :selected').data('mobile_code');
            let mobileNumber = `{{ $user?->mobile }}`;
            mobileNumber     = mobileNumber.replace(dialCode,'');

            $('[name=mobile]').val(mobileNumber);

            mobileElement.text(`+${dialCode}`);

            // Function to generate a random password
            function generatePassword(length = 12) {
                const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+[]{}|;:,.<>?'
                let password = ''

                for (let i = 0; i < length; i++) {
                    password += chars.charAt(Math.floor(Math.random() * chars.length))
                }

                return password
            }

            $('.btn-generate-password').on('click', function () {
                let newPassword = generatePassword();
                $('[name=password]').val(newPassword);
            });

            // Existing user check
            $('.checkUser').on('focusout',function(e) {
                var url = '{{ route('admin.user.check') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';

                if ($(this).attr('name') == 'mobile') {
                    var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                    var data = {mobile:mobile,_token:token}
                }

                if ($(this).attr('name') == 'email') {
                    var data = {email:value,_token:token}
                }

                if ($(this).attr('name') == 'username') {
                    var data = {username:value,_token:token}
                }

                $.post(url, data, function(response) {
                  if (response.data != false && (response.type == 'email' || response.type == 'username' || response.type == 'mobile')) {
                    $(`.${response.type}Exist`).text(`${response.type} already exist`);
                  }else{
                    $(`.${response.type}Exist`).text('');
                  }
                });
            });
        })(jQuery);
    </script>
@endpush
