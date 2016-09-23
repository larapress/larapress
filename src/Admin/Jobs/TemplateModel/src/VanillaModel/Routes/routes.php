<?php

\Route::group(['middleware' => ['web', 'larapress']], function(){
    \Route::resource('/larapress/{models}', '\{vendor}\{package}\Http\Controllers\{Models}Controller');
    \Route::post('larapress/{models}/search', ['as' => 'larapress.{models}.search', 'uses' => '\{vendor}\{package}\Http\Controllers\{Models}Controller@search']);
});

