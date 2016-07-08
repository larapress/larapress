<?php

\Route::group(['middleware' => ['web', 'larapress']], function(){
    \Route::get('/dashboard', ['as' => 'larapress.dashboard', 'uses' => '\Larapress\Admin\Http\Controllers\AdminController@dashboard']);
    \Route::get('/larapress', ['as' => 'larapress.login', 'uses' => '\Larapress\Admin\Http\Controllers\AdminController@login']);

    \Route::get('/mediaManager', ['as' => 'larapress.media', 'uses' => '\Larapress\Admin\Http\Controllers\MediaController@display']);
    \Route::post('/larapress/media/directories', ['as' => 'larapress.media.directories', 'uses' => '\Larapress\Admin\Http\Controllers\MediaController@directories']);
    \Route::post('/larapress/media/files', ['as' => 'larapress.media.files', 'uses' => '\Larapress\Admin\Http\Controllers\MediaController@files']);
    \Route::post('/larapress/media/upload', ['as' => 'larapress.media.upload', 'uses' => '\Larapress\Admin\Http\Controllers\MediaController@upload']);
    \Route::post('/larapress/media/create-directory', ['as' => 'larapress.media.createDirectory', 'uses' => '\Larapress\Admin\Http\Controllers\MediaController@createDirectory']);
    \Route::any('/larapress/attachments/getByModel', ['as' => 'larapress.attachment.getByModel', 'uses' => '\Larapress\Admin\Http\Controllers\AttachmentController@getByModel']);
});
