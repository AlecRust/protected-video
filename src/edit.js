import { BlockIcon, useBlockProps } from '@wordpress/block-editor';
import { Notice, Placeholder, TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import getVideoId from 'get-video-id';
import { pluginIcon } from './icons';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of the block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @param {Object}   props               Component props.
 * @param {Object}   props.attributes    Block attributes.
 * @param {Function} props.setAttributes Updates block attributes.
 * @return {Element} Element to render.
 */
export default function Edit( props ) {
	const { attributes, setAttributes } = props;
	const { videoUrl, videoId, videoService } = attributes;

	function handleVideoUrlChange( newUrl ) {
		const { id: newId, service: newService } = getVideoId( newUrl );
		setAttributes( {
			videoUrl: newUrl,
			videoId: newId,
			videoService: newService,
		} );
	}

	function renderVideoThumb() {
		const thumbUrls = {
			youtube: `https://i.ytimg.com/vi/${ videoId }/mqdefault.jpg`,
			vimeo: `https://vumbnail.com/${ videoId }.jpg`,
		};

		return (
			<img
				src={ thumbUrls[ videoService ] }
				width="320"
				height="180"
				alt={ __( 'Video thumbnail', 'protected-video' ) }
			/>
		);
	}

	return (
		<div { ...useBlockProps() }>
			<Placeholder
				icon={ <BlockIcon icon={ pluginIcon } /> }
				label={ __( 'Protected Video', 'protected-video' ) }
				instructions={ __(
					'Paste the URL of a YouTube or Vimeo video you want to display in a protected player.',
					'protected-video'
				) }
			>
				<TextControl
					label={ __( 'Video URL', 'protected-video' ) }
					value={ videoUrl }
					onChange={ handleVideoUrlChange }
					placeholder={ __(
						'e.g. https://youtu.be/aqz-KE-bpKQ',
						'protected-video'
					) }
				/>
				{ videoUrl && (
					<div>
						{ videoId ? (
							renderVideoThumb()
						) : (
							<Notice status="error" isDismissible={ false }>
								{ __(
									'Sorry, a video ID could not be found in that URL.',
									'protected-video'
								) }
							</Notice>
						) }
					</div>
				) }
			</Placeholder>
		</div>
	);
}
