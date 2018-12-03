ngApp.controller('productCtrl',function($scope, $myNotify, $myBootbox, $myLoader, $productService, $apply) {

    $scope.data = {
        products: {},
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
        getProduct: function () {
            var params = $productService.data.filter($scope.filter.freetext, $scope.filter.orderName, $scope.filter.orderBy,
                $scope.data.page.current_page, $scope.data.page.per_page);
            $productService.action.getProduct(params).then(function (resp) {
                if (resp) {
                    $apply(function () {
                        $scope.data.products = resp.data.data;
                        $scope.data.page    = resp.data;
                        if ($scope.data.page.current_page > resp.data.last_page) {
                            $scope.data.page.current_page = resp.data.last_page;
                            $scope.actions.getProduct();
                        }
                    })
                }
            }, function (error) {
            })
        },

        changePage: function (page) {
            $scope.data.page.current_page = page;
            $scope.actions.getProduct();
        },

        delete: function ($id) {
            if ($id) {
                $myBootbox.confirm('Bạn có muốn xóa？', function (resp) {
                    if (resp) {
                        $productService.action.deleteProduct($id).then(function (resp) {
                            if (resp) {
                                $myNotify.success();
                                $scope.actions.getProduct();
                            }
                        }, function (error) {
                            $myNotify.error();
                        })
                    }
                })
            }
        },

        filter: function () {
            $scope.actions.getProduct();
        },

        orderBy: function(propertyName) {
            $scope.filter.order = ($scope.filter.orderName == propertyName) ? !$scope.filter.order : false;
            $scope.filter.orderName = propertyName;
            $scope.filter.orderBy = $scope.filter.order ? 'desc' : 'asc'
            $scope.actions.getProduct();
        },

        checkAll: function(data) {
            $apply(function () {
                angular.forEach(data, function(val, key){
                    $scope.checker.checkedAll[val.id] = $scope.checker.btnCheckAll;
                });
            });
        },

        changeStatus: function (id) {
            $productService.action.statusProduct(id).then(function (resp) {
                if (resp.data.status) {
                    $myNotify.success();
                    $scope.actions.getProduct();
                }
            }, function (errors) {

            })

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
                        $productService.action.deleteNewMulti(params).then(function (resp) {
                            if (resp) {
                                $myNotify.success();
                                $scope.actions.getProduct();
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

    $scope.actions.getProduct();
});