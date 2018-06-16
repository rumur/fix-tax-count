<?php
namespace Rumur\Helpers;

/**
 * Loads all files within the directory.
 *
 * @param $dir                  The directory to load.
 * @param null $exclude_file    Can be useful when it's a loader file itself.
 */
function dir_loader( $dir, $exclude_file = null ) {
    $exclude_file = $exclude_file ? array( $exclude_file ) : array();

    $files = array_diff( glob( $dir . DIRECTORY_SEPARATOR . '*.php' ), $exclude_file );

    array_map( function ( $filename ) {
        if ( file_exists( $filename ) ) {
            include $filename;
        }
    }, $files );
}

/**
 * Whether is a debug mode.
 *
 * @return bool
 *
 * @author rumur
 */
function is_debug() {
    return defined('WP_DEBUG') && WP_DEBUG;
}