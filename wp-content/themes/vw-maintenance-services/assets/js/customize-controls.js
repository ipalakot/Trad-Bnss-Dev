( function( api ) {

	// Extends our custom "vw-maintenance-services" section.
	api.sectionConstructor['vw-maintenance-services'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );