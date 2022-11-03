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
                                <h2 class="font-weight-bolder">{{\App\Models\User::where('type_id',1)->count()}}</h2>
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
                                <h2 class="font-weight-bolder">{{\App\Models\User::where('type_id',3)->count()}}</h2>
                                <p class="card-text">@lang('admin.sellers')</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="avatar bg-light-success p-50 mb-1">
                                    <div class="avatar-content">
                                        <i data-feather="navigation" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="font-weight-bolder">{{\App\Models\User::where('is_draw',1)->count()}}</h2>
                                <p class="card-text">@lang('admin.requests')</p>
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
                                <h2 class="font-weight-bolder">{{\App\Models\User::where('type_id',2)->count()}}</h2>
                                <p class="card-text">@lang('admin.organizations')</p>
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
                                <h2 class="font-weight-bolder">{{\App\Models\City::count()}}</h2>
                                <p class="card-text">@lang('admin.cities')</p>
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
