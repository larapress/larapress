<?php

/**
 * Returns an array of items to be shown on the menu page. This could get
 * quite large and messy, so maybe be worth splitting into other files.
 */

return [
    'pages' => [
        'route' => '#',
        'display' => 'Pages',
        'sub_menu' => [
            [
                'route' => 'larapress.pages.index',
                'display' => 'All Pages',
            ],
            [
                'route' => 'larapress.pages.create',
                'display' => 'Create Page',
            ]
        ]
    ]
];