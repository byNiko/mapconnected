import gsap from './vendor/gsap/index';
import ScrollTrigger from './vendor/gsap/ScrollTrigger';
gsap.registerPlugin( ScrollTrigger );

const target = document.querySelector( '.secondary-nav__wrapper' );

if ( target ) {
	const st = ScrollTrigger.create( {
		onToggle: ( self ) => {
			// self.pin.classList.toggle( 'is-pinned' );
		},
		toggleClass: 'is-pinned',
		trigger: target,
		pin: true,
		start: 'top top',
		endTrigger: '.site-footer',
		end: 'top center',
		pinSpacing: false,
		// markers: true,
	} );
}
