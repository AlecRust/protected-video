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
   * Set up shortcode for use as alternative to Gutenberg block.
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
      'wp-block-protected-video-protected-video' .
      '" data-id1="' .
      base64_encode($atts['service']) .
      '" data-id2="' .
      base64_encode($atts['url']) .
      '"></div>';

    return $output_html;
  }

  /**
   * Register stylesheet/inline CSS for the public-facing side of the site.
   * NOTE: Empty stylesheet is registered to allow for inline CSS.
   */
  public function enqueue_styles()
  {
    if ($this->should_enqueue_assets()) {
      // Load inline CSS (public CSS is loaded automatically)
      wp_register_style($this->plugin_name, false);
      wp_enqueue_style($this->plugin_name);
      wp_add_inline_style(
        $this->plugin_name,
        sprintf(
          ':root { --plyr-color-main: %s; }',
          get_option('protected_video_player_theme_color', '#00b3ff')
        )
      );
    }
  }

  /**
   * Register the JavaScript for the public-facing side of the site
   * NOTE: This is for the case where the Shortcode alone is used.
   */
  public function enqueue_scripts()
  {
    if ($this->should_enqueue_assets()) {
      // Public JS with bundled Plyr JS
      wp_enqueue_script(
        $this->plugin_name,
        plugin_dir_url(__FILE__) . '../build/view.js',
        [], // no script dependencies
        $this->version, // include plugin version in query string
        true // enqueue at the end of <body> instead of in <head>
      );
    }
  }

  /**
   * Utility returning if the scripts and styles should be enqueued.
   */
  public function should_enqueue_assets()
  {
    $post_id = get_the_ID();
    if (
      $this->post_contains_shortcode($post_id) ||
      $this->post_is_custom_post_type($post_id)
    ) {
      return true;
    }
    return false;
  }

  /**
   * Utility returning if the post contains the plugin Shortcode.
   */
  public function post_contains_shortcode($post_id)
  {
    $post_content = get_post_field('post_content', $post_id);
    if (has_shortcode($post_content, 'protected_video')) {
      return true;
    }
    return false;
  }

  /**
   * Utility returning if the post is any custom post type.
   */
  public function post_is_custom_post_type($post_id)
  {
    if (
      in_array(get_post_type($post_id), get_post_types(['_builtin' => false]))
    ) {
      return true;
    }
    return false;
  }
}
