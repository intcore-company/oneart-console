<?php

/*
 * This file is part of the lucid-console project.
 *
 * (c) Vinelab <dev@vinelab.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MarkRady\OneARTConsole;

use Illuminate\Support\ServiceProvider;
use Stevebauman\LogReader\LogReaderServiceProvider;

/**
 * @author Abed Halawi <abed.halawi@vinelab.com>
 */
class OneARTServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/OneART.php';
        $this->publishes([$configPath => $this->getConfigPath()], 'config');

        $dashboardEnabled = $this->app['config']->get('OneART.dashboard');

        if ($dashboardEnabled === null) {
            $dashboardEnabled = $this->app['config']->get('app.debug');
        }

        if ($dashboardEnabled === true) {
            if (!$this->app->routesAreCached() ) {
                require_once __DIR__.'/Http/routes.php';
            }
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'lucid');

        $this->publishes([
             __DIR__.'/../resources/assets' => public_path('vendor/lucid'),
        ], 'public');
    }

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $configPath = __DIR__ . '/../config/OneART.php';
        $this->mergeConfigFrom($configPath, 'OneART');

        $this->app->register(LogReaderServiceProvider::class);
    }

    /**
     * Return path to config file.
     *
     * @return string
     */
    private function getConfigPath()
    {
        return config_path('OneART.php');
    }
}
