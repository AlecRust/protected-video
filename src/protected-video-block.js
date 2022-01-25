import { __ } from '@wordpress/i18n'
import { BlockIcon } from '@wordpress/block-editor' // eslint-disable-line no-unused-vars
import { Fragment } from '@wordpress/element' // eslint-disable-line no-unused-vars
import { Placeholder, TextControl } from '@wordpress/components' // eslint-disable-line no-unused-vars
import { registerBlockType } from '@wordpress/blocks'
import getVideoId from 'get-video-id'

const attributes = {
  videoUrl: { type: 'string' },
  videoId: { type: 'string' },
  videoService: { type: 'string' },
  cannotEmbed: { type: 'boolean' },
}

registerBlockType('protected-video/protected-video', {
  title: __('Protected Video', 'protected-video'),
  description: __(
    'YouTube/Vimeo player that prevents easy sharing of the video.',
    'protected-video'
  ),
  icon: 'lock',
  category: 'embed',
  attributes,

  edit(props) {
    const { videoUrl, videoId, videoService, cannotEmbed } = props.attributes

    function onChangeVideoUrl(newVideoUrl) {
      const videoIdAndService = getVideoId(newVideoUrl)
      props.setAttributes({
        videoUrl: newVideoUrl,
        videoId: videoIdAndService.id,
        videoService: videoIdAndService.service,
        cannotEmbed: newVideoUrl && !videoIdAndService.id,
      })
    }

    function thumbUrl() {
      if (videoService == 'youtube') {
        return `https://i.ytimg.com/vi/${videoId}/mqdefault.jpg`
      }
      if (videoService == 'vimeo') {
        return `https://vumbnail.com/${videoId}.jpg`
      }
    }

    return (
      <Fragment>
        <Placeholder
          icon={<BlockIcon icon="lock" />}
          label={__('Protected Video', 'protected-video')}
          className="wp-block-protected-video"
          instructions={__(
            'Paste the URL of a YouTube or Vimeo video you want to display in a protected player.',
            'protected-video'
          )}
        >
          <TextControl
            label={__('Video URL', 'protected-video')}
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
          {cannotEmbed && (
            <div>
              {__(
                'Sorry, a video ID could not be found in that URL.',
                'protected-video'
              )}
            </div>
          )}
        </Placeholder>
      </Fragment>
    )
  },

  save(props) {
    const { videoId, videoService } = props.attributes

    return (
      <div
        className="wp-block-protected-video"
        data-id1={btoa(videoService)}
        data-id2={btoa(videoId)}
      />
    )
  },

  deprecated: [
    {
      attributes,

      save(props) {
        const { videoId, videoService } = props.attributes

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
