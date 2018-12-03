ngApp.factory('$productService', function ($http, $httpParamSerializer){

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

    service.action.getProduct = function (params) {
        var url = SiteUrl + "/rest/admin/products?" + $httpParamSerializer(params);
        return $http.get(url);
    };

    service.action.deleteProduct = function ($id) {
        var url = SiteUrl + "/rest/admin/products/" + $id;
        return $http.delete(url);
    };

    service.action.deleteProductMulti = function (params) {
        var url = SiteUrl + "/rest/admin/products/delete-multi";
        return $http.post(url, params);
    };

    service.action.statusProduct = function ($id) {
        var url = SiteUrl + "/rest/admin/products/changeStatus/" + $id;
        return $http.post(url);
    };

    return service;
})