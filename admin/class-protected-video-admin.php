<?php
/**
 * Admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and hooks for
 * enqueuing the admin-specific Gutenberg block.
 *
 * @link       https://www.alecrust.com/
 * @package    Protected_Video
 * @subpackage Protected_Video/admin
 * @author     Alec Rust (https://www.alecrust.com/)
 */
class Protected_Video_Admin
{
  /**
   * The plugin ID.
   *
   * @access   private
   * @var      string    $plugin_name    The ID of this plugin.
   */
  private $plugin_name;

  /**
   * The plugin version.
   *
   * @access   private
   * @var      string    $version    The current version of this plugin.
   */
  private $version;

  /**
   * Initialize the class and set its properties.
   *
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
   * Migrate old plugin options.
   */
  public function migrate_plugin_options()
  {
    $old_option = get_option('protected_video_option_name');
    if (isset($old_option['player_theme_color'])) {
      update_option(
        'protected_video_player_theme_color',
        $old_option['player_theme_color']
      );
      delete_option('protected_video_option_name');
    }
  }

  /**
   * Add link to plugin settings on Plugins page.
   */
  public function add_settings_link($links)
  {
    $url = esc_url(
      add_query_arg(
        'page',
        $this->plugin_name,
        get_admin_url() . 'options-general.php'
      )
    );
    $settings_link =
      "<a href=\"$url\">" . __('Settings', 'protected-video') . '</a>';
    array_unshift($links, $settings_link);
    return $links;
  }

  /**
   * Return settings page.
   */
  public function protected_video_create_admin_page()
  {
    include 'partials/protected-video-admin-display.php';
  }

  /**
   * Register settings page options in admin.
   */
  public function settings_page_init()
  {
    register_setting(
      'protected_video_option_group', // settings group name
      'protected_video_player_theme_color', // option name
      [$this, 'sanitize_plugin_text_input'] // sanitize callback
    );

    add_settings_section(
      'protected_video_setting_section', // id
      __('Settings', 'protected-video'), // title
      [$this, 'protected_video_section_info'], // callback
      'protected-video-admin' // page
    );

    add_settings_field(
      'player_theme_color', // id
      __('Player Theme Color', 'protected-video'), // title
      [$this, 'player_theme_color_callback'], // callback
      'protected-video-admin', // page
      'protected_video_setting_section', // section
      [
        'id' => 'player_theme_color',
        'option_name' => 'protected_video_player_theme_color',
      ]
    );
  }

  /**
   * Sanitize plugin option text input data.
   */
  public function sanitize_plugin_text_input($input)
  {
    return sanitize_text_field($input);
  }

  /**
   * Explanation copy on settings page (between heading and fields).
   */
  public function protected_video_section_info()
  {
    _e('Set the player theme color below.', 'protected-video');
  }

  /**
   * Returns player theme color field on settings page.
   */
  public function player_theme_color_callback($val)
  {
    $id = $val['id'];
    $option_name = $val['option_name'];
    $option_value = get_option($option_name) ?: '#00b3ff';
    ?>
    <input
      type="color"
      id="<?php echo esc_attr($id); ?>"
      name="<?php echo esc_attr($option_name); ?>"
      value="<?php echo esc_attr($option_value); ?>"
    >
    <?php
  }

  /**
   * Register the Gutenberg block for the blocks editor.
   */
  public function register_block()
  {
    $asset_file = include plugin_dir_path(__FILE__) .
      'js/protected-video-block.asset.php';

    // Register block JS
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

  /**
   * Register the stylesheet for the admin area.
   */
  public function enqueue_styles()
  {
    wp_enqueue_style(
      'protected-video-admin-css',
      plugin_dir_url(__FILE__) . 'css/protected-video-admin.css',
      [],
      $this->version
    );
  }
}
