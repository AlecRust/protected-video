# Protected Video [![CI](https://github.com/AlecRust/protected-video/actions/workflows/lint.yml/badge.svg)](https://github.com/AlecRust/protected-video/actions/workflows/lint.yml)

WordPress plugin that provides a Gutenberg block and traditional Shortcode for embedding YouTube/Vimeo videos, in a way that prevents users easily accessing the underlying video.

## Features

- [Plyr](https://plyr.io/) player used to overlay default player with custom controls
- Player modifications to always prevent clicking the default player
- Encodes video ID in HTML to prevent finding it via “View Source”
- Settings page to configure the player theme to match your site

[View Player Demo](https://protected-video.alecrust.com/)

## Installation

Install from the [WordPress Plugin Directory](https://wordpress.org/plugins/protected-video/) or grab a ZIP from
[Releases](https://github.com/AlecRust/protected-video/releases). This plugin supports [Git Updater](https://github.com/afragen/git-updater).

To embed a video either search for "Protected Video" in the Block Editor, or use the Shortcode e.g.

    [protected_video url="https://youtu.be/c_hO_fjmMnk" service="youtube"]

## Development

To develop locally within WordPress, symlink this repository to `wp-content/plugins/protected-video`.

Then run `yarn` and `yarn build` to build the plugin, and activate it in the WordPress admin.

Run `yarn start` to build/watch files for development within WordPress.

Run `yarn start:demo` to build/watch files for standalone player demo and open in browser.
