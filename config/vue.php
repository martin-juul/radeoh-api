<?php

return [
    'dev' => [
        'remote_host' => env('VUE_DEV_REMOTE_HOST', env('APP_URL', 'http://localhost')),
        'remote_port' => env('VUE_DEV_REMOTE_PORT', 8098),
    ],
];
