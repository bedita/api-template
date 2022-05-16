<?php
/*
 * Local configuration file to provide any overrides to your app.php configuration.
 * Copy and save this file as app_local.php and make changes as required.
 * Note: It is not recommended to commit files with credentials such as app_local.php
 * into source code version control.
 */
return [
    /*
     * Debug Level:
     *
     * Production Mode:
     * false: No error messages, errors, or warnings shown.
     *
     * Development Mode:
     * true: Errors and warnings shown.
     */
    'debug' => filter_var(env('DEBUG', false), FILTER_VALIDATE_BOOLEAN),

    /*
     * Security and encryption configuration
     *
     * - salt - A random string used in security hashing methods.
     *   The salt value is also used as the encryption key.
     *   You should treat it as extremely sensitive data.
     */
    'Security' => [
        'salt' => env('SECURITY_SALT', '__SALT__'),
    ],

    /*
     * Connection information used by the ORM to connect
     * to your application's datastores.
     *
     * See app.php for more configuration options.
     */
    'Datasources' => [
        'default' => [
            'host' => 'localhost',
            /*
             * CakePHP will use the default DB port based on the driver selected
             * MySQL on MAMP uses port 8889, MAMP users will want to uncomment
             * the following line and set the port accordingly
             */
            //'port' => 'non_standard_port_number',
            'username' => 'my_app',
            'password' => 'secret',
            'database' => 'my_app',
            'log' => true,
            /*
             * You can use a DSN string to set the entire configuration
             */
            'url' => env('DATABASE_URL', null),
        ],

        /*
         * The test connection is used during the test suite.
         */
        'test' => [
            'host' => 'localhost',
            //'port' => 'non_standard_port_number',
            'username' => 'my_app',
            'password' => 'secret',
            'database' => 'test_myapp',
            //'schema' => 'myapp',
            'url' => env('DATABASE_TEST_URL', 'sqlite://127.0.0.1/tests.sqlite'),
        ],
    ],

    /*
     * Email configuration.
     *
     * Host and credential configuration in case you are using SmtpTransport
     *
     * See app.php for more configuration options.
     */
    'EmailTransport' => [
        'default' => [
            'host' => 'localhost',
            'port' => 25,
            'username' => null,
            'password' => null,
            'client' => null,
            'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
        ],
    ],

    /**
     * Project information.
     *
     * - `name` public name of the project, short expression recommended like `MyProject`, `Nope v1`
     */
    'Project' => [
        'name' => env('BEDITA_PROJECT_TITLE', 'MyApp'),
    ],

    /**
     * Additional plugins to load with this format:
     *
     * [
     *   'PluginName' => [(options array, see below)],
     * ]
     *
     * or simply using plugin name (default options are applied)
     *
     * [
     *   'PluginName',
     * ]
     *
     * Where options array may contain
     *
     * - `debugOnly` - boolean - (default: false) Whether or not you want to load the plugin when in 'debug' mode only
     * - `bootstrap` - boolean - (default: false) Whether or not you want the $plugin/config/bootstrap.php file loaded.
     * - `routes` - boolean - (default: false) Whether or not you want to load the $plugin/config/routes.php file.
     * - `ignoreMissing` - boolean - (default: false) Set to true to ignore missing bootstrap/routes files.
     * - `autoload` - boolean - (default: false) Whether or not you want an autoloader registered
     */
    // 'Plugins' => [
    //     'BEdita/DevTools' => ['bootstrap' => true, 'routes' => true, 'ignoreMissing' => true],
    //     'DebugKit' => ['debugOnly' => true, 'bootstrap' => true, 'routes' => true, 'ignoreMissing' => true],
    // ],
];
