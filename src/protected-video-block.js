import { __ } from '@wordpress/i18n'
import { useBlockProps, BlockIcon } from '@wordpress/block-editor' // eslint-disable-line no-unused-vars
import { Placeholder, TextControl } from '@wordpress/components' // eslint-disable-line no-unused-vars
import { registerBlockType } from '@wordpress/blocks'
import getVideoId from 'get-video-id'
import metadata from './block.json'

registerBlockType(metadata, {
  edit({ attributes, setAttributes }) {
    const { videoUrl, videoId, videoService, cannotEmbed } = attributes

    function onChangeVideoUrl(newVideoUrl) {
      const videoIdAndService = getVideoId(newVideoUrl)
      setAttributes({
        videoUrl: newVideoUrl,
        videoId: videoIdAndService.id,
        videoService: videoIdAndService.service,
        cannotEmbed: newVideoUrl && !videoIdAndService.id,
      })
    }

    function thumbUrl() {
      if (videoService === 'youtube') {
        return `https://i.ytimg.com/vi/${videoId}/mqdefault.jpg`
      }
      if (videoService === 'vimeo') {
        return `https://vumbnail.com/${videoId}.jpg`
      }
    }

    return (
      <div {...useBlockProps()}>
        <Placeholder
          icon={<BlockIcon icon="lock" />}
          label={__('Protected Video', 'protected-video')}
          instructions={__(
            'Paste the URL of a YouTube or Vimeo video you want to display in a protected player.',
            'protected-video',
          )}
        >
          <TextControl
            label={__('Video URL', 'protected-video')}
            value={videoUrl}
            onChange={onChangeVideoUrl}
            placeholder={__(
              'e.g. https://youtu.be/c_hO_fjmMnk',
              'protected-video',
            )}
          />
          {videoId && (
            <div>
              <img
                src={thumbUrl()}
                width="320"
                height="180"
                alt={__('Video thumbnail', 'protected-video')}
              />
            </div>
          )}
          {cannotEmbed && (
            <div>
              {__(
                'Sorry, a video ID could not be found in that URL.',
                'protected-video',
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
