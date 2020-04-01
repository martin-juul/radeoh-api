<?php

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/-/routes', 'HomeController@showRoutes')
    ->name('dev.show-routes');
