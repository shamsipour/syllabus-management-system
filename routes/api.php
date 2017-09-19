<?php

    use Illuminate\Http\Request;

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */

    Route::group(['prefix' => config('system.API_PATH'), 'namespace' => 'API'], function() {
        Route::get('plans', 'MainController@getPlans');
    });
    Route::get('times', function () {return \App\Time::all();});
    Route::get('majors', function () {return \App\Major::all();});
    Route::get('lessons', function () {return \App\Lesson::all();});
