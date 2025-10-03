

<div class="main-sidebar">
    <form class="header__search d-md-none">
         <span class="header__search__icon">
             <i class="ti ti-search"></i>
         </span>

         <input type="search" class="header__search__input" placeholder="@lang('Search')..." id="searchInput" autocomplete="off">
          <ul class="search-list d-none"></ul>
    </form>
    <ul class="sidebar-menu scroll">
         <li class="sidebar-item">
               <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ navigationActive('admin.dashboard', 2) }}">
                    <span class="nav-icon"><i class="ti ti-layout-dashboard"></i></span>
                    <span class="sidebar-txt">@lang('Dashboard')</span>
               </a>
         </li>
         <li class="sidebar-item">
               <a href="{{ route('admin.tenant.index') }}" class="sidebar-link {{ navigationActive('admin.tenant', 2) }}">
                    <span class="nav-icon"><i class="ti ti-users"></i></span>
                    <span class="sidebar-txt">@lang('Tenants')</span>
               </a>
         </li>
         <li class="sidebar-item">
               <a href="{{ route('admin.user.index') }}" class="sidebar-link {{ navigationActive('admin.user', 2) }}">
                    <span class="nav-icon"><i class="ti ti-home"></i></span>
                    <span class="sidebar-txt">@lang('Users')</span>
               </a>
         </li>
         <li class="sidebar-item">
              <a href="{{ route('admin.basic.setting') }}" class="sidebar-link {{ navigationActive('admin.basic*', 2) }}">
                   <span class="nav-icon"><i class="ti ti-settings"></i></span>
                   <span class="sidebar-txt">@lang('Basic')</span>
              </a>
         </li>
         <li class="sidebar-item">
              <a role="button" class="sidebar-link has-sub {{ navigationActive('admin.notification*', 2) }}">
                   <span class="nav-icon"><i class="ti ti-mail"></i></span>
                   <span class="sidebar-txt">@lang('Email & SMS')</span>
              </a>
              <ul class="sidebar-dropdown-menu">
                   <li class="sidebar-dropdown-item">
                        <a href="{{ route('admin.notification.universal') }}" class="sidebar-link {{ navigationActive('admin.notification.universal', 1) }}">
                              @lang('Universal Template')
                         </a>
                    </li>
                   <li class="sidebar-dropdown-item">
                        <a href="{{ route('admin.notification.email') }}" class="sidebar-link {{ navigationActive('admin.notification.email', 1) }}">
                              @lang('Email Config')
                         </a>
                    </li>
                   <li class="sidebar-dropdown-item">
                        <a href="{{ route('admin.notification.sms') }}" class="sidebar-link {{ navigationActive('admin.notification.sms', 1) }}">
                              @lang('SMS Config')
                         </a>
                    </li>
                   <li class="sidebar-dropdown-item">
                        <a href="{{ route('admin.notification.templates') }}" class="sidebar-link {{ navigationActive('admin.notification.templates', 1) }}">
                              @lang('All Templates')
                         </a>
                    </li>
              </ul>
         </li>
         <li class="sidebar-item">
              <a href="#cacheClearModal" class="sidebar-link" data-bs-toggle="modal">
                   <span class="nav-icon"><i class="ti ti-wash-dry-dip"></i></span>
                   <span class="sidebar-txt">@lang('Cache Clear')</span>
              </a>
         </li>
         <li class="sidebar-item">
              <a href="#systemInfoModal" class="sidebar-link" data-bs-toggle="modal">
                   <span class="nav-icon"><i class="ti ti-info-square-rounded"></i></span>
                   <span class="sidebar-txt">@lang('System Info')</span>
              </a>
         </li>
    </ul>
</div>

<div class="custom--modal modal fade m-0" id="cacheClearModal" tabindex="-1" aria-labelledby="cacheClearModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
               <div class="modal-header">
                    <h2 class="modal-title" id="cacheClearModalLabel">@lang('Flush System Cache')</h2>
                    <button type="button" class="btn btn--sm btn--icon btn-outline--secondary modal-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
               </div>
               <form method="GET" action="{{ route('admin.cache.clear') }}">
                    <div class="modal-body">
                         <ul class="cache-clear-list">
                              <li>@lang('The cache containing compiled views will be removed')</li>
                              <li>@lang('The cache containing application will be removed')</li>
                              <li>@lang('The cache containing route will be removed')</li>
                              <li>@lang('The cache containing configuration will be removed')</li>
                              <li>@lang('Clearing out the compiled service and package files')</li>
                              <li>@lang('The cache containing system will be removed')</li>
                         </ul>
                    </div>
                    <div class="modal-footer gap-2">
                         <button type="button" class="btn btn--sm btn-outline--base" data-bs-dismiss="modal">@lang('Close')</button>
                         <button type="submit" class="btn btn--sm btn--base">@lang('Clear')</button>
                    </div>
               </form>
          </div>
     </div>
</div>

<div class="custom--modal modal fade m-0" id="systemInfoModal" tabindex="-1" aria-labelledby="systemInfoModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
               <div class="modal-header">
                    <h2 class="modal-title" id="systemInfoModalLabel">@lang('System Information')</h2>
                    <button type="button" class="btn btn--sm btn--icon btn-outline--secondary modal-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
               </div>
               <div class="modal-body">
                    <nav>
                         <div class="custom--tab nav nav-tabs flex-nowrap mb-3" role="tablist">
                              <button class="nav-link w-100 active" id="nav-application-tab" data-bs-toggle="tab" data-bs-target="#nav-application" type="button" role="tab" aria-controls="nav-application" aria-selected="true">@lang('Application')</button>
                              <button class="nav-link w-100" id="nav-server-tab" data-bs-toggle="tab" data-bs-target="#nav-server" type="button" role="tab" aria-controls="nav-server" aria-selected="false">@lang('Server')</button>
                         </div>
                    </nav>
                    <div class="tab-content">
                         <div class="tab-pane fade show active" id="nav-application" role="tabpanel" aria-labelledby="nav-application-tab" tabindex="0">
                              <table class="table table-borderless">
                                   <tbody>
                                        <tr>
                                             <td class="fw-semibold">{{ systemDetails()['name'] }} @lang('Version')</td>
                                             <td>{{ systemDetails()['version'] }}</td>
                                         </tr>
                                         <tr>
                                             <td class="fw-semibold">@lang('Build Version')</td>
                                             <td>{{ systemDetails()['build_version'] }}</td>
                                         </tr>
                                         <tr>
                                             <td class="fw-semibold">@lang('Laravel Version')</td>
                                             <td>{{ app()->version() }}</td>
                                         </tr>
                                         <tr>
                                             <td class="fw-semibold">@lang('Timezone')</td>
                                             <td>{{ config('app.timezone') }}</td>
                                         </tr>
                                   </tbody>
                              </table>
                         </div>
                         <div class="tab-pane fade" id="nav-server" role="tabpanel" aria-labelledby="nav-server-tab" tabindex="0">
                              <table class="table table-borderless">
                                   <tbody>
                                        <tr>
                                             <td class="fw-semibold">@lang('PHP Version')</td>
                                             <td>{{ phpversion() }}</td>
                                         </tr>
                                         <tr>
                                             <td class="fw-semibold">@lang('Server Software')</td>
                                             <td>{{ $_SERVER['SERVER_SOFTWARE'] }}</td>
                                         </tr>
                                         <tr>
                                             <td class="fw-semibold">@lang('Server IP Address')</td>
                                             <td>{{ $_SERVER['SERVER_ADDR'] }}</td>
                                         </tr>
                                         <tr>
                                             <td class="fw-semibold">@lang('Server Protocol')</td>
                                             <td>{{ $_SERVER['SERVER_PROTOCOL'] }}</td>
                                         </tr>
                                         <tr>
                                             <td class="fw-semibold">@lang('HTTP Host')</td>
                                             <td>{{ $_SERVER['HTTP_HOST'] }}</td>
                                         </tr>
                                         <tr>
                                             <td class="fw-semibold">@lang('Server Port')</td>
                                             <td>{{ $_SERVER['SERVER_PORT'] }}</td>
                                         </tr>
                                   </tbody>
                              </table>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>