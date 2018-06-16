<?php
namespace Rumur;

use Rumur\Admin\Admin;
use Rumur\Core\Container;
use Rumur\Service\Compat;
use Rumur\Service\ViewService;
use Rumur\Service\NoticeService;

use Rumur\Facades\Facade;
use Rumur\Facades\NoticeAdmin;

/**
 * Class Plugin
 * @package Rumur
 */
class Plugin {
	/**
	 * @since 0.0.1
	 *
	 * @var string
	 */
	const VERSION = '1.0.0';
	/**
	 * @since 0.0.1
	 *
	 * @var string
	 */
	const NAME = 'Fix Tax Count';
	/**
	 * @since 0.0.1
	 *
	 * @var string
	 */
	const WP_VERSION_MIN = '4.5.0';
	/**
	 * @since 0.0.1
	 *
	 * @var string
	 */
	const PHP_VERSION_MIN = '5.5.9';
	/**
	 * @since 0.0.1
	 */
	const TEXT_DOMAIN = 'rumur';

	/**
	 * The DI Container.
	 *
	 * @since 0.0.1
	 *
	 * @var Container.
	 */
	private $container;
	/**
	 * @since 0.0.1
	 *
	 * @var string
	 */
	private $path;
	/**
	 * @since 0.0.1
	 *
	 * @var string
	 */
	private $dir_path;
	/**
	 * Whether the plugin is compatible or not.
	 *
	 * @since 0.0.1
	 *
	 * @var bool
	 */
	private $is_compatible = true;

	/**
	 * Plugin constructor.
	 *
	 * @param $file
	 */
	public function __construct( $file )
	{
		$this->setContainer( new Container() );
		$this->setPath( $file );
		$this->setDirPath();
	}

	/**
	 * Starting the Plugin.
	 *
	 * @since 0.0.1
	 *
	 * @param string $file ( __FILE__ )
	 *
	 * @return mixed|bool|Plugin
	 */
	public static function run( $file )
	{
		$self = new self( $file );

		/**
		 *  Map Service Providers.
		 *
		 * @since 0.0.1
		 */
        $providers = apply_filters(sanitize_title(Plugin::NAME) . '_service_providers', [
			ViewService::class,
			NoticeService::class,
		]);

		/**
		 * Put the link to its self.
		 */
		$self->container['plugin'] = $self;

		/**
		 * Instantiate Service Providers.
		 *
		 * @since 0.0.1
		 */
		array_walk( $providers, function ( $file ) use ( $self ) {
			$self->container->register( new $file );
		} );
		/**
		 * Setup the facade.
		 *
		 * @since 0.0.1
		 */
		Facade::setFacadeApplication( $self->container );
		/**
		 * Check for minimum PHP version.
		 *
		 * @since 0.0.1
		 */
		if (!Compat::checkPHP(Plugin::PHP_VERSION_MIN)) {
			// Add warning notice
			NoticeAdmin::addWarning(
				sprintf(
					__('Minimal PHP version is required for %1$s plugin: <b>%2$s</b>.', Plugin::TEXT_DOMAIN),
					Plugin::NAME, Plugin::PHP_VERSION_MIN
				)
			);
			$self->is_compatible = false;
		}
		/**
		 * Check for minimum WordPress version.
		 *
		 * @since 0.0.1
		 */
		if (!Compat::checkWordPress(Plugin::WP_VERSION_MIN)) {
			// Add warning notice
			NoticeAdmin::addWarning(
				sprintf(
					__('Minimal WP version is required for %1$s plugin: <b>%2$s</b>.', Plugin::TEXT_DOMAIN),
					Plugin::NAME, Plugin::WP_VERSION_MIN
				)
			);
			$self->is_compatible = false;
		}
		/**
		 * If there is no ignition with this env just do nothing.
		 *
		 * @since 0.0.1
		 */
		if ( ! $self->is_compatible ) {
			return false;
		}

        /**
         * The Vital file's list that need to be loaded.
         */
        $include_file_list = apply_filters('rumur/plugin/includes', array(
            'resources/Helpers/functions',
        ));

        /**
         * Load required files
         *
         * The mapped array determines the code library included in your plugin.
         * Add or remove files to the array as needed.
         */
        array_map( function ( $file ) use ($self) {
            $path = $self->container->offsetGet('plugin')->getDirPath();
            $file = "{$path}{$file}.php";

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

		/**
		 * Activation.
		 *
		 * @since 0.0.1
		 */
		register_activation_hook( $self->getPath(), [ 'Rumur\Activation', 'run' ] );
		/**
		 * Uninstall.
		 *
		 * @since 0.0.1
		 */
		register_uninstall_hook( $self->getPath(), [ 'Rumur\Uninstall', 'run' ] );
		/**
		 * Run admin hooks only.
		 *
		 * @since 0.0.1
		 */
		if ( is_admin() ) {
            Admin::run($self->getContainer());
		}

		return $self;
	}

	/**
	 * @since 0.0.1
	 *
	 * @return Container
	 */
	public function getContainer()
	{
		return $this->container;
	}

	/**
	 * @since 0.0.1
	 *
	 * @param Container $container
	 */
	public function setContainer( Container $container )
	{
		$this->container = $container;
	}

	/**
	 * @since 0.0.1
	 *
	 * @return string
	 */
	public function getPath()
	{
		return $this->path;
	}

	/**
	 * @since 0.0.1
	 *
	 * @param string $path
	 */
	public function setPath( $path )
	{
		$this->path = $path;
	}

	/**
	 * Dir Path e.g. .../wp-content/plugins/plugin.
	 *
	 * @since 0.0.1
	 *
	 * @return string
	 */
	public function getDirPath()
	{
		return $this->dir_path;
	}

	/**
	 * @since 0.0.1
	 */
	public function setDirPath()
	{
		$this->dir_path = plugin_dir_path( $this->getPath() );
	}
}
