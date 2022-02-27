<?php
/**
 * Public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and hooks to enqueue
 * the public-facing stylesheet and JavaScript.
 *
 * @link       https://www.alecrust.com/
 * @package    Protected_Video
 * @subpackage Protected_Video/public
 * @author     Alec Rust (https://www.alecrust.com/)
 */
class Protected_Video_Public
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
   * @param      string    $plugin_name       The name of the plugin.
   * @param      string    $version    The version of this plugin.
   */
  public function __construct($plugin_name, $version)
  {
    $this->plugin_name = $plugin_name;
    $this->version = $version;
  }

  /**
   * Sets up shortcode for use as alternative to Gutenberg block.
   *
   * Usage example: [protected_video url="https://youtu.be/c_hO_fjmMnk" service="youtube"]
   */
  public function protected_video_shortcode($atts)
  {
    $atts = shortcode_atts(
      [
        'url' => '',
        'service' => '',
      ],
      $atts,
      'protected_video'
    );

    $output_html =
      '<div class="' .
      'wp-block-protected-video-protected-video wp-block-protected-video' .
      '" data-id1="' .
      base64_encode($atts['service']) .
      '" data-id2="' .
      base64_encode($atts['url']) .
      '"></div>';

    return $output_html;
  }

  /**
   * Adds inline player CSS to <head>.
   */
  public function enqueue_inline_styles()
  {
    if ($this->post_has_block_or_shortcode()) {
      $player_theme_color = get_option(
        'protected_video_player_theme_color',
        '#00b3ff'
      );

      echo '<style>
        :root { --plyr-color-main: ' .
        $player_theme_color .
        '; }
      </style>';
    }
  }

  /**
   * Register stylesheets for the public-facing side of the site.
   */
  public function enqueue_styles()
  {
    if ($this->post_has_block_or_shortcode()) {
      // Public CSS with bundled Plyr CSS
      wp_enqueue_style(
        $this->plugin_name,
        plugin_dir_url(__FILE__) . 'css/protected-video-public.css',
        [], // no stylesheet dependencies
        $this->version // include plugin version in query string
      );
    }
  }

  /**
   * Register the JavaScript for the public-facing side of the site.
   */
  public function enqueue_scripts()
  {
    if ($this->post_has_block_or_shortcode()) {
      // Public JS with bundled Plyr JS
      wp_enqueue_script(
        $this->plugin_name,
        plugin_dir_url(__FILE__) . 'js/protected-video-public.js',
        [], // no script dependencies
        $this->version, // include plugin version in query string
        true // enqueue at the end of <body> instead of in <head>
      );
    }
  }

  /**
   * Utility returning if the post contains the plugin block or Shortcode.
   */
  public function post_has_block_or_shortcode()
  {
    if (
      has_block('protected-video/protected-video', get_the_ID()) ||
      has_shortcode(get_the_content(), 'protected_video')
    ) {
      return true;
    }
  }
}
