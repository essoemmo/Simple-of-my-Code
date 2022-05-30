    <!-- BEGIN: Main Menu-->
    <div class="horizontal-menu-wrapper">
        <div class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-shadow menu-border container-xxl" role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav" >

            <div class="shadow-bottom"></div>
            <!-- Horizontal menu content-->
            <div class="navbar-container main-menu-content" data-menu="menu-container">
                <!-- include ../../../includes/mixins-->
                <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                    
                     <li class="nav-item {{ URL::route('restauranthome') === URL::current() ? 'active' : '' }}" >
                        <a class="nav-link d-flex align-items-center" href="{{route('restauranthome')}}"><i data-feather='home'></i><span style="font-family: cairo;" data-i18n="Dashboards">@lang('admin.home')</span>
                        </a>
                    </li>

                    <li class="nav-item {{ URL::route('orders.index') === URL::current() ? 'active' : '' }}" >
                        <a class="nav-link d-flex align-items-center" href="{{route('orders.index')}}"><i data-feather='box'></i><span style="font-family: cairo;"  data-i18n="Dashboards">@lang('admin.orders')</span>
                        </a>
                    </li>
                    
                    <li class="nav-item {{ URL::route('categories.index') === URL::current() ? 'active' : '' }}" >
                        <a class="nav-link d-flex align-items-center" href="{{route('categories.index')}}"><i data-feather='list'></i><span style="font-family: cairo;"  data-i18n="Dashboards">@lang('admin.categories')</span>
                        </a>
                    </li>

                    <li class="nav-item {{ URL::route('products.index') === URL::current() ? 'active' : '' }}" >
                        <a class="nav-link d-flex align-items-center" href="{{route('products.index')}}"><i data-feather='codepen'></i><span style="font-family: cairo;"  data-i18n="Dashboards">@lang('admin.products')</span>
                        </a>
                    </li>

                    <li class="nav-item {{ URL::route('photos.index') === URL::current() ? 'active' : '' }}" >
                        <a class="nav-link d-flex align-items-center" href="{{route('photos.index')}}"><i data-feather='image'></i><span style="font-family: cairo;"  data-i18n="Dashboards">@lang('admin.photos')</span>
                        </a>
                    </li>

                    <li class="nav-item {{ URL::route('rates.index') === URL::current() ? 'active' : '' }}" >
                        <a class="nav-link d-flex align-items-center" href="{{route('rates.index')}}"><i data-feather='star'></i><span style="font-family: cairo;"  data-i18n="Dashboards">@lang('admin.rates')</span>
                        </a>
                    </li>

                    <li class="nav-item {{ URL::route('restaurantsetting') === URL::current() ? 'active' : '' }}" >
                        <a class="nav-link d-flex align-items-center" href="{{route('restaurantsetting')}}"><i data-feather='settings'></i><span style="font-family: cairo;" data-i18n="Dashboards">@lang('admin.settings')</span>
                        </a>
                    </li>
                   
                </ul>
            </div>
        </div>
    </div>
    <!-- END: Main Menu-->
