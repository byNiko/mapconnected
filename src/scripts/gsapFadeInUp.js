import gsap from './vendor/gsap/index';
import ScrollTrigger from './vendor/gsap/ScrollTrigger';
gsap.registerPlugin( ScrollTrigger );

gsap.defaults( { ease: 'power3' } );
gsap.set( '.fade_in_up', { y: 30, scale: 0.98, opacity: 0 } );

ScrollTrigger.batch( '.fade_in_up', {
	// end: 'center center',
	// interval: 1,
	// batchMax: 13,
	// start: 'top+=50px bottom-=50px',
	onEnter: ( item ) => {
		gsap.to( item, {

			duration: 2.5,
			stagger: 0.21,
			opacity: 1,
			y: 0,
			scale: 1,
		} );
	},
	markers: false,
} );

ScrollTrigger.batch( '.fade_in', {
	onEnter: ( batch ) => gsap.to( batch, { opacity: 1, stagger: 0.1 } ),
} );
