import { registerBlockType } from '@wordpress/blocks';

const Edit = ( { attributes, setAttributes } ) => {
	return (
		<>
			<form
				role='search'
				method='get'
			>
				<input
					type='search'
					placeholder='Search Events'
					name='s'
					value=''
				/>
				<input
					type='hidden'
					name='post_type'
					value='event'
				/>
				<button class='button button--primary button--inline-submit'>
					submit
				</button>
			</form>
		</>
	);
};

const Save = () => {
	return null; // Dynamic block, PHP handles rendering
};

registerBlockType( 'byniko/event-search-widget', {
	edit: Edit,
	save: Save,
} );
