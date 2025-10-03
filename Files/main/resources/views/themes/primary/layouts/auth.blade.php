@extends($activeTheme. 'layouts.app')
@section('content')

    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ getImage(getFilePath('logoFavicon').'/logo_dark.png') }}" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="@lang('Toggle navigation')">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="#0">@lang('contact')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.login') }}">@lang('login')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('user.register') }}">@lang('register')</a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.home') }}">@lang('Dashboard')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.bill.categories') }}">@lang('Categories')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.flat.index') }}">@lang('Flats')</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ auth()->user()->fullname }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('user.profile') }}">
                                    @lang('Profile')
                                </a>

                                <a class="dropdown-item" href="{{ route('user.change.password') }}">
                                    @lang('Change Password')
                                </a>

                                <a class="dropdown-item" href="{{ route('user.logout') }}">
                                    @lang('Logout')
                                </a>
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="page-wrapper">
        @yield('auth')
    </div>
@endsection
