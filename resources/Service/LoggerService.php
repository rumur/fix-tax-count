<?php

namespace Rumur\Service;

use Pimple\Container;

use Rumur\Core\ServiceProvider;

/**
 * Class LoggerService
 * @package Rumur\Service
 */
class LoggerService extends ServiceProvider
{
    /**
     * @since 0.0.1
     * @param Container $container
     */
    public function register( Container $container )
    {
        $container['logger'] = $container->factory(function ($c) {
            // @TODO retrun the Instance of Logger.
        });
    }

}
