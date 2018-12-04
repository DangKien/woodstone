@extends('Frontend.Layouts.default')

@section ('content')
    <div class="inner_top_area mrzn_zero">
        <h2>{{ __('frontend.label.quality') }}</h2>
        <h5><a href="{{ route('home.index') }}">{{ __('frontend.lable.home') }}</a> | {{ __('frontend.label.quality') }} </h5>
    </div>
    <div class="product_list_view">
        <div class="container">
            <div class="product-detail" style="margin-top: -80px;">
                <div class="row">
                    @includeIf('Frontend.Layouts._sidebar_static')
                    <div class="col-md-8">
                        <ol class="breadcrumb text-left">
                            <li><a href="{{ route('home.index') }}"><i class="fa fa-home"></i></a></li>
                            <li class="active">{{ __('frontend.label.quality') }}</li>
                        </ol>
                        <h2 class="text-center">
                            {{ __('frontend.label.quality') }}
                        </h2>
                        <br>
                        <p>
                            {!! @$quality->content !!}
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
        $arrMeta['title'] = @$quality->seo_keyword ?? __('frontend.label.quality');
        $arrMeta['meta_image'] = '';
        $arrMeta['meta_keyword'] = @$quality->seo_keyword;
        $arrMeta['meta_description'] = @$quality->description;
    @endphp
    @includeIf('Frontend.Layouts._meta', $arrMeta)
@endsection