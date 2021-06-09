=== Protected Video ===
Contributors:      alecrust
Tags:              block, gutenberg, media player, video player, plyr, youtube, vimeo, copyright
Requires at least: 4.6
Tested up to:      5.7
Stable tag:        1.0.8
Requires PHP:      7.0
License:           GPL-2.0-or-later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html

YouTube/Vimeo player that prevents easy sharing of the video.

== Description ==

**Want to embed your YouTube/Vimeo hosted videos on your site, but don't want your users to share the original video? Then this is the plugin for you.**

Protected Video provides a Gutenberg block for embedding YouTube/Vimeo hosted videos in a way that prevents users interacting with the original player. This is useful in cases where you want to avoid the original unlisted video being easily shared or viewed externally e.g. premium video course content.

The plugin uses the excellent [Plyr](https://plyr.io/) player to overlay the original player and includes additional modifications to prevent access to the original player where the user could "Share" or "Copy Link".

A base color for the player can be set in the plugin settings at `Settings > Protected Video` to match your site's branding.

**Note:** This only provides a basic level of protection for your videos for general users. Technical users would still be able to identify the original video URL.

This plugin is open source and contributions are welcome [on GitHub](https://github.com/AlecRust/protected-video).

== Installation ==

1. Install and activate the plugin
2. Optionally configure player base color at `Settings > Protected Video`
2. Search for and use "Protected Video" block in the blocks editor

== Frequently Asked Questions ==

= What does this plugin do? =

Displays YouTube/Vimeo videos within the [Plyr](https://plyr.io/) player, with additional modifications to disable access to the original player. This helps to prevent users from easily copying or sharing the URL to the original video.

= How secure is this plugin? =

This plugin only provides a basic level of protection against users accessing the default player or otherwise determining the video URL. Technical users would still be able to determine this information relatively easily.

= Why not use Plyr player on its own? =

The default [Plyr](https://plyr.io/) player overlays YouTube/Vimeo players with its own controls, which prevents access to the underlying video copy/share buttons under some scenarios, but this is a side-effect of the way it works rather than a feature. The goal of Protected Video is to make this a feature by accounting for more scenarios e.g. when the player is paused, and providing additional features such as obfuscation of the original video ID in the HTML.

If you don't care about your users sharing the video or actually want them to, a plugin like [WP YouTube Lyte](https://wordpress.org/plugins/wp-youtube-lyte/) is probably more suitable.

== Screenshots ==

1. Protected Video block in the blocks editor.
2. Configuration of the player theme color at Settings > Protected Video.
3. Display of the player in the public facing site.

== Changelog ==

= 1.0.8 =

* Add CHANGELOG.md
* Improve readme
* Bump npm deps
* Add Lint workflow
* Improve readme
* Tidy workflow
* Add check flag to Prettier in CI
* Rename readme

= 1.0.7 =

* Release date: 9 June 2021

* Exclude files from plugin deployment
* Release 1.0.7
* Add missing admin/index.php

= 1.0.6 =

* Release date: 9 June 2021

* Remove unnecessary @since comments
* Set up plugin deploy
* Release 1.0.6
* Specify minimum PHP version
* Improve plugin description
* Improve README
* Improve README
* Update license in package.json

= 1.0.5 =

* Release date: 6 June 2021

* Add admin stylesheet
* Release 1.0.5
* Register block on enqueue_block_editor_assets instead of init

= 1.0.4 =

* Release date: 6 June 2021

* Release 1.0.4
* Fix version not being updated in plugin header

= 1.0.3 =

* Release date: 6 June 2021

* Release 1.0.3
* Improve README installation instructions
* Add GitHub Plugin URI to plugin header

= 1.0.2 =

* Release date: 6 June 2021

* Add Rollup build process for public JS
* Release 1.0.2
* Bump release-it version
* Tweak readme
* Add plugin banner/icon assets

= 1.0.1 =

* Release date: 5 June 2021

* Add release-it
* Release 1.0.1

= 1.0.0 =

* Release date: 5 June 2021

* Initial commit
