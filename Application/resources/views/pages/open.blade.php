@extends('layouts.pages')
@section('title', 'Download')
@section('content')
    <div class="download_page my-2">
        <div class="container">
            @if($ads->download_top_ads != null)
                <div class="adsn-top d-none d-md-flex">
                    {!! $ads->download_top_ads !!}
                </div>
            @endif
            <div class="do_height"></div>
            <div class="row">
                @if($ads->download_left_top_ads != null && $ads->download_left_bottom_ads != null)
                    <div class="col-lg-4">
                        <div class="desktop-adsn d-none d-md-block">
                            @if($ads->download_left_top_ads != null)
                                <div class="downoad_ads_top">
                                    {!! $ads->download_left_top_ads !!}
                                </div>
                            @endif
                            @if($ads->download_left_bottom_ads != null)
                                <div class="do_height"></div>
                                <div class="downoad_ads_bottom">
                                    {!! $ads->download_left_bottom_ads !!}
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
                <div class="col-lg-8 video-js-responsive-container  @if($ads->download_left_top_ads == null && $ads->download_left_bottom_ads == null) m-auto @endif">
                    <div class="download_box">
                        @if($ads->download_left_top_ads != null)
                            <div class="mobile-ads-top d-block d-md-none mb-3">
                                <div class="downoad_ads_top">
                                    {!! $ads->download_left_top_ads !!}
                                </div>
                            </div>
                        @endif
                            <link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />
                            <video
                                id="my-video"
                                class="video-js vjs-default-skin vjs-16-9"
                                controls
                                preload="auto"
                                data-setup="{}"
                            >
                                <source src="{{$file->file_path}}" type="video/mp4" />
                                <!--<source src="MY_VIDEO.webm" type="video/webm" />-->
                                <p class="vjs-no-js">
                                    To view this video please enable JavaScript, and consider upgrading to a
                                    web browser that
                                    <a href="https://videojs.com/html5-video-support/" target="_blank"
                                    >supports HTML5 video</a
                                    >
                                </p>
                            </video>

                            <script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>
                    @if($ads->download_left_bottom_ads != null)
                        <div class="mobile-ads-bottom d-block d-md-none mb-3 mt-3">
                            <div class="downoad_ads_bottom">
                                {!! $ads->download_left_bottom_ads !!}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
