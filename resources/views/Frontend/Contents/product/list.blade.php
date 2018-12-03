@extends('Frontend.Layouts.default')

@section ('content')
    <div class="inner_top_area">
        <h2>Forward in Advance</h2>
        <h5> <a href="{{ route('home.index') }}"> {{ __('frontend.lable.home') }} | </a>
            @foreach ($breadcrumb as $key => $item)
                <a href="{{ route('home.product', array($item->slug, $item->id)) }}">{{ $item->name }}
                    @if ($key != count($breadcrumb) - 1)
                        |
                    @endif
                </a>
            @endforeach
        </h5>
    </div>
    <div class="product_list_view">
        <div class="container">
            <div class="product-detail">
                <div class="row">
                    {{--Category--}}
                        @includeIf('Frontend.Layouts._sidebar')
                    {{--End category--}}
                    <div class="col-md-8">
                        <ol class="breadcrumb text-left">
                            <li><a href="{{ route('home.index') }}"><i class="fa fa-home"></i></a></li>
                            @foreach ($breadcrumb as $item)
                                <li><a href="{{ route('home.product', array($item->slug, $item->id)) }}">{{ $item->name }}</a></li>
                            @endforeach
                        </ol>
                        <div class="product category_tab_area product_grid_area">
                            <div>
                                @foreach ($products as $item)
                                <div class="cat_item">
                                    <figure><img src="{{ url('').$item->image }}" alt="product">
                                        <a href="{{ route('home.product.detail', array($item->slug, $item->id)) }}">
                                            <div class="fig_overlay">
                                            </div>
                                        </a>
                                    </figure>
                                    <h3><a href="{{ route('home.product.detail', array($item->slug, $item->id)) }}">{{ $item->name }}</a></h3>
                                    <p>
                                        {{--{!! \Illuminate\Support\Str::words($item->description, ,'....') !!}--}}
                                    </p>
                                </div>
                                 @endforeach
                            </div>
                            <div class="pagination_area">
                                {{ $products->links('Frontend.Layouts._paginate') }}
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
    <meta name="description" content="{!! @$seo->data->description !!}">
    <meta name="keywords" content="{!! @$seo->data->keyword !!}" />
@endsection
@section ('title', @$seo->data->title)