ngApp.factory('$homeProductService', function ($http, $httpParamSerializer){

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

    service.action.getHomeProduct = function (params) {
        var url = SiteUrl + "/rest/admin/home-products?" + $httpParamSerializer(params);
        return $http.get(url);
    };

    service.action.deleteHomeProduct = function ($id) {
        var url = SiteUrl + "/rest/admin/home-products/" + $id;
        return $http.delete(url);
    };

    service.action.deleteHomeProductMulti = function (params) {
        var url = SiteUrl + "/rest/admin/home-products/delete-multi";
        return $http.post(url, params);
    };

    service.action.changeStatus = function ($id) {
        var url = SiteUrl + "/rest/admin/home-products/changeStatus/" + $id;
        return $http.post(url);
    };

    return service;
})