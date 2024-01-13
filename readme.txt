=== Protected Video ===
Contributors:      alecrust
Tags:              block, gutenberg, media player, video player, plyr, youtube, vimeo, copyright
Requires at least: 4.6
Tested up to:      6.4
Stable tag:        1.11.0
Requires PHP:      7.0
License:           GPL-2.0-or-later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html

YouTube/Vimeo player that prevents easy sharing of the video.

== Description ==

Gutenberg block and Shortcode for embedding YouTube/Vimeo videos, in a way that prevents users easily accessing the underlying video.

**This is useful for example when embedding an “unlisted” video as premium course content behind a paywall on your site.**

Features include:

* [Plyr](https://plyr.io/) player used to overlay default player with custom controls
* Player modifications to always prevent clicking the default player
* Encodes video ID in HTML to prevent finding it via “View Source”
* Settings page to e.g. configure the player theme to match your site

[View Player Demo](https://protected-video.alecrust.com/)

**Note:** This only provides a basic level of protection. Technical users may still be able to access the underlying video.

This plugin is open source and contributions are welcome [on GitHub](https://github.com/AlecRust/protected-video).

== Installation ==

1. Install and activate the plugin
2. Optionally configure player theme at **Settings > Protected Video**
3. Search for and use “Protected Video” block in the Block Editor
4. Alternatively use the Shortcode e.g. `[protected_video url="https://youtu.be/c_hO_fjmMnk" service="youtube"]`

== Frequently Asked Questions ==

= What does this plugin do? =

Embeds YouTube/Vimeo videos on your pages and takes steps to prevent users obtaining the e.g. YouTube URL of the video by clicking on the player or viewing the page source.

Watch [this YouTube video](https://www.youtube.com/watch?v=OVL0z9pO60I) for an introduction to the plugin and its potential use cases.

= How secure is this plugin? =

This plugin only provides a basic level of protection against users accessing the default player or otherwise determining the video URL. Technical users may still be able to figure out this information.

= Does this plugin work on mobile? =

Yes, the custom player works on mobile browsers and the disabling of access to the default player is still in place even in fullscreen mode.

= Why not use plain Plyr player? =

The default [Plyr](https://plyr.io/) player overlays YouTube/Vimeo players with its own controls, which prevents access to the underlying video copy/share buttons under some scenarios, but this is a side-effect of the way it works rather than a feature. The goal of Protected Video is to make this a feature by accounting for more scenarios e.g. when the player is paused, and providing additional features such as obfuscation of the underlying video ID in the HTML.

If you don't care about your users sharing the video or actually want them to, a plugin like [WP YouTube Lyte](https://wordpress.org/plugins/wp-youtube-lyte/) is probably more suitable.

= How can I style the player with CSS? =

The main color of the player can be configured at **Settings > Protected Video**. If you'd like to style the player further, you can provide your own CSS to override [the player's CSS variables](https://github.com/sampotts/plyr#customizing-the-css):

`
<style>
:root {
--plyr-badge-background: #000;
--plyr-control-radius: 5px;
}
</style>
`

= Can the YouTube watermark/controls be hidden? =

Unfortunately not. This plugin loads the standard YouTube player behind the overlay, which we have no control over. These aspects of the YouTube player cannot be disabled.

= Can you add feature X to the player? =

This plugin embeds the [Plyr](https://plyr.io/) player in a particular way and adds modifications to prevent access to the underlying video player. This plugin cannot provide additional features to the player itself beyond what is provided by Plyr. If you'd like to see a feature added to the player, please [open an issue on Plyr's GitHub](https://github.com/sampotts/plyr/issues).

= Why is there a Shortcode as well as Gutenberg block? =

The Shortcode is provided as an alternative embed method that still provides the same level of protection. Some people need the Shortcode for use with 3rd party page builders (Elementor etc.) and others simply prefer using a Shortcode over Gutenberg blocks.

= How do I use the Shortcode embed method? =

This is the format to use if you'd like to use the Shortcode embed method:

`
[protected_video url="https://youtu.be/c_hO_fjmMnk" service="youtube"]
`

A `service` of either `youtube` or `vimeo` must be specified when using the Shortcode embed method.

= How can I set the dimensions of the player? =

The [Plyr](https://plyr.io/) player is responsive by default and will grow to fill the container it is placed in. If you'd like to restrict these dimensions, place the block or Shortcode within a container that has your desired dimensions. See [this support topic](https://wordpress.org/support/topic/video-size-on-page/) for more.

= The display of the player is broken/it doesn't work =

If the player is not looking or behaving like [the demo](https://protected-video.alecrust.com/) on your site, this usually indicates another theme or plugin is interfering with Protected Video.

Please try disabling all other plugins one by one and switching to a default theme, to isolate which plugin or theme is causing the issue.

For performance reasons, Protected Video only loads its associated JS and CSS when it detects that a Gutenberg block or Shortcode is present on the page. If you insert a Protected Video in a non-standard way this detection may fail.

== Screenshots ==

1. Searching for Protected Video in the Block Editor.
2. Protected Video block inserted in the Block Editor.
3. Protected Video displayed on public facing site.
4. Configuration of the global plugin settings.
5. Optional Shortcode embed method also supported.

== Changelog ==

= 1.11.0 =

* Bump dependencies
* Add "Disable right-click" plugin option
* Use LTS Node version in CI workflows
* Bump actions/upload-pages-artifact from 2 to 3
* Bump actions/deploy-pages from 3 to 4

= 1.10.10 - 2023-12-19 =

* Bump dependencies
* Bump actions/deploy-pages from 2 to 3
* Bump actions/configure-pages from 3 to 4
* Remove unnecessary comment

= 1.10.9 - 2023-11-07 =

* Bump dependencies
* Automate deletion of old plugin SVN tags
* Bump actions/setup-node from 3 to 4

= 1.10.8 - 2023-10-27 =

* Bump dependencies
* Update "Tested up to" to 6.4

= 1.10.7 - 2023-10-17 =

* Bump dependencies
* Improve FAQ
* Load assets if post uses custom page template

= 1.10.6 - 2023-09-12 =

* Bump dependencies
* Specify Prettier PHP plugin in config
* Bump actions/checkout from 3 to 4

= 1.10.5 - 2023-08-18 =

* Bump dependencies
* Refine demo page
* Refactor demo page
* Further refine demo page
* Use GitHub CLI to upload release asset
* Tidy some CSS

= 1.10.4 - 2023-07-27 =

* Tidy comments formatting
* Refactor rendering of video thumbnail
* Improve method names consistency
* Use Notice component for displaying error message
* Refactor color input render code
* Remove unused do_shortcode fallback
* Load JS in head with defer, instead of end of body

= 1.10.3 - 2023-07-25 =

* Switch to @release-it/bumper plugin for bumping version in files
* Refactor plugin init code
* Use sanitize_hex_color for sanitizing player color value

= 1.10.2 - 2023-07-25 =

* Refactor away "hooks loader" abstraction
* Move registering of Gutenberg block to admin class
* Change some methods to be private
* Move lint-staged config to its own file
* Simplify file names
* Improve CI job names
* Remove unnecessary index.php files
* Fix CI badge in README

= 1.10.1 - 2023-07-24 =

* Split up CI workflows
* Add "MemberPress Courses" plugin custom filter to allow styles to load

= 1.10.0 - 2023-07-24 =

* Consolidate CI workflows
* Add cache busting to demo page
* Move demo webpack config to demo dir
* Simplify file names
* Refactor getVideoThumb() function
* Fix issue causing duplicate references to assets in HTML
* Improve plugin screenshots
* Tidy Shortcode fall back check
* Inject JS at end of &lt;body&gt; in demo to match plugin
* Disable right-clicking anywhere on a page containing a Protected Video
* Fix README CI badge
* Improve comment

= 1.9.1 - 2023-07-23 =

* Add support for @wordpress/env Docker dev environment
* Simplify dir structure of PHP files
* Simplify PHP utility functions
* Refactor Shortcode output HTML to use sprintf
* Improve checking for Shortcode usage
* Fix case where public CSS fails to load
* Tidy plugin metadata
* Add plugin banner to repo README
* Exclude webpack.demo.js from plugin dist

= 1.9.0 - 2023-07-22 =

* Switch from Yarn to npm, downgrade Prettier to fix prettier-php incompatibility
* Use wp-scripts to build all block assets
* Move block build directory from /admin/js to /build
* Fix duplicate enqueuing of public JS
* Tidy package.json
* Fix demo webpack config filename
* Move get-video-id to main dependencies
* Remove now-unnecessary Browserslist config
* Add "player" to block.json keywords
* Update plugin "Tested up to" to WordPress 6.3
* Add keywords to block.json

= 1.8.6 - 2023-07-20 =

* Add custom SVG as block icon
* Improve function name

= 1.8.5 - 2023-07-20 =

* Bump release-it version
* Remove unnecessary cannotEmbed block attribute
* Fix class names
* Add support for block preview when browsing
* Improve robustness of block editor CSS

= 1.8.4 - 2023-07-20 =

* Bump dependencies
* Move thumbUrl() out of main block code
* Use destructuring
* Implement useBlockProps() to support block.json apiVersion 3
* Set editorScript in block.json

= 1.8.3 - 2023-07-19 =

* Bump dependencies
* Store block metadata in block.json
* Run Prettier on all possible file extensions
* Bump semver from 5.7.1 to 5.7.2
* Separate lint and format scripts
* Tidy license comments
* Bump actions/upload-pages-artifact from 1 to 2
* Exclude public CSS from Prettier

= 1.8.2 - 2023-06-26 =

* Bump dependencies
* Bump dependencies
* Improve CI and demo deploy
* Remove unnecessary CNAME file from demo
* Improve plugin icon

= 1.8.1 - 2023-04-16 =

* Bump build dependencies
* Load player assets on custom post type pages
* Use better wp_add_inline_style() for loading inline styles
* Use plugin_dir_url consistently over plugins_url

= 1.8.0 - 2023-04-01 =

* Bump dependencies including Plyr 3.7.7 -&gt; 3.7.8
* Simplify JS for decoding HTML
* Switch YouTube embeds to use "no cookie" domain for GDPR support
* Add "Can you add feature X to the player?" FAQ

= 1.7.22 - 2023-03-20 =

* Bump dependencies including Plyr 3.7.6 -&gt; 3.7.7
* Add "How can I style the player how I like?" FAQ
* Add link to Plyr's styling documentation on plugin settings page
* Add "The display of the player is broken/it doesn't work" FAQ
* Update plugin "Tested up to" to WordPress 6.2

= 1.7.21 - 2023-03-10 =

* Bump dependencies including Plyr 3.7.3 -&gt; 3.7.6

= 1.7.20 - 2023-02-19 =

* Bump dependencies
* Improve "Why is there a Shortcode as well as Gutenberg block?" FAQ

= 1.7.19 - 2022-11-18 =

* Bump dependencies inc Plyr player v3.7.3
* Fix FAQ wrapping
* Update plugin "Tested up to" version

= 1.7.18 - 2022-11-06 =

* Bump dependencies
* Tidy readmes
* Add FAQ
* Fix readme typo

= 1.7.17 - 2022-08-14 =

* Bump dependencies
* Add missing $this-&gt;shortcodes placeholder variable
* Add "How do I use the Shortcode embed method?" to FAQs
* Add readme link to video that explains plugin

= 1.7.16 - 2022-07-24 =

* Bump dependencies
* Switch to official WordPress Babel preset
* Switch to official WordPress Browserslist
* Improve plugin information

= 1.7.15 - 2022-07-08 =

* Bump dependencies
* Fix CI badge in README.md

= 1.7.14 - 2022-05-28 =

* Move readme.txt into repository

= 1.7.13 - 2022-05-28 =

* Fix changelog building

= 1.7.12 - 2022-05-28 =

* Bump dependencies
* Split up CI workflows
* Ignore casing of "service" value in Shortcode

= 1.7.11 - 2022-05-08 =

* Bump dependencies
* Update "Tested up to" to WordPress 6

= 1.7.10 - 2022-04-20 =

* Bump dependencies
* Bump Plyr player version 3.6.12 -&gt; 3.7.2

= 1.7.9 - 2022-04-10 =

* Bump dependencies
* Improve README

= 1.7.8 - 2022-03-06 =

* Bump dependencies
* Refactor fetching of default player theme color option
* Automate keeping GitHub Actions up to date
* Upgrade "Checkout" GitHub Action to v3
* Upgrade download/upload artifact GitHub Actions to v3
* Remove unnecessary settings_errors call
* Allow errors to display at top of plugin settings page
* Tidy

= 1.7.7 - 2022-02-26 =

* Bump dependencies
* Store plugin option (theme color) as string instead of object

= 1.7.6 - 2022-02-14 =

* Bump dependencies

= 1.7.5 - 2022-02-05 =

* Bump dependencies
* Include .yml files in linting
* Remove unnecessary postcss-nested plugin
* Update author notes
* Improve public CSS webpack configs
* Remove invalid CSS from demo

= 1.7.4 - 2022-01-25 =

* Build player demo assets with webpack
* Add missing demo src files
* Bump mini-css-extract-plugin version
* Prevent interaction with &lt;iframe&gt; if poster removed in Dev Tools
* Improve WordPress vs standalone player dev experience
* Fix lint
* Simplify Demo CI
* Tidy
* Fix Vimeo thumbnail in blocks editor
* Exclude /demo from Prettier

= 1.7.3 - 2022-01-24 =

* Bump webpack-cli version
* Refactor/simplify public JS
* Update URL to player demo
* Fix excluding webpack-public.js from plugin dist
* Create CNAME

= 1.7.2 - 2022-01-23 =

* Bump dependencies
* Build public CSS with PostCSS
* Set Browserslist value in package.json

= 1.7.1 - 2022-01-23 =

* Update plugin "Tested up to" to WordPress 5.9

= 1.7.0 - 2022-01-22 =

* Bump dependencies
* Bundle Plyr in plugin JS/CSS instead of loading from CDN
* Optimize and minify public CSS
* Build public CSS with webpack
* Optimize and minify public JS

= 1.6.2 - 2022-01-16 =

* Fix syntax in readme FAQ

= 1.6.1 - 2022-01-16 =

* Switch from Rollup to webpack for building public JS
* Bump dependencies
* Bump dependencies
* Bump follow-redirects from 1.14.6 to 1.14.7
* Add FAQ about setting player dimensions

= 1.6.0 - 2022-01-02 =

* Bump dependencies to add support for YouTube Shorts
* Fix error when fetching post content when not on a post

= 1.5.2 - 2021-12-23 =

* Bump linting dependencies
* Extract "check if video on page" check into function
* Improve README/documentation
* Remove unused get_loader() utility function
* Remove unused globals from ESLint config
* Tidy README

= 1.5.1 - 2021-12-16 =

* Upgrade Plyr version 3.6.11 -&gt; 3.6.12

= 1.5.0 - 2021-12-16 =

* Bump dependencies
* Fix Shortcode-only usage not loading assets
* Upgrade Plyr player 3.6.9 -&gt; 3.6.11
* Adjust formatting in readme.txt

= 1.4.0 - 2021-11-17 =

* Bump dependencies
* Add Shortcode as alternative embed method
* Fix installation steps order
* Optimise banner image PNG

= 1.3.1 - 2021-11-14 =

* Upgrade get-video-id to improve YouTube URL matching
* Fix typo in plugin description

= 1.3.0 - 2021-10-13 =

* Update npm dependencies
* Update Plyr version 3.6.8 -&gt; 3.6.9

= 1.2.10 - 2021-09-18 =

* Bump dependencies
* Bump tar from 6.1.6 to 6.1.11

= 1.2.9 - 2021-09-05 =

* Bump dependencies

= 1.2.8 - 2021-08-06 =

* Update dependencies

= 1.2.7 - 2021-07-11 =

* Bump sub-dependencies to resolve security vulnerabilities

= 1.2.6 - 2021-07-11 =

* Update dependencies
* Use "block editor" instead of "blocks editor" in readme
* Tidy readme.txt
* Update "Tested up to" to WordPress 5.8
* Update plugin banner and icon

= 1.2.5 - 2021-07-03 =

* Bump dependencies
* Disable weekly Dependabot PRs
* Bump release-it from 14.8.0 to 14.9.0
* Mention /docs in local development instructions
* Remove links to PRs in readme.txt changelog
* Improve readme
* Remove unnecessary .husky/.gitignore

= 1.2.4 - 2021-06-12 =

* Bump rollup from 2.51.1 to 2.51.2
* Improve readmes
* Automate dependency PRs
* Remove unnecessary wp_enqueue_style option
* Depend on Plyr player CSS for custom CSS
* Improve dependency naming
* Support translation of more settings UI strings

= 1.2.3 - 2021-06-11 =

* Improve readme.txt
* Exclude /docs from plugin dist

= 1.2.2 - 2021-06-11 =

* Add demo of player
* Link to demo in readmes

= 1.2.1 - 2021-06-11 =

* Improve README.md
* Simplify readme.txt

= 1.2.0 - 2021-06-11 =

* Add obfuscation of provider and video ID in HTML
* Improve readmes
* Remove check-licenses
* Tidy CI
* Add license checking to lint
* Improve FAQ
* Add CI badge to README

= 1.1.12 - 2021-06-10 =

* Simplify CI workflow
* Improve readme
* Update block screenshot

= 1.1.11 - 2021-06-10 =

* Replace "replace" with "replace-in-files"
* Show error notice when no video ID found
* Improve block copy
* Add placeholder to embed input
* Use "yarn start" instead of "yarn watch"
* Remove readme CI badge for now
* Improve plugin banner/icon

= 1.1.10 - 2021-06-10 =

* Run separate lint workflow only on PRs
* Fix readme.txt changelog

= 1.1.9 - 2021-06-10 =

* Split up deployment workflow
* Exclude release commits from changelogs
* Add CI badge to README
* Improve plugin banner image

= 1.1.8 - 2021-06-09 =

* Exclude release commit from temp changelog
* Remove unnecessary --oneline flag

= 1.1.7 - 2021-06-09 =

* Improve order of CI steps
* Exclude Lint workflow from tag pushes
* Improve date output in changelog

= 1.1.6 - 2021-06-09 =

* Write to temporary file with git log
* Simplify git log output
* Exclude temp-changelog.txt from dist

= 1.1.5 - 2021-06-09 =

* Fix output savings

= 1.1.4 - 2021-06-09 =

* Save current tag as output

= 1.1.3 - 2021-06-09 =

* Fix build
* Fix GitHub release

= 1.1.2 - 2021-06-09 =

* Add fetch-depth

= 1.1.1 - 2021-06-09 =

* Fix changelog generating

= 1.1.0 - 2021-06-09 =

* Move GitHub release to CI
* Add link to plugin settings on Plugins page
* Improve readmes
* Add FAQ

= 1.0.8 - 2021-06-09 =

* Add CHANGELOG.md
* Improve readme
* Bump npm deps
* Add Lint workflow
* Improve readme
* Tidy workflow
* Add check flag to Prettier in CI
* Rename readme

= 1.0.7 - 2021-06-09 =

* Exclude files from plugin deployment
* Add missing admin/index.php

= 1.0.6 - 2021-06-09 =

* Remove unnecessary @since comments
* Set up plugin deploy
* Specify minimum PHP version
* Improve plugin description
* Improve README
* Improve README
* Update license in package.json

= 1.0.5 - 2021-06-06 =

* Add admin stylesheet
* Register block on enqueue_block_editor_assets instead of init

= 1.0.4 - 2021-06-06 =

* Fix version not being updated in plugin header

= 1.0.3 - 2021-06-06 =

* Improve README installation instructions
* Add GitHub Plugin URI to plugin header

= 1.0.2 - 2021-06-06 =

* Add Rollup build process for public JS
* Bump release-it version
* Tweak readme
* Add plugin banner/icon assets

= 1.0.1 - 2021-06-05 =

* Add release-it

= 1.0.0 - 2021-06-05 =

* Initial commit
