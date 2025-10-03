<header class="header" id="header">
    <div class="header__container">
        <div class="header__logo">
            <div class="header__logo__big">
                <a href="{{ route('admin.dashboard') }}"><img src="{{ getImage(getFilePath('logoFavicon').'/logo_dark.png') }}" alt="Logo"></a>
            </div>
            <div class="header__logo__small">
                <a href="{{ route('admin.dashboard') }}"><img src="{{ getImage(getFilePath('logoFavicon').'/favicon.png') }}" alt="Logo"></a>
            </div>
        </div>
        <div class="header__nav">
            <div class="header__nav__left">
                <button class="header__nav__btn sidebar-toggler"><i class="ti ti-menu-2"></i></button>
                <form class="header__search d-md-flex d-none">
                    <span class="header__search__icon">
                        <i class="ti ti-search"></i>
                    </span>
                    <input type="search" class="header__search__input" placeholder="@lang('Search')..." id="searchInput" autocomplete="off">

                    <ul class="search-list d-none"></ul>
                </form>
            </div>
            <div class="header__nav__right">
                <a href="{{ route('home') }}" target="_blank" class="header__nav__btn" title="@lang('Visit Website')"><i class="ti ti-world"></i></a>
                
                <div class="header__nav__admin dropdown custom--dropdown">
                    <button type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ getImage(getFilePath('adminProfile').'/'.auth('admin')->user()->image, getFileSize('adminProfile'), true) }}" alt="image">
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('admin.profile') }}" class="dropdown-item">
                                <span class="dropdown-icon"><i class="ti ti-user text--info"></i></span> @lang('Profile')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.basic.setting') }}" class="dropdown-item">
                                <span class="dropdown-icon"><i class="ti ti-settings-cog text--base"></i></span> @lang('Settings')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.logout') }}" class="dropdown-item text--danger">
                                <span class="dropdown-icon"><i class="ti ti-power"></i></span> @lang('Logout')
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>