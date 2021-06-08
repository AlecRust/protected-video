<?php
/**
 * Template for plugin settings page in admin area
 *
 * @link       https://www.alecrust.com/
 * @package    Protected_Video
 * @subpackage Protected_Video/admin/partials
 */
?>

<div class="wrap">
  <h2><?php _e('Protected Video', 'protected-video'); ?></h2>
  <form method="post" action="options.php">
    <?php
    settings_fields('protected_video_option_group');
    do_settings_sections('protected-video-admin');
    submit_button();
    ?>
  </form>
</div>
