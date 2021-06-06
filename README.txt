=== Plugin Name ===
Contributors: alecrust
Tags: block, gutenberg, media player, video player, plyr, youtube, vimeo, copyright
Requires at least: 4.6
Tested up to: 5.7
Stable tag: 1.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

YouTube/Vimeo player with disabled access to the original video.

== Description ==

Protected Video provides a block for embedding YouTube and Vimeo videos in a way that prevents easy access to the
underlying player. This is useful for premium video content you want to host externally and display behind a paywall.

For example if you provide a paid-for video course and the videos are "unlisted" on YouTube or Vimeo, embedding them
in your pages using Protected Video provides a basic level of protection against the videos being directly accessed
and shared.

Built on top of the excellent [Plyr](https://plyr.io/) which provides custom themeable player controls, this plugin
provides extra code to prevent easy access to the underlying player, and basic configuration of the player theme.

Protected Video is open source! Contribute to its development [on GitHub](https://github.com/AlecRust/protected-video).

== Installation ==

1. Install and activate the plugin
2. Find and use "Protected Video" block in the editor
3. Optionally configure player theme at Settings > Protected Video

== Frequently Asked Questions ==

= What does this plugin do? =

Displays YouTube and Vimeo videos within the [Plyr](https://plyr.io/) player, with extra code to disable access
to the original player. This helps to prevent users from easily copying and share the URL to the original video.

= Does this plugin prevent the user from accessing the original video? =

For general non-technical users, yes this plugin provides a basic level of protection against opening the original
video or copying its URL. However technical users would still be able to determine this information using browser
development tools or inspecting the page source.

== Screenshots ==

1. Protected Video block in the blocks editor.
2. Configuration of the player theme color at Settings > Protected Video.
3. Display of the player in the public facing site.

== Changelog ==

= 1.0.2 =

* Add Rollup build process for public JS
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
