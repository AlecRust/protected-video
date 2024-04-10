<?php
/**
 * Core plugin class.
 *
 * Defines the plugin name, version, and admin-specific
 * and public-facing site hooks.
 *
 * @package    Protected_Video
 * @subpackage Protected_Video/includes
 * @author     Alec Rust (https://www.alecrust.com/)
 * @link       https://github.com/AlecRust/protected-video
 */

/**
 * The core plugin class.
 */
class Protected_Video {

	/**
	 * Unique identifier of this plugin.
	 *
	 * @var string $plugin_name The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * Current version of the plugin.
	 *
	 * @var string $version The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define core plugin functionality.
	 */
	public function __construct() {
		$this->version     = defined( 'PROTECTED_VIDEO_VERSION' ) ? PROTECTED_VIDEO_VERSION : '1.0.0';
		$this->plugin_name = 'protected-video';
	}

	/**
	 * Initialize the plugin.
	 *
	 * @return void
	 */
	public function init() {
		$this->load_dependencies();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load required plugin dependencies.
	 *
	 * @return void
	 */
	private function load_dependencies() {
		/**
		 * Define all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'includes/class-protected-video-admin.php';

		/**
		 * Define all actions that occur in the public-facing site.
		 */
		require_once plugin_dir_path( __DIR__ ) . 'includes/class-protected-video-public.php';
	}

	/**
	 * Register hooks related to the admin area functionality.
	 *
	 * @SuppressWarnings(PHPMD.MissingImport)
	 *
	 * @return void
	 */
	private function define_admin_hooks() {
		$plugin_admin = new Protected_Video_Admin(
			$this->get_plugin_name(),
			$this->get_version()
		);

		// Gutenberg block
		add_action( 'init', array( $plugin_admin, 'register_block' ) );

		// Admin settings page
		add_action( 'admin_init', array( $plugin_admin, 'settings_page_init' ) );

		// Admin menu item
		add_action( 'admin_menu', array( $plugin_admin, 'add_menu_item' ) );

		// Plugin settings link on "Plugins" page
		add_filter(
			'plugin_action_links_protected-video/protected-video.php',
			array(
				$plugin_admin,
				'add_settings_link',
			)
		);

		// Migrate settings when plugins have loaded
		add_action( 'plugins_loaded', array( $plugin_admin, 'migrate_plugin_options' ) );
	}

	/**
	 * Register hooks related to the public-facing functionality.
	 *
	 * @SuppressWarnings(PHPMD.MissingImport)
	 *
	 * @return void
	 */
	private function define_public_hooks() {
		$plugin_public = new Protected_Video_Public(
			$this->get_plugin_name(),
			$this->get_version()
		);

		// Shortcode
		add_shortcode( 'protected_video', array( $plugin_public, 'render_shortcode' ) );

		// Public CSS
		add_action( 'wp_enqueue_scripts', array( $plugin_public, 'enqueue_styles' ) );

		// Public JS
		add_action( 'wp_enqueue_scripts', array( $plugin_public, 'enqueue_scripts' ) );

		// Body class
		add_filter( 'body_class', array( $plugin_public, 'add_body_classes' ) );

		// Allow plugin styles to be enqueued in "MemberPress Courses" course pages
		// https://docs.memberpress.com/article/381-how-to-edit-lessons-in-classroom-mode-with-a-page-builder
		add_filter(
			'mpcs_classroom_style_handles',
			function ( $allowed_handles ) {
				$allowed_handles[] = 'protected-video-protected-video-style';
				return $allowed_handles;
			}
		);
	}

	/**
	 * Utility returning plugin name uniquely identifying it.
	 *
	 * @return string The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * Utility returning the version number of the plugin.
	 *
	 * @return string The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}
