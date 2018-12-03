@extends('Backend.Layouts.default')
@section('content')
    <div id="content-container">
        <div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow"> {!! trans('backend.post.lable') !!} </h1>
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
                                    @if (isset($post))
                                        <form action="{{ route('posts.update', @$post->id) }}" method="POST" enctype="multipart/form-data" >
                                            @method('PUT')
                                        @else
                                        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" >
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
                                                                        @if (isset($post))
                                                                            @foreach ($post->translations as $translation)
                                                                                @if ($translation->locale == $languageTab->locale)
                                                                                    @php
                                                                                        @$recordPost = $translation;
                                                                                    @endphp
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                        <div id="language-tab-{{ @$languageTab->id }}" class="tab-pane {{ $key == 0 ? 'fade active in' : '' }}">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label class="control-label text-bold">
                                                                                        {!! trans('backend.post.title') !!} <span class="text-danger">*</span>
                                                                                    </label>
                                                                                    <input type="text" name="title[{{ @$languageTab->id }}]" class="form-control" value="{{ old('title.'.@$languageTab->id) ?? @$recordPost->title }}">
                                                                                    @if ($errors->has('title.'.@$languageTab->id))
                                                                                        <p class="text-left text-danger">{{ $errors->first('title.'.@$languageTab->id) }}</p>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label class="control-label text-bold">
                                                                                        {!! trans('backend.post.description') !!}
                                                                                    </label>
                                                                                    <textarea class="my-ckeditor" name="description[{{ @$languageTab->id }}]" placeholder="{!! trans('backend.category.description') !!}"
                                                                                              rows="5" class="form-control">{{ old('description.'.@$languageTab->id) ?? @$recordPost->description }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label class="control-label text-bold">
                                                                                        {!! trans('backend.post.content') !!} <span class="text-danger">*</span>
                                                                                    </label>
                                                                                    <textarea class="my-ckeditor" name="content[{{ @$languageTab->id }}]" placeholder="{!! trans('backend.category.content') !!}"
                                                                                              rows="5" class="form-control">{{ old('content.'.@$languageTab->id) ?? @$recordPost->content }}</textarea>
                                                                                    @if ($errors->has('content.'.@$languageTab->id))
                                                                                        <p class="text-left text-danger">{{ $errors->first('content.'.@$languageTab->id) }}</p>
                                                                                    @endif
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label class="control-label text-bold">
                                                                                        {!! trans('backend.seo.meta_title') !!}
                                                                                    </label>
                                                                                    <input type="text" name="meta_title[{{ @$languageTab->id }}]" class="form-control" placeholder="{!! trans('backend.seo.meta_title') !!}"
                                                                                           value="{{ old('meta_title.'.@$languageTab->id) ?? @$recordPost->meta_title }}">
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
                                                                                              rows="5" class="form-control">{{ old('meta_keyword.'.@$languageTab->id) ?? @$recordPost->meta_keyword}}</textarea>
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