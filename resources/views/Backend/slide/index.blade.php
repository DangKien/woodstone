@extends('Backend.Layouts.default')
@section ('title', 'ZeLike 澤樣室內設計')
@section('content')
	<div id="content-container" ng-controller="slideCtrl">
		<div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">{!! trans('backend.slide.slide') !!}</h1>
            </div>
            <ol class="breadcrumb">
				<li><a href="#"><i class="demo-pli-home"></i></a></li>
				<li><a href="#">{!! trans('backend.actions.list') !!}</a></li>
            </ol>
        </div>
		<div id="page-content">
	        <div class="panel">
	            <div class="panel-heading">
	            </div>
	            <div class="panel-body">
	            	<div class="pad-btm form-inline">
			            <div class="row">
			                <div class="col-sm-6 table-toolbar-left">
			                   <a href="{{ route('slides.create') }}" id="demo-btn-addrow" class="btn btn-purple"><i class="ti-plus"></i> {!! trans('backend.actions.create') !!}</a>
			                </div>
			                <div class="col-sm-6 table-toolbar-right">
			                </div>
			            </div>
			            
			        </div>
			        <div class="row">
		                <div class="col-sm-6 table-toolbar-left">
		                   <a ng-click="actions.actionCheckAll()" id="demo-btn-addrow" class="btn btn-danger"><i class="ti-minus"></i> {!! trans('backend.actions.delete') !!}</a>
		                </div>
		            </div>
	                <div class="table-responsive">
	                    <table class="table table-bordered table-hover table-vcenter">
	                        <thead>
	                            <tr>
	                            	<th class="text-center">
                        		        <input type="checkbox" ng-model="checker.btnCheckAll" 
                        		        ng-click="actions.checkAll(data.slides)">
	                            	</th>
	                                <th class="text-center">#</th>
	                                <th 
	                                ng-class="(filter.orderName =='title' && filter.order) ? 'sorting_desc' : (filter.orderName =='title' && !filter.order) ? 'sorting_asc' : 'sorting'" 
	                                ng-click="actions.orderBy('title')">{!! trans('backend.slide.title') !!}</th>
	                                <th class="sorting" 
	                                ng-class="(filter.orderName =='status' && filter.order) ? 'sorting_desc' : (filter.orderName =='status' && !filter.order) ? 'sorting_asc' : 'sorting'"
	                                ng-click="actions.orderBy('status')">{!! trans('backend.status.status') !!}</th>
	                                <th class="sorting" 
	                                ng-class="(filter.orderName =='created_at' && filter.order) ? 'sorting_desc' : (filter.orderName =='created_at' && !filter.order) ? 'sorting_asc' : 'sorting'"
	                                ng-click="actions.orderBy('created_at')">{!! trans('backend.slide.created_at') !!}</th>
	                                <th>{!! trans('backend.actions.actions') !!}</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                            <tr ng-repeat="(key, slide) in data.slides">
	                            	<td style="width: 50px" class="text-center"> 
                        		        <input type="checkbox" ng-model="checker.checkedAll[slide.id]" ng-click="actions.checkOrUncheck(checker.checkedAll[slide.id])">
	                            	</td>
	                                <td style="width: 50px"  class="text-center"> @{{ (data.page.current_page - 1) * data.page.per_page + key + 1 }} </td>
	                                <td> @{{ slide.title }} </td>
	                                <td>
	                                	<span class="label label-danger" ng-if="(slide.status == '{{ App\Libs\Configs\StatusConfig::CONST_DISABLE }}')">
	                                	{!! trans('backend.status.disable') !!}</span>

	                                	<span class="label label-success" ng-if="(slide.status == '{{ App\Libs\Configs\StatusConfig::CONST_AVAILABLE }}')">
	                                	{!! trans('backend.status.available') !!}</span>
	                                </td>
	                                <td style="width: 170px"  class="text-center"> @{{ slide.created_at }} </td>
	                                <td style="width: 100px">
	                                	<a href="{{ url('admin/slides') }}/@{{ slide.id }}/edit" class="btn btn-info btn-icon btn-sm" title="{!! trans('backend.actions.update') !!}">
	                                		<i class="ti-pencil-alt"></i> 
	                                	</a>
	                                	<button class="btn btn-danger btn-sm btn-icon" ng-click="actions.delete(slide.id)" title="{!! trans('backend.actions.delete') !!}">
	                                		<i class="ti-trash"></i> 
	                                	</button>
	                                </td>
	                            </tr>
	                        </tbody>
	                    </table>
	                    <div class="text-center"> 
		                    <div paging
		                      page="data.page.current_page"  
    						  show-first-last="true"
		                      page-size="data.page.per_page" 
		                      total="data.page.total"
		                      paging-action="actions.changePage(page)">
		                    </div> 
	                    </div>
	                </div>
	            </div>
	        </div>
		</div>
	</div>
@endsection

@section ('myJs')
	<script src="{{ url('angularJs/uses/factory/services/slideService.js') }}"></script>
	<script src="{{ url('angularJs/uses/ctrls/slideCtrl.js') }}"></script>

	@if (Session::has('slide') && Session::get('slide') == 'success')
	<script>
		$.toast({
		    heading: '{!! trans("confirm.success") !!}',
		    text: '{!! trans("backend.slide.success_message") !!}',
		    showHideTransition: 'fade',
		    position: 'top-right',
		    icon: 'success'
		})
	</script>
	@endif
@endsection
@section ('myCss')
@endsection

