( () => {
	const modalId = new URLSearchParams( window.location.search ).get( 'modal_id' );
	const target = document.querySelector( `#${ modalId }` );
	if ( target ) {
		setTimeout( () => {
			MicroModal.show( modalId );
		}, 500 );
	}
} )();

