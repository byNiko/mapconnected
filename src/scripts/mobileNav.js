const button = document.querySelector( '.menu-toggle' );
button.addEventListener( 'click', toggleNav );
const primaryNav = document.querySelector( '.primary-navbar' );
function toggleNav( e ) {
	e.target.closest( '.hamburger' ).classList.toggle( 'is-active' );
	primaryNav.classList.toggle( 'is-active' );
}
