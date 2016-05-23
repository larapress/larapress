<?php

\Route::group(['middleware' => ['web', 'larapress']], function(){
    \Route::get('/dashboard', ['as' => 'larapress.dashboard', 'uses' => '\Larapress\Admin\Http\Controllers\AdminController@dashboard']);
    \Route::get('/larapress', ['as' => 'larapress.login', 'uses' => '\Larapress\Admin\Http\Controllers\AdminController@login']);

    \Route::get('/mediaManager', ['as' => 'larapress.media', 'uses' => '\Larapress\Admin\Http\Controllers\MediaController@display']);
    \Route::get('/larapress/media/directories', ['as' => 'larapress.media.directories', 'uses' => '\Larapress\Admin\Http\Controllers\MediaController@directories']);
    \Route::post('/larapress/media/files', ['as' => 'larapress.media.files', 'uses' => '\Larapress\Admin\Http\Controllers\MediaController@files']);
    \Route::post('/larapress/media/upload', ['as' => 'larapress.media.upload', 'uses' => '\Larapress\Admin\Http\Controllers\MediaController@upload']);
});
