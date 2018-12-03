@extends('Backend.Layouts.default')
@section('content')
    @php
        $languages = app('Language')->getLanguage();
    @endphp
    <div id="content-container">
        <div id="page-content">
            <div class="panel">
                <div class="panel-body">
                    <form action="{{ route('quanlity.post') }}" method="POST">
                        @method('POST')
                        @csrf()
                        <ul class="nav nav-tabs tabs-border">
                            <li class="active">
                                <a data-toggle="tab" href="#demo-lft-tab-1">{!! trans('backend.category.garena') !!}</a>
                            </li>
                        </ul>
                        <!--Tabs Content-->
                        <div class="tab-content">
                            <!-- Tab language -->
                            <div id="demo-lft-tab-1" class="tab-pane fade active in">
                                <div class="panel-body col-sm-offset-1">
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
                                            @php
                                                $translations = @$quanlity->translations ?? array();
                                            @endphp
                                            @foreach ($translations as $translation)
                                                @if ($translation->locale == $languageTab->locale)
                                                    @php
                                                        $record_quanlity = $translation;
                                                    @endphp
                                                @endif
                                            @endforeach
                                                <div id="language-tab-{{ @$languageTab->id }}" class="tab-pane {{ $key == 0 ? 'fade active in' : '' }}">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                {!! trans('backend.quanlity.content') !!} <span class="text-danger"> (*)</span>
                                                            </label>
                                                            <textarea class="my-ckeditor"
                                                                      name="content[{{ @$languageTab->id }}]">{!! @$record_quanlity->content ? $record_quanlity->content : @old('content.'.@$languageTab->id) !!}</textarea>

                                                            @if ($errors->has('content.'.@$languageTab->id))
                                                                <p class="text-left text-danger">{{ $errors->first('content.'.@$languageTab->id) }}</p>
                                                            @endif
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                {!! trans('backend.seo.meta_title') !!}
                                                            </label>
                                                            <input type="text" name="meta_title[{{ @$languageTab->id }}]" class="form-control"
                                                                   placeholder="{!! trans('backend.seo.meta_title') !!}"
                                                                   value="{{ @$record_quanlity->meta_title ? $record_quanlity->meta_title: @old('meta_title.'.@$languageTab->id) }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                {!! trans('backend.seo.meta_keyword') !!}
                                                            </label>
                                                            <input type="text" name="meta_keyword[{{ @$languageTab->id }}]" class="form-control"  placeholder="{!! trans('backend.seo.meta_keyword') !!}"
                                                                   value="{{ @$record_quanlity->meta_keyword ? $record_quanlity->meta_keyword: @old('meta_keyword.'.@$languageTab->id) }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label">{!! trans('backend.seo.meta_description') !!}</label>
                                                            <textarea placeholder="{!! trans('backend.seo.meta_description') !!}" rows="5" class="form-control" name="meta_description[{{ @$languageTab->id }}]"
                                                            >{!! @$record_quanlity->meta_description ? $record_quanlity->meta_description: @old('meta_description.'.@$languageTab->id) !!}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
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
@endsection

@section('myJs')
    @if (Session::has('status') )
        <script>
            $.toast({
                heading: '{!! Session::get('status') !!}',
                text: '{!! Session::get('messages') !!}',
                showHideTransition: 'fade',
                position: 'top-right',
                icon: '{!! Session::get('status') !!}'
            })
        </script>
    @endif
@stop
