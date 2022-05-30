  <!--Start footer -->

  <div class="footer">
    <div class="container">
        <div class="row all_links_wrapper">
            <div class="col-12 col-md-6 col-lg-5">
                <a href="{{route('home')}}">
                    <img src="{{ asset('FrontS/img/footer-logo.png') }}" alt="" class="footer_logo">
                </a>
                <div class="info_contact">
                    <p class="footer_des">
                        {{$setting->description}}
                    </p>

                    <div class="icon-social d-flex">
                        <div class="social-cont face">
                            <a href="{{$setting->facebook}}">
                                <i class="fa fa-facebook-f"></i>
                            </a>
                        </div>
                        <div class="social-cont twiter">
                            <a href="{{$setting->twitter}}">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>
                        <div class="social-cont whats">
                            <a href="{{$setting->instagram}}">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
            <div class=" col-md-6 col-lg-2">
                <h3 class="footer-title heading-list"> @lang('website.quicklinks') <i class="fas fa-sort-down"></i></h3>
                <ul class="footer_menu grid_menu">
                    <li>
                        <a href="{{route('home')}}" class="footer-link">@lang('website.home')</a>
                    </li>
                    <li>
                        <a href="{{route('faq')}}" class="footer-link">@lang('website.faqs')</a>
                    </li>
                    <li>
                        <a href="{{route('contact')}}" class="footer-link">@lang('website.contactUs')</a>
                    </li>
                </ul>
            </div>

            <div class="col-6 col-lg-3">
                <h3 class="footer-title heading-list">@lang('website.contactinfo')<i class="fas fa-sort-down"></i></h3>
                <ul class="footer_menu">
                    <li>
                        <i class="fas fa-phone"></i>
                        <a href="tel:{{$setting->phone}}" class="footer-link">{{$setting->phone}}</a>

                    </li>
                    <li>
                        <i class="far fa-envelope"></i>
                        <a href="{{$setting->email}}" class="footer-link">{{$setting->email}}</a>
                    </li>
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <a href="#" class="footer-link">{{$setting->address}}</a>
                    </li>


                </ul>

            </div>
            <div class="col-12 col-lg-2">
                <h3 class="footer-title heading-list">@lang('website.download')<i class="fas fa-sort-down"></i></h3>
                <ul class="footer_menu">
                    <li>
                        <a href=""><img src="{{ asset('FrontS/img/App Store.png') }}" alt=""></a>

                    </li>
                    <li>
                        <a href=""> <img src="{{ asset('FrontS/img/Play Store.png') }}" alt=""></a>

                    </li>
                </ul>

            </div>

        </div>

    </div>

</div>

<div class="copyrights">
    <div class="container ">
        <p>© {{ now()->year }} @lang('website.copyright') Din-IN</p>
    </div>
</div>
<a href="# " class="go-top " data-toggle="tooltip " title=" " data-placement="left " data-original-title="go to top ">
    <i class="fa fa-arrow-up "></i>
</a>

<script src="{{ asset('FrontS/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('FrontS/js/simple-lightbox.min.js ') }}" type="text/javascript "></script>
<script src="{{ asset('FrontS/js/slick.js ') }}"></script>
<script src="{{ asset('FrontS/js/jquery.nice-select.js ') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN " crossorigin="anonymous "></script>

<script src="{{ asset('FrontS/js/bootstrap.min.js') }}"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script src="{{ asset('FrontS/js/main.js') }}"></script>
<script src="{{ asset('FrontS/js/wow.min.js') }}"></script>
<script>
    new WOW().init();
</script>

@stack('js')

</body>

</html>