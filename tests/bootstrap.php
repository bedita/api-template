<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Cache\Cache;
use Cake\Chronos\Chronos;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\ConnectionHelper;
use Migrations\TestSuite\Migrator;

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/config/bootstrap.php';
require dirname(__DIR__) . '/vendor/bedita/core/config/bootstrap.php';

if (empty($_SERVER['HTTP_HOST']) && !Configure::read('App.fullBaseUrl')) {
    Configure::write('App.fullBaseUrl', 'http://localhost');
}

// Fixate now to avoid one-second-leap-issues
Chronos::setTestNow(Chronos::now());

// Fixate sessionid early on, as php7.2+
// does not allow the sessionid to be set after stdout
// has been written to.
session_id('cli');

if (!defined('API_KEY')) {
    define('API_KEY', 'API_KEY');
}

// Connection aliasing needs to happen before migrations are run.
// Otherwise, table objects inside migrations would use the default datasource
ConnectionHelper::addTestAliases();

Cache::drop('_bedita_object_types_');
Cache::setConfig('_bedita_object_types_', ['className' => 'Null']);

if (defined('UNIT_TEST_RUN')) {
    Cache::clearAll();
    $migrator = new Migrator();
    $migrator->runMany([
        ['plugin' => 'BEdita/Core'],
        [],
    ]);
}

Cache::clearAll();
TableRegistry::getTableLocator()->clear();
