<?php
/**
 * Public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and hooks to enqueue
 * the public-facing stylesheet and JavaScript.
 *
 * @link       https://www.alecrust.com/
 * @since      1.0.0
 *
 * @package    Protected_Video
 * @subpackage Protected_Video/public
 * @author     Alec Rust <me@alecrust.com>
 */
class Protected_Video_Public
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
   * @since    1.0.0
   * @param      string    $plugin_name       The name of the plugin.
   * @param      string    $version    The version of this plugin.
   */
  public function __construct($plugin_name, $version)
  {
    $this->plugin_name = $plugin_name;
    $this->version = $version;
  }

  /**
   * Adds inline player CSS to <head>.
   *
   * @since    1.0.0
   */
  public function enqueue_inline_styles()
  {
    // Check Protected Video block is in use on this page
    if (has_block('protected-video/protected-video', get_the_ID())) {
      $player_theme_color = get_option('protected_video_option_name');

      if ($player_theme_color) {
        echo '<style>:root { --plyr-color-main: ' .
          $player_theme_color['player_theme_color'] .
          '; }</style>';
      }
    }
  }

  /**
   * Register stylesheets for the public-facing side of the site.
   *
   * @since    1.0.0
   */
  public function enqueue_styles()
  {
    // Check Protected Video block is in use on this page
    if (has_block('protected-video/protected-video', get_the_ID())) {
      // Plyr CSS from CDN
      wp_enqueue_style(
        'plyr',
        'https://cdn.plyr.io/' . PLYR_VERSION . '/plyr.css'
      );

      // Custom Plyr CSS
      wp_enqueue_style(
        $this->plugin_name,
        plugin_dir_url(__FILE__) . 'css/protected-video-public.css',
        [],
        $this->version,
        'all'
      );
    }
  }

  /**
   * Register the JavaScript for the public-facing side of the site.
   *
   * @since    1.0.0
   */
  public function enqueue_scripts()
  {
    // Check Protected Video block is in use on this page
    if (has_block('protected-video/protected-video', get_the_ID())) {
      // Plyr JS from CDN
      wp_enqueue_script(
        'plyr-player',
        'https://cdn.plyr.io/' . PLYR_VERSION . '/plyr.polyfilled.js',
        [], // no registered script dependencies
        null, // disable ?ver= query string on this 3rd party asset
        true // enqueue at the end of <body> instead of in <head>
      );

      // Custom Plyr JS
      wp_enqueue_script(
        $this->plugin_name,
        plugin_dir_url(__FILE__) . 'js/protected-video-public.js',
        ['plyr-player'], // depend on plyr-player script set above
        $this->version, // set the query string version to plugin version
        true // enqueue at the end of <body> instead of in <head>
      );
    }
  }
}
