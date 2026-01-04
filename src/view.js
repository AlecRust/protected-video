/**
 * Public JS that decodes the video ID and provider from
 * the data attributes and initializes Plyr.
 */

import plyrSpriteUrl from './assets/plyr.svg';
import Plyr from 'plyr';

function decodeVideoBlock( videoBlock ) {
	const encodedProvider = videoBlock.dataset.id1;
	const encodedVideoId = videoBlock.dataset.id2;

	if ( ! encodedProvider || ! encodedVideoId ) {
		return null;
	}

	let decodedProvider;
	let decodedVideoId;

	try {
		decodedProvider = atob( encodedProvider );
		decodedVideoId = atob( encodedVideoId );
	} catch {
		return null;
	}

	if ( ! decodedProvider || ! decodedVideoId ) {
		return null;
	}

	// Add attributes that Plyr requires
	// https://github.com/sampotts/plyr/issues/1936
	videoBlock.dataset.plyrProvider = decodedProvider.toLowerCase();
	videoBlock.dataset.plyrEmbedId = decodedVideoId;

	return { provider: decodedProvider, videoId: decodedVideoId };
}

const videoBlocks = document.querySelectorAll(
	'.wp-block-protected-video-protected-video'
);

videoBlocks.forEach( ( videoBlock ) => {
	const decoded = decodeVideoBlock( videoBlock );
	if ( ! decoded ) {
		return;
	}

	const plyrConfig = {
		youtube: {
			noCookie: true,
		},
		iconUrl: plyrSpriteUrl,
	};

	new Plyr( videoBlock, plyrConfig );
} );

// Disable right-click if plugin option enabled
if (
	document.body.classList.contains( 'protected-video-disable-right-click' )
) {
	document.addEventListener( 'contextmenu', ( event ) =>
		event.preventDefault()
	);
}
