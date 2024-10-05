const state = {
	navIsActive: false,
};
const siteContent = document.querySelector( '.site-content' );
const button = document.querySelector( '.menu-toggle' );
button.addEventListener( 'click', toggleNav );
siteContent.addEventListener( 'click', ( e ) => {
	if ( state.navIsActive ) {
		state.navIsActive = false;
		button.classList.remove( 'is-active' );
		primaryNav.classList.remove( 'is-active' );
	}
} );
const primaryNav = document.querySelector( '.primary-navbar' );
function toggleNav( e ) {
	state.navIsActive = ! state.navIsActive;
	e.target.closest( '.hamburger' ).classList.toggle( 'is-active' );
	primaryNav.classList.toggle( 'is-active' );
}
