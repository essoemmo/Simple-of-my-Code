<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="#"><span class="brand-logo">
                        <img src="{{asset('AdminS/assets_ar/app-assets/images/logo/logo.png')}}"
                            style="max-width: 35px;margin-top: -22px;">
                    </span>
                    <h2 class="brand-text" style="margin-top: -10px;margin-left: 5px;font-size: 31px;">Dine-In</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item {{ URL::route('adminhome') === URL::current() ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{route('adminhome')}}"><i data-feather='home'></i><span
                        style="font-family: cairo;" class="menu-title text-truncate"
                        data-i18n="City">@lang('admin.home')</span>
                </a>
            </li>


            @if(Auth::guard('admin')->user()->hasPermission('users-read'))
            <li class="nav-item {{ URL::route('users.index') === URL::current() ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{route('users.index')}}"><i data-feather='users'></i><span
                        style="font-family: cairo;" class="menu-title text-truncate"
                        data-i18n="City">@lang('admin.users')</span>
                </a>
            </li>
            @endif

            @if(Auth::guard('admin')->user()->hasPermission('rates-read'))
            <li class="nav-item {{ URL::route('admin.rates.index') === URL::current() ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{route('rates.index')}}"><i data-feather='star'></i><span
                        style="font-family: cairo;" class="menu-title text-truncate"
                        data-i18n="City">@lang('admin.rates')</span>
                </a>
            </li>
            @endif

            @if(Auth::guard('admin')->user()->hasPermission('restaurants-read'))
            <li class="nav-item {{ URL::route('restaurants.index') === URL::current() ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{route('restaurants.index')}}"><i
                        data-feather='list'></i><span style="font-family: cairo;" class="menu-title text-truncate"
                        data-i18n="City">@lang('admin.restaurants')</span>
                </a>
            </li>
            @endif

            @if(Auth::guard('admin')->user()->hasPermission('admins-read'))
            <li class="nav-item {{ URL::route('admins.index') === URL::current() ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{route('admins.index')}}"><i data-feather="user"></i><span
                        style="font-family: cairo;" class="menu-title text-truncate"
                        data-i18n="Admin">@lang('admin.admins')</span>
                </a>
            </li>
            @endif

            @if(Auth::guard('admin')->user()->hasPermission('roles-read'))
            <li class="nav-item {{ URL::route('roles.index') === URL::current() ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{route('roles.index')}}"><i
                        data-feather='book-open'></i><span style="font-family: cairo;" class="menu-title text-truncate"
                        data-i18n="Role">@lang('admin.roles')</span>
                </a>
            </li>
            @endif

            @if(Auth::guard('admin')->user()->hasPermission('orders-read'))
            <li class="nav-item {{ URL::route('admin.orders.index') === URL::current() ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{route('admin.orders.index')}}"><i data-feather='edit-3'></i><span
                        style="font-family: cairo;" class="menu-title text-truncate"
                        data-i18n="Role">@lang('admin.orders')</span>
                </a>
            </li>
            @endif

            @if(Auth::guard('admin')->user()->hasPermission('coupons-read'))
            <li class="nav-item {{ URL::route('coupons.index') === URL::current() ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{route('coupons.index')}}"><i data-feather='credit-card'></i><span
                        style="font-family: cairo;" class="menu-title text-truncate"
                        data-i18n="Role">@lang('admin.coupons')</span>
                </a>
            </li>
            @endif

            @if(Auth::guard('admin')->user()->hasPermission('banners-read'))
            <li class="nav-item {{ URL::route('banners.index') === URL::current() ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{route('banners.index')}}"><i data-feather='feather'></i><span
                        style="font-family: cairo;" class="menu-title text-truncate"
                        data-i18n="about">@lang('admin.banners')</span>
                </a>
            </li>
            @endif

            @if(Auth::guard('admin')->user()->hasPermission('amenities-read'))
            <li class="nav-item {{ URL::route('amenities.index') === URL::current() ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{route('amenities.index')}}"><i data-feather='dribbble'></i><span style="font-family: cairo;" class="menu-title text-truncate"
                        data-i18n="about">@lang('admin.amenities')</span>
                </a>
            </li>
            @endif

            @if(Auth::guard('admin')->user()->hasPermission('aboutus-read'))
            <li class="nav-item {{ URL::route('aboutus.index') === URL::current() ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{route('aboutus.index')}}"><i data-feather='book'></i><span
                        style="font-family: cairo;" class="menu-title text-truncate"
                        data-i18n="about">@lang('admin.aboutus')</span>
                </a>
            </li>
            @endif

            @if(Auth::guard('admin')->user()->hasPermission('terms-read'))
            <li class="nav-item {{ URL::route('terms.index') === URL::current() ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{route('terms.index')}}"><i
                        data-feather='alert-octagon'></i><span style="font-family: cairo;"
                        class="menu-title text-truncate" data-i18n="term">@lang('admin.terms')</span>
                </a>
            </li>
            @endif

            @if(Auth::guard('admin')->user()->hasPermission('usages-read'))
            <li class="nav-item {{ URL::route('usages.index') === URL::current() ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{route('usages.index')}}"><i data-feather='tool'></i><span style="font-family: cairo;"
                        class="menu-title text-truncate" data-i18n="term">@lang('admin.usages')</span>
                </a>
            </li>
            @endif

            @if(Auth::guard('admin')->user()->hasPermission('privecy-read'))
            <li class="nav-item {{ URL::route('privecy.index') === URL::current() ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{route('privecy.index')}}"><i data-feather='file-text'></i><span style="font-family: cairo;"
                        class="menu-title text-truncate" data-i18n="term">@lang('admin.privecy')</span>
                </a>
            </li>
            @endif

            @if(Auth::guard('admin')->user()->hasPermission('faqs-read'))
            <li class="nav-item {{ URL::route('faqs.index') === URL::current() ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{route('faqs.index')}}"><i data-feather='alert-circle'></i><span style="font-family: cairo;"
                        class="menu-title text-truncate" data-i18n="term">@lang('admin.faqs')</span>
                </a>
            </li>
            @endif

            @if(Auth::guard('admin')->user()->hasPermission('contactus-read'))
            <li class="nav-item {{ URL::route('contactus.index') === URL::current() ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{route('contactus.index')}}"><i
                        data-feather='phone-call'></i><span style="font-family: cairo;" class="menu-title text-truncate"
                        data-i18n="contacts">@lang('admin.contactus')</span>
                </a>
            </li>
            @endif

            @if(Auth::guard('admin')->user()->hasPermission('settings-read'))
            <li class="nav-item {{ URL::route('setting') === URL::current() ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{route('setting')}}"><i data-feather='settings'></i><span
                        style="font-family: cairo;" class="menu-title text-truncate"
                        data-i18n="Setting">@lang('admin.settings')</span>
                </a>
            </li>
            @endif

            @if(Auth::guard('admin')->user()->hasPermission('sections-read'))
            <li class="nav-item {{ URL::route('sections.index') === URL::current() ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{route('sections.index')}}"><i data-feather='layout'></i><span
                        style="font-family: cairo;" class="menu-title text-truncate"
                        data-i18n="Setting">@lang('admin.websection')</span>
                </a>
            </li>
            @endif
            
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
