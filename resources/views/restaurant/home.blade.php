@extends('restaurant.layout.master')

   @section('content')

   <!-- BEGIN: Content-->
   <div class="content-header row">

    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">@lang('admin.dashboard')</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">@lang('admin.home')</a>
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
                    <a class="dropdown-item" href="app-todo.html"><i class="mr-1"
                            data-feather="check-square"></i><span class="align-middle">Todo</span></a>

                    <a class="dropdown-item" href="app-chat.html"><i class="mr-1"
                            data-feather="message-square"></i><span class="align-middle">Chat</span></a>

                    <a class="dropdown-item" href="app-email.html"><i class="mr-1" data-feather="mail"></i><span
                            class="align-middle">Email</span></a>

                    <a class="dropdown-item" href="app-calendar.html"><i class="mr-1"
                            data-feather="calendar"></i><span class="align-middle">Calendar</span></a>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="content-body">
    <!-- Dashboard Ecommerce Starts -->
         <!-- Dashboard Ecommerce Starts -->
         <section id="dashboard-ecommerce">
            <!-- Stats Vertical Card -->
            <div class="row">

             <div class="col-xl-2 col-md-4 col-sm-6">
                 <div class="card text-center">
                     <div class="card-body">
                         <div class="avatar bg-light-danger p-50 mb-1">
                             <div class="avatar-content">
                                 <i data-feather="shopping-bag" class="font-medium-5"></i>
                             </div>
                         </div>
                         <h2 class="font-weight-bolder">{{\App\Models\Order::where('restaurant_id',restId())->count()}}</h2>
                         <p class="card-text">@lang('admin.orders')</p>
                     </div>
                 </div>
             </div>
             <div class="col-xl-2 col-md-4 col-sm-6">
                 <div class="card text-center">
                     <div class="card-body">
                         <div class="avatar bg-light-danger p-50 mb-1">
                             <div class="avatar-content">
                                 
                                 <i data-feather="message-square" class="font-medium-5"></i>
                             </div>
                         </div>
                         <h2 class="font-weight-bolder">{{\App\Models\Rate::where('restaurant_id',restId())->count()}}</h2>
                         <p class="card-text">@lang('admin.rates')</p>
                     </div>
                 </div>
             </div>
             <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="avatar bg-light-warning p-50 mb-1">
                            <div class="avatar-content">
                                <i data-feather="truck" class="font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="font-weight-bolder">{{\App\Models\Product::where('restaurant_id',restId())->count()}}</h2>
                        <p class="card-text">@lang('admin.products')</p>
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
                        <h2 class="font-weight-bolder">{{\App\Models\Category::where('restaurant_id',restId())->count()}}</h2>
                        <p class="card-text">@lang('admin.categories')</p>
                    </div>
                </div>
            </div>
         </div>
         <!--/ Stats Vertical Card -->
     </section>
     <!-- Dashboard Ecommerce ends -->
    <!-- Dashboard Ecommerce ends -->

</div>
<!-- END: Content-->


@endsection
