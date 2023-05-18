<?php

Route::get('/', 'HomeController@index');
Route::get('property-type/{slug}', 'RealEstateTypeController@index')->name('event_type');
Route::get('location/{slug}', 'LocationController@index')->name('location');
Route::get('search', 'SearchController@index')->name('search');
Route::get('real-estate/{slug}/{id}', 'RealEstateController@show')->name('real_estate.show');

Route::view('about', 'about')->name('about');
Route::view('contact', 'contact')->name('contact');

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => true]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Locations
    Route::delete('locations/destroy', 'LocationsController@massDestroy')->name('locations.massDestroy');
    Route::post('locations/media', 'LocationsController@storeMedia')->name('locations.storeMedia');
    Route::post('locations/ckmedia', 'LocationsController@storeCKEditorImages')->name('locations.storeCKEditorImages');
    Route::resource('locations', 'LocationsController');

    // Real Estate Type
    Route::delete('real-estate-types/destroy', 'RealEstateTypeController@massDestroy')->name('real-estate-types.massDestroy');
    Route::post('real-estate-types/media', 'RealEstateTypeController@storeMedia')->name('real-estate-types.storeMedia');
    Route::post('real-estate-types/ckmedia', 'RealEstateTypeController@storeCKEditorImages')->name('real-estate-types.storeCKEditorImages');
    Route::resource('real-estate-types', 'RealEstateTypeController');

    // Real Estate
    Route::delete('real-estates/destroy', 'RealEstateController@massDestroy')->name('real-estates.massDestroy');
    Route::post('real-estates/media', 'RealEstateController@storeMedia')->name('real-estates.storeMedia');
    Route::post('real-estates/ckmedia', 'RealEstateController@storeCKEditorImages')->name('real-estates.storeCKEditorImages');
    Route::resource('real-estates', 'RealEstateController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});

//Route::group(['prefix' => 'user', 'as' => 'user.', 'namespace' => 'User', 'middleware' => ['auth']], function () {
Route::group(['prefix' => 'user', 'as' => 'user.', 'namespace' => 'User', 'middleware' => ['auth']], function () {
    Route::get('/', 'UserHomeController@index')->name('home');

    // Real Estate
    Route::delete('real-estates/destroy', 'UserRealEstateController@massDestroy')->name('real-estates.massDestroy');
    Route::post('real-estates/media', 'UserRealEstateController@storeMedia')->name('real-estates.storeMedia');
    Route::post('real-estates/ckmedia', 'UserRealEstateController@storeCKEditorImages')->name('real-estates.storeCKEditorImages');
    Route::resource('real-estates', 'UserRealEstateController');
});


