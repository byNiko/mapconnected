( function() {
	const state = {};
	const targets = document.querySelectorAll( '[data-toggle="collapse"]' );
	targets.forEach( ( t ) => {
		t.addEventListener( 'click', toggleCollapse );
	} );

	function toggleCollapse( el ) {
		const targetId = el.target.dataset.target;
		state[ targetId ] = state[ targetId ] || {
			openText: el.target.innerText,
			closeText: el.target.dataset.toggleText,
			targetEl: document.querySelector( targetId ),
		};

		if ( state[ targetId ].isOpen ) {
			state[ targetId ].targetEl.removeAttribute( 'style' );
			state[ targetId ].targetEl.setAttribute( 'aria-expanded', 'false' );
			el.target.innerText = state[ targetId ].openText;
		} else {
			// find parent's collapsed element's height
			const height = state[ targetId ].targetEl.querySelector( '.collapsed' ).offsetHeight;
			// assign max-height to parent
			state[ targetId ].targetEl.style.maxHeight = `${ height }px`;
			state[ targetId ].targetEl.setAttribute( 'aria-expanded', 'true' );
			el.target.innerText = state[ targetId ].closeText;
		}
		state[ targetId ].isOpen = ! state[ targetId ].isOpen;
	}
}() );
