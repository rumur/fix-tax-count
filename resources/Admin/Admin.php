<?php
namespace Rumur\Admin;

use Rumur\Plugin;
use Rumur\Core\Container;
use Rumur\Facades\NoticeAdmin;
/**
 * Class Admin
 * @package Rumur\Admin
 * @author rumur
 */
class Admin {
    /** @var Container */
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
	 * It runs on WordPress /wp-admin/ pages only.
	 *
     * @param Container $container.
     *
	 * Called from \Rumur\Plugin::run().
	 *
	 * @since 0.0.1
	 *
	 * @see \Rumur\Plugin::run()
	 */
	static public function run(Container $container)
	{
        $self = new self($container);
        /**
         * The Vital file's list that need to be loaded.
         */
        $include_file_list = apply_filters('rumur/plugin/admin/run', array(
            'Admin/loader',
        ));

        /**
         * Load required files
         *
         * The mapped array determines the code library included in your plugin.
         * Add or remove files to the array as needed.
         */
        array_map( function ( $file ) use ($self) {
            $path = $self->container->offsetGet('plugin')->getDirPath();
            $file = "{$path}app/{$file}.php";

            if ( ! file_exists( $file ) ) {
                // Add warning notice
                NoticeAdmin::addWarning(
                    sprintf(
                        __( 'Error locating <code>%s</code> for inclusion.', Plugin::TEXT_DOMAIN ),
                        basename($file)
                    )
                );
            } else {
                include_once $file;
            }
        }, $include_file_list );
	}
}
