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
 * @since     3.3.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace MyApp;

use BEdita\Core\Middleware\BodyParserMiddleware;
use Cake\Core\Configure;
use Cake\Core\ContainerInterface;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Http\MiddlewareQueue;
use Cake\Routing\Middleware\RoutingMiddleware;

/**
 * Application setup class.
 *
 * This defines the bootstrapping logic and middleware layers you
 * want to use in your application.
 */
class Application extends BaseApplication
{
    /**
     * Default plugin load options
     *
     * @var array
     */
    const PLUGIN_DEFAULTS = [
        'debugOnly' => false,
        'autoload' => false,
        'bootstrap' => true,
        'routes' => true,
        'ignoreMissing' => true
    ];

    /**
     * @inheritDoc
     */
    public function bootstrap(): void
    {
        // Call parent to load bootstrap from files.
        parent::bootstrap();

        if (PHP_SAPI === 'cli') {
            $this->bootstrapCli();
        }

        // Load basic plugins here
        $this->addPlugin('BEdita/Core', ['bootstrap' => true]);
        $this->addPlugin('BEdita/API', ['bootstrap' => true, 'routes' => true]);
        // Load additional plugins via config
        $this->addConfigPlugins();
    }

    /**
     * Add plugins from 'Plugins' configuration
     *
     * @return void
     */
    public function addConfigPlugins(): void
    {
        $plugins = (array)Configure::read('Plugins');
        if (empty($plugins)) {
            return;
        }

        foreach ($plugins as $plugin => $options) {
            if (!is_string($plugin) && is_string($options)) {
                // plugin listed not as assoc array 'PluginName' => [....]
                // but as numeric array like 0 => 'PluginName'
                $plugin = $options;
                $options = [];
            }
            $options = array_merge(self::PLUGIN_DEFAULTS, $options);
            if (!$options['debugOnly'] || ($options['debugOnly'] && Configure::read('debug'))) {
                $this->addPlugin($plugin, $options);
            }
        }
    }

    /**
     * Setup the middleware queue your application will use.
     *
     * @param \Cake\Http\MiddlewareQueue $middlewareQueue The middleware queue to setup.
     * @return \Cake\Http\MiddlewareQueue The updated middleware queue.
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue
            // Catch any exceptions in the lower layers,
            // and make an error page/response
            ->add(new ErrorHandlerMiddleware(Configure::read('Error')))

            // Add routing middleware.
            // If you have a large number of routes connected, turning on routes
            // caching in production could improve performance. For that when
            // creating the middleware instance specify the cache config name by
            // using it's second constructor argument:
            // `new RoutingMiddleware($this, '_cake_routes_')`
            ->add(new RoutingMiddleware($this))

            // Parse various types of encoded request bodies so that they are
            // available as array through $request->getData()
            // https://book.cakephp.org/4/en/controllers/middleware.html#body-parser-middleware
            ->add(new BodyParserMiddleware());

        return $middlewareQueue;
    }

    /**
     * Register application container services.
     *
     * @param \Cake\Core\ContainerInterface $container The Container to update.
     * @return void
     * @link https://book.cakephp.org/4/en/development/dependency-injection.html#dependency-injection
     */
    public function services(ContainerInterface $container): void
    {
    }

    /**
     * Bootstrapping for CLI application.
     *
     * That is when running commands.
     *
     * @return void
     */
    protected function bootstrapCli(): void
    {
        $this->addOptionalPlugin('Cake/Repl');
        $this->addOptionalPlugin('Bake');
        $this->addOptionalPlugin('IdeHelper');


        $this->addPlugin('Migrations');

        // Load more plugins here
    }
}
