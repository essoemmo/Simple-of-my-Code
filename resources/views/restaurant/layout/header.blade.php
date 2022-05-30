<!DOCTYPE html>
<html dir="{{ app()->getLocale() }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin">
    <meta name="keywords" content="Vuexy admin">
    <meta name="author" content="">
    <title>Dashboard - restaurant</title>
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" href="{{ asset('AdminS/assets_ar/app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon"
        href="{{ asset('AdminS/assets_ar/app-assets/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    @if (app()->getlocale() == 'ar')
        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_ar/app-assets/vendors/css/vendors-rtl.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_ar/app-assets/vendors/css/charts/apexcharts.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_ar/app-assets/vendors/css/extensions/toastr.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_ar/app-assets/vendors/css/animate/animate.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_ar/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_ar/app-assets/vendors/css/vendors.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_ar/app-assets/vendors/css/forms/select/select2.min.css') }}">
        <script rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_ar/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}"></script>
        <link rel="stylesheet" type="text/css" 
            href="{{ asset('AdminS/assets_ar/app-assets/app-assets/vendors/css/extensions/swiper.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_ar/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_ar/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
        <!-- END: Vendor CSS-->

        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('AdminS/assets_ar/app-assets/css-rtl/bootstrap.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_ar/app-assets/css-rtl/bootstrap-extended.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('AdminS/assets_ar/app-assets/css-rtl/colors.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_ar/app-assets/css-rtl/components.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_ar/app-assets/css-rtl/themes/dark-layout.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_ar/app-assets/css-rtl/themes/bordered-layout.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_ar/app-assets/css-rtl/themes/semi-dark-layout.css') }}">

        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_ar/app-assets/css-rtl/core/menu/menu-types/horizontal-menu.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_ar/app-assets/css-rtl/pages/dashboard-ecommerce.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_ar/app-assets/css-rtl/plugins/charts/chart-apex.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_ar/app-assets/css-rtl/plugins/extensions/ext-component-toastr.css') }}">
        <link rel="stylesheet" type="text/css" 
            href="{{ asset('AdminS/assets_ar/app-assets/css/plugins/extensions/ext-component-swiper.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_ar/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('AdminS/assets_ar/app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
        <!-- END: Page CSS-->

        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_ar/app-assets/css-rtl/custom-rtl.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('AdminS/assets_ar/assets/css/style-rtl.css') }}">
        <!-- END: Custom CSS-->

    @else

        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_en/app-assets/vendors/css/vendors.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_en/app-assets/vendors/css/charts/apexcharts.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_en/app-assets/vendors/css/extensions/toastr.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_en/app-assets/vendors/css/animate/animate.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_en/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_en/app-assets/vendors/css/vendors.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_en/app-assets/vendors/css/forms/select/select2.min.css') }}">
         <script rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_en/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}"></script>
        <link rel="stylesheet" type="text/css" 
            href="{{ asset('AdminS/assets_ar/app-assets/vendors/css/extensions/swiper.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_en/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_en/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
        <!-- END: Vendor CSS-->

        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('AdminS/assets_en/app-assets/css/bootstrap.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_en/app-assets/css/bootstrap-extended.css') }}">
        <link rel="stylesheet" type="text/css" 
            href="{{ asset('AdminS/assets_en/app-assets/css/colors.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('AdminS/assets_en/app-assets/css/components.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_en/app-assets/css/themes/dark-layout.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_en/app-assets/css/themes/bordered-layout.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_en/app-assets/css/themes/semi-dark-layout.css') }}">
        <!-- END: Theme CSS-->

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_en/app-assets/css/core/menu/menu-types/horizontal-menu.css') }}">
        <link rel="stylesheet" type="text/css" 
            href="{{ asset('AdminS/assets_en/app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_en/app-assets/css/pages/dashboard-ecommerce.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_en/app-assets/css/plugins/charts/chart-apex.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_en/app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('AdminS/assets_en/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css') }}">
        <link rel="stylesheet" type="text/css" 
            href="{{ asset('AdminS/assets_en/app-assets/css/plugins/extensions/ext-component-swiper.css') }}">
        <!-- END: Page CSS-->

        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('AdminS/assets_en/assets/css/style.css') }}">
        <!-- END: Custom CSS-->

    @endif

    @stack('css')
    {{-- parsly --}}
    <link rel="stylesheet" href="{{ asset('AdminS/parsley/parsly.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Cairo' rel='stylesheet'>
<style>
      body {
        font-family: 'Cairo';
        /* font-size: 18px; */
    }
</style>
</head>

<!-- BEGIN: Body-->
<body class="horizontal-layout horizontal-menu  navbar-floating footer-static" data-open="hover" data-menu="horizontal-menu" data-col="">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center" data-nav="brand-center">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav">
                <li class="nav-item"><a class="navbar-brand" href="#"><span class="brand-logo">
                        <h2 class="brand-text mb-0" style="font-family: cairo;color: black;"> {{ auth()->user()->guard(['restaurant'])->name }} </h2>
                    </a></li>
            </ul>
        </div>
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
                </ul>

                <ul class="nav navbar-nav bookmark-icons">
                    <li class="nav-item">
                        @if(app()->isLocale('ar'))
                            <a href="{{route('Reslang','en')}}"class="nav-link" style="font-family: cairo;display: block ruby;margin-left: 10px;"><i class="flag-icon flag-icon-us"></i>English </a>
                           @else
                            <a href="{{route('Reslang','ar')}}"class="nav-link" style="font-family: cairo;display: block ruby;margin-right: 10px;"><i class="flag-icon flag-icon-sa"></i>العربية</a>
                        @endif
                    </li>
                </ul>
             
            </div>
            <ul class="nav navbar-nav align-items-center ml-auto">
                
                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                    id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <a class="dropdown-item" href="{{ route('restaurant.logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                        class="mr-50" data-feather="power"></i>@lang('admin.logout')</a>
                <form id="logout-form" action="{{ route('restaurant.logout') }}" method="POST"
                    class="d-none">
                    @csrf
                </form>
            </li>
            </ul>
        </div>
    </nav>
    <!-- END: Header-->

 