<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         3.3.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace MyApp\Test\TestCase;

use Cake\Core\Configure;
use Cake\TestSuite\TestCase;
use MyApp\Application;

/**
 * {@see MyApp\Application} Test Case
 *
 * @coversDefaultClass \MyApp\Application
 */
class ApplicationTest extends TestCase
{
    /**
     * Test `bootstrap` method
     *
     * @return void
     * @covers ::bootstrap()
     */
    public function testBootstrap()
    {
        Configure::write('Plugins', []);
        $app = new Application(CONFIG);
        $app->bootstrap();
        static::assertTrue($app->getPlugins()->has('BEdita/Core'));
        static::assertTrue($app->getPlugins()->has('BEdita/API'));
        static::assertTrue($app->getPlugins()->has('Migrations'));
    }

    /**
     * Test `bootstrapCli` method
     *
     * @return void
     * @covers ::bootstrapCli()
     */
    public function testBootstrapCli()
    {
        $currDebug = Configure::read('debug');
        $app = new Application(CONFIG);
        $app->bootstrap();
        static::assertTrue($app->getPlugins()->has('Cake/Repl'));
        Configure::write('debug', $currDebug);
    }
}
