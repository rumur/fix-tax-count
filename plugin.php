<?php
use Rumur\Plugin;
/*
Plugin Name: Fix Tax Count
Plugin URI: https://github.com/rumur/fix-tax-count
Description: Light WordPress Plugin, which helps reindex post count for taxonomies after import/export.
Version: 1.0.0
Author: rumur
Author URI: https://github.com/rumur/
Copyright: rumur
Text Domain: rumur
Domain Path: /languages
*/

/**
 * Default constants.
 *
 * @since 0.1.0
 */
defined('DS') ? DS : define('DS', DIRECTORY_SEPARATOR);

/**
 * Class Autoloader.
 *
 * @since 0.1.0
 */
if ( ! class_exists('Rumur\Plugin') ) {
	require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
}

try {
    do_action('rumur\plugin\run', Plugin::run(__FILE__) );
} catch (\Throwable $e) {
    if (defined('WP_DEBUG') && WP_DEBUG && current_user_can('activate_plugins')) {
        add_action('admin_notices', function () use ($e) {
            $notice_class = array(
                'notice',
                'notice-error',  // red
            );
            $html = '<div class="%1$s"><p><strong>%2$s</strong><pre>%3$s</pre></p></div>';

            printf($html, join(' ', $notice_class), __('Fix Tax Count', 'rumur'), $e);
        });
    } else {
        error_log('< Taxonomy count reindexer > ' . $e);
    }
}
