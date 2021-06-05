<?php
/**
 * Admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and hooks for
 * enqueuing the admin-specific Gutenberg block.
 *
 * @link       https://www.alecrust.com/
 * @since      1.0.0
 *
 * @package    Protected_Video
 * @subpackage Protected_Video/admin
 * @author     Alec Rust <me@alecrust.com>
 */
class Protected_Video_Admin
{
  /**
   * The plugin ID.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $plugin_name    The ID of this plugin.
   */
  private $plugin_name;

  /**
   * The plugin version.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $version    The current version of this plugin.
   */
  private $version;

  /**
   * Initialize the class and set its properties.
   *
   * @since      1.0.0
   * @param      string    $plugin_name       The name of this plugin.
   * @param      string    $version    The version of this plugin.
   */
  public function __construct($plugin_name, $version)
  {
    $this->plugin_name = $plugin_name;
    $this->version = $version;
  }

  /**
   * Register settings page in admin.
   *
   * @since    1.0.0
   */
  public function add_menu_item()
  {
    add_options_page(
      __('Protected Video', 'protected-video'), // page_title
      __('Protected Video', 'protected-video'), // menu_title
      'manage_options', // capability
      $this->plugin_name, // menu_slug
      [$this, 'protected_video_create_admin_page'] // function
    );
  }

  /**
   * Return settings page.
   *
   * @since    1.0.0
   */
  public function protected_video_create_admin_page()
  {
    $this->protected_video_options = get_option('protected_video_option_name');

    include 'partials/protected-video-admin-display.php';
  }

  /**
   * Register settings page options in admin.
   *
   * @since    1.0.0
   */
  public function settings_page_init()
  {
    register_setting(
      'protected_video_option_group', // option_group
      'protected_video_option_name', // option_name
      [$this, 'protected_video_sanitize'] // sanitize_callback
    );

    add_settings_section(
      'protected_video_setting_section', // id
      'Settings', // title
      [$this, 'protected_video_section_info'], // callback
      'protected-video-admin' // page
    );

    add_settings_field(
      'player_theme_color', // id
      __('Player Theme Color', 'protected-video'), // title
      [$this, 'player_theme_color_callback'], // callback
      'protected-video-admin', // page
      'protected_video_setting_section' // section
    );
  }

  /**
   * Sanitize settings page options.
   *
   * @since    1.0.0
   */
  public function protected_video_sanitize($input)
  {
    $sanitary_values = [];
    if (isset($input['player_theme_color'])) {
      $sanitary_values['player_theme_color'] = sanitize_text_field(
        $input['player_theme_color']
      );
    }

    return $sanitary_values;
  }

  /**
   * Explanation copy on settings page (between heading and fields).
   *
   * @since    1.0.0
   */
  public function protected_video_section_info()
  {
    _e('Set the player theme color below.', 'protected-video');
  }

  /**
   * Populates fields on settings page.
   *
   * @since    1.0.0
   */
  public function player_theme_color_callback()
  {
    printf(
      '<input value="%s" type="color" name="protected_video_option_name[player_theme_color]" id="player_theme_color">',
      isset($this->protected_video_options['player_theme_color'])
        ? esc_attr($this->protected_video_options['player_theme_color'])
        : ''
    );
  }

  /**
   * Register the Gutenberg block for the admin post editor.
   *
   * @since    1.0.0
   */
  public function register_block()
  {
    $asset_file = include plugin_dir_path(__FILE__) .
      'js/protected-video-block.asset.php';

    // Register the block
    wp_register_script(
      'protected-video-block',
      plugins_url('js/protected-video-block.js', __FILE__),
      $asset_file['dependencies'],
      $asset_file['version']
    );
    register_block_type('protected-video/protected-video', [
      'editor_script' => 'protected-video-block',
    ]);

    // Load translations for JS
    if (function_exists('wp_set_script_translations')) {
      wp_set_script_translations('protected-video-block', 'protected-video');
    }
  }
}
