<?php

Route::get('stations', 'Api\StationController@index')
    ->name('api.stations.index');
