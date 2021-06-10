import { __ } from '@wordpress/i18n'
import { BlockIcon } from '@wordpress/block-editor' // eslint-disable-line no-unused-vars
import { Fragment } from '@wordpress/element' // eslint-disable-line no-unused-vars
import { Placeholder, TextControl } from '@wordpress/components' // eslint-disable-line no-unused-vars
import { registerBlockType } from '@wordpress/blocks'
import getVideoId from 'get-video-id'

registerBlockType('protected-video/protected-video', {
  title: __('Protected Video', 'protected-video'),
  description: __(
    'YouTube/Vimeo player that prevents easy sharing of the video.',
    'protected-video'
  ),
  icon: 'lock',
  category: 'embed',
  attributes: {
    videoUrl: { type: 'string' },
    videoId: { type: 'string' },
    videoService: { type: 'string' },
  },

  edit({ attributes, setAttributes }) {
    const { videoUrl, videoId, videoService } = attributes

    function onChangeVideoUrl(newVideoUrl) {
      const videoIdAndService = getVideoId(newVideoUrl)
      setAttributes({
        videoUrl: newVideoUrl,
        videoId: videoIdAndService.id,
        videoService: videoIdAndService.service,
      })
    }

    function thumbUrl() {
      if (videoService == 'youtube') {
        return `https://i.ytimg.com/vi/${videoId}/mqdefault.jpg`
      }
      if (videoService == 'vimeo') {
        return `https://i.vimeocdn.com/video/${videoId}_320x180`
      }
    }

    return (
      <Fragment>
        <Placeholder
          icon={<BlockIcon icon="lock" />}
          label={__('Protected Video', 'protected-video')}
          className="wp-block-protected-video"
          instructions={__(
            'Paste a link to a YouTube or Vimeo video you want to display in a protected player.',
            'protected-video'
          )}
        >
          <TextControl
            label={__('YouTube or Vimeo URL', 'protected-video')}
            value={videoUrl}
            onChange={onChangeVideoUrl}
            placeholder={__(
              'e.g. https://youtu.be/c_hO_fjmMnk',
              'protected-video'
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
        </Placeholder>
      </Fragment>
    )
  },

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
})
