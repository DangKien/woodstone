ngApp.controller('settingCtrl',function($scope, $myNotify, $myBootbox, $myLoader, $settingService, $apply) {

    $scope.data = {
        users: {},
        page: {},
        logo: {},
        banner_home: {},
        contact: {},
        service: {},
        review: {
            home_image: []
        },
        advantage: {}
    }
    $scope.filter = {
        freetext: ""
    }

    $scope.actions = {
        getLogo: function () {
            $settingService.action.getSetting().then(function (resp) {
                angular.forEach(resp.data, function(value, key){
                    if (value.key == 'CONTACT') {
                        $scope.data.contact = value.setting
                    }
                    if (value.key == 'SEO_DEFAULT') {
                        $scope.data.seo_default = value.setting
                    }
                    if (value.key == 'LOGO') {
                        $scope.data.logo = value.setting
                    }

                    if (value.key == 'SETTING_HOME') {
                        $scope.data.description_home = value.setting
                    }

                    if (value.key == 'BANNER') {
                        $scope.data.banner = value.setting
                    }

                });
            }, function (error) {
            })
        },

        saveLogo: function () {
            let params = {
                'setting': JSON.stringify(
                    {
                        'top': $scope.data.logo.top || '',
                        'bottom' : $scope.data.logo.bottom || ''
                    }),
                'key' : 'LOGO'
            }
            $settingService.action.insertSetting(params).then(function (resp){
                if (resp) {
                    $myNotify.success('Success')
                }
            }, function (error) {
                $myNotify.error('Error')
            });
        },

        saveSeoDefault: function () {
            let params = {
                'setting': JSON.stringify(
                    {
                        'title': $scope.data.seo_default.title || '',
                        'description' : $scope.data.seo_default.description || '',
                        'content': $scope.data.seo_default.content || '',
                        'keyword' : $scope.data.seo_default.keyword || '',
                        'image': $scope.data.seo_default.image || '',
                    }),
                'key' : 'SEO_DEFAULT'
            }
            $settingService.action.insertSetting(params).then(function (resp){
                if (resp) {
                    $myNotify.success('Success')
                }
            }, function (error) {
                $myNotify.error('Error')
            });
        },

        saveSettingHome: function () {
            let params = {
                'setting': JSON.stringify(
                    {
                        'description_about': $scope.data.description_home.description_about || '',
                        'description_contact' : $scope.data.description_home.description_contact || '',
                    }),
                'key' : 'SETTING_HOME'
            }
            $settingService.action.insertSetting(params).then(function (resp){
                if (resp) {
                    $myNotify.success('Success')
                }
            }, function (error) {
                $myNotify.error('Error')
            });
        },

        saveBanner: function () {
            let params = {
                'setting': JSON.stringify(
                    {
                        'contact': $scope.data.banner.contact || '',
                        'about' : $scope.data.banner.about || '',
                        'news_detail' : $scope.data.banner.news_detail || '',
                        'news' : $scope.data.banner.news || '',
                        'product' : $scope.data.banner.product || '',
                        'product_detail' : $scope.data.banner.product_detail || '',
                    }),
                'key' : 'BANNER'
            }
            $settingService.action.insertSetting(params).then(function (resp){
                if (resp) {
                    $myNotify.success('Success')
                }
            }, function (error) {
                $myNotify.error('Error')
            });
        },

        saveContact: function () {
            let params = {
                'setting': JSON.stringify(
                    {
                        'address': $scope.data.contact.address || '',
                        'phone'  : $scope.data.contact.phone || '',
                        'fax' : $scope.data.contact.fax || '',
                        'email': $scope.data.contact.email || '',
                        'copy_right' : $scope.data.contact.copy_right || '',
                        'google_map' : $scope.data.contact.google_map || '',
                        'google_analytic': $scope.data.contact.google_analytic || '',
                        'fb_pixel' : $scope.data.contact.fb_pixel
                    }
                ),
                'key' : 'CONTACT'
            }
            $settingService.action.insertSetting(params).then(function (resp){
                if (resp) {
                    $myNotify.success('Success')
                }
            }, function (error) {
                $myNotify.error('Error')
            });
        },

        delete: function ($id) {
            if ($id) {
                $myBootbox.confirm('Are you sure?', function (resp) {
                    if (resp) {
                        $settingService.action.deleteUser($id).then(function (resp) {
                            if (resp) {
                                $myNotify.success('Sure!');
                                $scope.actions.getAboutTeam();
                            }
                        }, function (error) {
                            $myNotify.error('No!');
                        })
                    }
                })
            }
        },

    }

    $scope.actions.getLogo();
});