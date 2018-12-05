@extends('Backend.Layouts.default')
@section ('title', 'ZeLike 澤樣室內設計')
@section('content')
    @php
        $languages = app('Language')->getLanguage();
    @endphp
    <div id="content-container" ng-controller="settingCtrl">
        <div id="page-content">
            <div class="panel" style="background-color: #ecf0f5">
                <div class="panel-body">
                    <div class="tab-base tab-stacked-left tab-setting">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a data-toggle="tab" href="#tab-1">{!! trans('backend.setting.contact') !!}</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab-2">{!! trans('backend.setting.seo_default') !!}</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab-3">{!! trans('backend.setting.logo') !!}</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab-4">{!! trans('backend.setting.setting_home') !!}</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab-5">{!! trans('backend.setting.setting_banner') !!}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane fade active in">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="tab-base">
                                            <ul class="nav nav-tabs">
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
                                                    <div id="language-tab-{{ @$languageTab->id }}" class="tab-pane {{ $key == 0 ? 'fade active in' : '' }}">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="control-label">{!! trans('backend.setting.address') !!}</label>
                                                                <input type="text" class="form-control" ng-model="data.contact.address[{{ @$languageTab->id }}]"
                                                                       required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="control-label">{!! trans('backend.setting.phone') !!}</label>
                                                                <input type="text" class="form-control" ng-model="data.contact.phone[{{ @$languageTab->id }}]"
                                                                       required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="control-label">{!! trans('backend.setting.fax') !!}</label>
                                                                <input type="text" class="form-control" ng-model="data.contact.fax[{{ @$languageTab->id }}]"
                                                                       required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="control-label">{!! trans('backend.setting.email') !!}</label>
                                                                <input type="email" class="form-control" ng-model="data.contact.email[{{ @$languageTab->id }}]"
                                                                       required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="control-label">{!! trans('backend.setting.copy_right') !!}</label>
                                                                <input type="text" class="form-control" ng-model="data.contact.copy_right[{{ @$languageTab->id }}]"
                                                                       required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="control-label">{!! trans('backend.setting.google_map') !!}</label>
                                                                <textarea rows="6" type="text" class="form-control" ng-model="data.contact.google_map[{{ @$languageTab->id }}]"
                                                                          required></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">{!! trans('backend.setting.google_analytic') !!}</label>
                                                        <textarea rows="6" type="text" class="form-control" ng-model="data.contact.google_analytic"
                                                                  required></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">{!! trans('backend.setting.fb_pixel') !!}</label>
                                                        <textarea rows="6" type="text" class="form-control" ng-model="data.contact.fb_pixel"
                                                                  required></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <button type="button" ng-click="actions.saveContact()" class="btn btn-primary btn-block">{{ trans('backend.actions.send') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="tab-2" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="panel-body">
                                            <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">{!! trans('backend.setting.seo_title') !!}</label>
                                                        <input type="text" class="form-control" ng-model="data.seo_default.title" required>
                                                    </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label">{!! trans('backend.setting.seo_keyword') !!}</label>
                                                    <input type="text" class="form-control" ng-model="data.seo_default.keyword" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label">{!! trans('backend.setting.seo_description') !!}</label>
                                                    <textarea placeholder="Description" rows="4" class="form-control" ng-model="data.seo_default.description"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label">{!! trans('backend.setting.seo_content') !!}</label>
                                                    <textarea placeholder="Content seo" rows="4" class="form-control" ng-model="data.seo_default.content"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                       <span class="input-group-btn">
                                                        <a data-input="seo_image_default" data-preview="seo_image_perview" class="my-lfm btn btn-primary" type="image">
                                                           <i class="fa fa-picture-o"></i> {!! trans('backend.setting.seo_image') !!}
                                                        </a>
                                                        </span>
                                                        <input id="seo_image_default" class="form-control" type="text" name="main_image" ng-model="data.seo_default.image"  style="display: none">
                                                    </div>
                                                    <img id="seo_image_perview"  ng-src="{{ url('') }}/@{{ data.seo_default.image }}" style="margin-top:15px; margin-bottom: 5px; height:100px; max-width:180px">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <button type="button" ng-click="actions.saveSeoDefault()" class="btn btn-primary btn-block">
                                                    <i class="fa fa-save"></i> {{ trans('backend.actions.send') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="tab-3" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="panel-body">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="input-group">
	        			                            	    <span class="input-group-btn">
	        			                            	    <a data-input="logo_top" data-preview="image_logo_top_preview" class="my-lfm btn btn-primary" type="image">
	        			                            	       <i class="fa fa-picture-o"></i> {!! trans('backend.setting.logo_top') !!}
	        			                            	    </a>
	        			                            	    </span>
                                                            <input id="logo_top" class="form-control" type="text" name="main_image" ng-model="data.logo.top"  style="display: none">
                                                        </div>
                                                        <img id="image_logo_top_preview"  ng-src="{{ url('') }}/@{{ data.logo.top }}" style="margin-top:15px; margin-bottom: 5px; height:100px; max-width:180px">
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="input-group">
	        			                            	    <span class="input-group-btn">
	        			                            	    <a data-input="logo_bottom" data-preview="image_logo_bottom_preview" class="my-lfm btn btn-primary" type="image">
	        			                            	       <i class="fa fa-picture-o"></i> {!! trans('backend.setting.logo_bottom') !!}
	        			                            	    </a>
	        			                            	    </span>
                                                            <input id="logo_bottom" class="form-control" type="text" name="main_image" ng-model="data.logo.bottom"  style="display: none">
                                                        </div>
                                                        <img id="image_logo_bottom_preview"  ng-src="{{ url('') }}/@{{ data.logo.bottom }}" style="margin-top:15px; margin-bottom: 5px; height:100px; max-width:180px">
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <button type="button" ng-click="actions.saveLogo()" class="btn btn-primary btn-block">
                                                        <i class="fa fa-save"></i> {{ trans('backend.actions.send') }}
                                                    </button>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>

                            <div id="tab-4" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="tab-base">
                                            <ul class="nav nav-tabs">
                                                @foreach (@$languages as $key => $languageTab)
                                                    <li class="{{ $key == 0 ? 'active' : '' }}">
                                                        <a data-toggle="tab" href="#language-tab-setting-{{ @$languageTab->id }}">
                                                            {{ @$languageTab->name_display }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="tab-content">
                                                @foreach (@$languages as $key => $languageTab)
                                                    <div id="language-tab-setting-{{ @$languageTab->id }}" class="tab-pane {{ $key == 0 ? 'fade active in' : '' }}">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="control-label">{!! trans('backend.setting.description_contact') !!}</label>
                                                                <textarea rows="6" type="text" class="form-control" ng-model="data.description_home.description_contact[{{ @$languageTab->id }}]"
                                                                          required></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="control-label">{!! trans('backend.setting.description_about') !!}</label>
                                                                <textarea rows="6" type="text" class="form-control" ng-model="data.description_home.description_about[{{ @$languageTab->id }}]"
                                                                          required></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <button type="button" ng-click="actions.saveSettingHome()" class="btn btn-primary btn-block">
                                                <i class="fa fa-save"></i> {{ trans('backend.actions.send') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="tab-5" class="tab-pane fade">
                                <div class="row">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                    <span class="input-group-btn">
                                                    <a data-input="banner_product" data-preview="preview_banner_product" class="my-lfm btn btn-primary" type="image">
                                                       <i class="fa fa-picture-o"></i> {!! trans('backend.setting.banner_product') !!}
                                                    </a>
                                                    </span>
                                                        <input id="banner_product" class="form-control" type="text" name="main_image"
                                                               ng-model="data.banner.product"  style="display: none">
                                                    </div>
                                                    <img id="preview_banner_product"  ng-src="{{ url('') }}/@{{ data.banner.product }}" style="margin-top:15px; margin-bottom: 5px; height:100px; max-width:180px">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                    <span class="input-group-btn">
                                                    <a data-input="banner_news" data-preview="preview_banner_news" class="my-lfm btn btn-primary" type="image">
                                                       <i class="fa fa-picture-o"></i> {!! trans('backend.setting.banner_news') !!}
                                                    </a>
                                                    </span>
                                                        <input id="banner_news" class="form-control" type="text" name="main_image" ng-model="data.banner.news"  style="display: none">
                                                    </div>
                                                    <img id="preview_banner_news"  ng-src="{{ url('') }}/@{{ data.banner.news }}" style="margin-top:15px; margin-bottom: 5px; height:100px; max-width:180px">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                    <span class="input-group-btn">
                                                    <a data-input="banner_product_detail" data-preview="preview_banner_product_detail" class="my-lfm btn btn-primary" type="image">
                                                       <i class="fa fa-picture-o"></i> {!! trans('backend.setting.banner_product_detail') !!}
                                                    </a>
                                                    </span>
                                                        <input id="banner_product_detail" class="form-control" type="text" name="main_image"
                                                               ng-model="data.banner.product_detail"  style="display: none">
                                                    </div>
                                                    <img id="preview_banner_product_detail"  ng-src="{{ url('') }}/@{{ data.banner.product_detail }}" style="margin-top:15px; margin-bottom: 5px; height:100px; max-width:180px">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                    <span class="input-group-btn">
                                                    <a data-input="banner_news_detail" data-preview="preview_banner_news_detail" class="my-lfm btn btn-primary" type="image">
                                                       <i class="fa fa-picture-o"></i> {!! trans('backend.setting.banner_news_detail') !!}
                                                    </a>
                                                    </span>
                                                        <input id="banner_news_detail" class="form-control" type="text" name="main_image" ng-model="data.banner.news_detail"  style="display: none">
                                                    </div>
                                                    <img id="preview_banner_news_detail"  ng-src="{{ url('') }}/@{{ data.banner.news_detail }}" style="margin-top:15px; margin-bottom: 5px; height:100px; max-width:180px">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                    <span class="input-group-btn">
                                                    <a data-input="banner_contact" data-preview="preview_banner_contact" class="my-lfm btn btn-primary" type="image">
                                                       <i class="fa fa-picture-o"></i> {!! trans('backend.setting.banner_contact') !!}
                                                    </a>
                                                    </span>
                                                        <input id="banner_contact" class="form-control" type="text" name="main_image"
                                                               ng-model="data.banner.contact"  style="display: none">
                                                    </div>
                                                    <img id="preview_banner_contact"  ng-src="{{ url('') }}/@{{ data.banner.contact }}" style="margin-top:15px; margin-bottom: 5px; height:100px; max-width:180px">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                    <span class="input-group-btn">
                                                    <a data-input="banner_about" data-preview="preview_banner_about" class="my-lfm btn btn-primary" type="image">
                                                       <i class="fa fa-picture-o"></i> {!! trans('backend.setting.banner_about') !!}
                                                    </a>
                                                    </span>
                                                        <input id="banner_about" class="form-control" type="text" name="main_image"
                                                               ng-model="data.banner.about"  style="display: none">
                                                    </div>
                                                    <img id="preview_banner_about"  ng-src="{{ url('') }}/@{{ data.banner.about }}" style="margin-top:15px; margin-bottom: 5px; height:100px; max-width:180px">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <button type="button" ng-click="actions.saveBanner()" class="btn btn-primary btn-block">
                                                <i class="fa fa-save"></i> {{ trans('backend.actions.send') }}
                                            </button>
                                        </div>
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
    <script>
        var lang = '{!! $languages !!}'
    </script>
    <script src="{{ url('angularJs/uses/factory/services/settingService.js') }}"></script>
    <script src="{{ url('angularJs/uses/ctrls/settingCtrl.js') }}"></script>
@endsection