<?php
namespace Rumur;

/**
 * Class Uninstall
 * @package Rumur
 */
class Uninstall {

	/**
	 * Run while plugin delete.
	 *
	 * @since 0.0.1
	 */
	public static function run()
	{
		if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
			exit;
		}

		// @TODO Some stuff here.
	}
}