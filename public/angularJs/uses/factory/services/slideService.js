ngApp.factory('$slideService', function ($http, $httpParamSerializer){

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

	service.action.getSlide = function (params) {
		var url = SiteUrl + "/rest/admin/slides?" + $httpParamSerializer(params);
        return $http.get(url);
	};

	service.action.deleteSlide = function ($id) {
		var url = SiteUrl + "/rest/admin/slides/" + $id;
        return $http.delete(url);
	};

	service.action.deleteSlideMulti = function (params) {
		var url = SiteUrl + "/rest/admin/slides/delete-multi";
        return $http.post(url, params);
	};

	

	return service;
})