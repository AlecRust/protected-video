<?php
/**
 * Plugin Name:       Protected Video
 * Plugin URI:        http://github.com/AlecRust/protected-video
 * GitHub Plugin URI: AlecRust/protected-video
 * Description:       YouTube/Vimeo player that prevents easy sharing of the video.
 * Version:           1.8.2
 * Author:            Alec Rust
 * Author URI:        https://www.alecrust.com/
 * Text Domain:       protected-video
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package           Protected_Video
 * @author            Alec Rust
 * @license           GPL-2.0-or-later
 * @link              https://www.alecrust.com/
 */

// Abort if this file is called directly.
if (!defined('WPINC')) {
  die();
}

/**
 * Plugin version.
 */
define('PROTECTED_VIDEO_VERSION', '1.8.2');

/**
 * Load core plugin class defining all hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-protected-video.php';

/**
 * Begin plugin execution.
 */
function run_protected_video()
{
  $plugin = new Protected_Video();
  $plugin->run();
}
run_protected_video();
