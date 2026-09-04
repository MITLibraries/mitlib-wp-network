const wpConfig = require( '@wordpress/scripts/config/eslint.config.cjs' );

// When we are ready to apply linting to the hours loader script, update the ignores: line appropriately.
module.exports = [
	...wpConfig,
	{
		ignores: [ 'js/**' ],
	},
];
