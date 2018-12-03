@extends('Backend.Layouts.default')
@section ('title', 'ZeLike 澤樣室內設計')
@section('content')
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
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane fade active in">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form>
                                            <div class="panel-body">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">{!! trans('backend.setting.address') !!}</label>
                                                        <input type="text" class="form-control" ng-model="data.contact.address"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">{!! trans('backend.setting.phone') !!}</label>
                                                        <input type="text" class="form-control" ng-model="data.contact.phone"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">{!! trans('backend.setting.work_time') !!}</label>
                                                        <input type="text" class="form-control" ng-model="data.contact.worktime"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">{!! trans('backend.setting.fax') !!}</label>
                                                        <input type="text" class="form-control" ng-model="data.contact.fax"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">{!! trans('backend.setting.email') !!}</label>
                                                        <input type="email" class="form-control" ng-model="data.contact.email"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">{!! trans('backend.setting.facebook') !!}</label>
                                                        <input type="text" class="form-control" ng-model="data.contact.fb"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">{!! trans('backend.setting.youtube') !!}</label>
                                                        <input type="text" class="form-control" ng-model="data.contact.youtube"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">{!! trans('backend.setting.instagram') !!}</label>
                                                        <input type="text" class="form-control" ng-model="data.contact.instagram"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">{!! trans('backend.setting.zalo') !!}</label>
                                                        <input type="text" class="form-control" ng-model="data.contact.zalo"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">{!! trans('backend.setting.google_map') !!}</label>
                                                        <textarea rows="6" type="text" class="form-control" ng-model="data.contact.google_map"
                                                                  required></textarea>
                                                    </div>
                                                </div>

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
                                                    <button type="button" ng-click="actions.saveContact()" class="btn btn-primary btn-block">{!! trans('setting.submit') !!}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>

                            <div id="tab-2" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form>
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
	        			                            	    <a data-input="seo_image_default" data-preview="seo_image_perview" class="my-lfm btn btn-primary">
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
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div id="tab-3" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form>
                                            <div class="panel-body">

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="input-group">
	        			                            	    <span class="input-group-btn">
	        			                            	    <a data-input="logo_top" data-preview="image_logo_top_preview" class="my-lfm btn btn-primary">
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
	        			                            	    <a data-input="logo_bottom" data-preview="image_logo_bottom_preview" class="my-lfm btn btn-primary">
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
                                        </form>
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
    <script src="{{ url('angularJs/uses/factory/services/settingService.js') }}"></script>
    <script src="{{ url('angularJs/uses/ctrls/settingCtrl.js') }}"></script>
@endsection