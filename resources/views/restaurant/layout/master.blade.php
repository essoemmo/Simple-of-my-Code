
    @include('restaurant.layout.header')

    @include('restaurant.layout.sidenav')

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">

            <!-- Dashboard Ecommerce Starts -->
            <section>

                @yield('content')

            </section>
            <!-- Dashboard Ecommerce ends -->

    </div>
  </div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>


    @include('restaurant.layout.footer')

    @include('restaurant.layout.session')

    <!-- Warning Section Ends -->

