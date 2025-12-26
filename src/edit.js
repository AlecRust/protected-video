import { BlockIcon, useBlockProps } from '@wordpress/block-editor';
import { Notice, Placeholder, TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import getVideoId from 'get-video-id';
import { pluginIcon } from './icons';

const SUPPORTED_VIDEO_SERVICES = new Set( [ 'youtube', 'vimeo' ] );

function parseVideoUrl( url ) {
	const parsed = getVideoId( url );

	return {
		id: typeof parsed?.id === 'string' ? parsed.id : '',
		service: typeof parsed?.service === 'string' ? parsed.service : '',
	};
}

function isSupportedVideoService( service ) {
	return SUPPORTED_VIDEO_SERVICES.has( service );
}

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
	const { videoUrl } = attributes;

	const parsedVideo = videoUrl
		? parseVideoUrl( videoUrl )
		: { id: '', service: '' };
	const isSupportedService = isSupportedVideoService( parsedVideo.service );
	const canRenderThumbnail = Boolean( parsedVideo.id ) && isSupportedService;

	function handleVideoUrlChange( newUrl ) {
		const nextUrl = typeof newUrl === 'string' ? newUrl : '';
		const nextVideo = nextUrl ? parseVideoUrl( nextUrl ) : null;
		const isSupported = isSupportedVideoService( nextVideo?.service );

		setAttributes( {
			videoUrl: nextUrl,
			videoId: isSupported ? nextVideo.id : '',
			videoService: isSupported ? nextVideo.service : '',
		} );
	}

	function renderVideoThumb() {
		const thumbUrls = {
			youtube: `https://i.ytimg.com/vi/${ parsedVideo.id }/mqdefault.jpg`,
			vimeo: `https://vumbnail.com/${ parsedVideo.id }.jpg`,
		};

		return (
			<img
				src={ thumbUrls[ parsedVideo.service ] }
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
						{ canRenderThumbnail ? (
							renderVideoThumb()
						) : (
							<Notice status="error" isDismissible={ false }>
								{ parsedVideo.service && ! isSupportedService
									? __(
											'Only YouTube and Vimeo URLs are supported.',
											'protected-video'
									  )
									: __(
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
