# Protected Video [![CI](https://github.com/AlecRust/protected-video/actions/workflows/ci.yml/badge.svg)](https://github.com/AlecRust/protected-video/actions/workflows/ci.yml)

WordPress plugin for embedding YouTube/Vimeo videos with features that prevent users easily obtaining the original video URL.

[View Player Demo](https://alecrust.github.io/protected-video/)

## Features

- Uses [Plyr](https://github.com/sampotts/plyr) as the video player which overlays default player with custom controls
- Includes modifications to prevent default player becoming clickable when paused etc.
- Obfuscates video information in the HTML to prevent users finding it via "View Source"
- Provides a settings page to configure the player theme to match your site's branding

## Installation

Install from the [WordPress Plugin Directory](https://wordpress.org/plugins/protected-video/) or grab a ZIP from the
[releases page](https://github.com/AlecRust/protected-video/releases).

If you choose manual ZIP installation note that this plugin supports [Git Updater](https://github.com/afragen/git-updater).

## Development

To develop locally:

1. Fork and clone this repository
2. Symlink/map the clone location to `/wp-content/plugins/protected-video` in a local WordPress site
3. Run `yarn` to install dependencies
4. Run `yarn start` to build JS and watch for changes
5. Activate the "Protected Video" plugin in your local WordPress site
