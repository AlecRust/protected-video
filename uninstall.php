<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @link    https://www.alecrust.com/
 * @package Protected_Video
 */

// If uninstall not called from WordPress, then exit.
if (!defined('WP_UNINSTALL_PLUGIN')) {
  exit();
}

// Delete the plugin option from the wp_options table
delete_option('protected_video_player_theme_color');
