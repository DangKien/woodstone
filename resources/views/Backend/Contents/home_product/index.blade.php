@extends('Backend.Layouts.default')
@section('content')
    <div id="content-container" ng-controller="homeProductCtrl">
        <div id="page-head">
            <div id="page-title">
                <h1 class="page-header text-overflow">{!! trans('backend.home_product.lable') !!}</h1>
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
                                    <a href="{{ route('home-products.create') }}" id="demo-btn-addrow" class="btn btn-purple">
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
                                               ng-click="actions.checkAll(data.home_products)">
                                    </th>
                                    <th class="text-center">#</th>
                                    <th class="text-center">{!! trans('backend.home_product.image') !!}</th>
                                    <th class="sorting"
                                        ng-class="scope.filter.orderBy =='name' && filter.reverse ? 'sorting-desc' : 'sorting-asc' "
                                        ng-click="actions.orderBy('name')">{!! trans('backend.home_product.name') !!}</th>
                                    <th class="sorting"
                                        ng-class="scope.filter.orderBy =='status' && filter.reverse ? 'sorting-desc' : 'sorting-asc' "
                                        ng-click="actions.orderBy('status')">{!! trans('backend.status.status') !!}</th>
                                    <th>{!! trans('backend.category.action') !!}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="(key, home_product) in data.home_products">
                                    <td style="width: 50px" class="text-center">
                                        <input type="checkbox" ng-model="checker.checkedAll[home_product.id]">
                                    </td>
                                    <td style="width: 50px"  class="text-center"> @{{ (data.page.current_page - 1) * data.page.per_page + key + 1 }} </td>
                                    <td class="text-center" style="width: 150px;">
                                        <img class="img-md img-circle mar-btm my-thumbnail" ng-src="{{ url('') }}/@{{ home_product.image }}" alt="@{{ home_product.name }}">
                                    </td>
                                    <td> @{{ home_product.name }} </td>
                                    <td style="width: 150px;">
                                        <input ng-click="actions.changeStatus(home_product.id)" class="is-sw-checked" type="checkbox" ng-checked="(home_product.status == '{{ App\Libs\Configs\StatusConfig::CONST_AVAILABLE }}')">
                                        <span class="label label-danger" ng-if="(home_product.status == '{{ App\Libs\Configs\StatusConfig::CONST_DISABLE }}')">
		                                	{!! trans('backend.status.disable') !!}</span>
                                        <span class="label label-success" ng-if="(home_product.status == '{{ App\Libs\Configs\StatusConfig::CONST_AVAILABLE }}')">
		                                	{!! trans('backend.status.available') !!}</span>
                                    </td>
                                    <td style="width: 180px">
                                        <a href="{{ url('admin/home-products') }}/@{{ home_product.id }}/edit" class="btn btn-info btn-icon btn-sm" >
                                            <i class="fa-lg ti-pencil-alt"></i> {!! trans("backend.actions.edit") !!}
                                        </a>
                                        <button class="btn btn-danger btn-sm btn-icon" ng-click="actions.delete(home_product.id)">
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
    <script src="{{ url('angularJs/uses/factory/services/homeProductService.js') }}"></script>
    <script src="{{ url('angularJs/uses/ctrls/homeProductCtrl.js') }}"></script>
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

