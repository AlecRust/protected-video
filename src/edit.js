import { __ } from '@wordpress/i18n'
import { useBlockProps, BlockIcon } from '@wordpress/block-editor' // eslint-disable-line no-unused-vars
import { Placeholder, TextControl, Notice } from '@wordpress/components' // eslint-disable-line no-unused-vars
import { pluginIcon } from './icons'
import getVideoId from 'get-video-id'

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss'

/**
 * The edit function describes the structure of the block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit({ attributes, setAttributes }) {
  const { videoUrl, videoId, videoService } = attributes

  function handleVideoUrlChange(newUrl) {
    const { id: newId, service: newService } = getVideoId(newUrl)
    setAttributes({
      videoUrl: newUrl,
      videoId: newId,
      videoService: newService,
    })
  }

  function renderVideoThumb() {
    const thumbUrls = {
      youtube: `https://i.ytimg.com/vi/${videoId}/mqdefault.jpg`,
      vimeo: `https://vumbnail.com/${videoId}.jpg`,
    }

    return (
      <img
        src={thumbUrls[videoService]}
        width="320"
        height="180"
        alt={__('Video thumbnail', 'protected-video')}
      />
    )
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
          onChange={handleVideoUrlChange}
          placeholder={__(
            'e.g. https://youtu.be/c_hO_fjmMnk',
            'protected-video'
          )}
        />
        {videoUrl && (
          <div>
            {videoId ? (
              renderVideoThumb()
            ) : (
              <Notice status="error" isDismissible={false}>
                {__(
                  'Sorry, a video ID could not be found in that URL.',
                  'protected-video'
                )}
              </Notice>
            )}
          </div>
        )}
      </Placeholder>
    </div>
  )
}
