<?php

Route::get('stations', 'Api\StationController@index')
    ->name('api.stations.index');

Route::get('nowplaying', 'Api\\NowPlayingController@get')
    ->name('api.nowplaying.get');
