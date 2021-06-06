<?php

/**
 * Plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * and defines a function that starts the plugin.
 *
 * @link              https://www.alecrust.com/
 * @since             1.0.0
 * @package           Protected_Video
 *
 * @wordpress-plugin
 * Plugin Name:       Protected Video
 * Plugin URI:        http://github.com/AlecRust/protected-video
 * Description:       YouTube/Vimeo player with disabled access to the original video.
 * Version:           1.0.0
 * Author:            Alec Rust
 * Author URI:        https://www.alecrust.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       protected-video
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
  die();
}

/**
 * Protected Video plugin version.
 */
define('PROTECTED_VIDEO_VERSION', '1.0.2');

/**
 * Plyr player version.
 */
define('PLYR_VERSION', '3.6.8');

/**
 * Core plugin class used to define admin-specific hooks and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-protected-video.php';

/**
 * Begin execution of the plugin.
 *
 * @since    1.0.0
 */
function run_protected_video()
{
  $plugin = new Protected_Video();
  $plugin->run();
}
run_protected_video();
