<?php

\Route::group(['middleware' => ['web', 'larapress']], function(){
    \Route::resource('/larapress/gallery', '\Larapress\Gallery\Http\Controllers\PortfolioController');
    \Route::post('larapress/gallery/search', ['as' => 'larapress.gallery.search', 'uses' => '\Larapress\Gallery\Http\Controllers\PortfolioController@search']);
});

