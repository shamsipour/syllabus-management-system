<?php

    Route::group(['prefix' => config('system.API_PATH'), 'namespace' => 'API'], function() {
        Route::get('plans', 'MainController@getPlans');

        Route::get('times', function () {return \App\Time::all();});
        Route::get('majors', function () {return \App\Major::all();});
        Route::get('lessons', function () {return \App\Lesson::all();});
    });
