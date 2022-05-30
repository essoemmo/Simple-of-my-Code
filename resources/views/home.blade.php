@extends('website.layouts.master')

@section('content')
   <!--start top section-->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="h1-head">{{$header->title}}</h1>
                    <p class="p-head">{{$header->description}}</p>
                    <div class="store-cont">
                        <a href="#"><img src="{{ asset('FrontS/img/App Store.png') }}" alt=""></a>
                        <a href="#"> <img src="{{ asset('FrontS/img/Play Store.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('FrontS/img/images.png') }}" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </header>

    <!-- start ABoutus -->

    <div id="services" class="services">
        <img src="{{ asset('FrontS/img/dots.png') }}" class="img-fluid dot2" alt="">
        <img src="{{ asset('FrontS/img/Mask Group (7).png') }}" class="img-fluid dot1" alt="">
        <div class="container">
            <div class="align-center">
                <h2 class="title-header ">
                    {{$features->title}}
                </h2>
            </div>

            <p class="p-title">{{$features->description}}</p>

            <div class="row">
            @foreach ( $features->subsections as $feature )
                <div class="col-md-4 col-12">
                    <div class="cont-ser">
                        <div class="cont-ser-section">
                            <img src="{{ asset($feature->image) }}" alt="" style="width: 80px;">
                            <h4>{{$feature->title}}</h4>
                            <p>{{$feature->description}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
    <!-- End ABoutus  -->

    <!-- start banner -->
    <div class="banner">
        <div class="over-lay"></div>
        <div class="container">
            <div class="cont-banner">
                @foreach ( $sliders->subsections as $slider)

                <div class="item">
                    <h5>{{$slider->title}}</h5>
                    <p>{{$slider->description}}</p>
                </div>
                    
                @endforeach

            </div>
        </div>
    </div>
    <!-- End banner -->

    <!-- start services -->
    <div class="services-section">
        <div class="container">
            <div class="align-center">
                <h2 class="title-header ">
                    {{$services->title}}
                </h2>
            </div>

            <p class="p-title"> {{$services->description}}</p>
            <div class="row">

                @foreach ( $services->subsections as $service )
                <div class="col-md-4">
                    <div class="cont-services-section">
                        <div class="img-services-section">
                            <img src="{{ asset($service->image) }}" style="width: 80px;">
                        </div>
                        <h4> {{$services->title}} </h4>
                        <p>
                        {{$services->description}}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- END services -->


    <!--start feel or vibe -->
    <div class="vibe">
        <div class="container">
            <div class="align-center">
                <h2 class="title-header ">
                    {{$vibe->title}}
                </h2>
            </div>

            <p class="p-title">{{$vibe->description}} </p>
            <!-- Gallery -->
            <div class="gallery-cont">

                <div class="double">
                    <div>
                        <img src="{{ asset($vibe->subsections()->where('id',7)->first()->image) }}" alt="">
                    </div>
                    <div>
                        <img src="{{ asset($vibe->subsections()->where('id',8)->first()->image) }}" alt="">
                    </div>
                </div>

                <div class="single">
                    <img src="{{ asset($vibe->subsections()->where('id',11)->first()->image) }}" alt="">
                </div>

                <div class="double">
                    <div>
                        <img src="{{ asset($vibe->subsections()->where('id',9)->first()->image) }}" alt="">
                    </div>
                    <div>
                        <img src="{{ asset($vibe->subsections()->where('id',10)->first()->image) }}" alt="">
                    </div>
                </div>

            </div>
            <!-- end gallery -->

        </div>

    </div>
    <!--End feel or vibe -->

    <!-- start banner -->
    <div class="banner-two">
        <div class="container">
            <div class="align-center">
                <h2 class="title-header">
                   {{$partners->title}}
                </h2>
            </div>

            <p class="p-title">
                {{$partners->description}}
            </p>

            <div class="row">
                @foreach ( $partners->subsections as $partner)

                <div class="col-md-2 col-4">
                    <div class="img-partner">
                        <img src="{{ asset($partner->image) }}" alt="">
                    </div>
                </div>

                @endforeach

            </div>
        </div>
    </div>
    <!-- End banner -->

    <!-- start contact us -->
    <div class="contact-us">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="text-form">
                        <h4>@lang('admin.contactus')</h4>
                        <p>@lang('admin.contactusTitle')</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="backform">
                        <form action="{{ route('storecontact')}}" method="POST" data-parsley-validate>
                            @csrf
                            @method('post')
                            <div>
                                <h6>@lang('admin.phone') : </h6>
                                <input type="number" name="phone" required>
                            </div>
                            <div>
                                <h6>@lang('admin.massega') : </h6>
                                <textarea name="description" id=""></textarea>
                            </div>
                            <div>
                                <input name="submit" type="submit" value="Send message">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End contact us -->

    <!-- start contact us -->
    <div class="contact-us">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="text-form">
                        <h4>{{$video->title}}</h4>
                        <p> {{$video->description}} </p>
                        <a href="#" class="download-buton">
                            @lang('website.subscribe')
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <iframe width="100%" height="300px" style="margin-top: 150px;" poster=""
                    src="{{$video->url}}">
                    </iframe> 
                </div>
            </div>
        </div>
    </div>
    <!-- End contact us -->
    
    <div class="footer-application">
        <div class="container">
            <div class="cont-banner-app">
                <h3>{{$devices->title}}</h3>
                <p>
                    {{$devices->description}}
                </p>
                <div class="store-cont">
                    <a href=""><img src="{{ asset('FrontS/img/App Store.png') }}" alt=""></a>
                    <a href=""> <img src="{{ asset('FrontS/img/Play Store.png') }}" alt=""></a>
                </div>
            </div>
        </div>
    </div>
    @endsection