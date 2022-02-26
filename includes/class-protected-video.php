<?php
/**
 * Core plugin class.
 *
 * Defines admin-specific and public-facing site hooks.
 *
 * @link       https://www.alecrust.com/
 * @package    Protected_Video
 * @subpackage Protected_Video/includes
 * @author     Alec Rust (https://www.alecrust.com/)
 */
class Protected_Video
{
  /**
   * Loader responsible for maintaining and registering all plugin hooks.
   *
   * @access   protected
   * @var      Protected_Video_Loader    $loader    Maintains and registers all hooks for the plugin.
   */
  protected $loader;

  /**
   * Unique identifier of this plugin.
   *
   * @access   protected
   * @var      string    $plugin_name    The string used to uniquely identify this plugin.
   */
  protected $plugin_name;

  /**
   * Current version of the plugin.
   *
   * @access   protected
   * @var      string    $version    The current version of the plugin.
   */
  protected $version;

  /**
   * Define core plugin functionality.
   */
  public function __construct()
  {
    if (defined('PROTECTED_VIDEO_VERSION')) {
      $this->version = PROTECTED_VIDEO_VERSION;
    } else {
      $this->version = '1.0.0';
    }
    $this->plugin_name = 'protected-video';

    $this->load_dependencies();
    $this->define_admin_hooks();
    $this->define_public_hooks();
  }

  /**
   * Load required plugin dependencies.
   *
   * @access   private
   */
  private function load_dependencies()
  {
    /**
     * Orchestrate the actions and filters of the plugin.
     */
    require_once plugin_dir_path(dirname(__FILE__)) .
      'includes/class-protected-video-loader.php';

    /**
     * Define all actions that occur in the admin area.
     */
    require_once plugin_dir_path(dirname(__FILE__)) .
      'admin/class-protected-video-admin.php';

    /**
     * Define all actions that occur in the public-facing site.
     */
    require_once plugin_dir_path(dirname(__FILE__)) .
      'public/class-protected-video-public.php';

    $this->loader = new Protected_Video_Loader();
  }

  /**
   * Register hooks related to the admin area functionality.
   *
   * @access   private
   */
  private function define_admin_hooks()
  {
    $plugin_admin = new Protected_Video_Admin(
      $this->get_plugin_name(),
      $this->get_version()
    );

    // Gutenberg block
    $this->loader->add_action(
      'enqueue_block_editor_assets',
      $plugin_admin,
      'register_block'
    );

    // Admin CSS
    $this->loader->add_action(
      'enqueue_block_editor_assets',
      $plugin_admin,
      'enqueue_styles'
    );

    // Admin settings page
    $this->loader->add_action(
      'admin_init',
      $plugin_admin,
      'settings_page_init'
    );

    // Admin menu item
    $this->loader->add_action('admin_menu', $plugin_admin, 'add_menu_item');

    // Plugin settings link on "Plugins" page
    $this->loader->add_filter(
      'plugin_action_links_protected-video/protected-video.php',
      $plugin_admin,
      'add_settings_link'
    );

    // Migrate settings when plugins have loaded
    $this->loader->add_action(
      'plugins_loaded',
      $plugin_admin,
      'migrate_plugin_options'
    );
  }

  /**
   * Register hooks related to the public-facing functionality.
   *
   * @access   private
   */
  private function define_public_hooks()
  {
    $plugin_public = new Protected_Video_Public(
      $this->get_plugin_name(),
      $this->get_version()
    );

    // Shortcode
    $this->loader->add_shortcode(
      'protected_video',
      $plugin_public,
      'protected_video_shortcode'
    );

    // Inline player CSS
    $this->loader->add_action(
      'wp_head',
      $plugin_public,
      'enqueue_inline_styles'
    );

    // Public CSS
    $this->loader->add_action(
      'wp_enqueue_scripts',
      $plugin_public,
      'enqueue_styles'
    );

    // Public JS
    $this->loader->add_action(
      'wp_enqueue_scripts',
      $plugin_public,
      'enqueue_scripts'
    );
  }

  /**
   * Run the loader to execute all of the hooks with WordPress.
   */
  public function run()
  {
    $this->loader->run();
  }

  /**
   * Utility returning plugin name uniquely identifying it within the context of WordPress.
   *
   * @return    string    The name of the plugin.
   */
  public function get_plugin_name()
  {
    return $this->plugin_name;
  }

  /**
   * Utility returning the version number of the plugin.
   *
   * @return    string    The version number of the plugin.
   */
  public function get_version()
  {
    return $this->version;
  }
}
