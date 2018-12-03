ngApp.controller('slideCtrl',function($scope, $myNotify, $myBootbox, $myLoader, $slideService, $apply) {

	$scope.data = {
		slides: {},
		page: {},
	}
	$scope.filter = {
		freetext: "",
		orderBy: "",
		orderByCheck: '',
		order: false,
	}

	$scope.checker = {
		btnCheckAll: false,
		checkedAll: []
	}
	$scope.actions = {
		getSlide: function () {
			var params = $slideService.data.filter($scope.filter.freetext, $scope.filter.orderName, $scope.filter.orderBy,
											 $scope.data.page.current_page, $scope.data.page.per_page);
			$slideService.action.getSlide(params).then(function (resp) {
				if (resp) {
					$apply(function () {
						$scope.data.slides = resp.data.data;
						$scope.data.page    = resp.data;
						if ($scope.data.page.current_page > resp.data.last_page) {
							$scope.data.page.current_page = resp.data.last_page;
							$scope.actions.getSlide();
						}
					})
				}
			}, function (error) {
			})
		},

		changePage: function (page) {
			$scope.data.page.current_page = page;
			$scope.actions.getSlide();
		},

		delete: function ($id) {
			if ($id) {
				$myBootbox.confirm('Bạn có muốn xóa？', function (resp) {
					if (resp) {
					$slideService.action.deleteSlide($id).then(function (resp) {
						if (resp) {
							$myNotify.success();
							$scope.actions.getSlide();
						}
						}, function (error) {
							$myNotify.error();
						})
					}
				})
			}
		},

		filter: function () {
			$scope.actions.getSlide();
		},

		orderBy: function(propertyName) {
			$scope.filter.order = ($scope.filter.orderName == propertyName) ? !$scope.filter.order : false;
			$scope.filter.orderName = propertyName;
			$scope.filter.orderBy = $scope.filter.order ? 'desc' : 'asc'
			$scope.actions.getSlide();
		},

		checkAll: function(data) {
			$apply(function () {
				angular.forEach(data, function(val, key){
					$scope.checker.checkedAll[val.id] = $scope.checker.btnCheckAll;
				});
			});
		}, 

		actionCheckAll: function () {
			var ids = [];
			angular.forEach($scope.checker.checkedAll, function(val, key){
				if(val == true) {
					ids.push(key);
				}
			});
			if (ids.length != 0 ) {
				var params = {
					ids: ids
				};
				$myBootbox.confirm('',function (resp) {
					if (resp) {
					$slideService.action.deleteSlideMulti(params).then(function (resp) {
						if (resp) {
							$myNotify.success();
							$scope.actions.getSlide();
						}
						}, function (error) {
							$myNotify.error();
						})
					}
				})
			}
		},

		checkOrUncheck: function (check) {
			if (!check && $scope.checker.btnCheckAll) {
				$scope.checker.btnCheckAll = ! $scope.checker.btnCheckAll;
			}
		},

	}

	$scope.actions.getSlide();
});