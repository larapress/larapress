<?php
/**
 * Authorization level required for each method in controller
 */

return [
    'index' => ['admin'],
    'create' => ['admin'],
    'store' => ['admin'],
    'edit' => ['admin'],
    'update' => ['admin'],
    'destroy' => ['admin'],
    'search' => ['admin'],
];