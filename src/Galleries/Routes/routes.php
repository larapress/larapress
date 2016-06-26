<?php

\Route::group(['middleware' => ['web', 'larapress']], function(){
    \Route::resource('/larapress/galleries', '\Larapress\Galleries\Http\Controllers\GalleriesController');
    \Route::post('larapress/galleries/search', ['as' => 'larapress.galleries.search', 'uses' => '\Larapress\Galleries\Http\Controllers\GalleriesController@search']);
});

