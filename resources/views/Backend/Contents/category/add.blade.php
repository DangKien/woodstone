@extends('Backend.Layouts.default')
@section ('title', 'ZeLike 澤樣室內設計')
@section('content')
<div id="content-container">
	<div id="page-head">
        <div id="page-title">
            <h1 class="page-header text-overflow"> {!! trans('backend.category.category') !!} </h1>
        </div>
        <ol class="breadcrumb">
			<li><a href="#"><i class="demo-pli-home"></i></a></li>
			<li><a href="#">{{ isset($category) ? trans('backend.actions.update') : trans('backend.actions.create') }}</a></li>
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
			                	<i class="ti-pencil"></i> {{ isset($category) ? trans('backend.actions.update') : trans('backend.actions.create') }} 
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
	                			@if (isset($category))
									<form action="{{ route('categories.update', @$category->id) }}" method="POST" enctype="multipart/form-data" >
										@method('PUT')
	                			@else 
	                				<form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" >
	                					@method('POST')
	                			@endif
        		                @csrf
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
		                		                        	@if (isset($category))
			                		                        	@php
																	$recordCategory = app('Category')->recordCategory(@$category->id, @$languageTab->locale);
			                		                        	@endphp
			                		                        @endif
		                		                        <div id="language-tab-{{ @$languageTab->id }}" 
		                		                        	class="tab-pane {{ $key == 0 ? 'fade active in' : '' }}">

									                        <div class="col-sm-10">
									                            <div class="form-group">
									                                <label class="control-label text-bold">
									                                	{!! trans('backend.category.name') !!}
									                                	<span class="text-danger">*</span>
									                                </label>

									                                <input type="text" name="name[{{ @$languageTab->id }}]" class="form-control" 
									                                value="{{ @$recordCategory->name ? $recordCategory->name : old('name[@$languageTab->id]') }}">

									                                @if ($errors->has('name.'.@$languageTab->id))
										                            	<p class="text-left text-danger">{{ $errors->first('name.'.@$languageTab->id) }}</p>
										                            @endif
									                            </div>
									                        </div> 
									                        <div class="col-sm-10">
							                                    <div class="form-group">
							                                        <label class="control-label text-bold">
							                                        	{!! trans('backend.category.description') !!}
							                                        	<span class="text-danger">*</span>
							                                        </label>

							                                        <textarea name="description[{{ @$languageTab->id }}]" placeholder="{!! trans('backend.category.description') !!}" rows="5" class="form-control">{{ @$recordCategory->description ? $recordCategory->description : old('description.'.@$languageTab->id) }}</textarea>
							                                    </div>
							                                </div>
							                                <div class="col-sm-10">
							                                    <div class="form-group">
							                                        <label class="control-label text-bold">
							                                        	{!! trans('backend.category.meta_title') !!}
							                                        	<span class="text-danger">*</span>
							                                        </label>

							                                        <input type="text" name="meta_title[{{ @$languageTab->id }}]" class="form-control" value="{{ @$recordCategory->meta_title ? $recordCategory->meta_title : old('meta_title.'.@$languageTab->id) }}">
							                                    </div>
							                                </div>
									                        <div class="col-sm-10">
									                            <div class="form-group">
									                                <label class="control-label text-bold">
									                                	{!! trans('backend.category.meta_description') !!} 
									                                	<span class="text-danger">*</span>
									                                </label>
									                                <textarea name="meta_description[{{ @$languageTab->id }}]" placeholder="{!! trans('backend.category.meta_description') !!}" rows="5" class="form-control">{{ @$recordCategory->meta_description ? $recordCategory->meta_description : old('meta_description.'.@$languageTab->id) }}</textarea>
									                            </div>
									                        </div>
							                                <div class="col-sm-10">
							                                    <div class="form-group">
							                                        <label class="control-label text-bold">
							                                        	{!! trans('backend.category.meta_content') !!}
							                                        	<span class="text-danger">*</span>
							                                        </label>
							                                        <textarea name="meta_content[{{ @$languageTab->id }}]" placeholder="{!! trans('backend.category.meta_content') !!}" rows="5" class="form-control">{{ @$recordCategory->meta_data ? @$recordCategory->meta_data : old('meta_content.'.@$languageTab->id)}}</textarea>
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
		                		            <div class="panel-body col-sm-offset-1">
		                					<!-- data-parsley-validate -->
				    		                    <div class="row">
				    		                        <div class="col-sm-10">
				    		                            <div class="form-group">
				    		                                <label class="control-label text-bold">
				    		                                	{!! trans('backend.category.parent') !!}
				    		                                	<span class="text-danger">*</span>
				    		                                	
				    		                                </label>
				    		                                <select class="selectpicker" data-live-search="true" data-width="100%"name="parent_id">
								                                <option value="0">-- None --</option>
								                                {{ showCategories($categories, 0, "--", @$category->parent_id ? $category->parent_id : old('parent_id'),  @$category->id ? $category->id : '-1' ) }}
								                            </select>
				    		                                @if ($errors->has('parent_id'))
				    			                            	<p class="text-left text-danger">{{ $errors->first('parent_id') }}</p>
				    			                            @endif
				    		                            </div>
				    		                        </div> 

					                                <div class="col-sm-10"  style="margin-bottom: 15px;">
					                                	
					                                    <div class="form-group has-feedback row">
					        	                            <label class="col-sm-3 control-label text-bold" style="padding-top: 10px;">{!! trans('backend.status.status') !!}
					        	                            </label>
					        	                            <div class="col-sm-7">
					        	                                <div class="radio">
					        	                                    <input id="AVAILABLE" class="magic-radio" type="radio" name="status" value="{{ App\Libs\Configs\StatusConfig::CONST_AVAILABLE }}" 
					        	                                    @if (statusAvailable(old('status')) || statusAvailable(@$category->status) )
																		checked
					        	                                    @endif
					        	                                    checked 
					        	                                    >
					        	                                    <label for="AVAILABLE">{!! trans('backend.status.available') !!}</label>
					        	
					        	                                    <input id="DISABLE" class="magic-radio" type="radio" name="status" value="{{ App\Libs\Configs\StatusConfig::CONST_DISABLE }}"
				            	                                    @if (statusDisable(old('status')) || statusDisable(@$category->status) )
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

