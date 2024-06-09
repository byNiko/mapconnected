/*
 * Splide Initialization
 */
export function initSplide() {
	const updateHeight = ( slider, newIndex ) => {
		const slide = slider.Components.Slides.getAt( typeof ( newIndex ) === 'number' ? newIndex : slider.index ).slide;
		slide.parentElement.parentElement.style.height = slide.offsetHeight + 'px';
	};

	document.addEventListener( 'DOMContentLoaded', function() {
		// Query all sliders
		const splideElements = document.querySelectorAll( '.splide' );

		// Initialize each slider instance
		splideElements.forEach( function( el ) {
			// Retrieve the options from the data-splide attribute
			const options = el.dataset.splide ? JSON.parse( el.dataset.splide ) : {};
			const slider = new Splide( el, options );
			// Initialize slider with the options
			slider.mount();
			if ( options.adaptiveHeight ) {
				slider.on( 'resized move ', () => {
					updateHeight( slider );
				} );
				updateHeight( slider );
			}
		} );
	} );
}
