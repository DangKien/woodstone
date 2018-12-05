@extends('Backend.Layouts.default')
@section ('title', '')
@section('content')
	<div id="content-container">
		<div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">{!! trans('backend.slide.slide') !!}</h1>
            </div>
            <ol class="breadcrumb">
			<li><a href="#"><i class="demo-pli-home"></i></a></li>
			<li><a href="#">
				{{ isset($slide) ? trans('backend.actions.update') : trans('backend.actions.create') }}
				</a></li>
            </ol>
        </div>
		<div id="page-content">
	        <div class="panel">
	            <div class="panel">
		            <div class="panel-heading">
		            </div>
		            @if (!isset($slide)) 
						<form action="{{ route('slides.store') }}" method="POST" enctype="multipart/form-data" data-parsley-validate>
							@method ('POST')
		            @else
						<form action="{{ route('slides.update', $slide->id) }}" method="POST" enctype="multipart/form-data" data-parsley-validate>
							@method ('PUT')	
		            @endif
			            	@csrf
			                <div class="panel-body col-sm-offset-1">
			                    <div class="row">
			                        <div class="col-sm-10">
			                            <div class="form-group">
			                                <label class="control-label text-bold">
			                                	{!! trans('backend.slide.title') !!} <span class="text-danger"> (*)</span>
			                                </label>
			                                <input type="text" name="title" class="form-control" value="{{ @$slide->title ? $slide->title : @old('title') }}" required>
			                                @if ($errors->has('title'))
				                            	<p class="text-left text-danger">{{ $errors->first('title') }}</p>
				                            @endif
			                            </div>
			                        </div> 
					
			                        {{--<div class="col-sm-10">--}}
			                            {{--<div class="form-group">--}}
			                                {{--<label class="control-label text-bold">--}}
			                                	{{--{!! trans('backend.slide.link') !!} <span class="text-danger"> (*)</span>--}}
			                                {{--</label>--}}
			                                {{--<input type="text" name="link" class="form-control" value="{{  @old('link') ?? @$slide->link }}" required>--}}
			                                {{--@if ($errors->has('link'))--}}
				                            	{{--<p class="text-left text-danger">{{ $errors->first('link') }}</p>--}}
				                            {{--@endif--}}
			                            {{--</div>--}}
			                        {{--</div> --}}

    		                        <div class="col-sm-10">
			                            <div class="form-group">
			                                <label class="control-label">
			                                	{!! trans('backend.actions.sort_by') !!} <span class="text-danger"> (*)</span>
			                                </label>

			                                <select class="selectpicker" data-width="100%" name="sort_by">
			                                    @foreach ($sort_bys as $sort_by) 
													<option value="{{ @$sort_by->sort_by }}"
														@if (@$slide->sort_by == $sort_by->sort_by) 
															selected
														@endif
														> 
														{{ $sort_by->sort_by }}
													</option>
			                                    @endforeach
			                                    @if (!isset($slide))
													<option selected value="{{ count($sort_bys) + 1  }}">
														{{ count($sort_bys) + 1 }}
													</option>
			                                    @endif
			                                </select>
			                                @if ($errors->has('sort_by'))
				                            	<p class="text-left text-danger">{{ $errors->first('sort_by') }}</p>
				                            @endif
			                            </div>
			                        </div>	

			                        <div class="col-sm-10">
			                            <div class="form-group">
			                                <label class="control-label text-bold">
			                                	{!! trans('backend.slide.image') !!} <span class="text-danger"> (*)</span>
			                                	<br>
			                                	<span class="text-danger"> (*) {{ trans('backend.slide.size_image') }}</span>
			                                </label>
			                                 <div class="input-group">
												<span class="input-group-btn">
													<a data-input="image" data-preview="image-preview" class="btn btn-primary my-lfm" type="'image'">
														<i class="fa fa-picture-o"></i> Choose
													</a>
												</span>
												<input id="image" class="form-control" type="text" name="image" value="{{ @$slide->image ? $slide->image: @old('image') }}">
											</div>
											<img id="holder" 
												@if (@$slide->image || @old('image'))
    			                            	 	src="{{ url('') }}/{{ @$slide->image ? $slide->image : @old('image') }}"
												@endif style="margin-top:15px;max-height:100px;">
			                                @if ($errors->has('image'))
				                            	<p class="text-left text-danger">{{ $errors->first('image') }}</p>
				                            @endif
			                            </div>
			                        </div>

			                        <div class="col-sm-10" style="margin-bottom: 15px;">	
	                                    <div class="form-group row">
	        	                            <label class="col-sm-2 control-label text-bold text-bold" style="padding-top: 10px;">{!! trans('backend.status.status') !!}
	        	                            </label>
	        	                            <div class="col-sm-7">
	        	                                <div class="radio">
	        	                                    <input id="AVAILABLE" class="magic-radio" type="radio" name="status" value="{{ App\Libs\Configs\StatusConfig::CONST_AVAILABLE }}" 
	        	                                    @if (statusAvailable(old('status')) || statusAvailable(@$slide->status) )
														checked
	        	                                    @endif
	        	                                    checked 
	        	                                    >
	        	                                    <label for="AVAILABLE">{!! trans('backend.status.available') !!}</label>
	        	
	        	                                    <input id="DISABLE" class="magic-radio" type="radio" name="status" value="{{ App\Libs\Configs\StatusConfig::CONST_DISABLE }}"
            	                                    @if (statusDisable(old('status')) || statusDisable(@$slide->status) )
    													checked
            	                                    @endif>
	        	                                    <label for="DISABLE"> {!! trans('backend.status.disable') !!}</label>
	        	                                </div>
	        	                        	</div>
	                                	</div>
	                            	</div> 

			                    </div>
                            	<div class="row">
                                	<button class="btn btn-primary btn-icon btn-form-submit">
            	                    	<i class="fa fa-save icon-lg"></i>
            	                    </button>
                                </div>
			                </div>
				   		</form>
		        </div>
	        </div>
		</div>
	</div>
@endsection

@section ('myJs')
	<script>
		toolbar = [
               [ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ],
               [ 'FontSize', 'TextColor', 'BGColor' ]
           ];
		CKEDITOR.replace('description', {toolbar: toolbar});
	</script>
@endsection

@section ('myCss')
	
@endsection

