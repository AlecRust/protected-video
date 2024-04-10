<?php
/**
 * Runs when the plugin is uninstalled.
 *
 * @link    https://github.com/AlecRust/protected-video
 * @package Protected_Video
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

// Delete the plugin options from the wp_options table
delete_option( 'protected_video_player_theme_color' );
delete_option( 'protected_video_disable_right_click' );
