import MicroModal from 'micromodal';

MicroModal.init( {
	onShow: async ( modal, el, triggerEv ) => {
		autoIframeVimeo( modal, el, triggerEv );
		autoIframeModal( modal, el, triggerEv );
	}, // [1]
	onClose: ( modal ) => {
		// modal.querySelector( '.modal__container' ).classList.remove( 'is-ready' );
		const iframe = modal.querySelector( 'iframe' );
		if ( iframe ) {
			iframe.remove();
		}
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

async function autoIframeVimeo( modal, el, triggerEv ) {
	const videoTrigger = triggerEv.target.closest( '[data-video-url]' );
	let videoUrl = videoTrigger && videoTrigger.getAttribute( 'data-video-url' );
	if ( videoUrl && videoUrl.length ) {
		videoUrl = isValidCanvaUrl( videoUrl );
		// const resp = await fetch( `https://vimeo.com/api/oembed.json?url=${ videoUrl }` );
		// const video = resp.ok && await resp.json();
		const video = false; // unused - but might be if we use Vimeo (above)
		const iframe = document.createElement( 'iframe' );
		const container = modal.querySelector( '.modal__container' );
		const main = modal.querySelector( 'main' );

		iframe.onload = function() {
			// container.classList.add( 'is-ready' );
		};

		iframe.setAttribute( 'allow', 'autoplay' );
		iframe.classList.add( 'responsive_embed' );
		iframe.setAttribute( 'style', `width: 100%; aspect-ratio:${ video.width || 16 }/${ video.height || 9 }` );
		iframe.src = videoUrl;
		// iframe.src = `https://player.vimeo.com/video/${ video.video_id }?app_id=122963&badge=0&vimeo_logo=false&title=false&autoplay=1&byline=false&responsive=true`;
		// iframe.src = `https://www.canva.com/design/DAGIoM35H1w/fumRJ552w3BTDbIdlSle9w/watch?embed`;
		// iframe.src = `https://www.canva.com/design/DAGIPuaZxqg/FHEixGSbK7vev6ZjdNBI0Q/watch?embed`;
		main.append( iframe );
		container.classList.add( 'is-ready' );
	}
}

async function autoIframeModal( modal ) {
	const iframeUrl = modal.getAttribute( 'data-iframe-url' );
	if ( iframeUrl && iframeUrl.length ) {
		const iframe = document.createElement( 'iframe' );
		const container = modal.querySelector( '.modal__container' );
		const content = modal.querySelector( '.modal__content' );

		iframe.onload = function() {
			// container.classList.add( 'is-ready' );
		};

		iframe.setAttribute( 'style', `width:100%;height:100%;border:hidden;` );
		iframe.src = iframeUrl;
		content.append( iframe );
		container.classList.add( 'is-ready' );
	}
}

function isValidCanvaUrl( url ) {
	const isCanva = url.match( /canva/ ) !== null;

	const isCanvaURL = isCanva && new URL( url );
	isCanvaURL.searchParams.set( 'embed', '' );

	// add the embed parameter to canva urls
	return isCanva ? isCanvaURL.href : false;
}
