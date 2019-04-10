/**
 * Makes premium notification active.
 *
 * @package priscila
 * @since 1.0.0
 */

( function( api ) {

	api.sectionConstructor[ 'premium' ] = api.Section.extend(
		{
			/* Always make the section active. */
			isContextuallyActive: function () {
				return true;
			}
		}
	);

} )( wp.customize );
