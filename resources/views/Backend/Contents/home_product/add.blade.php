@extends('Backend.Layouts.default')
@section('content')
    <div id="content-container">
        <div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow"> {!! trans('backend.home_product.lable') !!} </h1>
            </div>
            <ol class="breadcrumb">
                <li><a href="#"><i class="demo-pli-home"></i></a></li>
                <li><a href="#">{{ isset($product) ? trans('backend.actions.update') : trans('backend.actions.create') }}</a></li>
            </ol>
        </div>
        @php
            $languages = app('Language')->getLanguage();
        @endphp
        <div id="page-content">
            <div class="panel-body">
                <div class="panel">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-heading">
                                <h3 class="panel-title text-main text-bold mar-no">
                                    <i class="ti-pencil"></i> {{ isset($product) ? trans('backend.actions.update') : trans('backend.actions.create') }}
                                </h3>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="tab-base">
                                    <ul class="nav nav-tabs tabs-border">
                                        <li class="active">
                                            <a data-toggle="tab" href="#demo-lft-tab-1">{!! trans('backend.category.garena') !!}</a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#demo-lft-tab-2">{!! trans('backend.category.detail') !!}</a>
                                        </li>
                                    </ul>
                                    @if (isset($home_product))
                                        <form action="{{ route('home-products.update', @$home_product->id) }}" method="POST" enctype="multipart/form-data" >
                                        @method('PUT')
                                    @else
                                        <form action="{{ route('home-products.store') }}" method="POST" enctype="multipart/form-data" >
                                        @method('POST')
                                    @endif
                                        @csrf
                                                <div class="tab-content">
                                                    <!-- Tab language -->
                                                    <div id="demo-lft-tab-1" class="tab-pane fade active in">
                                                        <div class="panel-body col-sm-offset-0">
                                                            <div class="tab-base">
                                                                <!--Nav Tabs-->
                                                                <ul class="nav nav-tabs tabs-border">
                                                                    @foreach (@$languages as $key => $languageTab)
                                                                        <li class="{{ $key == 0 ? 'active' : '' }}">
                                                                            <a data-toggle="tab" href="#language-tab-{{ @$languageTab->id }}">
                                                                                {{ @$languageTab->name_display }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                                <div class="tab-content">
                                                                    @foreach (@$languages as $key => $languageTab)
                                                                        @if (isset($home_product))
                                                                            @foreach ($home_product->translations as $translation)
                                                                                @if ($translation->locale == $languageTab->locale)
                                                                                    @php
                                                                                        @$recordProduct = $translation;
                                                                                    @endphp
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                        <div id="language-tab-{{ @$languageTab->id }}" class="tab-pane {{ $key == 0 ? 'fade active in' : '' }}">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label class="control-label text-bold">
                                                                                        {!! trans('backend.product.name') !!}<span class="text-danger">*</span>
                                                                                    </label>
                                                                                    <input type="text" name="name[{{ @$languageTab->id }}]" class="form-control"
                                                                                           value="{{  old('name.'.@$languageTab->id) ?? @$recordProduct->name }}">
                                                                                    @if ($errors->has('name.'.@$languageTab->id))
                                                                                        <p class="text-left text-danger">{{ $errors->first('name.'.@$languageTab->id) }}</p>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label class="control-label text-bold">
                                                                                        {!! trans('backend.product.description') !!}
                                                                                    </label>
                                                                                    <textarea class="my-ckeditor" name="description[{{ @$languageTab->id }}]" placeholder="{!! trans('backend.category.description') !!}"
                                                                                              rows="5" class="form-control">{{ old('description.'.@$languageTab->id) ?? @$recordProduct->description }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label class="control-label text-bold">
                                                                                        {!! trans('backend.product.content') !!}
                                                                                    </label>
                                                                                    <textarea class="my-ckeditor" name="content[{{ @$languageTab->id }}]" placeholder="{!! trans('backend.category.content') !!}"
                                                                                              rows="5" class="form-control">{{ old('content.'.@$languageTab->id) ?? @$recordProduct->content }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!-- Tab detail -->
                                                    <div id="demo-lft-tab-2" class="tab-pane fade">
                                                        <div class="panel-body col-sm-offset-0">
                                                            <!-- data-parsley-validate -->
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label text-bold">
                                                                            {!! trans('backend.home_product.url') !!}<span class="text-danger">*</span>
                                                                        </label>
                                                                        <input type="text" name="url_product" class="form-control"
                                                                               value="{{  old('url_product') ?? @$home_product->url_product }}">
                                                                        @if ($errors->has('url_product'))
                                                                            <p class="text-left text-danger">{{ $errors->first('url_product') }}</p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label text-bold">
                                                                            {!! trans('backend.home_product.image') !!} <span class="text-danger">{!! trans('backend.home_product.size_image') !!} (*)</span>
                                                                        </label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-btn">
                                                                                <a data-input="image" data-preview="image_preview" class="btn btn-primary my-lfm" type="'image'">
                                                                                    <i class="fa fa-picture-o"></i> Choose
                                                                                </a>
                                                                            </span>
                                                                            <input id="image" class="form-control" type="text" name="image" value="{{ @old('image') ?? @$home_product->image }}">
                                                                        </div>
                                                                        <img id="image_preview" @if (@$home_product->image || @old('image'))
                                                                             src="{{ url('') }}/{{ @old('image') ?? @$home_product->image  }}" @endif style="margin-top:15px;max-height:100px;">
                                                                        @if ($errors->has('image'))
                                                                            <p class="text-left text-danger">{{ $errors->first('image') }}</p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12"  style="margin-bottom: 15px;">
                                                                    <div class="form-group has-feedback row">
                                                                        <label class="col-sm-3 control-label text-bold" style="padding-top: 12px;">{!! trans('backend.status.status') !!}
                                                                        </label>
                                                                        <div class="col-sm-7">
                                                                            <div class="radio">
                                                                                <input id="AVAILABLE" class="magic-radio" type="radio" name="status" value="{{ App\Libs\Configs\StatusConfig::CONST_AVAILABLE }}"
                                                                                       @if (statusAvailable(old('status')) || statusAvailable(@$product->status) )
                                                                                            checked @endif checked
                                                                                >
                                                                                <label for="AVAILABLE">{!! trans('backend.status.available') !!}</label>

                                                                                <input id="DISABLE" class="magic-radio" type="radio" name="status" value="{{ App\Libs\Configs\StatusConfig::CONST_DISABLE }}"
                                                                                       @if (statusDisable(old('status')) || statusDisable(@$product->status) )
                                                                                       checked @endif>
                                                                                <label for="DISABLE"> {!! trans('backend.status.disable') !!}</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-block btn-form-submit"><i class="ti-save"></i></button>
                                        </form>
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

