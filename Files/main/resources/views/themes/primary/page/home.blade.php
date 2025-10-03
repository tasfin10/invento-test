@extends($activeTheme. 'layouts.app')
@section('content')
    <section>
        <div class="container">
            <div class="document-header d-flex flex-wrap justify-content-between align-items-center mb-2">
                <div class="logo">
                    <a href="{{ route('home') }}"><img src="{{ getImage(getFilePath('logoFavicon').'/logo_dark.png') }}" alt=""></a>
                </div>
            </div>

            <div class="document-wrapper">
                <div class="row g-0">
                    @guest
                        <div class="col-lg-12">
                            <div class="document-item d-flex flex-wrap">
                                <div class="document-item__icon">
                                    <i class="las la-sign-in-alt"></i>
                                </div>
                                <div class="document-item__content">
                                    <h4 class="title"><a href="{{ route('user.login') }}" class="text-underline">@lang('Login')</a></h4>
                                </div>
                            </div>
                        </div>
                    @endguest

                    @auth
                        <div class="col-lg-6">
                            <div class="document-item d-flex flex-wrap">
                                <div class="document-item__icon">
                                    <i class="las la-tachometer-alt"></i>
                                </div>
                                <div class="document-item__content">
                                    <h4 class="title"><a href="{{ route('user.home') }}" class="text-underline">@lang('Dashboard')</a></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="document-item d-flex flex-wrap">
                                <div class="document-item__icon">
                                    <i class="las la-sign-out-alt"></i>
                                </div>
                                <div class="document-item__content">
                                    <h4 class="title"><a href="{{ route('user.logout') }}" class="text-underline">@lang('Logout')</a></h4>
                                </div>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>

            <div class="document-footer d-flex flex-wrap justify-content-end mt-4">
                <p>@lang('Laravel Version') ({{ app()->version() }}), @lang('PHP Version') ({{ PHP_VERSION }})</p>
            </div>
        </div>
    </section>
@endsection
