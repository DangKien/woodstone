ngApp.factory('$postService', function ($http, $httpParamSerializer){

    var service = {
        action: {},
        data: {}
    };

    service.data.filter = function (freetext, orderName, orderBy , page, perPage) {
        return params = {
            'freetext': freetext || '',
            'orderName': orderName || 'id',
            'orderBy': orderBy || 'asc',
            'page': page || 1,
            'perPage': perPage || 20,
        }
    };

    service.action.getPost = function (params) {
        var url = SiteUrl + "/rest/admin/posts?" + $httpParamSerializer(params);
        return $http.get(url);
    };

    service.action.deletePost = function ($id) {
        var url = SiteUrl + "/rest/admin/posts/" + $id;
        return $http.delete(url);
    };

    service.action.deletePostMulti = function (params) {
        var url = SiteUrl + "/rest/admin/posts/delete-multi";
        return $http.post(url, params);
    };

    service.action.changeStatus = function ($id) {
        var url = SiteUrl + "/rest/admin/posts/changeStatus/" + $id;
        return $http.post(url);
    };

    return service;
})