<?php
/**
 * Public-facing functionality of the plugin.
 *
 * @package    Protected_Video
 * @subpackage Protected_Video/includes
 * @author     Alec Rust (https://www.alecrust.com/)
 * @link       https://github.com/AlecRust/protected-video
 */

/**
 * The public-facing functionality of the plugin.
 */
class Protected_Video_Public {

	/**
	 * The plugin ID.
	 *
	 * @var string $plugin_name The ID of this plugin.
	 */
	// @phpstan-ignore-next-line
	private $plugin_name;

	/**
	 * The plugin version.
	 *
	 * @var string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of the plugin.
	 * @param string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Render Shortcode (Gutenberg block alternative).
	 *
	 * Usage example: [protected_video url="https://youtu.be/aqz-KE-bpKQ" service="youtube"]
	 *
	 * @param array<string> $atts Shortcode attributes.
	 * @return string HTML output for the shortcode.
	 */
	public function render_shortcode( $atts ) {
		$atts = shortcode_atts(
			array(
				'url'     => '',
				'service' => '',
			),
			$atts,
			'protected_video'
		);
		return sprintf(
			'<div class="wp-block-protected-video-protected-video" data-id1="%s" data-id2="%s"></div>',
			base64_encode( $atts['service'] ),
			base64_encode( $atts['url'] )
		);
	}

	/**
	 * Register stylesheet/inline CSS for the public-facing side of the site.
	 * NOTE: block.json automatically registers the block assets if the
	 * block is used, we duplicate it here to support "Shortcode only"
	 *
	 * @return void
	 */
	public function enqueue_styles() {
		if ( $this->should_enqueue_assets() ) {
			// Public CSS with bundled Plyr CSS
			wp_enqueue_style(
				'protected-video-protected-video-style', // matches block asset handle
				plugin_dir_url( __FILE__ ) . '../build/style-index.css',
				array(), // no stylesheet dependencies
				$this->version // include plugin version in query string
			);

			wp_add_inline_style(
				'protected-video-protected-video-style', // matches block asset handle
				sprintf(
					':root { --plyr-color-main: %s; }',
					get_option( 'protected_video_player_theme_color', '#00b3ff' )
				)
			);
		}
	}

	/**
	 * Register the JavaScript for the public-facing side of the site
	 * NOTE: block.json automatically registers the block assets if the
	 * block is used, we duplicate it here to support "Shortcode only"
	 *
	 * @return void
	 */
	public function enqueue_scripts() {
		if ( $this->should_enqueue_assets() ) {
			// Get block public JS metadata
			$asset_file = include plugin_dir_path( __FILE__ ) .
				'../build/view.asset.php';
			$version    = isset( $asset_file['version'] )
				? $asset_file['version']
				: false;

			// Public JS with bundled Plyr JS
			wp_enqueue_script(
				'protected-video-protected-video-view-script', // matches block asset handle
				plugin_dir_url( __FILE__ ) . '../build/view.js',
				array(), // no script dependencies
				$version,
				array( 'strategy' => 'defer' ) // defer script execution
			);
		}
	}

	/**
	 * Return body classes for the public-facing side of the site
	 *
	 * @param array<string> $classes Body classes.
	 * @return array<string> Body classes.
	 */
	public function add_body_classes( $classes ) {
		$disable_right_click = get_option(
			'protected_video_disable_right_click',
			'1'
		);

		if ( $disable_right_click === '1' ) {
			$classes[] = 'protected-video-disable-right-click';
		}

		return $classes;
	}

	/**
	 * Utility returning if the scripts and styles should be enqueued.
	 *
	 * @return bool True if the scripts and styles should be enqueued.
	 */
	private function should_enqueue_assets() {
		$post_id = get_the_ID();
		return $this->post_contains_block_or_shortcode( $post_id ) ||
			$this->post_is_custom( $post_id );
	}

	/**
	 * Utility returning if the post contains the plugin block or Shortcode.
	 *
	 * @param int $post_id The post ID.
	 * @return bool True if the post contains the plugin block or Shortcode.
	 */
	private function post_contains_block_or_shortcode( $post_id ) {
		$post_content = get_post_field( 'post_content', $post_id );
		return has_block( 'protected-video/protected-video', $post_id ) ||
			has_shortcode( $post_content, 'protected_video' );
	}

	/**
	 * Utility returning if the post is a custom type or is using a custom template.
	 *
	 * @param int $post_id The post ID.
	 * @return bool True if the post is a custom type or is using a custom template.
	 */
	private function post_is_custom( $post_id ) {
		$is_custom_post_type = in_array(
			get_post_type( $post_id ),
			get_post_types( array( '_builtin' => false ) )
		);

		$is_custom_template = get_page_template_slug( $post_id ) !== '';

		return $is_custom_post_type || $is_custom_template;
	}
}
