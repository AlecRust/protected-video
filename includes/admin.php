<?php
/**
 * Admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and hooks for
 * enqueuing the admin-specific Gutenberg block.
 *
 * @link       https://www.alecrust.com/
 * @package    Protected_Video
 * @subpackage Protected_Video/includes
 * @author     Alec Rust (https://www.alecrust.com/)
 */
class Protected_Video_Admin
{
  /**
   * The plugin ID.
   *
   * @access private
   * @var    string    $plugin_name    The ID of this plugin.
   */
  private $plugin_name;

  /**
   * The plugin version.
   *
   * @access private
   * @var    string    $version    The current version of this plugin.
   */
  private $version;

  /**
   * Initialize the class and set its properties.
   *
   * @param string $plugin_name The name of this plugin.
   * @param string $version     The version of this plugin.
   */
  public function __construct($plugin_name, $version)
  {
    $this->plugin_name = $plugin_name;
    $this->version = $version;
  }

  /**
   * Register the block using the metadata loaded from the `block.json` file.
   * Behind the scenes, it also registers all assets so they can be enqueued
   * through the block editor in the corresponding context.
   *
   * @see https://developer.wordpress.org/reference/functions/register_block_type/
   */
  public function register_block()
  {
    register_block_type(__DIR__ . '/../build');
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
      [$this, 'render_settings_page'] // callback
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
        sanitize_hex_color($old_option['player_theme_color'])
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
  public function render_settings_page()
  {
    ?>
      <div class="wrap">
        <h2><?php echo __('Protected Video', 'protected-video'); ?></h2>
        <form method="post" action="options.php">
          <?php
          settings_fields('protected_video_option_group');
          do_settings_sections('protected-video-admin');
          submit_button();?>
        </form>
      </div>
    <?php
  }

  /**
   * Register settings page options in admin.
   */
  public function settings_page_init()
  {
    // Add settings section
    add_settings_section(
      'protected_video_setting_section', // HTML id
      __('Settings', 'protected-video'), // title
      [$this, 'render_settings_description'], // callback
      'protected-video-admin' // page
    );

    // Add "Player theme color" setting field
    add_settings_field(
      'player_theme_color', // HTML id
      __('Player theme color', 'protected-video'), // field title
      [$this, 'render_color_input'], // callback
      'protected-video-admin', // page
      'protected_video_setting_section', // section
      [
        'id' => 'player_theme_color',
        'option_name' => 'protected_video_player_theme_color',
      ]
    );

    // Register "Player theme color" setting
    register_setting(
      'protected_video_option_group', // settings group name
      'protected_video_player_theme_color', // option name
      ['sanitize_callback' => [$this, 'sanitize_color_input']] // callback
    );

    // Add "Disable right-click" setting field
    add_settings_field(
      'disable_right_click', // HTML id
      __('Disable right-click', 'protected-video'), // field title
      [$this, 'render_disable_right_click_checkbox'], // callback
      'protected-video-admin', // page
      'protected_video_setting_section' // section
    );

    // Register "Disable right-click" setting
    register_setting(
      'protected_video_option_group', // settings group name
      'protected_video_disable_right_click', // option name
      [
        'default' => '1',
        'sanitize_callback' => [$this, 'sanitize_checkbox_input'],
      ] // callback
    );
  }

  /**
   * Sanitize color input data.
   */
  public function sanitize_color_input($input)
  {
    return sanitize_hex_color($input);
  }

  /**
   * Sanitize checkbox input data.
   */
  public function sanitize_checkbox_input($input)
  {
    return isset($input) && true == $input ? '1' : '0';
  }

  /**
   * Explanation copy on settings page (between heading and fields).
   */
  public function render_settings_description()
  {
    echo '<p>' .
      __('Global settings for the Protected Video plugin.', 'protected-video') .
      '</p>';
  }

  /**
   * Render the Player theme color field.
   */
  public function render_color_input($val)
  {
    $id = $val['id'];
    $name = $val['option_name'];
    $value = get_option($name, '#00b3ff');

    printf(
      '<input type="color" id="%s" name="%s" value="%s">',
      esc_attr($id),
      esc_attr($name),
      esc_attr($value)
    );

    printf(
      '<p class="description">%s</p>',
      sprintf(
        __(
          'Sets the player theme color. See %s for advanced styling options.',
          'protected-video'
        ),
        '<a href="https://github.com/sampotts/plyr#customizing-the-css" target="_blank">' .
          __("Plyr's documentation", 'protected-video') .
          '</a>'
      )
    );
  }

  /**
   * Render the disable right-click checkbox field.
   */
  public function render_disable_right_click_checkbox()
  {
    $value = get_option('protected_video_disable_right_click', '1');
    printf(
      '<input type="checkbox" id="disable_right_click" name="protected_video_disable_right_click" value="1" %s>',
      checked(1, $value, false)
    );

    printf(
      '<p class="description">%s</p>',
      __(
        'Disables right-click on pages where a Protected Video is displayed.',
        'protected-video'
      )
    );
  }
}
