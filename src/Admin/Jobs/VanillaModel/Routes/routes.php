<?php

\Route::group(['middleware' => ['web', 'larapress']], function(){
    \Route::resource('/larapress/pages', '\Larapress\Pages\Http\Controllers\PagesController');
    \Route::post('larapress/pages/search', ['as' => 'larapress.pages.search', 'uses' => '\Larapress\Pages\Http\Controllers\PagesController@search']);
});

