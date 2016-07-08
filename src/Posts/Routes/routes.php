<?php

\Route::group(['middleware' => ['web', 'larapress']], function(){
    \Route::resource('/larapress/posts', '\Larapress\Posts\Http\Controllers\PostsController');
    \Route::post('larapress/posts/search', ['as' => 'larapress.posts.search', 'uses' => '\Larapress\Posts\Http\Controllers\PostsController@search']);
});

