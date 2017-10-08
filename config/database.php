<?php

return [

    'fetch'       => PDO::FETCH_OBJ,
    'default'     => env('DB_CONNECTION', 'pgsql'),
    'connections' => [

        'test_sqlite' => [
            'driver'   => 'sqlite',
            'database' => 'database/database_test.sqlite',
            'prefix'   => '',
        ],

        'pgsql' => [
            'driver'   => 'pgsql',
            'host'     => env('DB_HOST', '127.0.0.1'),
            'port'     => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset'  => 'utf8',
            'prefix'   => '',
            'schema'   => 'public',
            'sslmode'  => 'prefer',
        ],

        'test_pgsql' => [
            'driver'   => 'pgsql',
            'host'     => env('TEST_DB_HOST', '127.0.0.1'),
            'port'     => env('TEST_DB_PORT', '5432'),
            'database' => env('TEST_DB_DATABASE', 'forge'),
            'username' => env('TEST_DB_USERNAME', 'forge'),
            'password' => env('TEST_DB_PASSWORD', ''),
            'charset'  => 'utf8',
            'prefix'   => '',
            'schema'   => 'public',
            'sslmode'  => 'prefer',
        ],

    ],

    'migrations' => 'migrations',

    'redis' => [
        'cluster' => false,
        'default' => [
            'host'     => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', ''),
            'port'     => env('REDIS_PORT', 6379),
            'database' => 0,
        ],

    ],

];
