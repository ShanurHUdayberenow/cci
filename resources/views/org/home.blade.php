@extends('org.layouts.layout')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/lib/owlcarousel/assets/owl.theme.default.min.css') }}">

<style>
.footer {
    background: #152F4F;
    color: white;
}

.footer .links ul {
    list-style-type: none;
}

.footer .links li a {
    color: white;
    transition: color 0.2s;
}

.footer .links li a:hover {
    text-decoration: none;
    color: #4180CB;
}

.footer .about-company i {
    font-size: 25px;
}

.footer .about-company a {
    color: white;
    transition: color 0.2s;
}

.footer .about-company a:hover {
    color: #4180CB;
}

.footer .location i {
    font-size: 18px;
}

.footer .copyright p {
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.running {
    display: inline-block;
    margin: 5px;
}

.tickerheader {
    /* width: 150px; */
    height: 30px;
    position: absolute;
    background: #286090;
    color: whitesmoke;
    text-align: center;
    z-index: 1;
    line-height: 30px;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
    display: inline;
    padding: 0px 10px;
    margin-top: 15px;
}

.tickerheader span {
    vertical-align: baseline;
    font-family: inherit;
    font-size: 15px;
    font-weight: bold;
}

.tickerheader:before {
    content: "";
    position: absolute;
    z-index: 1;
    right: -15px;
    bottom: 0;
    width: 0;
    height: 0;
    border-left: 15px solid #286090;
    border-top: 15px solid transparent;
    border-bottom: 15px solid transparent;
}

marquee {
    margin-bottom: -60px;
    box-shadow: 0px 0px 4px 1px rgba(0, 0, 0, 0.267);
    background: white;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    margin-top: 20px;
    margin-bottom: 20px;
    padding-top: 15px;
    padding-bottom: 10px;
    overflow-x: hidden !important;
}

marquee .text_car {
    font-weight: bolder;
    font-size: 14px;
    color: black;
    margin-left: 20px;
    margin-right: 20px;
}

marquee .running {
    font-size: 14px;
    color: gray;
}

marquee img {
    margin-right: 5px;
}

.media-29101 .blok span {
    margin: 10px;
    color: black;
}

.media-29101 {
    border: 1px solid rgba(0, 0, 0, 0.125);
}

.cub .partner img{
    width: 100%;
    height: 70px;
    object-fit: contain;
}



.cub{
    background: white;
    border-radius: 5px;
    width: 80%;
    margin-left: auto;
    margin-right: auto;
    padding-left: 10px;
    padding-right: 10px;
    
}

</style>
@endpush

@section('title', $title)

@section('content')



<div class="wrapper m-auto">
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
        </ol>
        <div class="carousel-inner m-auto" style="margin: 0px;">
            @foreach ($carousels as $k => $v)
            <div class="carousel-item @if ($k == 0) active @endif">
                <img class="d-block w-100" src="{{ asset('uploads') . '/' . $v->__('thumbnail') }}">
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev m-auto" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="fa fa-chevron-left"></span>
        </a>
        <a class="carousel-control-next m-auto" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="fa fa-chevron-right"></span>
        </a>
    </div><!-- /.container -->
</div>
{{-- news --}}
<div class="wrapper m-auto carous_text">
    {{-- <div class="tickerheader">
            <span>@lang('home/home.news')</span>
        </div> --}}
    <marquee behavior="scroll" direction="left" style="--pause-on-hover: paused;--pause-on-click: running;"
        onmouseover="this.stop();" onmouseout="this.start();">
        <div class="marquee-container" style="width: 100%;">
            @foreach ($running as $run)
            @continue(($run->__('title')) == false)
            <a href="{{ route('news_single', $run->slug) }}">
                <img src="images/Union.png">
                <p class="running card-text">{{ Carbon\Carbon::parse($run->publish_at)->format('d.m.Y')  }}
                    <span class="text_car">{{ $run->__('title') }}</span>
                </p>
            </a>
            @endforeach
        </div>

    </marquee>
</div>
<section class="news m-auto">
    <div class="news-main">
        <h1>@lang('home/home.news')</h1><a href="{{ route('news') }}">
            <p>@lang('home/home.news_small')</p>
        </a>
    </div>
</section>
<section class="main-photo" style="background-color: #f5f6fb;padding: 25px 0;">
    <div class="m-photo">
        <div class="container ">
            <div class="row">
                <div class="card-group">
                    @foreach ($news as $new)
                    @continue(($new->__('title') && $new->__('desc')) == false)
                    <div class="card m-2">
                        
                        <img class="card-img-top" src="{{ $new->getImage() }}" alt="Card image cap">
                        
                        <div class="card-body">
                            <a href="{{ route('news_single', $new->slug) }}">
                                <p class="card-text text-dark">{{ $new->__('title') }}</p>
                            </a>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">{{date("d.m.Y", strtotime($new->publish_at ))}}</small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>
</section>

{{--NewsCci--}}
<section class="news m-auto">
    <div class="news-main">
        <h1>@lang('home/home.news2')</h1>
        <a href="{{ route('news_cci') }}">
            <p>@lang('home/home.news_small')</p>
        </a>
    </div>
</section>
<section class="main-photo" style="background-color: #f5f6fb;padding: 25px 0;">
    <div class="m-photo">
        <div class="container ">
            <div class="row">
                <div class="card-group">
                    @foreach ($newsCci as $cci)
                    @continue(($cci->__('title') && $cci->__('desc')) == false)
                    <div class="card m-2">
                        <img class="card-img-top" src="{{ $cci->getImage() }}" alt="Card image cap">
                        <div class="card-body">
                            <a href="{{ route('news_cci_single', $cci->slug) }}">
                                <p class="card-text text-dark">{{ $cci->__('title') }}</p>
                            </a>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">{{date("d.m.Y", strtotime($cci->publish_at ))}}</small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>
</section>

{{-- reklamny banner --}}
<section class="main-photo">
    <div class="m-photo">
        <div class="container ">
            <div class="row"></div><!-- /.row -->
        </div><!-- /.container -->
    </div>
</section><!-- /.blocks -->
<div class="banner m-auto text-center">
    <div class="wrapper m-auto">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner m-auto">
                @foreach ($banner as $k => $v)
                <div class="carousel-item @if ($k==0) active @endif">
                    <a href="
                            @if (app()->getLocale() === 'ru' || app()->getLocale() === null)
                            {{ asset('assets/admin/docs/Arza_ru.docx')}}
                            @elseif(app()->getLocale() === 'tk')
                            {{ asset('assets/admin/docs/Arza_tm.docx')}}
                            @endif">
                        <img class="d-block " height="330" width="100%"
                            src="{{ asset('uploads') . '/' . $v->__('thumbnail') }}">
                    </a>
                </div>
                @endforeach
            </div>
        </div><!-- /.container -->
    </div>
</div><!-- /.banner -->

<br>

{{-- Gallery --}}
<div class="content">
    <div class="rolls m-auto">
        <div class="news-main ">
            <h1>@lang('home/home.gallery')</h1>
        </div><!-- /.container -->
    </div>
    <br>
    <div class="site-section bg-left-half mb-5">
        <div class="container-fluid owl-2-style">
            <div class="owl-carousel owl-2" style="max-width: 1583px; margin-left: auto; margin-right: auto;">
                @foreach ($galleries as $gallery)
                <div class="media-29101">
                    <a href="{{ route('album_single', ['slug' => $gallery->slug]) }}" @if ($gallery->album == null)
                        style="pointer-events: none;" @endif>
                        <div class="img d-flex align-items-end justify-content-center" style="
                                        background-image:url({{ $gallery->getImage() }});
                                        height: 250px;
                                        background-position: center;
                                        background-repeat: no-repeat;
                                        background-size: cover;">

                        </div>
                        <div class="blok w-100 h-30 text-center"
                            style="font-weight: 500;padding-top: 10px;padding-bottom: 5px;padding-left: 5px;padding-right: 5px;">
                            <span>{{ Illuminate\Support\Str::limit($gallery->__('title') , 40)}}</span>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>

{{--partners--}}
<section class="" style="background: #f5f6fb;padding-top: 20px;padding-bottom: 20px;">
    <div class="main m-auto">
        <h2>@lang('home/home.partners')</h2>
    </div>
    <div id="partners" class="main m-auto owl-carousel">

        @foreach ($partners as $partner)
        @continue($partner->thumbnail === null || $partner->is_show === 0)
        <div class="row align-items-center justify-content-center">
            <div class="cub">
                <div class="partner" style="">
                    <div><a href="https://{{$partner->web}}" target="blank"><img src="{{ $partner->getImage() }}" alt="">
                        <style>
                        .partner div img {
                            display: flex !important;
                            width: 100% !important;
                            padding: .5rem 0px;
                            margin-left: 2.1rem;
                        }
                        </style>
                        </a>
                    </div>
                </div>
            </div><!-- /.col-lg-2 -->
        </div>
        @endforeach
    </div>
</section>

@push('scripts')

<script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>

{{-- carousel gallery --}}
<script>
$(function() {
    if ($('.owl-2').length > 0) {
        $('.owl-2').owlCarousel({
            center: true,
            items: 1,
            loop: true,
            stagePadding: 0,
            margin: 5,
            smartSpeed: 1000,
            autoplay: true,
            nav: true,
            dots: true,
            pauseOnHover: false,
            responsive: {
                600: {
                    margin: 5,
                    nav: true,
                    items: 2
                },
                1000: {
                    margin: 5,
                    stagePadding: 0,
                    nav: true,
                    items: 5
                }
            }
        });
    }
})
</script>
@endpush
@endsection