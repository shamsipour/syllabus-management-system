<?php

    Route::group(['prefix' => config('system.API_PATH'), 'namespace' => 'API'], function() {
        Route::get('plans', 'MainController@getPlans');

        Route::get('times'  , 'MainController@getTimes');
        Route::get('majors' , 'MainController@getMajors');
        Route::get('lessons', 'MainController@getLessons');
    });
