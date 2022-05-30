@extends('website.layouts.master')

@section('content')

    <!--start top section-->
    <div class="internal-header">
        <div class="container">
            <h3>Contact us</h3>
            {{-- <p>An enim nullam tempor sapien gravida donec enim ipsum porta justo congue purus pretium ligula sapien gravida donec enim ipsum poc enim ipsum porta</p> --}}
        </div>
    </div>

    <!-- start ABoutus -->

    <div id="services" class="services">
        <img src="{{ asset('FrontS/img/dots.png') }}" class="img-fluid dot2" alt="">
        <img src="{{ asset('FrontS/img/Mask Group (7).png') }}" class="img-fluid dot1" alt="">
        <div class="container">


            <div class="row">

                <div class="col-md-4 col-12">
                    <div class="cont-ser">
                        <div class="cont-ser-section">
                            <div class="localinkk">
                                <img src="{{ asset('FrontS/img/location.png') }}" alt="">
                            </div>
                            <p class="loc">{{$setting->address}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12 ">
                    <div class="cont-ser ">
                        <div class="cont-ser-section ">
                            <div class="localinkk">
                                <img src="{{ asset('FrontS/img/call.png') }}" alt="">
                            </div>
                            <div class="linkk">
                                <a href="tel:{{$setting->phone}}">{{$setting->phone}}</a>
                                <a href="#">{{$setting->whatsapp}}</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12 ">
                    <div class="cont-ser ">
                        <div class="cont-ser-section ">
                            <div class="localinkk">
                                <img src="{{ asset('FrontS/img/mess.png') }}" alt="">
                            </div>
                            <div class="linkk">
                                <a href="#">{{$setting->email}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact_cont">
                <div class="row">
                    <div class="col-md-6">
                        <div class="map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3623.650859370141!2d46.64176368475698!3d24.738863956212338!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2ee36823527cdb%3A0x67b0574b6b8f0d27!2sMCIT!5e0!3m2!1sar!2seg!4v1632406153544!5m2!1sar!2seg"
                                style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="text-form-cont">

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
    </div>
    </div>
    <!-- End ABoutus  -->


@endsection