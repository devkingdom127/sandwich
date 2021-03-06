@extends('layouts.app')

@section('title')
    Home Page
@endsection

@section('content')
    @includeIf('layouts.header')

    <section class="hero">
        <div class="container container-custom">
            <section class="u-clearfix u-grey-10 u-section-1" id="carousel_db44">
                <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
                    <div id="carousel-963b" data-interval="5000" data-u-ride="carousel"
                         class="u-carousel u-expanded-width u-slider u-slider-1">
                        <ol class="u-absolute-hcenter u-carousel-indicators u-carousel-indicators-1">
                            @if($slider->count() != 0)
                                @php $c = 0 ; @endphp
                                @foreach($slider as $r)
                                    <li data-u-target="#carousel-963b" class="{{$c == 0 ? "u-active" : ""}} u-grey-30"
                                        data-u-slide-to="{{$c}}"></li>
                                    @php $c = 1 + $c; @endphp
                                @endforeach
                            @endif
                        </ol>


                        <div class="u-carousel-inner" role="listbox">

                            @if($slider->count() != 0)
                                @php $c = 1 ; @endphp
                                @foreach($slider as $r)
                                    <div
                                        class="{{$c == 1 ? "u-active" : ""}} u-carousel-item u-container-style u-slide">
                                        <!-- Slide 1 -->
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 sc-sm">
                                                <div class="photo">
                                                    <img src="{{$r->img1()}}" alt="{{$r->name}}">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12">
                                                <div class="content">
                                                    {!! $r->summary !!}
                                                    <a href="{{$r->link}}" id="google-play">
                                                        <img src="{{path()}}public/files/home/img/google_play.png" alt="">
                                                        <span>GET IT ON</span>
                                                        <span>Google Play</span>
                                                    </a>
                                                    <a href="{{$r->video}}" id="apple">
                                                        <img src="{{path()}}public/files/home/img/apple.png" alt="">
                                                        <span>Available on the</span>
                                                        <span>App Store</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 sc-lg">
                                                <div class="photo">
                                                    <img src="{{$r->img1()}}" alt="{{$r->name}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php $c = 1 + $c; @endphp
                                @endforeach
                            @endif

                        </div>

                        <a class="u-absolute-vcenter u-carousel-control u-carousel-control-prev u-opacity u-opacity-70 u-palette-3-base u-spacing-15 u-text-body-color u-carousel-control-1"
                           href="#carousel-963b" role="button" data-u-slide="prev">
                            <span aria-hidden="true">
                            <svg viewBox="0 0 477.175 477.175"><path d="M145.188,238.575l215.5-215.5c5.3-5.3,5.3-13.8,0-19.1s-13.8-5.3-19.1,0l-225.1,225.1c-5.3,5.3-5.3,13.8,0,19.1l225.1,225
                                    c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1L145.188,238.575z"></path></svg>
                            </span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="u-absolute-vcenter u-carousel-control u-carousel-control-next u-opacity u-opacity-70 u-palette-3-base u-spacing-15 u-text-body-color u-carousel-control-2"
                           href="#carousel-963b" role="button" data-u-slide="next">
                            <span aria-hidden="true">
                            <svg viewBox="0 0 477.175 477.175"><path d="M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5
                                    c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z"></path></svg>
                            </span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </section>

        </div>
    </section>

    <section class="join-us">
        <div class="container container-custom">
            <div class="title">
                <h3 class="">Join us</h3>
                <p>Be a part of the talabat story</p>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 wow animate__animated animate__fadeInUp">
                    <div class="box-1">
                        <div class="join-img">
                            <img src="{{$join_us->img1()}}" alt="">
                        </div>
                        <div class="join-content">
                            {!! $join_us->summary !!}
                            <a href="{{route('restaurant')}}">Read More</a>
                        </div>

                    </div>
                </div>
                <div class="col-md-6 col-sm-12 wow animate__animated animate__fadeInUp">
                    <div class="box-2">
                        <div class="join-img">
                            <img src="{{$join_us->img2()}}" alt="">
                        </div>
                        <div class="join-content">
                            {!! $join_us->summary1 !!}
                            <a href="{{route('rider')}}">Read More</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="video wow animate__animated animate__fadeInUp">
        <div class="container container-custom">
            {!! $video->summary !!}
        </div>
        <div class="parent-video">
            <div class="box-video" style="background: url('{{$video->img1()}}');background-repeat: no-repeat;
                background-size: contain;
                background-position: center center;    height: 350px;
                opacity: .5;">

            </div>
            <a href="{{$video->link}}"><img src="{{path()}}public/files/home/img/play_video.png" alt=""></a>
        </div>

    </section>

    @includeIf('layouts.footer')

@endsection
