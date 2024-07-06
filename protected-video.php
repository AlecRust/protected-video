<?php
/**
 * Plugin Name:       Protected Video
 * Plugin URI:        http://github.com/AlecRust/protected-video
 * GitHub Plugin URI: AlecRust/protected-video
 * Description:       YouTube/Vimeo player that prevents easy sharing of the video.
 * Version:           1.11.6
 * Author:            Alec Rust
 * Author URI:        https://www.alecrust.com/
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       protected-video
 *
 * @package Protected_Video
 * @author  Alec Rust
 * @link    https://github.com/AlecRust/protected-video
 */

// Abort if this file is called directly.
if ( ! defined( 'WPINC' ) ) {
	die();
}

/**
 * Plugin version.
 */
define( 'PROTECTED_VIDEO_VERSION', '1.11.6' );

/**
 * Load core plugin class defining all hooks.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-protected-video.php';

/**
 * Begin plugin execution.
 *
 * @return void
 * @SuppressWarnings(PHPMD.MissingImport)
 */
function protected_video_init() {
	$plugin = new Protected_Video();
	$plugin->init();
}
protected_video_init();
