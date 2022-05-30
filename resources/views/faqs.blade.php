@extends('website.layouts.master')

@section('content')
    <!--start top section-->
    <div class="internal-header">
        <div class="container">
            <h3>Frequently Asked Questions</h3>
            {{-- <p>An enim nullam tempor sapien gravida donec enim ipsum porta justo congue purus pretium ligula sapien gravida donec enim ipsum poc enim ipsum porta</p> --}}
        </div>
    </div>

    <!-- start ABoutus -->

    <div class="faq">
        <div class="container">

            <div class="row">
              
                <div class="col-md-12">
                    <div class="container-inner">
                        <div class="tab-container">
@foreach ( $faqs as $faq)
    <div class="tab-accordian">

                                <div class="titleWrapper inactive">
                                    <h3>{{$faq->question}} ?</h3>

                                    <div class="collapse-icon">
                                        <div class="acc-close"></div>
                                        <div class="acc-open"></div>
                                    </div>
                                </div>

                                <div id="descwrapper" class="desWrapper">
                                    <p> {{$faq->question}}</p>


                                </div>

                            </div>
@endforeach
                            

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection