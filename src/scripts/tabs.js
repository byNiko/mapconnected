const createTabs = ( tabContainers ) => {
	const tabId = new URLSearchParams( window.location.search ).get( 'tab_id' );
	// history.replaceState( { tab_id: tabId }, null, null );

	// Selecting header and content containers
	const headerContainer = document.querySelector( '.tabs-header' );
	const contentContainer = document.querySelector( '.tabs-content' );

	// Converting HTML collections to arrays
	const tabHeaders = [ ...headerContainer.children ];
	const tabContents = [ ...contentContainer.children ];

	// Hide all tab contents
	tabContents.forEach( ( content ) => ( content.style.display = 'none' ) );

	let currentTabIndex = -1;

	// function getTabIndex( tab_id ) {
	// 	let tabIndex;
	// 	tabHeaders.forEach( ( el, i ) => {
	// 		if ( el.id === tab_id ) {
	// 			tabIndex = i;
	// 			return i;
	// 		}
	// 		return false;
	// 	} );
	// 	return tabIndex;
	// }

	// window.addEventListener( 'popstate', ( event ) => {
	// 	if ( event.state.tab_id ) {
	// 		const index = getTabIndex( event.state.tab_id );
	// 		setTab( event.state[ index ] );
	// 	}
	// 	if ( event.state.tab_index ) {
	// 		setTab( event.state.tab_index );
	// 	}
	// } );

	const setTab = ( index ) => {
		// Remove active class and hide previous tab content
		if ( currentTabIndex > -1 ) {
			tabHeaders[ currentTabIndex ].classList.remove( 'active' );
			tabContents[ currentTabIndex ].style.display = 'none';
		}
		// Add active class and display selected tab content
		tabHeaders[ index ].classList.add( 'active' );
		tabContents[ index ].style.display = 'block';

		// Update currentTabIndex
		currentTabIndex = index;
	};

	// Determine default tab index
	let defaultTabIndex = tabHeaders.findIndex( ( header ) => {
		return tabId
			? header.id === tabId
			: header.classList.contains( 'default-tab' );
	}
	);
	defaultTabIndex = defaultTabIndex === -1 ? 0 : defaultTabIndex;

	// Set default tab
	setTab( defaultTabIndex );

	// Add click event listeners to tab headers
	tabHeaders.forEach( ( header, index ) => {
		header.addEventListener( 'click', () => {
			setTab( index );
			const newUrl = new URL( window.location );
			newUrl.searchParams.set( 'tab_id', tabHeaders[ index ].id );
			history.replaceState( { tab_id: `${ tabHeaders[ index ].id }`, tab_index: index }, null, newUrl );
		} );
	} );
};

// Select all tab containers and apply createTabs function
const tabContainers = [ ...document.querySelectorAll( '.tabs' ) ];
tabContainers.forEach( createTabs );
