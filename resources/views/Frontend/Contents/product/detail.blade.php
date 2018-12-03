@extends('Frontend.Layouts.default')

@section ('content')
    <div class="inner_top_area">
        <h2>Forward in Advance</h2>
        <!-- <h5>Home / Products List</h5> -->
    </div>
    <div class="product_list_view">
        <div class="container">
            <div class="product-detail">
                <div class="row">
                    @includeIf('Frontend.Layouts._sidebar')
                    <div class="col-md-8">
                        <div class="product">
                            <ol class="breadcrumb text-left">
                                <li><a href="{{ route('home.index') }}"><i class="fa fa-home"></i></a></li>
                                @foreach ($breadcrumb as $item)
                                    <li><a href="{{ route('home.product', array($item->slug, $item->id)) }}">{{ $item->name }}</a></li>
                                @endforeach
                                <li class="active">{{ $product->name }}</li>
                            </ol>
                            <h2>{{ $product->name }}</h2>
                            <div>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#overview" aria-controls="overview" role="tab" data-toggle="tab">{{ __('frontend.product.overview') }}</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#featrue" aria-controls="featrue" role="tab" data-toggle="tab">{{ __('frontend.product.feature') }}</a>
                                    </li>
                                </ul>
                            </div>
                            <p>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="overview">
                                <p>
                                    {!! $product->description !!}
                                </p>
                                <p>
                                    {!! $product->content !!}
                                </p>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="featrue">
                                <p>
                                    {!! $product->specifications !!}
                                </p>
                                <p>
                                    {!! $product->series !!}
                                </p>
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
    <meta name="description" content="{!! @$seo->data->description !!}">
    <meta name="keywords" content="{!! @$seo->data->keyword !!}" />
@endsection
@section ('title', @$seo->data->title)