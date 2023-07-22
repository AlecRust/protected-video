/**
 * Public JS that decodes the video ID and provider from
 * the data attributes and initializes Plyr.
 */

import Plyr from 'plyr'

function decodeVideoBlock(videoBlock) {
  const encodedProvider = videoBlock.dataset.id1
  const encodedVideoId = videoBlock.dataset.id2

  if (!encodedProvider || !encodedVideoId) {
    return
  }

  const decodedProvider = atob(encodedProvider)
  const decodedVideoId = atob(encodedVideoId)

  if (!decodedProvider || !decodedVideoId) {
    return
  }

  // Add attributes that Plyr requires
  // https://github.com/sampotts/plyr/issues/1936
  videoBlock.dataset.plyrProvider = decodedProvider.toLowerCase()
  videoBlock.dataset.plyrEmbedId = decodedVideoId
}

const videoBlocks = document.querySelectorAll(
  '.wp-block-protected-video-protected-video'
)

videoBlocks.forEach((videoBlock) => {
  decodeVideoBlock(videoBlock)

  new Plyr(videoBlock, {
    youtube: {
      noCookie: true,
    },
  })
})
