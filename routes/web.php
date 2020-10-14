<?php

Route::get('/', 'HomeController@index')->name('home');
Route::get('/docs', 'HomeController@docs')->name('docs');
