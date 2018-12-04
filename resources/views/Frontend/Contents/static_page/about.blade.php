@extends('Frontend.Layouts.default')

@section ('content')
    <div class="inner_top_area mrzn_zero">
        <h2>{{ __('frontend.label.about') }}</h2>
        <h5><a href="{{ route('home.index') }}">{{ __('frontend.lable.home') }}</a> | {{ __('frontend.label.about') }} </h5>
    </div>
    <div class="product_list_view">
        <div class="container">

            <div class="product-detail" style="margin-top: -80px;">
                <div class="row">
                    @includeIf('Frontend.Layouts._sidebar_static')
                    <div class="col-md-8">
                        <ol class="breadcrumb text-left">
                            <li><a href="{{ route('home.index') }}"><i class="fa fa-home"></i></a></li>
                            <li class="active">{{ __('frontend.label.about') }}</li>
                        </ol>
                        <h2 class="text-center">
                            {{ __('frontend.label.about') }}
                        </h2>
                        <br>
                        <p>
                            {!! @$about->content !!}
                        </p>
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
        $arrMeta['title'] = @$about->seo_keyword ?? __('frontend.label.about');
        $arrMeta['meta_image'] = '';
        $arrMeta['meta_keyword'] = $about->seo_keyword;
        $arrMeta['meta_description'] = $about->description;
    @endphp
    @includeIf('Frontend.Layouts._meta', $arrMeta)
@endsection