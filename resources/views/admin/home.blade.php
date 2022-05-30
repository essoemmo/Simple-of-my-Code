@extends('admin.layout.master')

@section('content')

<!-- BEGIN: Content-->
        <div class="content-header row">

            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">@lang('admin.dashboard')</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">@lang('admin.home')</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrumb-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-dark btn-round btn-sm dropdown-toggle" type="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                data-feather="grid"></i></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            {{-- @if(Auth::guard('admin')->user()->hasPermission('supports-read'))
                                <a class="dropdown-item" href="{{route('supports.index')}}"><i data-feather='archive'></i><span style="font-family: cairo;">@lang('admin.supports')</span>
                                </a>
                            @endif

                            @if(Auth::guard('admin')->user()->hasPermission('settings-read'))
                                <a class="dropdown-item" href="{{route('setting')}}"><i data-feather='settings'></i><span style="font-family: cairo;">@lang('admin.settings')</span>
                                </a>
                            @endif

                            @if(Auth::guard('admin')->user()->hasPermission('users-read'))
                            <li class="nav-item {{ URL::route('users.index') === URL::current() ? 'active' : '' }}">
                                <a class="dropdown-item" href="{{route('users.index')}}"><i data-feather='users'></i><span style="font-family: cairo;" class="menu-title text-truncate" data-i18n="City">@lang('admin.users')</span>
                                </a>
                            </li>
                            @endif

                            @if(Auth::guard('admin')->user()->hasPermission('daycares-read'))
                                <a class="dropdown-item" href="{{route('daycares.index')}}"><i data-feather='list'></i><span style="font-family: cairo;" class="menu-title text-truncate" data-i18n="City">@lang('admin.daycares')</span>
                                </a>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">
            <!-- Dashboard Ecommerce Starts -->
            <section id="dashboard-ecommerce">
                   <!-- Stats Vertical Card -->
                   <div class="row">
                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="avatar bg-light-info p-50 mb-1">
                                    <div class="avatar-content">
                                        <i data-feather="eye" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="font-weight-bolder">{{\App\Models\User::count()}}</h2>
                                <p class="card-text">@lang('admin.users')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="avatar bg-light-warning p-50 mb-1">
                                    <div class="avatar-content">
                                        <i data-feather="message-square" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="font-weight-bolder">{{\App\Models\Banner::count()}}</h2>
                                <p class="card-text">@lang('admin.banners')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="avatar bg-light-danger p-50 mb-1">
                                    <div class="avatar-content">
                                        <i data-feather="shopping-bag" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="font-weight-bolder">{{\App\Models\Order::count()}}</h2>
                                <p class="card-text">@lang('admin.orders')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="avatar bg-light-primary p-50 mb-1">
                                    <div class="avatar-content">
                                        <i data-feather="heart" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="font-weight-bolder">{{\App\Models\Restaurant::count()}}</h2>
                                <p class="card-text">@lang('admin.restaurants')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="avatar bg-light-success p-50 mb-1">
                                    <div class="avatar-content">
                                        <i data-feather="award" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="font-weight-bolder">{{\App\Models\ContactUs::count()}}</h2>
                                <p class="card-text">@lang('admin.contactus')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="avatar bg-light-danger p-50 mb-1">
                                    <div class="avatar-content">
                                        <i data-feather="truck" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="font-weight-bolder">{{\App\Models\Coupon::count()}}</h2>
                                <p class="card-text">@lang('admin.coupons')</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Stats Vertical Card -->
            </section>
            <!-- Dashboard Ecommerce ends -->

        </div>
<!-- END: Content-->

@endsection

@push('js')

@endpush
