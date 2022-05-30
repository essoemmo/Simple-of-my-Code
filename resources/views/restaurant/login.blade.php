<!DOCTYPE html>
<html class="loading semi-dark-layout" lang="en" data-layout="semi-dark-layout" dir="">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="restaurant Admin">
    <meta name="keywords" content="restaurant Admin">
    <meta name="author" content="restaurant">
    <title>Dashboard - restaurant</title>
    <link rel="apple-touch-icon" href="{{asset('AdminS/assets_ar/app-assets/images/ico/logo%2030.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('AdminS/assets_ar/app-assets/app-assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    @if (app()->getlocale() == 'ar')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_ar/app-assets/vendors/css/vendors-rtl.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_ar/app-assets/vendors/css/extensions/toastr.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_ar/app-assets/css-rtl/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_ar/app-assets/css-rtl/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_ar/app-assets/css-rtl/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_ar/app-assets/css-rtl/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_ar/app-assets/css-rtl/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_ar/app-assets/css-rtl/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_ar/app-assets/css-rtl/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_ar/app-assets/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_ar/app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_ar/app-assets/css-rtl/plugins/forms/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_ar/app-assets/css-rtl/pages/page-auth.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_ar/app-assets/css-rtl/custom-rtl.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_ar/assets/css/style-rtl.css')}}">
    <!-- END: Custom CSS-->

    @else

<!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_en/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_en/app-assets/vendors/css/extensions/toastr.min.css') }}">
    <!-- END: Vendor CSS-->
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_en/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_en/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_en/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_en/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_en/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_en/app-assets/css/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_en/app-assets/css/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_en/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_ar/app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_en/app-assets/css/plugins/forms/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_en/app-assets/css/pages/page-auth.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('AdminS/assets_ar/assets/css/style.css')}}">
    <!-- END: Custom CSS-->
    @endif
    

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu blank-page navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-v2">
                    <div class="auth-inner row m-0">
                       
                        <!-- Left Text-->
                        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="{{asset('AdminS/assets_ar/app-assets/images/pages/coming-soon-dark.svg')}}" alt="Login V2" style="width: 100%" /></div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Login-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <a  class="card-title mb-1">
                                    <img src="{{asset('AdminS/assets_ar/app-assets/images/logo/logo.png')}}" alt="" style="width: 20%;margin-left: 37%;margin-bottom: 10%;">
                                </a>
                                
                                <h4 class="card-title mb-1" style="text-align: center;">@lang('admin.welcome')  👋</h4>
                                <p class="card-text mb-2" style="text-align: center;">@lang('admin.pleasesign')</p>
                                <form class="auth-login-form mt-2" method="POST" action="{{ route('restaurant.login') }}" data-parsley-validate>
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="login-email" class="form-label">@lang('admin.email')</label>
                                        <input type="email" class="form-control" id="login-email" name="email" value="{{ old('email') }}" placeholder="@lang('admin.email')" aria-describedby="login-email" tabindex="1"  required autofocus />
                                    </div>

                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <label for="login-password">@lang('admin.password')</label>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input type="password" class="form-control form-control-merge" id="login-password" name="password" value="{{ old('password') }}" tabindex="2" placeholder="@lang('admin.password')" aria-describedby="login-password" required autofocus/>
                                            <div class="input-group-append">
                                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                   
                                    <button class="btn btn-dark btn-block" tabindex="4">@lang('admin.login')</button>
                                </form>
                                <p class="text-center mt-2">
                                    <span>@lang('admin.thankslogin') <i data-feather="heart" style="margin-bottom: 8px;color: red;"></i></span>
                                </p>
                            </div>
                        </div>
                        <!-- /Login-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->


 <!-- BEGIN: Vendor JS-->
 <script src="{{asset('AdminS/assets_ar/app-assets/vendors/js/vendors.min.js')}}"></script>
 <!-- BEGIN Vendor JS-->

 <!-- BEGIN: Page Vendor JS-->
 <script src="{{asset('AdminS/assets_ar/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
 <script src="{{asset('AdminS/assets_ar/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
 <!-- END: Page Vendor JS-->

 <!-- BEGIN: Theme JS-->
 <script src="{{asset('AdminS/assets_ar/app-assets/js/core/app-menu.js')}}"></script>
 <script src="{{asset('AdminS/assets_ar/app-assets/js/core/app.js')}}"></script>
 <!-- END: Theme JS-->

 <!-- BEGIN: Page JS-->
 <script src="{{asset('AdminS/assets_ar/app-assets/js/scripts/pages/page-auth-login.js')}}"></script>
 <!-- END: Page JS-->

 <script>
     $(window).on('load', function() {
         if (feather) {
             feather.replace({
                 width: 14,
                 height: 14
             });
         }
     })
 </script>
    @include('admin.layout.session')
</body>
</html>
