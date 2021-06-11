# Protected Video [![CI](https://github.com/AlecRust/protected-video/actions/workflows/ci.yml/badge.svg)](https://github.com/AlecRust/protected-video/actions/workflows/ci.yml)

WordPress plugin that adds a "Protected Video" Gutenberg block, used for embedding YouTube/Vimeo videos with a
[Plyr](https://github.com/sampotts/plyr) overlay that prevents access to the underlying player.

## Installation

Install from the [WordPress Plugin Directory](https://wordpress.org/plugins/protected-video/) or grab a ZIP from the
[releases page](https://github.com/AlecRust/protected-video/releases).

If you choose manual ZIP installation note that this plugin supports [Git Updater](https://github.com/afragen/git-updater).

## Development

To develop this plugin locally:

1. Fork and clone this repository
2. Symlink/map the clone location to `/wp-content/plugins/protected-video` in a local WordPress site
3. Run `yarn` to install dependencies
4. Run `yarn start` to build JS and watch for changes
5. Activate the "Protected Video" plugin in your local WordPress site
