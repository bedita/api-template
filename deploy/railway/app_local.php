<?php

use BEdita\Core\Cache\Engine\LayeredEngine;
use Cake\Cache\Engine\RedisEngine;
use Cake\Log\Engine\ConsoleLog;
/*
 * Local configuration file to provide any overrides to your app.php configuration.
 * Copy and save this file as app_local.php and make changes as required.
 * Note: It is not recommended to commit files with credentials such as app_local.php
 * into source code version control.
 */
return [
    /*
     * Connection information used by the ORM to connect
     * to your application's datastores.
     *
     * See app.php for more configuration options.
     */
    'Datasources' => [
        'default' => [
            'driver' => 'Cake\Database\Driver\Postgres',
            'persistent' => false,
            // needed by PgBouncer
            'flags' => [
                PDO::ATTR_EMULATE_PREPARES => true,
            ],
            'url' => env('DATABASE_URL', null),
        ],

        /*
         * The test connection is used during the test suite.
         */
        'test' => [
            'url' => env('DATABASE_TEST_URL', 'sqlite:///tmp/myapp.sqlite'),
        ],
    ],

    /**
     * Configures logging options
     */
    'Log' => [
        'analytics' => [
            'className' => ConsoleLog::class,
            'scopes' => ['analytics'],
        ],
        'debug' => [
            'className' => ConsoleLog::class,
            'scopes' => null,
            'levels' => ['notice', 'info', 'debug'],
        ],
        'error' => [
            'className' => ConsoleLog::class,
            'scopes' => null,
            'levels' => ['warning', 'error', 'critical', 'alert', 'emergency'],
        ],
        // To enable this dedicated query log, you need set your datasource's log flag to true
        'queries' => [
            'className' => ConsoleLog::class,
            'scopes' => ['queriesLog'],
        ],
    ],

    // 'Cache' => [
    //     'default' => [
    //         'className' => RedisEngine::class,
    //         'host' => env('CACHE_REDIS_HOST'),
    //         'port' => env('CACHE_REDIS_PORT', 6379),
    //         'database' => 0,
    //         'password' => env('CACHE_REDIS_PASSWORD', null),
    //         'prefix' => sprintf('%sdefault_', env('CACHE_PREFIX')),
    //     ],
    //     '_cake_core_' => [
    //         'className' => RedisEngine::class,
    //         'host' => env('CACHE_REDIS_HOST'),
    //         'port' => env('CACHE_REDIS_PORT', 6379),
    //         'database' => 0,
    //         'password' => env('CACHE_REDIS_PASSWORD', null),
    //         'prefix' => sprintf('%scake_core_', env('CACHE_PREFIX')),
    //         'duration' => '+1 years',
    //     ],
    //     '_cake_translations_' => [
    //         'className' => RedisEngine::class,
    //         'host' => env('CACHE_REDIS_HOST'),
    //         'port' => env('CACHE_REDIS_PORT', 6379),
    //         'database' => 0,
    //         'password' => env('CACHE_REDIS_PASSWORD', null),
    //         'prefix' => sprintf('%scake_translations_', env('CACHE_PREFIX')),
    //         'duration' => '+1 years',
    //     ],
    //     '_cake_model_' => [
    //         'className' => RedisEngine::class,
    //         'host' => env('CACHE_REDIS_HOST'),
    //         'port' => env('CACHE_REDIS_PORT', 6379),
    //         'database' => 0,
    //         'password' => env('CACHE_REDIS_PASSWORD', null),
    //         'prefix' => sprintf('%scake_model_', env('CACHE_PREFIX')),
    //         'duration' => '+1 years',
    //     ],
    //     '_bedita_core_' => [
    //         'className' => LayeredEngine::class,
    //         'persistent' => [
    //             'className' => RedisEngine::class,
    //             'host' => env('CACHE_REDIS_HOST'),
    //             'port' => env('CACHE_REDIS_PORT', 6379),
    //             'database' => 0,
    //             'password' => env('CACHE_REDIS_PASSWORD', null),
    //             'prefix' => sprintf('%sbedita_core_', env('CACHE_PREFIX')),
    //             'duration' => '+1 year',
    //         ],
    //         'serialize' => true,
    //         'prefix' => sprintf('%sbedita_core_', env('CACHE_PREFIX')),
    //         'duration' => '+1 year',
    //     ],
    //     '_bedita_object_types_' => [
    //         'className' => LayeredEngine::class,
    //         'persistent' => [
    //             'className' => RedisEngine::class,
    //             'host' => env('CACHE_REDIS_HOST'),
    //             'port' => env('CACHE_REDIS_PORT', 6379),
    //             'database' => 0,
    //             'password' => env('CACHE_REDIS_PASSWORD', null),
    //             'prefix' => sprintf('%sbedita_object_types_', env('CACHE_PREFIX')),
    //             'duration' => '+1 year',
    //         ],
    //         'serialize' => true,
    //         'prefix' => sprintf('%sbedita_object_types_', env('CACHE_PREFIX')),
    //         'duration' => '+1 year',
    //     ],
    // ],

    /**
     * Default values per object type
     * object type names as keys (lower case), default property names and values as value
     */
    // 'DefaultValues' => [
    //     'cats' => [
    //         'status' => 'off',
    //     ],
    //     'dogs' => [
    //         'status' => 'on', // GO dogs!
    //     ],
    // ],
];
