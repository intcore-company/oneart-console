<?php

namespace MarkRady\OneARTConsole;

use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $configPath = __DIR__ . '/../config/OneART.php';
        $this->mergeConfigFrom($configPath, 'OneART');
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
