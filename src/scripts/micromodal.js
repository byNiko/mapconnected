import MicroModal from 'micromodal';

MicroModal.init( {
	onShow: async ( modal ) => {
		autoIframeVimeo( modal );
	}, // [1]
	onClose: ( modal ) => {
		// modal.querySelector( '.modal__container' ).classList.remove( 'is-ready' );
		modal.querySelector( 'iframe' ).remove();
	}, // [2]
	// openTrigger: 'data-custom-open', // [3]
	// closeTrigger: 'data-custom-close', // [4]
	openClass: 'is-open', // [5]
	disableScroll: true, // [6]
	disableFocus: false, // [7]
	awaitOpenAnimation: false, // [8]
	awaitCloseAnimation: false, // [9]
	debugMode: true, // [10]
} );

async function autoIframeVimeo( modal ) {
	const videoUrl = modal.getAttribute( 'data-video-url' );
	if ( videoUrl.length ) {
		const resp = await fetch( `https://vimeo.com/api/oembed.json?url=${ videoUrl }` );
		const video = resp.ok && await resp.json();
		const iframe = document.createElement( 'iframe' );
		const container = modal.querySelector( '.modal__container' );
		const main = modal.querySelector( 'main' );

		iframe.onload = function() {
			// container.classList.add( 'is-ready' );
		};

		iframe.setAttribute( 'allow', 'autoplay' );
		iframe.classList.add( 'responsive_embed' );
		iframe.setAttribute( 'style', `width: 100%; aspect-ratio:${ video.width || 16 }/${ video.height || 9 }` );
		iframe.src = `https://player.vimeo.com/video/${ video.video_id }?app_id=122963&badge=0&vimeo_logo=false&title=false&autoplay=1&byline=false&responsive=true`;
		iframe.src = `https://www.canva.com/design/DAGIoM35H1w/fumRJ552w3BTDbIdlSle9w/watch?embed`;
		iframe.src = `https://www.canva.com/design/DAGIPuaZxqg/FHEixGSbK7vev6ZjdNBI0Q/watch?embed`;
		main.append( iframe );
		container.classList.add( 'is-ready' );
	}
}
