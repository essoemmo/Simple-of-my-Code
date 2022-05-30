<!doctype html>
<html dir="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>dine in</title>
    <link href="{{ asset('FrontS/img/Vector (1).png') }}" rel="icon" type="image/png" sizes="16x16">
    <link href="{{ asset('FrontS/css/simple-lightbox.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('FrontS/css/animate.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('FrontS/css/hover.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('FrontS/css/nice-select.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('FrontS/css/slick.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('FrontS/css/slick-theme.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('FrontS/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('FrontS/css/main.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('FrontS/css/style-en.css') }}" rel="stylesheet" type="text/css">
    
    @if (app()->getlocale() == 'ar')
    <link href="{{ asset('FrontS/css/style-ar.css') }}" rel="stylesheet" type="text/css">
    @endif

    <link rel="stylesheet" type="text/css" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://use.fontawesome.com/d10920a460.js"></script>

    @stack('css')
</head>

<body>

    <!-- End dark mode icon -->
    <!--loader-->
    {{-- <div class="loader-container" id="loader-container">
        <div class="loader">
            <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_nwl1en9m.json " background="transparent" speed=".7" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
        </div>
    </div> --}}

    <!-- start navbar  -->
    <div class="nav_bar">
        <div class="container">
            <div class="nav_cont">
                <div class="logo_brand">
                    <a href="{{route('home')}}"> <img src="{{ asset('FrontS/img//Vector (1).png') }}" alt="" class="img-fluid">
                        <h5>@lang('website.dinein')</h5>
                    </a>
                </div>

                <!-- start list-mob -->
                <div class="list-item">
                    <ul class="">
                        <li>
                            <a href="{{route('home')}}">@lang('website.home')</a>
                        </li>
                        <li>
                            <a href="{{route('faq')}}">@lang('website.faqs')</a>
                        </li>
                        <li>
                            <a href="{{route('contact')}}">@lang('website.contactUs')</a>
                        </li>
                        <li>
                            <a href="{{route('restaurantLogin')}}" class="sign">@lang('website.restsignin')</a>
                        </li>

                        @if(app()->isLocale('ar'))
                       <li><a href="{{route('langhome','en')}}" class="sign"><img src="{{ asset('FrontS/img/united-kingdom.png') }}" alt="" style="width: 29%">English </a></li> 
                       @else
                       <li><a href="{{route('langhome','ar')}}" class="sign"><img src="{{ asset('FrontS/img/saudi-arabia.png') }}" alt="" style="width: 30%">العربية</a></li> 
                       @endif
                    </ul>
                </div>

            </div>
        </div>
    </div>