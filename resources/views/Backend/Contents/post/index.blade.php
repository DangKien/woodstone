@extends('Backend.Layouts.default')
@section('content')
    <div id="content-container" ng-controller="postCtrl">
        <div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">{!! trans('backend.product.lable') !!}</h1>
            </div>
            <ol class="breadcrumb">
                <li><a href="#"><i class="demo-pli-home"></i></a></li>
                <li><a href="#">{!! trans('backend.actions.list') !!}</a></li>
            </ol>
        </div>
        <div id="page-content">
            <div class="panel-body">
                <div class="panel">
                    <div class="panel-heading">
                    </div>
                    <div class="panel-body">
                        <div class="pad-btm form-inline">
                            <div class="row">
                                <div class="col-sm-6 table-toolbar-left">
                                    <a href="{{ route('posts.create') }}" id="demo-btn-addrow" class="btn btn-purple">
                                        <i class="demo-pli-add"></i> {!! trans('backend.actions.create') !!}</a>
                                </div>
                                <div class="col-sm-6 table-toolbar-right">
                                    <div class="form-group col-sm-12">
                                        <input id="demo-input-search2" type="text" placeholder="{!! trans('backend.actions.search') !!}" class="form-control col-sm-
				                        8" autocomplete="off" ng-change="actions.filter()" ng-model="filter.freetext">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="category-table" class="table table-bordered table-hover table-vcenter">
                                <thead>
                                <tr>
                                    <th class="text-center">
                                        <input type="checkbox" ng-model="checker.btnCheckAll"
                                               ng-click="actions.checkAll(data.posts)">
                                    </th>
                                    <th class="text-center">#</th>
                                    <th class="text-center">{!! trans('backend.post.image') !!}</th>
                                    <th class="sorting"
                                        ng-class="scope.filter.orderBy =='title' && filter.reverse ? 'sorting-desc' : 'sorting-asc' "
                                        ng-click="actions.orderBy('title')">{!! trans('backend.post.title') !!}</th>
                                    <th class="sorting"
                                        ng-class="scope.filter.orderBy =='status' && filter.reverse ? 'sorting-desc' : 'sorting-asc' "
                                        ng-click="actions.orderBy('status')">{!! trans('backend.status.status') !!}</th>
                                    <th>{!! trans('backend.category.action') !!}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="(key, post) in data.posts">
                                    <td style="width: 50px" class="text-center">
                                        <input type="checkbox" ng-model="checker.checkedAll[post.id]">
                                    </td>
                                    <td style="width: 50px"  class="text-center"> @{{ (data.page.current_page - 1) * data.page.per_page + key + 1 }} </td>
                                    <td style="width: 150px;">
                                        <img class="img-md img-circle mar-btm" ng-src="{{ url('') }}/@{{ product.image }}" alt="">
                                    </td>
                                    <td> @{{ post.title }} </td>
                                    <td style="width: 150px;">
                                        <input ng-click="actions.changeStatus(post.id)" class="is-sw-checked" type="checkbox" ng-checked="(post.status == '{{ App\Libs\Configs\StatusConfig::CONST_AVAILABLE }}')">
                                        <span class="label label-danger" ng-if="(post.status == '{{ App\Libs\Configs\StatusConfig::CONST_DISABLE }}')">
		                                	{!! trans('backend.status.disable') !!}</span>
                                        <span class="label label-success" ng-if="(post.status == '{{ App\Libs\Configs\StatusConfig::CONST_AVAILABLE }}')">
		                                	{!! trans('backend.status.available') !!}</span>
                                    </td>
                                    <td style="width: 180px">
                                        <a href="{{ url('admin/posts') }}/@{{ post.id }}/edit" class="btn btn-info btn-icon btn-sm" >
                                            <i class="fa-lg ti-pencil-alt"></i> {!! trans("backend.actions.edit") !!}
                                        </a>
                                        <button class="btn btn-danger btn-sm btn-icon" ng-click="actions.delete(post.id)">
                                            <i class="fa-lg ti-trash"></i> {!! trans("backend.actions.delete") !!}
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
    </div>
@endsection

@section ('myJs')
    <script src="{{ url('angularJs/uses/factory/services/postService.js') }}"></script>
    <script src="{{ url('angularJs/uses/ctrls/postCtrl.js') }}"></script>
    @if (Session::has('status'))
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
@endsection
@section ('myCss')
@endsection

