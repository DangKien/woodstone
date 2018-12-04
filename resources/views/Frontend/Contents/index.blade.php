@extends('Frontend.Layouts.default')

@section ('content')
    @php
        $productHomes = app('Home')->getProductHome();
    @endphp
    <div class="service_bx">
        <ul>
            <li>
                <div class="service_head">
                    <h4>About Us</h4>
                    <h6>Glovane Co., Ltd is a leading supplier of highly
                        integrated and low-power Digital radio receiver
                        SoCs</h6>
                    <div class="mt25">
                        <a href="/sub04/sub01.php">View <i class="fa fa-angle-right"> </i></a>
                    </div>
                </div>
                <figure><img src="{{ url('Frontend') }}/images/product/1.png" alt="icon"></figure>
            </li>
            <li>
                <div class="service_head">
                    <h4>Contact Us</h4>
                    <h6>Glovane Co., Ltd. has office in South Korea and Shen-Zhen in China.
                    </h6>
                    <div class="mt26">
                        <a href="/sub04/sub01.php">View <i class="fa fa-angle-right"> </i></a>
                    </div>
                </div>
                <figure><img src="{{ url('Frontend') }}/images/product/2.png" alt="icon"></figure>
            </li>
        </ul>
    </div>
    <div class="clearfix" style="background: #f6f6f6;">
    </div>
    <div class="welcome_area">
        <div class="container">
            <div id="random" class="skippr owl-carousel">
                @foreach ($productHomes as $productHome)
                    <div class="prd_con visible col-md-10 col-md-offset-1">
                        <div class="con_txt col-md-6">
                            <p class="pr_subject">{{ $productHome->name }}</p>
                            <p class="pr_txt">
                                {!! $productHome->description !!}
                            </p>
                            {!! $productHome->content !!}
                            <div class="view-more">
                                <a href="{{ $productHome->url_product }}">
                                    {{ __('frontend.view_more') }} <i class="fa fa-angle-right"> </i>
                                </a>
                            </div>

                        </div>

                        <div class="img col-md-6 text-center">
                            <img src="{{ url('Frontend') }}/images/product/img_rolling01.jpg">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section ('slide')
    @includeif ('Frontend.Layouts._slide')
@endsection

@section ('myJs')
    <script>
        $('.owl-carousel').owlCarousel({
            loop:true,
            items:1,
            margin:10,
            nav:true,
            navText: ['<i class="fa fa-angle-left nav-product nav-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right nav-product nav-right" aria-hidden="true"></i>']
        })
    </script>
@endsection
@section ('myCss')
@endsection
@section ('meta')
    @php
        $arrMeta['title'] = '';
        $arrMeta['meta_image'] = '';
        $arrMeta['meta_keyword'] = '';
        $arrMeta['meta_description'] = '';
    @endphp
    @includeIf('Frontend.Layouts._meta', $arrMeta)
@endsection