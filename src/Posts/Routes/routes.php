<?php

\Route::group(['middleware' => ['web', 'larapress']], function(){
    \Route::get('/larapress/posts/category/{category}', ['as' =>  'larapress.posts.category', 'uses' => '\Larapress\Posts\Http\Controllers\PostsController@category']);
    \Route::resource('/larapress/posts', '\Larapress\Posts\Http\Controllers\PostsController');
    \Route::post('larapress/posts/search', ['as' => 'larapress.posts.search', 'uses' => '\Larapress\Posts\Http\Controllers\PostsController@search']);
});

