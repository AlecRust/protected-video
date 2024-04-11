#!/bin/bash

SVN_REPO_URL="https://plugins.svn.wordpress.org/protected-video/"

# Fetch all tags from SVN
svn_tags=$(svn ls "$SVN_REPO_URL/tags" --username "$SVN_USERNAME" --password "$SVN_PASSWORD" --non-interactive --no-auth-cache)

# Parse tags, sort them, and get all but the latest 10
old_tags=$(echo "$svn_tags" | sort -V | head -n -10)

# Loop through old tags and delete them
for tag in $old_tags; do
    svn delete "$SVN_REPO_URL/tags/$tag" --username "$SVN_USERNAME" --password "$SVN_PASSWORD" -m "Delete old tag: $tag" --non-interactive --no-auth-cache
done
