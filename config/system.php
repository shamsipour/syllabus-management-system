<?php

    // All system configs
    return [
        'ADMIN_PATH' => env('ADMIN_PATH', 'adm-panel'),

        'API_PATH'   => env('API_PATH', '/'),

        'PAGINATION_LIMIT' => 20,

        'MAJOR_LEVELS' => [
            ['name' => 'کاردانی', 'value' => 0],
            ['name' => 'کارشناسی', 'value' => 1],
            ['name' => 'کارشناسی ارشد', 'value' => 2],
            ['name' => 'دکتری', 'value' => 3],
        ],

        'DAYS' => ['شنبه', 'یکشنبه', 'دوشنبه', 'سه شنبه', 'چهارشنبه', 'پنجشنبه', 'جمعه'],

        'FULL_PLANS_PATH'  => public_path('/'),
        'DAILY_PLANS_PATH' => public_path('excels/')
    ];