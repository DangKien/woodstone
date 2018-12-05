<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Frontend Route
Route::group(['prefix' => '/', 'namespace' => 'Frontend', 'middleware' => 'locale'], function () {

	Route::get('', 'HomeController@index')->name('home.index');

	Route::get('contact-us.html', 'HomeController@contact')->name('home.contact');

	Route::get('products/{slug}.{id}.html', 'ProductController@list')->name('home.product');

	Route::get('product-detail/{slug}.{id}.html', 'ProductController@detail')->name('home.product.detail');

	Route::get('categories/{slug}.{id}.html', 'ProductController@list')->name('home.categories');

	Route::get('news-center.html', 'PostController@list')->name('home.news');

	Route::get('new-center/{slug}.{id}.html', 'PostController@detail')->name('home.news.detail');

	Route::get('about-us.html', 'HomeController@about')->name('home.about');

	Route::get('quality.html', 'HomeController@quality')->name('home.quality');

	Route::get('change-locale', 'HomeController@locale')->name('home.locale');
});





// Backend Route
Route::group(['prefix' => 'admin', 'namespace' => 'Auth', 'middleware' => 'web'], function() {
    Route::get('login',  'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout')->name('logout');
    Route::get('register', 'LoginController@register')->name('register');
});

Route::group(['prefix' => 'admin/users'], function() {
    Route::get('user-permission/{id}', '\DangKien\RolePer\Controllers\UserRoleController@index')->name('user-permission.index');
    Route::post('user-permission/{id}', '\DangKien\RolePer\Controllers\UserRoleController@store')->name('user-permission.store');
    Route::get('role-permission/{id}', '\DangKien\RolePer\Controllers\RolePermissionController@index')->name('roles-permission.index');
    Route::post('role-permission/{id}', '\DangKien\RolePer\Controllers\RolePermissionController@store')->name('roles-permission.store');
});

Route::resource('admin/roles', '\DangKien\RolePer\Controllers\RoleController');
Route::group(['prefix' => '', 'middleware' => 'role:superadmin'], function() {
    Route::resource('admin/permissions', '\DangKien\RolePer\Controllers\PermissionController');
    Route::resource('admin/permissions-group', '\DangKien\RolePer\Controllers\PermissionGroupController');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Backend', 'middleware' => 'auth'], function() {
    Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
    

    Route::get('users/profile', 'UserController@show')->name('users.profile');
    Route::post('users/profile', 'UserController@updateSeft')->name('users.updateProfile');

    Route::get('users/change-password', 'UserController@change')->name('users.change');
    Route::post('users/change-password', 'UserController@changePassword')->name('users.changePassword');

    Route::resource('users', 'UserController');

	Route::get('setting', 'SettingController@index')->name('setting.index');

    Route::resource('languages', 'LanguagesController', ['except'=>['destroy']]);

    Route::resource('categories', 'CategoryController', ['except'=>['destroy']]);

	Route::resource('products', 'ProductController', ['except'=>['destroy']]);

	Route::resource('posts', 'PostController', ['except'=>['destroy']]);

	Route::resource('home-products', 'HomeProductController', ['except'=>['destroy']]);

	Route::resource('slides', 'SlideController', ['except'=>['destroy']]);

	Route::get('static-page/about', 'StaticPageController@about')->name('about.index');
	Route::post('static-page/about', 'StaticPageController@postAbout')->name('about.post');

	Route::get('static-page/quanlity', 'StaticPageController@quanlity')->name('quanlity.index');
	Route::post('static-page/quanlity', 'StaticPageController@postQuanlity')->name('quanlity.post');

});

Route::group(['prefix' => 'rest/admin', 'namespace' => 'Backend'], function() {
    Route::get('users', 'UserController@getList');
    Route::delete('users/{id}', 'UserController@destroy');

    // Route::get('languages', 'LanguagesController@list');
    // Route::delete('languages/{id}', 'LanguagesController@destroy');

    Route::get('categories', 'CategoryController@list');
    Route::delete('categories/{id}', 'CategoryController@destroy');

	Route::get('setting', 'SettingController@getSetting');
	Route::post('insertSetting', 'SettingController@insertSetting');

	Route::get('products', 'ProductController@list');
	Route::delete('products/{id}', 'ProductController@destroy');
	Route::post('products/changeStatus/{id}', 'ProductController@changeStatus');

	Route::get('posts', 'PostController@list');
	Route::delete('posts/{id}', 'PostController@destroy');
	Route::post('posts/changeStatus/{id}', 'PostController@changeStatus');

	Route::get('home-products', 'HomeProductController@list');
	Route::delete('home-products/{id}', 'HomeProductController@destroy');
	Route::post('home-products/changeStatus/{id}', 'HomeProductController@changeStatus');

	Route::get('slides', 'SlideController@list');
	Route::delete('slides/{id}', 'SlideController@destroy');
	Route::post('slides/delete-multi', 'SlideController@destroyMulti');
});