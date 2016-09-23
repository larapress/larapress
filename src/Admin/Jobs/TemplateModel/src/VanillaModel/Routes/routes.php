<?php

\Route::group(['middleware' => ['web', 'larapress']], function(){
    \Route::resource('/larapress/{models}', '\{Vendor}\{Package}\{Models}\Http\Controllers\{Models}Controller');
    \Route::post('larapress/{models}/search', ['as' => 'larapress.{models}.search', 'uses' => '\{Vendor}\{Package}\{Models}\Http\Controllers\{Models}Controller@search']);
});

