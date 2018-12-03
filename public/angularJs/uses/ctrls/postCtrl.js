ngApp.controller('postCtrl',function($scope, $myNotify, $myBootbox, $myLoader, $postService, $apply) {

    $scope.data = {
        posts: {},
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
        getPost: function () {
            var params = $postService.data.filter($scope.filter.freetext, $scope.filter.orderName, $scope.filter.orderBy,
                $scope.data.page.current_page, $scope.data.page.per_page);
            $postService.action.getPost(params).then(function (resp) {
                if (resp) {
                    $apply(function () {
                        $scope.data.posts = resp.data.data;
                        $scope.data.page    = resp.data;
                        if ($scope.data.page.current_page > resp.data.last_page) {
                            $scope.data.page.current_page = resp.data.last_page;
                            $scope.actions.getPost();
                        }
                    })
                }
            }, function (error) {
            })
        },

        changePage: function (page) {
            $scope.data.page.current_page = page;
            $scope.actions.getPost();
        },

        delete: function ($id) {
            if ($id) {
                $myBootbox.confirm('Bạn có muốn xóa？', function (resp) {
                    if (resp) {
                        $postService.action.deletePost($id).then(function (resp) {
                            if (resp) {
                                $myNotify.success();
                                $scope.actions.getPost();
                            }
                        }, function (error) {
                            $myNotify.error();
                        })
                    }
                })
            }
        },

        filter: function () {
            $scope.actions.getPost();
        },

        orderBy: function(propertyName) {
            $scope.filter.order = ($scope.filter.orderName == propertyName) ? !$scope.filter.order : false;
            $scope.filter.orderName = propertyName;
            $scope.filter.orderBy = $scope.filter.order ? 'desc' : 'asc'
            $scope.actions.getPost();
        },

        checkAll: function(data) {
            $apply(function () {
                angular.forEach(data, function(val, key){
                    $scope.checker.checkedAll[val.id] = $scope.checker.btnCheckAll;
                });
            });
        },

        changeStatus: function (id) {
            $postService.action.changeStatus(id).then(function (resp) {
                if (resp.data.status) {
                    $myNotify.success();
                    $scope.actions.getPost();
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
                        $postService.action.deletePostMulti(params).then(function (resp) {
                            if (resp) {
                                $myNotify.success();
                                $scope.actions.getPost();
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

    $scope.actions.getPost();
});