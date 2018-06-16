<?php

namespace Rumur\Service;

use Pimple\Container;

use Rumur\Admin\Service\NoticeAdmin;
use Rumur\Core\ServiceProvider;
use Rumur\Service\Notice\NoticeFront;

/**
 * Class NoticeService
 * @package Rumur\Service
 */
class NoticeService extends ServiceProvider
{
	function __construct()
	{
		if ( ! session_id() ) {
			session_start();
		}
	}

	/**
	 * @since 0.0.1
	 * @param Container $container
	 */
	public function register( Container $container )
	{
		$container['notice.admin'] = function () {
			return NoticeAdmin::register();
		};
		$container['notice.front'] = function () {
			return NoticeFront::register();
		};
	}
}
