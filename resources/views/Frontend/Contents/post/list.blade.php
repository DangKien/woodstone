@extends('Frontend.Layouts.default')

@section ('content')
    @php
        $banners = app('Setting')->getBanner();
    @endphp
    <div class="inner_top_area" style="background-image: url({{ url('').@$banners->setting->news }});">
        <h2>{{ __('frontend.lable.new_center') }}</h2>
        <h5>
            <a href="{{ route('home.index') }}"> {{ __('frontend.lable.home') }} | </a>
            <a href="{{ route('home.news') }}">  {{ __('frontend.lable.new_center') }} </a>
        </h5>
    </div>
    <div class="product_list_view">
        <div class="container">
            <div class="product-detail">
                <div class="row">
                    {{--Category--}}
                    {{--@includeIf('Frontend.Layouts._sidebar')--}}
                    {{--End category--}}
                    <div class="col-md-12">
                        <div class="recent_news_area blog_page spacer">
                            <div class="row">
                                @foreach ($posts as $item)
                                    <div class="news_cnt">
                                        <div class="news_slider_txt">
                                            <h3><a href="{{ route('home.news.detail', array($item->slug, $item->id)) }}">{{ $item->title }}</a></h3>
                                            <p>{!! \Illuminate\Support\Str::words($item->description, 20,'...') !!}</p>
                                            <div class="news_btn_area">
                                                <a href="{{ route('home.news.detail', array($item->slug, $item->id)) }}" class="cmn_btn1">
                                                    {{ __('frontend.lable.readmore') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="pagination_area">
                                    {{ $posts->links('Frontend.Layouts._paginate') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section ('myJs')
@endsection
@section ('myCss')
@endsection
@section ('meta')
    @php
        $arrMeta['title'] = __('frontend.lable.new_center');
        $arrMeta['meta_image'] = '';
        $arrMeta['meta_keyword'] = "";
        $arrMeta['meta_description'] = "";
    @endphp
    @includeIf('Frontend.Layouts._meta', $arrMeta)
@endsection