<?php

    return [
        'mode' => '',
        'format' => 'A4',
        'default_font_size' => '12',
        'default_font' => 'yekan',
        'margin_left' => 10,
        'margin_right' => 10,
        'margin_top' => 40,
        'margin_bottom' => 10,
        'margin_header' => 0,
        'margin_footer' => 0,
        'orientation' => 'P',
        'title' => 'Shamsipour Classes Plans',
        'author' => 'Erfan Sahafnejad',
        'watermark' => '',
        'show_watermark' => false,
        'watermark_font' => 'sans-serif',
        'display_mode' => 'fullpage',
        'watermark_text_alpha' => 0.1,

        'custom_font_path' => storage_path('fonts/'),
        'custom_font_data' => [
            'yekan' => [
                'R' => 'Yekan.ttf',
                'useOTL' => 0xFF,
                'useKashida' => 75,
            ]
        ]
    ];
