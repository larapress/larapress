<?php

\Route::group(['middleware' => ['web', 'larapress']], function(){
    \Route::resource('/larapress/portfolio', '\Larapress\Portfolio\Http\Controllers\PortfolioController');
    \Route::post('larapress/portfolio/search', ['as' => 'larapress.portfolio.search', 'uses' => '\Larapress\Portfolio\Http\Controllers\PortfolioController@search']);
});

