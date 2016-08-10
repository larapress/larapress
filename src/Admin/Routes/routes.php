<?php

\Route::group(['middleware' => ['web']], function() {
    \Route::get('/larapress/login', ['as' => 'larapress.login', 'uses' => '\Larapress\Admin\Http\Controllers\AdminController@login']);
    \Route::post('/larapress/auth', ['as' => 'larapress.auth', 'uses' => '\Larapress\Admin\Http\Controllers\AdminController@auth']);
});

\Route::group(['middleware' => ['web', 'larapress', '\Larapress\Admin\Http\Middleware\LarapressRole:authorization.admin']], function(){

    //login and admin
    \Route::get('/larapress/dashboard', ['as' => 'larapress.dashboard', 'uses' => '\Larapress\Admin\Http\Controllers\AdminController@dashboard']);
    \Route::get('/larapress/logout', ['as' => 'larapress.logout', 'uses' => '\Larapress\Admin\Http\Controllers\AdminController@logout']);
    \Route::get('/larapress/deny', ['as' => 'larapress.deny', 'uses' => '\Larapress\Admin\Http\Controllers\AdminController@deny']);

    //administrators
    \Route::post('/larapress/administrators/search', ['as' => 'larapress.administrators.search', 'uses' => '\Larapress\Admin\Http\Controllers\AdministratorsController@search']);
    \Route::resource('/larapress/administrators', '\Larapress\Admin\Http\Controllers\AdministratorsController');

    //media manager
    \Route::get('/mediaManager', ['as' => 'larapress.media', 'uses' => '\Larapress\Admin\Http\Controllers\MediaController@display']);
    \Route::post('/larapress/media/directories', ['as' => 'larapress.media.directories', 'uses' => '\Larapress\Admin\Http\Controllers\MediaController@directories']);
    \Route::post('/larapress/media/files', ['as' => 'larapress.media.files', 'uses' => '\Larapress\Admin\Http\Controllers\MediaController@files']);
    \Route::post('/larapress/media/upload', ['as' => 'larapress.media.upload', 'uses' => '\Larapress\Admin\Http\Controllers\MediaController@upload']);
    \Route::post('/larapress/media/create-directory', ['as' => 'larapress.media.createDirectory', 'uses' => '\Larapress\Admin\Http\Controllers\MediaController@createDirectory']);

    //attachments
    \Route::any('/larapress/attachments/getByModel', ['as' => 'larapress.attachment.getByModel', 'uses' => '\Larapress\Admin\Http\Controllers\AttachmentController@getByModel']);
});
