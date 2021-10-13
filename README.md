# Protected Video [![CI](https://github.com/AlecRust/protected-video/actions/workflows/ci.yml/badge.svg)](https://github.com/AlecRust/protected-video/actions/workflows/ci.yml)

Gutenberg block WordPress plugin for embedding YouTube/Vimeo videos in a way that prevents users easily accessing the original video.

## Features

- [Plyr](https://plyr.io/) player used to overlay default player with custom controls
- Player modifications to always prevent clicking the default player
- Encodes video ID in HTML to prevent finding it via “View Source”
- Settings page to configure the player theme to match your site

[View Player Demo](https://alecrust.github.io/protected-video/)

## Installation

Install from the [WordPress Plugin Directory](https://wordpress.org/plugins/protected-video/) or grab a ZIP from the
[releases page](https://github.com/AlecRust/protected-video/releases).

If you choose manual ZIP installation note that this plugin supports [Git Updater](https://github.com/afragen/git-updater).

## Development

To develop locally within a WordPress installation:

1. Fork and clone this repository
2. Symlink/map the clone location to `/wp-content/plugins/protected-video` in a local WordPress site
3. Run `yarn` to install dependencies
4. Run `yarn start` to build JS and watch for changes
5. Activate the "Protected Video" plugin in your local WordPress site

There's also a standalone player demo in `/docs` which can be served with e.g. `npx serve docs`.
