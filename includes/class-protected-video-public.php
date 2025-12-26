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
	 * Render Shortcode (Gutenberg block alternative).
	 *
	 * Usage example: [protected_video url="https://youtu.be/aqz-KE-bpKQ" service="youtube"]
	 *
	 * @param array<string, mixed>|string $atts Shortcode attributes.
	 * @param string|null                 $content Optional shortcode content.
	 * @param string                      $tag Shortcode tag.
	 * @return string HTML output for the shortcode.
	 */
	public function render_shortcode( $atts, $content = null, $tag = '' ) {
		unset( $content );

		if ( ! is_array( $atts ) ) {
			$atts = array();
		}

		$atts = shortcode_atts(
			array(
				'url'     => '',
				'service' => '',
			),
			$atts,
			$tag ? $tag : 'protected_video'
		);

		$url     = trim( $atts['url'] );
		$service = strtolower( trim( $atts['service'] ) );

		if ( '' === $url ) {
			return '';
		}

		if ( 'youtube' !== $service && 'vimeo' !== $service ) {
			return '';
		}

		$video_id = null;
		if ( 'youtube' === $service ) {
			$video_id = $this->extract_youtube_id( $url );
		}

		if ( 'vimeo' === $service ) {
			$video_id = $this->extract_vimeo_id( $url );
		}

		if ( ! $video_id ) {
			return '';
		}

		// Used to obscure the original values in HTML attributes.
		// phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_encode
		$encoded_service = base64_encode( $service );
		// phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_encode
		$encoded_video_id = base64_encode( $video_id );

		return sprintf(
			'<div class="wp-block-protected-video-protected-video" data-id1="%s" data-id2="%s"></div>',
			esc_attr( $encoded_service ),
			esc_attr( $encoded_video_id )
		);
	}

	/**
	 * Extract a YouTube ID from a URL or return it if it already looks like an ID.
	 *
	 * @param string $url Video URL or ID.
	 * @return string|null
	 */
	private function extract_youtube_id( $url ) {
		$url = trim( $url );

		// Allow IDs directly.
		if ( preg_match( '/^[A-Za-z0-9_-]{6,64}$/', $url ) ) {
			return $url;
		}

		if (
			preg_match(
				'~(?:youtu\\.be/|youtube(?:-nocookie)?\\.com/(?:embed/|v/|shorts/|live/)|[?&]v=)([A-Za-z0-9_-]{6,64})~',
				$url,
				$matches
			)
		) {
			return $matches[1];
		}

		return null;
	}

	/**
	 * Extract a Vimeo ID from a URL or return it if it already looks like an ID.
	 *
	 * @param string $url Video URL or ID.
	 * @return string|null
	 */
	private function extract_vimeo_id( $url ) {
		$url = trim( $url );

		// Allow IDs directly.
		if ( preg_match( '/^[0-9]+$/', $url ) ) {
			return $url;
		}

		if ( preg_match( '~vimeo\\.com/(?:.*?/)?([0-9]+)~', $url, $matches ) ) {
			return $matches[1];
		}

		return null;
	}

	/**
	 * Register stylesheet/inline CSS for the public-facing side of the site.
	 * NOTE: block.json automatically registers the block assets if the
	 * block is used, we duplicate it here to support "Shortcode only"
	 *
	 * @return void
	 */
	public function enqueue_styles() {
		if ( ! $this->should_enqueue_assets() ) {
			return;
		}

		$block_style_handle = 'protected-video-protected-video-style';
		wp_enqueue_style( $block_style_handle );
		wp_add_inline_style(
			$block_style_handle,
			sprintf(
				':root { --plyr-color-main: %s; }',
				get_option( 'protected_video_player_theme_color', '#00b3ff' )
			)
		);
	}

	/**
	 * Register the JavaScript for the public-facing side of the site
	 * NOTE: block.json automatically registers the block assets if the
	 * block is used, we duplicate it here to support "Shortcode only"
	 *
	 * @return void
	 */
	public function enqueue_scripts() {
		if ( ! $this->should_enqueue_assets() ) {
			return;
		}

		$block_script_handle = 'protected-video-protected-video-view-script';
		wp_enqueue_script( $block_script_handle );
	}

	/**
	 * Return body classes for the public-facing side of the site
	 *
	 * @param string[] $classes Body classes.
	 * @return string[] Body classes.
	 */
	public function add_body_classes( $classes ) {
		$disable_right_click = get_option(
			'protected_video_disable_right_click',
			'1'
		);

		if ( '1' === $disable_right_click ) {
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
		if ( false === $post_id ) {
			return false;
		}

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
		if ( ! is_string( $post_content ) ) {
			$post_content = '';
		}

		return has_block( 'protected-video/protected-video', $post_content ) ||
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
			get_post_types( array( '_builtin' => false ) ),
			true
		);

		$is_custom_template = get_page_template_slug( $post_id ) !== '';

		return $is_custom_post_type || $is_custom_template;
	}
}
