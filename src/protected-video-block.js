import { __ } from '@wordpress/i18n'
import { useBlockProps, BlockIcon } from '@wordpress/block-editor' // eslint-disable-line no-unused-vars
import { Placeholder, TextControl } from '@wordpress/components' // eslint-disable-line no-unused-vars
import { registerBlockType } from '@wordpress/blocks'
import getVideoId from 'get-video-id'
import metadata from './block.json'

function getVideoThumb(videoService, videoId) {
  if (videoService === 'youtube') {
    return `https://i.ytimg.com/vi/${videoId}/mqdefault.jpg`
  }
  if (videoService === 'vimeo') {
    return `https://vumbnail.com/${videoId}.jpg`
  }
}

const pluginIcon = (
  <svg viewBox="0 0 363 512" xmlns="http://www.w3.org/2000/svg">
    <path
      d="M181.333 0C104.789.094 42.76 62.122 42.666 138.667V224c0 5.891 4.776 10.667 10.667 10.667H96c5.891 0 10.667-4.776 10.667-10.667v-85.333C106.666 97.429 140.096 64 181.333 64 222.57 64 256 97.429 256 138.667V224c0 5.891 4.776 10.667 10.667 10.667h42.666c5.891 0 10.667-4.776 10.667-10.667v-85.333C319.906 62.122 257.877.094 181.333 0Z"
      fill="#455a64"
    />
    <path
      d="M53.333 213.333h256c29.455 0 53.333 23.878 53.333 53.333v192c0 29.456-23.878 53.334-53.333 53.334h-256C23.878 512 0 488.122 0 458.667v-192c0-29.456 23.878-53.334 53.333-53.334Z"
      fill="#ffc107"
    />
    <path
      d="M134.156 277.687v170.997l134.354-85.499-134.354-85.498Z"
      fill="#455a64"
    />
  </svg>
)

registerBlockType(metadata, {
  icon: pluginIcon,

  edit({ attributes, setAttributes }) {
    const { videoUrl, videoId, videoService } = attributes

    function setVideoDetails(newUrl) {
      const { id: newId, service: newService } = getVideoId(newUrl)
      setAttributes({
        videoUrl: newUrl,
        videoId: newId,
        videoService: newService,
      })
    }

    return (
      <div {...useBlockProps()}>
        <Placeholder
          icon={<BlockIcon icon={pluginIcon} />}
          label={__('Protected Video', 'protected-video')}
          instructions={__(
            'Paste the URL of a YouTube or Vimeo video you want to display in a protected player.',
            'protected-video'
          )}
        >
          <TextControl
            label={__('Video URL', 'protected-video')}
            value={videoUrl}
            onChange={setVideoDetails}
            placeholder={__(
              'e.g. https://youtu.be/c_hO_fjmMnk',
              'protected-video'
            )}
          />
          {videoId && (
            <div>
              <img
                src={getVideoThumb(videoService, videoId)}
                width="320"
                height="180"
                alt={__('Video thumbnail', 'protected-video')}
              />
            </div>
          )}
          {videoUrl && !videoId && (
            <div>
              {__(
                'Sorry, a video ID could not be found in that URL.',
                'protected-video'
              )}
            </div>
          )}
        </Placeholder>
      </div>
    )
  },

  save({ attributes }) {
    const { videoId, videoService } = attributes

    return (
      <div
        {...useBlockProps.save()}
        data-id1={btoa(videoService)}
        data-id2={btoa(videoId)}
      />
    )
  },

  deprecated: [
    {
      attributes: metadata.attributes,

      save({ attributes }) {
        const { videoId, videoService } = attributes

        return (
          <div
            className="wp-block-protected-video"
            data-plyr-provider={videoService}
            data-plyr-embed-id={videoId}
          />
        )
      },
    },
  ],
})
