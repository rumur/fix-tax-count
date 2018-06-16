<?php

namespace Rumur\Service;

use Pimple\Container;

use Rumur\Core\ServiceProvider;

/**
 * Class ViewService
 * @package Rumur\Service
 */
class ViewService extends ServiceProvider
{
	/**
	 * @since 0.0.1
	 * @param Container $container
	 */
	public function register( Container $container )
	{
		$container['view'] = $container->factory(function ($c) {
			return new View\View( $c['plugin']->getDirPath() . 'views' );
		});
	}
}
