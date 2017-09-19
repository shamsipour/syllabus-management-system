<?php

    /*
     * All Routes
     *
     * All website routes (not API) are listed below
     */

    Route::get('/', 'HomeController@Index')->name('index');
    Route::get('/plans', 'HomeController@getPlans')->name('get-plans');

    // Route all Admin requests
    Route::group(['prefix' => config('system.ADMIN_PATH'), 'namespace' => 'Panel'], function(){
        Route::get('/', function(){return redirect()->route('login');});
        Route::get('/auth', 'AuthController@Login')->name('login');
        Route::post('/auth', 'AuthController@Auth')->name('check');

        Route::group(['middleware' => 'auth:web'], function(){
            Route::get('/dashboard','PanelController@Dashboard')->name('dashboard');
            Route::get('/logout', 'AuthController@Logout')->name('logout');

            // All settings route
            Route::get('/settings/export-pdf', 'SettingsController@ExportPDF')->name('export-pdf');
            Route::get('/settings/export-db', 'SettingsController@ExportDatabaseAsExcel')->name('export-db');
            Route::post('/settings/import-db', 'SettingsController@ImportDatabaseFromExcel')->name('import-db');
            Route::get('/settings', 'SettingsController@index')->name('settings');

            // Handle Times
            Route::resource('/times', 'TimesController', [
                'names' => ['index' => 'manage-times', 'create' => 'new-time', 'edit' => 'edit-time', 'destroy' => 'destroy-time'],
                'except' => ['show']
            ]);
            // Handle Majors
            Route::post('/majors/search', 'MajorsController@search')->name('search-major');
            Route::resource('/majors', 'MajorsController', [
                'names' => ['show' => 'get-major','index' => 'manage-majors', 'destroy' => 'destroy-major'],
                'except' => ['create', 'edit']
            ]);
            // Handle Teachers
            Route::post('/teachers/search', 'TeachersController@search')->name('search-teacher');
            Route::resource('/teachers', 'TeachersController', [
                'names' => ['index' => 'manage-teachers', 'create' => 'new-teacher', 'edit' => 'edit-teacher', 'destroy' => 'destroy-teacher'],
                'except' => ['show']
            ]);
            // Handle Lessons
            Route::post('/lessons/search', 'LessonsController@search')->name('search-lesson');
            Route::resource('/lessons', 'LessonsController', [
                'names' => ['show' => 'get-lesson','index' => 'manage-lessons', 'destroy' => 'destroy-lesson'],
                'except' => ['create', 'edit']
            ]);
            // Handle Plans
            Route::get('/plans/manage/{day}', 'PlansController@manage')->name('show-plan');
            Route::post('/plans/search', 'PlansController@search')->name('search-plan');
            Route::resource('/plans', 'PlansController', [
                'names' => ['index' => 'manage-plans', 'destroy' => 'destroy-plan'],
                'except' => ['create', 'edit']
            ]);
        });
    });
