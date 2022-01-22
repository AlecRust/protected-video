import Plyr from 'plyr'
import './protected-video-public.css'

// Decode video provider and ID and set up players
const videos = document.querySelectorAll('.wp-block-protected-video')

videos.forEach((video) => {
  // Decode strings from data attributes
  const encodedProvider = video.dataset.id1
  const encodedVideoId = video.dataset.id2

  if (encodedProvider && encodedVideoId) {
    const decodedProvider = atob(encodedProvider)
    const decodedVideoId = atob(encodedVideoId)

    if (decodedProvider && decodedVideoId) {
      // Add attributes that Plyr requires
      // https://github.com/sampotts/plyr/issues/1936
      video.dataset.plyrProvider = decodedProvider
      video.dataset.plyrEmbedId = decodedVideoId

      // Initialize player
      return new Plyr(video)
    }
  }

  // Fallback for yet to be migrated HTML
  if (video.dataset.plyrProvider && video.dataset.plyrEmbedId) {
    new Plyr(video)
  }
})
