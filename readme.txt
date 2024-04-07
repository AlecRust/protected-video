=== Protected Video ===
Contributors:      alecrust
Tags:              video, player, plyr, youtube, vimeo
Requires at least: 4.6
Tested up to:      6.5
Stable tag:        1.11.4
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

= Can I load my own videos into the player? =

Currently this plugin only supports YouTube and Vimeo embeds. You can upload your videos to YouTube or Vimeo and then embed them using this plugin. Support for loading your own video file directly from a server is a potential future feature.

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

For performance reasons, Protected Video only loads its associated JS and CSS when it detects that a Gutenberg block or Shortcode is present on the page. If you insert a video in a non-standard way this detection may fail.

== Screenshots ==

1. Searching for Protected Video in the Block Editor.
2. Protected Video block inserted in the Block Editor.
3. Protected Video displayed on public facing site.
4. Configuration of the global plugin settings.
5. Optional Shortcode embed method also supported.

== Changelog ==

= 1.11.4 - 2024-04-07 =

* Improve variable names
* Add plugin Blueprint file
* Use latest version of all development Composer packages
* Simplify setting of plugin version
* Enable PHPStan
* Remove @access tags

= 1.11.3 - 2024-04-05 =

* Add missing "Can I load my own videos into the player?" FAQ
* Tidy comments
* Bump dependencies
* Bump actions/configure-pages from 4 to 5
* Switch to git-cliff for changelog building
* Add Composer and GrumPHP for PHP linting
* Bump dependencies
* Remove linting step from release

= 1.11.2 - 2024-03-13 =

* Add Plugin Check to development plugins
* Add development requirements to README
* Reduce plugin tags to 5
* Tidy comments
* Tidy @link comments
* Increase var name length
* Tidy copy
* Add "Can I load my own videos into the player?" FAQ
* Bump dependencies
* Improve HTML escaping
* Add translators comment
* Change PHP code to 4 spaces indentation

= 1.11.1 - 2024-03-02 =

* Include protected_video_disable_right_click option in plugin uninstall
* Improve consistency of option fields rendering
* Set default value for protected_video_player_theme_color option
* Bump Prettier version
* Misc tidy
* Simplify some PHP code
* Upgrade husky to v9
* Upgrade get-video-id to v4
* Bump dependencies
* Update "Tested up to" to 6.5

= 1.11.0 - 2024-01-13 =

* Bump actions/deploy-pages from 3 to 4
* Bump actions/upload-pages-artifact from 2 to 3
* Bump dependencies
* Use LTS Node version in CI workflows
* Add "Disable right-click" plugin option

= 1.10.10 - 2023-12-19 =

* Bump actions/configure-pages from 3 to 4
* Bump actions/deploy-pages from 2 to 3
* Remove unnecessary comment
* Bump dependencies

= 1.10.9 - 2023-11-07 =

* Bump actions/setup-node from 3 to 4
* Bump dependencies
* Automate deletion of old plugin SVN tags

= 1.10.8 - 2023-10-27 =

* Update "Tested up to" to 6.4
* Bump dependencies

= 1.10.7 - 2023-10-17 =

* Improve FAQ
* Bump dependencies
* Load assets if post uses custom page template

= 1.10.6 - 2023-09-12 =

* Specify Prettier PHP plugin in config
* Bump actions/checkout from 3 to 4
* Bump dependencies

= 1.10.5 - 2023-08-18 =

* Refine demo page
* Tidy some CSS
* Refactor demo page
* Further refine demo page
* Use GitHub CLI to upload release asset
* Bump dependencies

= 1.10.4 - 2023-07-27 =

* Remove unused do_shortcode fallback
* Load JS in head with defer, instead of end of body
* Improve method names consistency
* Refactor color input render code
* Tidy comments formatting
* Refactor rendering of video thumbnail
* Use Notice component for displaying error message

= 1.10.3 - 2023-07-25 =

* Refactor plugin init code
* Use sanitize_hex_color for sanitizing player color value
* Switch to @release-it/bumper plugin for bumping version in files

= 1.10.2 - 2023-07-25 =

* Improve CI job names
* Fix CI badge in README
* Refactor away "hooks loader" abstraction
* Move registering of Gutenberg block to admin class
* Simplify file names
* Change some methods to be private
* Remove unnecessary index.php files
* Move lint-staged config to its own file

= 1.10.1 - 2023-07-24 =

* Split up CI workflows
* Add "MemberPress Courses" plugin custom filter to allow styles to load

= 1.10.0 - 2023-07-24 =

* Improve comment
* Add cache busting to demo page
* Inject JS at end of <body> in demo to match plugin
* Consolidate CI workflows
* Fix README CI badge
* Move demo webpack config to demo dir
* Tidy Shortcode fall back check
* Simplify file names
* Refactor getVideoThumb() function
* Disable right-clicking anywhere on a page containing a Protected Video
* Fix issue causing duplicate references to assets in HTML
* Improve plugin screenshots

= 1.9.1 - 2023-07-23 =

* Exclude webpack.demo.js from plugin dist
* Simplify dir structure of PHP files
* Simplify PHP utility functions
* Refactor Shortcode output HTML to use sprintf
* Tidy plugin metadata
* Add support for @wordpress/env Docker dev environment
* Fix case where public CSS fails to load
* Add plugin banner to repo README
* Improve checking for Shortcode usage

= 1.9.0 - 2023-07-22 =

* Tidy package.json
* Add keywords to block.json
* Update plugin "Tested up to" to WordPress 6.3
* Add "player" to block.json keywords
* Switch from Yarn to npm, downgrade Prettier to fix prettier-php incompatibility
* Move block build directory from /admin/js to /build
* Use wp-scripts to build all block assets
* Remove now-unnecessary Browserslist config
* Move get-video-id to main dependencies
* Fix demo webpack config filename
* Fix duplicate enqueuing of public JS

= 1.8.6 - 2023-07-20 =

* Improve function name
* Add custom SVG as block icon

= 1.8.5 - 2023-07-20 =

* Add support for block preview when browsing
* Improve robustness of block editor CSS
* Remove unnecessary cannotEmbed block attribute
* Fix class names
* Bump release-it version

= 1.8.4 - 2023-07-20 =

* Set editorScript in block.json
* Implement useBlockProps() to support block.json apiVersion 3
* Bump dependencies
* Use destructuring
* Move thumbUrl() out of main block code

= 1.8.3 - 2023-07-19 =

* Run Prettier on all possible file extensions
* Separate lint and format scripts
* Bump actions/upload-pages-artifact from 1 to 2
* Bump semver from 5.7.1 to 5.7.2
* Tidy license comments
* Exclude public CSS from Prettier
* Store block metadata in block.json
* Bump dependencies

= 1.8.2 - 2023-06-26 =

* Bump dependencies
* Improve CI and demo deploy
* Remove unnecessary CNAME file from demo
* Improve plugin icon
* Bump dependencies

= 1.8.1 - 2023-04-16 =

* Load player assets on custom post type pages
* Bump build dependencies
* Use plugin_dir_url consistently over plugins_url
* Use better wp_add_inline_style() for loading inline styles

= 1.8.0 - 2023-04-01 =

* Bump dependencies including Plyr 3.7.7 -> 3.7.8
* Add "Can you add feature X to the player?" FAQ
* Simplify JS for decoding HTML
* Switch YouTube embeds to use "no cookie" domain for GDPR support

= 1.7.22 - 2023-03-20 =

* Update plugin "Tested up to" to WordPress 6.2
* Bump dependencies including Plyr 3.7.6 -> 3.7.7
* Add "The display of the player is broken/it doesn't work" FAQ
* Add "How can I style the player how I like?" FAQ
* Add link to Plyr's styling documentation on plugin settings page

= 1.7.21 - 2023-03-10 =

* Bump dependencies including Plyr 3.7.3 -> 3.7.6

= 1.7.20 - 2023-02-19 =

* Bump dependencies
* Improve "Why is there a Shortcode as well as Gutenberg block?" FAQ

= 1.7.19 - 2022-11-18 =

* Update plugin "Tested up to" version
* Fix FAQ wrapping
* Bump dependencies inc Plyr player v3.7.3

= 1.7.18 - 2022-11-06 =

* Fix readme typo
* Bump dependencies
* Tidy readmes
* Add FAQ

= 1.7.17 - 2022-08-14 =

* Add missing $this->shortcodes placeholder variable
* Bump dependencies
* Add "How do I use the Shortcode embed method?" to FAQs
* Add readme link to video that explains plugin

= 1.7.16 - 2022-07-24 =

* Switch to official WordPress Browserslist
* Improve plugin information
* Switch to official WordPress Babel preset
* Bump dependencies

= 1.7.15 - 2022-07-08 =

* Fix CI badge in README.md
* Bump dependencies

= 1.7.14 - 2022-05-28 =

* Move readme.txt into repository

= 1.7.13 - 2022-05-28 =

* Fix changelog building

= 1.7.12 - 2022-05-28 =

* Split up CI workflows
* Bump dependencies
* Ignore casing of "service" value in Shortcode

= 1.7.11 - 2022-05-08 =

* Bump dependencies
* Update "Tested up to" to WordPress 6

= 1.7.10 - 2022-04-20 =

* Bump Plyr player version 3.6.12 -> 3.7.2
* Bump dependencies

= 1.7.9 - 2022-04-10 =

* Improve README
* Bump dependencies

= 1.7.8 - 2022-03-06 =

* Tidy
* Refactor fetching of default player theme color option
* Allow errors to display at top of plugin settings page
* Automate keeping GitHub Actions up to date
* Remove unnecessary settings_errors call
* Bump dependencies
* Upgrade "Checkout" GitHub Action to v3
* Upgrade download/upload artifact GitHub Actions to v3

= 1.7.7 - 2022-02-26 =

* Store plugin option (theme color) as string instead of object
* Bump dependencies

= 1.7.6 - 2022-02-14 =

* Bump dependencies

= 1.7.5 - 2022-02-05 =

* Include .yml files in linting
* Update author notes
* Remove invalid CSS from demo
* Improve public CSS webpack configs
* Remove unnecessary postcss-nested plugin
* Bump dependencies

= 1.7.4 - 2022-01-25 =

* Build player demo assets with webpack
* Add missing demo src files
* Fix lint
* Tidy
* Simplify Demo CI
* Improve WordPress vs standalone player dev experience
* Exclude /demo from Prettier
* Bump mini-css-extract-plugin version
* Fix Vimeo thumbnail in blocks editor
* Prevent interaction with <iframe> if poster removed in Dev Tools

= 1.7.3 - 2022-01-24 =

* Fix excluding webpack-public.js from plugin dist
* Refactor/simplify public JS
* Create CNAME
* Update URL to player demo
* Bump webpack-cli version

= 1.7.2 - 2022-01-23 =

* Build public CSS with PostCSS
* Set Browserslist value in package.json
* Bump dependencies

= 1.7.1 - 2022-01-23 =

* Update plugin "Tested up to" to WordPress 5.9

= 1.7.0 - 2022-01-22 =

* Bump dependencies
* Build public CSS with webpack
* Optimize and minify public CSS
* Bundle Plyr in plugin JS/CSS instead of loading from CDN
* Optimize and minify public JS

= 1.6.2 - 2022-01-16 =

* Fix syntax in readme FAQ

= 1.6.1 - 2022-01-16 =

* Bump follow-redirects from 1.14.6 to 1.14.7
* Bump dependencies
* Switch from Rollup to webpack for building public JS
* Add FAQ about setting player dimensions
* Bump dependencies

= 1.6.0 - 2022-01-02 =

* Fix error when fetching post content when not on a post
* Bump dependencies to add support for YouTube Shorts

= 1.5.2 - 2021-12-23 =

* Tidy README
* Improve README/documentation
* Bump linting dependencies
* Extract "check if video on page" check into function
* Remove unused get_loader() utility function
* Remove unused globals from ESLint config

= 1.5.1 - 2021-12-16 =

* Upgrade Plyr version 3.6.11 -> 3.6.12

= 1.5.0 - 2021-12-16 =

* Adjust formatting in readme.txt
* Fix Shortcode-only usage not loading assets
* Bump dependencies
* Upgrade Plyr player 3.6.9 -> 3.6.11

= 1.4.0 - 2021-11-17 =

* Bump dependencies
* Optimise banner image PNG
* Fix installation steps order
* Add Shortcode as alternative embed method

= 1.3.1 - 2021-11-14 =

* Fix typo in plugin description
* Upgrade get-video-id to improve YouTube URL matching

= 1.3.0 - 2021-10-13 =

* Update npm dependencies
* Update Plyr version 3.6.8 -> 3.6.9

= 1.2.10 - 2021-09-18 =

* Bump tar from 6.1.6 to 6.1.11
* Bump dependencies

= 1.2.9 - 2021-09-05 =

* Bump dependencies

= 1.2.8 - 2021-08-06 =

* Update dependencies

= 1.2.7 - 2021-07-11 =

* Bump sub-dependencies to resolve security vulnerabilities

= 1.2.6 - 2021-07-11 =

* Update dependencies
* Update "Tested up to" to WordPress 5.8
* Tidy readme.txt
* Use "block editor" instead of "blocks editor" in readme
* Update plugin banner and icon

= 1.2.5 - 2021-07-03 =

* Improve readme
* Remove links to PRs in readme.txt changelog
* Bump release-it from 14.8.0 to 14.9.0
* Disable weekly Dependabot PRs
* Bump dependencies
* Remove unnecessary .husky/.gitignore
* Mention /docs in local development instructions

= 1.2.4 - 2021-06-12 =

* Support translation of more settings UI strings
* Remove unnecessary wp_enqueue_style option
* Automate dependency PRs
* Improve dependency naming
* Depend on Plyr player CSS for custom CSS
* Improve readmes
* Bump rollup from 2.51.1 to 2.51.2
* Merge pull request #1 from AlecRust/dependabot/npm_and_yarn/rollup-2.51.2

= 1.2.3 - 2021-06-11 =

* Exclude /docs from plugin dist
* Improve readme.txt

= 1.2.2 - 2021-06-11 =

* Add demo of player
* Link to demo in readmes

= 1.2.1 - 2021-06-11 =

* Simplify readme.txt
* Improve README.md

= 1.2.0 - 2021-06-11 =

* Add CI badge to README
* Add license checking to lint
* Tidy CI
* Remove check-licenses
* Improve readmes
* Improve FAQ
* Add obfuscation of provider and video ID in HTML

= 1.1.12 - 2021-06-10 =

* Update block screenshot
* Improve readme
* Simplify CI workflow

= 1.1.11 - 2021-06-10 =

* Improve plugin banner/icon
* Replace "replace" with "replace-in-files"
* Use "yarn start" instead of "yarn watch"
* Add placeholder to embed input
* Improve block copy
* Show error notice when no video ID found
* Remove readme CI badge for now

= 1.1.10 - 2021-06-10 =

* Fix readme.txt changelog
* Run separate lint workflow only on PRs

= 1.1.9 - 2021-06-10 =

* Improve plugin banner image
* Add CI badge to README
* Exclude release commits from changelogs
* Split up deployment workflow

= 1.1.8 - 2021-06-09 =

* Remove unnecessary --oneline flag
* Exclude release commit from temp changelog

= 1.1.7 - 2021-06-09 =

* Improve date output in changelog
* Improve order of CI steps
* Exclude Lint workflow from tag pushes

= 1.1.6 - 2021-06-09 =

* Exclude temp-changelog.txt from dist
* Simplify git log output
* Write to temporary file with git log

= 1.1.5 - 2021-06-09 =

* Fix output savings

= 1.1.4 - 2021-06-09 =

* Fix GitHub release
* Fix build
* Merge branch 'master' of github.com:AlecRust/protected-video
* Save current tag as output

= 1.1.2 - 2021-06-09 =

* Add fetch-depth

= 1.1.1 - 2021-06-09 =

* Fix changelog generating

= 1.1.0 - 2021-06-09 =

* Improve readmes
* Add FAQ
* Add link to plugin settings on Plugins page
* Move GitHub release to CI

= 1.0.8 - 2021-06-09 =

* Improve readme
* Tidy workflow
* Improve readme
* Bump npm deps
* Add Lint workflow
* Rename readme
* Add check flag to Prettier in CI
* Add CHANGELOG.md

= 1.0.7 - 2021-06-09 =

* Exclude files from plugin deployment
* Add missing admin/index.php

= 1.0.6 - 2021-06-09 =

* Improve plugin description
* Improve README
* Improve README
* Update license in package.json
* Remove unnecessary @since comments
* Specify minimum PHP version
* Set up plugin deploy

= 1.0.5 - 2021-06-06 =

* Register block on enqueue_block_editor_assets instead of init
* Add admin stylesheet

= 1.0.4 - 2021-06-06 =

* Fix version not being updated in plugin header

= 1.0.3 - 2021-06-06 =

* Improve README installation instructions
* Add GitHub Plugin URI to plugin header

= 1.0.2 - 2021-06-06 =

* Tweak readme
* Add Rollup build process for public JS
* Add plugin banner/icon assets
* Bump release-it version

= 1.0.1 - 2021-06-05 =

* Add release-it

= 1.0.0 - 2021-06-05 =

* Initial commit
