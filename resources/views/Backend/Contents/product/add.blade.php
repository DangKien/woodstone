@extends('Backend.Layouts.default')
@section('content')
    <div id="content-container">
        <div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow"> {!! trans('backend.product.lable') !!} </h1>
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
                                    @if (isset($product))
                                        <form action="{{ route('products.update', @$product->id) }}" method="POST" enctype="multipart/form-data" >
                                            @method('PUT')
                                        @else
                                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" >
                                             @method('POST')
                                    @endif
                                        @csrf
                                        <!--Tabs Content-->
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
                                                                    @if (isset($product))
                                                                        @foreach ($product->translations as $translation) 
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
                                                                                       value="{{  old('name[@$languageTab->id]') ?? @$recordProduct->name }}">
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
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <label class="control-label text-bold">
                                                                                    {!! trans('backend.product.digital_radio') !!}
                                                                                </label>
                                                                                <textarea class="my-ckeditor" name="digital_radio[{{ @$languageTab->id }}]" placeholder="{!! trans('backend.category.digital_radio') !!}"
                                                                                          rows="5" class="form-control">{{ old('digital_radio.'.@$languageTab->id) ?? @$recordProduct->digital_radio }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <label class="control-label text-bold">
                                                                                    {!! trans('backend.product.specifications') !!}
                                                                                </label>
                                                                                <textarea class="my-ckeditor" name="specifications[{{ @$languageTab->id }}]" placeholder="{!! trans('backend.category.specifications') !!}"
                                                                                          rows="5" class="form-control">{{ old('specifications.'.@$languageTab->id) ?? @$recordProduct->specifications }}</textarea>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <label class="control-label text-bold">
                                                                                    {!! trans('backend.product.series') !!}
                                                                                </label>
                                                                                <textarea class="my-ckeditor" name="series[{{ @$languageTab->id }}]" placeholder="{!! trans('backend.category.series') !!}"
                                                                                          rows="5" class="form-control">{{ @old('series.'.@$languageTab->id) ?? @$recordProduct->series }}</textarea>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <label class="control-label text-bold">
                                                                                    {!! trans('backend.category.meta_title') !!}
                                                                                </label>
                                                                                <input type="text" name="meta_title[{{ @$languageTab->id }}]" class="form-control" placeholder="{!! trans('backend.category.meta_title') !!}"
                                                                                       value="{{ old('meta_title.'.@$languageTab->id) ?? @$recordProduct->meta_title }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <label class="control-label text-bold">
                                                                                    {!! trans('backend.seo.meta_description') !!}
                                                                                </label>
                                                                                <textarea name="meta_description[{{ @$languageTab->id }}]"
                                                                                          placeholder="{!! trans('backend.seo.meta_description') !!}" rows="5" class="form-control">{{ old('meta_description.'.@$languageTab->id) ?? @$recordProduct->meta_description }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <label class="control-label text-bold">
                                                                                    {!! trans('backend.seo.meta_keyword') !!}
                                                                                </label>
                                                                                <textarea name="meta_keyword[{{ @$languageTab->id }}]" placeholder="{!! trans('backend.seo.meta_keyword') !!}"
                                                                                          rows="5" class="form-control">{{ old('meta_keyword.'.@$languageTab->id) ?? @$recordProduct->meta_keyword}}</textarea>
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
                                                                        {!! trans('backend.product.category') !!}<span class="text-danger">*</span>
                                                                    </label>
                                                                    @php
                                                                    @endphp
                                                                    <select class="selectpicker" data-live-search="true" data-width="100%" name="category_id">
                                                                        <option value="0">-- None --</option>
                                                                        {{ showCategories($categories, 0, "--", @$product->category_id) }}
                                                                    </select>
                                                                    @if ($errors->has('parent_id'))
                                                                        <p class="text-left text-danger">{{ $errors->first('parent_id') }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label class="control-label text-bold">
                                                                        {!! trans('backend.product.image') !!} <span class="text-danger"> {!! trans('backend.product.size_image') !!}(*)</span>
                                                                    </label>
                                                                    <div class="input-group">
                                                                            <span class="input-group-btn">
                                                                                <a data-input="image" data-preview="image_preview" class="btn btn-primary my-lfm" type="'image'">
                                                                                    <i class="fa fa-picture-o"></i> Choose
                                                                                </a>
                                                                            </span>
                                                                        <input id="image" class="form-control" type="text" name="image" value="{{ @old('image') ?? @$product->image }}">
                                                                    </div>
                                                                    <img id="image_preview" @if (@$product->image || @old('image'))
                                                                    src="{{ url('') }}/{{ @old('image') ?? @$product->image  }}" @endif style="margin-top:15px;max-height:100px;">
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
                                                                                   checked
                                                                                   @endif
                                                                                   checked
                                                                            >
                                                                            <label for="AVAILABLE">{!! trans('backend.status.available') !!}</label>

                                                                            <input id="DISABLE" class="magic-radio" type="radio" name="status" value="{{ App\Libs\Configs\StatusConfig::CONST_DISABLE }}"
                                                                                   @if (statusDisable(old('status')) || statusDisable(@$product->status) )
                                                                                   checked
                                                                                    @endif>
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

