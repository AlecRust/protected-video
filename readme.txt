=== Protected Video ===
Contributors:      alecrust
Tags:              video, player, plyr, youtube, vimeo
Requires at least: 4.6
Tested up to:      6.6
Stable tag:        1.11.6
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
4. Alternatively use the Shortcode e.g. `[protected_video url="https://youtu.be/aqz-KE-bpKQ" service="youtube"]`

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

= Can I load my own videos into the player? =

Currently this plugin only supports YouTube and Vimeo embeds. You can upload your videos to YouTube or Vimeo and then embed them using this plugin. Support for loading your own video file directly from a server is a potential future feature.

= Why is there a Shortcode as well as Gutenberg block? =

The Shortcode is provided as an alternative embed method that still provides the same level of protection. Some people need the Shortcode for use with 3rd party page builders (Elementor etc.) and others simply prefer using a Shortcode over Gutenberg blocks.

= How do I use the Shortcode embed method? =

This is the format to use if you'd like to use the Shortcode embed method:

`
[protected_video url="https://youtu.be/aqz-KE-bpKQ" service="youtube"]
`

A `service` of either `youtube` or `vimeo` must be specified when using the Shortcode embed method.

= How can I set the dimensions of the player? =

The [Plyr](https://plyr.io/) player is responsive by default and will grow to fill the container it is placed in. If you'd like to restrict these dimensions, place the block or Shortcode within a container that has your desired dimensions. See [this support topic](https://wordpress.org/support/topic/video-size-on-page/) for more.

= The display of the player is broken/it doesn't work =

If the player is not looking or behaving like [the demo](https://protected-video.alecrust.com/) on your site, this usually indicates another theme or plugin is interfering with Protected Video.

Please try disabling all other plugins one by one and switching to a default theme, to isolate which plugin or theme is causing the issue.

For performance reasons, Protected Video only loads its associated JS and CSS when it detects that a Gutenberg block or Shortcode is present on the page. If you insert a video in a non-standard way this detection may fail.

== Screenshots ==

1. Searching for Protected Video in the Block Editor.
2. Protected Video block inserted in the Block Editor.
3. Protected Video displayed on public facing site.
4. Configuration of the global plugin settings.
5. Optional Shortcode embed method also supported.

== Changelog ==

= 1.11.6 - 2024-07-06 =

* Update WordPress "Tested up to" to 6.6
* Bump dependencies
* Remove Node script to simplify build process
* Improve workflow name
* Rename workflow
* Add weekly "Tested up to" CI check
* Set permissions for deploy plugin workflow
* Remove "v" prefix from git-cliff commands
* Improve tag deletion SVN commit message
* Simplify changelog config
* Tidy comments

= 1.11.5 - 2024-04-10 =

* Increase PHPStan level
* Use consistent example YouTube ID
* Apply WPCS auto fixes
* Change PHP files to use tabs
* Enable PHPMD linting
* Improve file naming
* Remove @prettier/plugin-php, use WP Prettier config
* Tweak order in .distignore
* Include composer.json in plugin dist
* Prefix public function
* Sort changelogs consistently

= 1.11.4 - 2024-04-07 =

* Remove @access tags
* Enable PHPStan
* Simplify setting of plugin version
* Use latest version of all development Composer packages
* Add plugin Blueprint file
* Improve variable names

= 1.11.3 - 2024-04-05 =

* Remove linting step from release
* Bump dependencies
* Add Composer and GrumPHP for PHP linting
* Switch to git-cliff for changelog building
* Bump actions/configure-pages from 4 to 5
* Bump dependencies
* Tidy comments
* Add missing "Can I load my own videos into the player?" FAQ

= 1.11.2 - 2024-03-13 =

* Change PHP code to 4 spaces indentation
* Add translators comment
* Improve HTML escaping
* Bump dependencies
* Add "Can I load my own videos into the player?" FAQ
* Tidy copy
* Increase var name length
* Tidy @link comments
* Tidy comments
* Reduce plugin tags to 5
* Add development requirements to README
* Add Plugin Check to development plugins

= 1.11.1 - 2024-03-02 =

* Update "Tested up to" to 6.5
* Bump dependencies
* Upgrade get-video-id to v4
* Upgrade husky to v9
* Simplify some PHP code
* Misc tidy
* Bump Prettier version
* Set default value for protected_video_player_theme_color option
* Improve consistency of option fields rendering
* Include protected_video_disable_right_click option in plugin uninstall

= 1.11.0 - 2024-01-13 =

* Add "Disable right-click" plugin option
* Use LTS Node version in CI workflows
* Bump dependencies
* Bump actions/upload-pages-artifact from 2 to 3
* Bump actions/deploy-pages from 3 to 4

= 1.10.10 - 2023-12-19 =

* Bump dependencies
* Remove unnecessary comment
* Bump actions/deploy-pages from 2 to 3
* Bump actions/configure-pages from 3 to 4

= 1.10.9 - 2023-11-07 =

* Automate deletion of old plugin SVN tags
* Bump dependencies
* Bump actions/setup-node from 3 to 4

= 1.10.8 - 2023-10-27 =

* Bump dependencies
* Update "Tested up to" to 6.4

= 1.10.7 - 2023-10-17 =

* Load assets if post uses custom page template
* Bump dependencies
* Improve FAQ

= 1.10.6 - 2023-09-12 =

* Bump dependencies
* Bump actions/checkout from 3 to 4
* Specify Prettier PHP plugin in config

= 1.10.5 - 2023-08-18 =

* Bump dependencies
* Use GitHub CLI to upload release asset
* Further refine demo page
* Refactor demo page
* Tidy some CSS
* Refine demo page

= 1.10.4 - 2023-07-27 =

* Use Notice component for displaying error message
* Refactor rendering of video thumbnail
* Tidy comments formatting
* Refactor color input render code
* Improve method names consistency
* Load JS in head with defer, instead of end of body
* Remove unused do_shortcode fallback

= 1.10.3 - 2023-07-25 =

* Switch to @release-it/bumper plugin for bumping version in files
* Use sanitize_hex_color for sanitizing player color value
* Refactor plugin init code

= 1.10.2 - 2023-07-25 =

* Move lint-staged config to its own file
* Remove unnecessary index.php files
* Change some methods to be private
* Simplify file names
* Move registering of Gutenberg block to admin class
* Refactor away "hooks loader" abstraction
* Fix CI badge in README
* Improve CI job names

= 1.10.1 - 2023-07-24 =

* Add "MemberPress Courses" plugin custom filter to allow styles to load
* Split up CI workflows

= 1.10.0 - 2023-07-24 =

* Improve plugin screenshots
* Fix issue causing duplicate references to assets in HTML
* Disable right-clicking anywhere on a page containing a Protected Video
* Refactor getVideoThumb() function
* Simplify file names
* Tidy Shortcode fall back check
* Move demo webpack config to demo dir
* Fix README CI badge
* Consolidate CI workflows
* Inject JS at end of <body> in demo to match plugin
* Add cache busting to demo page
* Improve comment

= 1.9.1 - 2023-07-23 =

* Improve checking for Shortcode usage
* Add plugin banner to repo README
* Fix case where public CSS fails to load
* Add support for @wordpress/env Docker dev environment
* Tidy plugin metadata
* Refactor Shortcode output HTML to use sprintf
* Simplify PHP utility functions
* Simplify dir structure of PHP files
* Exclude webpack.demo.js from plugin dist

= 1.9.0 - 2023-07-22 =

* Fix duplicate enqueuing of public JS
* Fix demo webpack config filename
* Move get-video-id to main dependencies
* Remove now-unnecessary Browserslist config
* Use wp-scripts to build all block assets
* Move block build directory from /admin/js to /build
* Switch from Yarn to npm, downgrade Prettier to fix prettier-php incompatibility
* Add "player" to block.json keywords
* Update plugin "Tested up to" to WordPress 6.3
* Add keywords to block.json
* Tidy package.json

= 1.8.6 - 2023-07-20 =

* Add custom SVG as block icon
* Improve function name

= 1.8.5 - 2023-07-20 =

* Bump release-it version
* Fix class names
* Remove unnecessary cannotEmbed block attribute
* Improve robustness of block editor CSS
* Add support for block preview when browsing

= 1.8.4 - 2023-07-20 =

* Move thumbUrl() out of main block code
* Use destructuring
* Bump dependencies
* Implement useBlockProps() to support block.json apiVersion 3
* Set editorScript in block.json

= 1.8.3 - 2023-07-19 =

* Bump dependencies
* Store block metadata in block.json
* Exclude public CSS from Prettier
* Tidy license comments
* Bump semver from 5.7.1 to 5.7.2
* Bump actions/upload-pages-artifact from 1 to 2
* Separate lint and format scripts
* Run Prettier on all possible file extensions

= 1.8.2 - 2023-06-26 =

* Bump dependencies
* Improve plugin icon
* Remove unnecessary CNAME file from demo
* Improve CI and demo deploy
* Bump dependencies

= 1.8.1 - 2023-04-16 =

* Use better wp_add_inline_style() for loading inline styles
* Use plugin_dir_url consistently over plugins_url
* Bump build dependencies
* Load player assets on custom post type pages

= 1.8.0 - 2023-04-01 =

* Switch YouTube embeds to use "no cookie" domain for GDPR support
* Simplify JS for decoding HTML
* Add "Can you add feature X to the player?" FAQ
* Bump dependencies including Plyr 3.7.7 -> 3.7.8

= 1.7.22 - 2023-03-20 =

* Add link to Plyr's styling documentation on plugin settings page
* Add "How can I style the player how I like?" FAQ
* Add "The display of the player is broken/it doesn't work" FAQ
* Bump dependencies including Plyr 3.7.6 -> 3.7.7
* Update plugin "Tested up to" to WordPress 6.2

= 1.7.21 - 2023-03-10 =

* Bump dependencies including Plyr 3.7.3 -> 3.7.6

= 1.7.20 - 2023-02-19 =

* Improve "Why is there a Shortcode as well as Gutenberg block?" FAQ
* Bump dependencies

= 1.7.19 - 2022-11-18 =

* Bump dependencies inc Plyr player v3.7.3
* Fix FAQ wrapping
* Update plugin "Tested up to" version

= 1.7.18 - 2022-11-06 =

* Add FAQ
* Tidy readmes
* Bump dependencies
* Fix readme typo

= 1.7.17 - 2022-08-14 =

* Add readme link to video that explains plugin
* Add "How do I use the Shortcode embed method?" to FAQs
* Bump dependencies
* Add missing $this->shortcodes placeholder variable

= 1.7.16 - 2022-07-24 =

* Bump dependencies
* Switch to official WordPress Babel preset
* Improve plugin information
* Switch to official WordPress Browserslist

= 1.7.15 - 2022-07-08 =

* Bump dependencies
* Fix CI badge in README.md

= 1.7.14 - 2022-05-28 =

* Move readme.txt into repository

= 1.7.13 - 2022-05-28 =

* Fix changelog building

= 1.7.12 - 2022-05-28 =

* Ignore casing of "service" value in Shortcode
* Bump dependencies
* Split up CI workflows

= 1.7.11 - 2022-05-08 =

* Update "Tested up to" to WordPress 6
* Bump dependencies

= 1.7.10 - 2022-04-20 =

* Bump dependencies
* Bump Plyr player version 3.6.12 -> 3.7.2

= 1.7.9 - 2022-04-10 =

* Bump dependencies
* Improve README

= 1.7.8 - 2022-03-06 =

* Upgrade download/upload artifact GitHub Actions to v3
* Upgrade "Checkout" GitHub Action to v3
* Bump dependencies
* Remove unnecessary settings_errors call
* Automate keeping GitHub Actions up to date
* Allow errors to display at top of plugin settings page
* Refactor fetching of default player theme color option
* Tidy

= 1.7.7 - 2022-02-26 =

* Bump dependencies
* Store plugin option (theme color) as string instead of object

= 1.7.6 - 2022-02-14 =

* Bump dependencies

= 1.7.5 - 2022-02-05 =

* Bump dependencies
* Remove unnecessary postcss-nested plugin
* Improve public CSS webpack configs
* Remove invalid CSS from demo
* Update author notes
* Include .yml files in linting

= 1.7.4 - 2022-01-25 =

* Prevent interaction with <iframe> if poster removed in Dev Tools
* Fix Vimeo thumbnail in blocks editor
* Bump mini-css-extract-plugin version
* Exclude /demo from Prettier
* Improve WordPress vs standalone player dev experience
* Simplify Demo CI
* Tidy
* Fix lint
* Add missing demo src files
* Build player demo assets with webpack

= 1.7.3 - 2022-01-24 =

* Bump webpack-cli version
* Update URL to player demo
* Create CNAME
* Refactor/simplify public JS
* Fix excluding webpack-public.js from plugin dist

= 1.7.2 - 2022-01-23 =

* Bump dependencies
* Set Browserslist value in package.json
* Build public CSS with PostCSS

= 1.7.1 - 2022-01-23 =

* Update plugin "Tested up to" to WordPress 5.9

= 1.7.0 - 2022-01-22 =

* Optimize and minify public JS
* Bundle Plyr in plugin JS/CSS instead of loading from CDN
* Optimize and minify public CSS
* Build public CSS with webpack
* Bump dependencies

= 1.6.2 - 2022-01-16 =

* Fix syntax in readme FAQ

= 1.6.1 - 2022-01-16 =

* Bump dependencies
* Add FAQ about setting player dimensions
* Switch from Rollup to webpack for building public JS
* Bump dependencies
* Bump follow-redirects from 1.14.6 to 1.14.7

= 1.6.0 - 2022-01-02 =

* Bump dependencies to add support for YouTube Shorts
* Fix error when fetching post content when not on a post

= 1.5.2 - 2021-12-23 =

* Remove unused globals from ESLint config
* Remove unused get_loader() utility function
* Extract "check if video on page" check into function
* Bump linting dependencies
* Improve README/documentation
* Tidy README

= 1.5.1 - 2021-12-16 =

* Upgrade Plyr version 3.6.11 -> 3.6.12

= 1.5.0 - 2021-12-16 =

* Upgrade Plyr player 3.6.9 -> 3.6.11
* Bump dependencies
* Fix Shortcode-only usage not loading assets
* Adjust formatting in readme.txt

= 1.4.0 - 2021-11-17 =

* Add Shortcode as alternative embed method
* Fix installation steps order
* Optimise banner image PNG
* Bump dependencies

= 1.3.1 - 2021-11-14 =

* Upgrade get-video-id to improve YouTube URL matching
* Fix typo in plugin description

= 1.3.0 - 2021-10-13 =

* Update Plyr version 3.6.8 -> 3.6.9
* Update npm dependencies

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

* Update plugin banner and icon
* Use "block editor" instead of "blocks editor" in readme
* Tidy readme.txt
* Update "Tested up to" to WordPress 5.8
* Update dependencies

= 1.2.5 - 2021-07-03 =

* Mention /docs in local development instructions
* Remove unnecessary .husky/.gitignore
* Bump dependencies
* Disable weekly Dependabot PRs
* Bump release-it from 14.8.0 to 14.9.0
* Remove links to PRs in readme.txt changelog
* Improve readme

= 1.2.4 - 2021-06-12 =

* Merge pull request #1 from AlecRust/dependabot/npm_and_yarn/rollup-2.51.2
* Bump rollup from 2.51.1 to 2.51.2
* Improve readmes
* Depend on Plyr player CSS for custom CSS
* Improve dependency naming
* Automate dependency PRs
* Remove unnecessary wp_enqueue_style option
* Support translation of more settings UI strings

= 1.2.3 - 2021-06-11 =

* Improve readme.txt
* Exclude /docs from plugin dist

= 1.2.2 - 2021-06-11 =

* Link to demo in readmes
* Add demo of player

= 1.2.1 - 2021-06-11 =

* Improve README.md
* Simplify readme.txt

= 1.2.0 - 2021-06-11 =

* Add obfuscation of provider and video ID in HTML
* Improve FAQ
* Improve readmes
* Remove check-licenses
* Tidy CI
* Add license checking to lint
* Add CI badge to README

= 1.1.12 - 2021-06-10 =

* Simplify CI workflow
* Improve readme
* Update block screenshot

= 1.1.11 - 2021-06-10 =

* Remove readme CI badge for now
* Show error notice when no video ID found
* Improve block copy
* Add placeholder to embed input
* Use "yarn start" instead of "yarn watch"
* Replace "replace" with "replace-in-files"
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

* Exclude Lint workflow from tag pushes
* Improve order of CI steps
* Improve date output in changelog

= 1.1.6 - 2021-06-09 =

* Write to temporary file with git log
* Simplify git log output
* Exclude temp-changelog.txt from dist

= 1.1.5 - 2021-06-09 =

* Fix output savings

= 1.1.4 - 2021-06-09 =

* Save current tag as output
* Merge branch 'master' of github.com:AlecRust/protected-video
* Fix build
* Fix GitHub release

= 1.1.2 - 2021-06-09 =

* Add fetch-depth

= 1.1.1 - 2021-06-09 =

* Fix changelog generating

= 1.1.0 - 2021-06-09 =

* Move GitHub release to CI
* Add link to plugin settings on Plugins page
* Add FAQ
* Improve readmes

= 1.0.8 - 2021-06-09 =

* Add CHANGELOG.md
* Add check flag to Prettier in CI
* Rename readme
* Add Lint workflow
* Bump npm deps
* Improve readme
* Tidy workflow
* Improve readme

= 1.0.7 - 2021-06-09 =

* Add missing admin/index.php
* Exclude files from plugin deployment

= 1.0.6 - 2021-06-09 =

* Set up plugin deploy
* Specify minimum PHP version
* Remove unnecessary @since comments
* Update license in package.json
* Improve README
* Improve README
* Improve plugin description

= 1.0.5 - 2021-06-06 =

* Add admin stylesheet
* Register block on enqueue_block_editor_assets instead of init

= 1.0.4 - 2021-06-06 =

* Fix version not being updated in plugin header

= 1.0.3 - 2021-06-06 =

* Add GitHub Plugin URI to plugin header
* Improve README installation instructions

= 1.0.2 - 2021-06-06 =

* Bump release-it version
* Add plugin banner/icon assets
* Add Rollup build process for public JS
* Tweak readme

= 1.0.1 - 2021-06-05 =

* Add release-it

= 1.0.0 - 2021-06-05 =

* Initial commit
