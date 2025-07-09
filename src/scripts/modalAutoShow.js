( () => {
	const modalId = new URLSearchParams( window.location.search ).get( 'modal' );

	const target = document.querySelector( `#${ modalId }` );
	if ( target ) {
		setTimeout( () => {
			MicroModal.show( modalId );
		}, 1000 );
	}
} )();

