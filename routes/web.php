<?php
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');

Route::group([
    'prefix'=>'admin',
    'namespace'=>'Admin',
    'middleware'=>'auth',
], function() {
    Route::get('home', 'AdminController@index')->name('admin.dashboard');

    Route::resource('users', 'UsersController', ['as' => 'admin'], ['middleware' => 'Ver usuarios', 'Crear usuarios', 'Editar usuarios']);
    Route::get('users/{user}/photo','UsersController@editphoto')->name('admin.users.photo');
    Route::post('users/photo/update','UsersController@updatePhoto')->name('admin.users.photo.update');

    Route::resource('places', 'PlacesController', ['except' => ['create'], 'as' => 'admin']);

    Route::resource('photographies', 'PhotographiesController', ['except' => ['create'], 'as' => 'admin']);

    Route::resource('pointsofinterest', 'PointsOfInterestController', ['except' => ['create'], 'as' => 'admin']);

    Route::resource('visits', 'VisitsController', ['except' => ['create'], 'as' => 'admin']);

    Route::resource('thematicareas', 'ThematicAreasController', ['except' => ['create'], 'as' => 'admin']);

    Route::resource('videos', 'VideosController', ['except' => ['create'], 'as' => 'admin']);

    Route::resource('videoitems', 'VideoItemsController', ['except' => ['index, create, store, show, destroy'], 'as' => 'admin']);

    Route::resource('roles', 'RolesController', ['except' => 'show', 'as' => 'admin'], ['middleware' => 'Crear roles', 'Editar roles']);
    Route::middleware('role:Administrador')
        ->put('users/{user}/roles', 'UsersRolesController@update')
        ->name('admin.users.roles.update');
    Route::middleware('role:Administrador')
        ->put('users/{user}/permissions', 'UsersPermissionsController@update')
        ->name('admin.users.permissions.update');
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');

Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('password/email', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.email');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');

// Password reset routes...
Route::post('password/reset', 'Auth\ResetPasswordController@reset') ;
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
