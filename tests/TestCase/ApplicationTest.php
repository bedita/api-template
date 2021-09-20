<?php
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
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\MiddlewareQueue;
use Cake\Routing\Middleware\RoutingMiddleware;
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
     * Test `middleware` method
     *
     * @return void
     *
     * @covers ::middleware
     */
    public function testMiddleware(): void
    {
        $app = new Application(CONFIG);
        $middleware = new MiddlewareQueue();
        $middleware = $app->middleware($middleware);

        static::assertInstanceOf(ErrorHandlerMiddleware::class, $middleware->get(0));
        static::assertInstanceOf(RoutingMiddleware::class, $middleware->get(1));
    }

    /**
     * Test `bootstrap` method
     *
     * @return void
     *
     * @covers ::bootstrap()
     * @covers ::bootstrapCli()
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
     * `testConfigPlugins` data provider
     *
     * @return array
     */
    public function configPluginsProvider(): array
    {
        return [
            'simple' => [
                true,
                [
                    'Bake',
                ],
            ],
            'empty' => [
                false,
                [],
            ],
            'options' => [
                true,
                [
                    'Bake' => ['bootstrap' => true, 'ignoreMissing' => true],
                ],
            ],
            'debug no' => [
                false,
                [
                    'Bake' => ['debugOnly' => true],
                ],
                false,
            ],
            'debug yes' => [
                true,
                [
                    'Bake' => ['debugOnly' => true],
                ],
                true,
            ]

        ];
    }

    /**
     * Test `addConfigPlugins` method using `Bake` Plugin
     *
     * @return void
     *
     * @covers ::addConfigPlugins()
     * @dataProvider configPluginsProvider
     */
    public function testConfigPlugins(bool $expected, array $config, bool $debug = false)
    {
        $currDebug = Configure::read('debug');

        Configure::write('Plugins', $config);
        Configure::write('debug', $debug);

        $app = new Application(CONFIG);
        $app->getPlugins()->remove('Bake');

        $app->addConfigPlugins();

        static::assertEquals($expected, $app->getPlugins()->has('Bake'));

        Configure::write('debug', $currDebug);
    }
}
