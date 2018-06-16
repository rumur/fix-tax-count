<?php
namespace Rumur\Facades;

/**
 * Class NoticeFront
 * @package Rumur\Facades
 */
class NoticeFront extends Facade {
	/**
	 * Return the igniter service key responsible for the Notice class.
	 * The key must be the same as the one used in the assigned
	 * igniter service.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'notice.front';
	}
}