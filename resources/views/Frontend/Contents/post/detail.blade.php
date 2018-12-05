@extends('Frontend.Layouts.default')

@section ('content')
    @php
        $banners = app('Setting')->getBanner();
    @endphp
    <div class="inner_top_area" style="background-image: url({{ url('').@$banners->setting->news_detail }});">
        <h2>{{ __('frontend.lable.new_center') }}</h2>
        <h5>
            <a href="{{ route('home.index') }}"> {{ __('frontend.lable.home') }} | </a>
            <a href="{{ route('home.news') }}">  {{ __('frontend.lable.new_center') }} | </a>
            <a>{{ $post->title }} </a>
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
                            <h2 class="text-center">
                                {!! $post->title  !!}
                            </h2>
                            <br>
                            <div>
                                <p>
                                    {!! $post->description  !!}
                                </p>
                                {!! $post->content !!}
                            </div>
                            <div class="view-more text-right">
                                <a href="{{ route('home.news') }}">
                                    {{ __('frontend.label.back') }}
                                    <i class="fa fa-angle-right"> </i>
                                </a>
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
        $arrMeta['title'] = @$post->meta_title ??  @$post->title;
        $arrMeta['meta_image'] = @$post->image ?? "";
        $arrMeta['meta_keyword'] = @$post->meta_keyword ?? "";
        $arrMeta['meta_description'] = @$post->meta_description ?? "";
    @endphp
    @includeIf('Frontend.Layouts._meta', $arrMeta)
@endsection