<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @link       https://www.alecrust.com/
 * @since      1.0.0
 *
 * @package    Protected_Video
 */

// If uninstall not called from WordPress, then exit.
if (!defined('WP_UNINSTALL_PLUGIN')) {
  exit();

  // Delete the plugin option from the wp_options table
  delete_option('player_theme_color');
}
