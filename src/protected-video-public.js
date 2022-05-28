import Plyr from 'plyr'
import './protected-video-public.css'

function decodeVideoBlock(videoBlock) {
  const encodedProvider = videoBlock.dataset.id1
  const encodedVideoId = videoBlock.dataset.id2

  if (encodedProvider && encodedVideoId) {
    const decodedProvider = atob(encodedProvider)
    const decodedVideoId = atob(encodedVideoId)

    if (decodedProvider && decodedVideoId) {
      // Add attributes that Plyr requires
      // https://github.com/sampotts/plyr/issues/1936
      videoBlock.dataset.plyrProvider = decodedProvider.toLowerCase()
      videoBlock.dataset.plyrEmbedId = decodedVideoId
    }
  }
}

const videoBlocks = document.querySelectorAll('.wp-block-protected-video')

if (videoBlocks.length) {
  videoBlocks.forEach((videoBlock) => decodeVideoBlock(videoBlock))

  Plyr.setup(videoBlocks)
}
