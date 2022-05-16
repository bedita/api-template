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

use BEdita\Core\Middleware\BodyParserMiddleware;
use Cake\Core\Configure;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\MiddlewareQueue;
use Cake\Routing\Middleware\RoutingMiddleware;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use InvalidArgumentException;
use MyApp\Application;

/**
 * {@see MyApp\Application} Test Case
 *
 * @coversDefaultClass \MyApp\Application
 */
class ApplicationTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Test `middleware` method
     *
     * @return void
     * @covers ::middleware()
     */
    public function testMiddleware(): void
    {
        $app = new Application(CONFIG);
        $middleware = new MiddlewareQueue();
        $middleware = $app->middleware($middleware);

        $this->assertInstanceOf(ErrorHandlerMiddleware::class, $middleware->current());
        $middleware->seek(1);
        $this->assertInstanceOf(RoutingMiddleware::class, $middleware->current());
        $middleware->seek(2);
        $this->assertInstanceOf(BodyParserMiddleware::class, $middleware->current());
    }

    /**
     * Test bootstrap in production.
     *
     * @return void
     * @covers ::bootstrap()
     * @covers ::bootstrapCli()
     */
    public function testBootstrap()
    {
        Configure::write('Plugins', []);
        Configure::write('debug', false);
        $app = new Application(dirname(dirname(__DIR__)) . '/config');
        $app->bootstrap();
        $plugins = $app->getPlugins();

        static::assertTrue($plugins()->has('BEdita/Core'));
        static::assertTrue($plugins()->has('BEdita/API'));
        static::assertTrue($plugins()->has('Migrations'));
        $this->assertTrue($plugins->has('Bake'), 'plugins has Bake?');
        $this->assertFalse($plugins->has('DebugKit'), 'plugins has DebugKit?');
        $this->assertTrue($plugins->has('Migrations'), 'plugins has Migrations?');
    }

    /**
     * Test bootstrap add DebugKit plugin in debug mode.
     *
     * @return void
     */
    public function testBootstrapInDebug()
    {
        Configure::write('debug', true);
        $app = new Application(dirname(dirname(__DIR__)) . '/config');
        $app->bootstrap();
        $plugins = $app->getPlugins();

        $this->assertTrue($plugins->has('DebugKit'), 'plugins has DebugKit?');
    }

    /**
     * testBootstrapPluginWitoutHalt
     *
     * @return void
     */
    public function testBootstrapPluginWithoutHalt()
    {
        $this->expectException(InvalidArgumentException::class);

        $app = $this->getMockBuilder(Application::class)
            ->setConstructorArgs([dirname(dirname(__DIR__)) . '/config'])
            ->onlyMethods(['addPlugin'])
            ->getMock();

        $app->method('addPlugin')
            ->will($this->throwException(new InvalidArgumentException('test exception.')));

        $app->bootstrap();
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
