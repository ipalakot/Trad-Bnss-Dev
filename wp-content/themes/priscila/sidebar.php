<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package priscila
 * @since 1.0.0
 */

if ( is_active_sidebar( 'primary' ) ) :

	/**
	 * Displays the primary sidebar.
	 *
	 * @see priscila_primary_sidebar_start - 10
	 * @see priscila_primary_sidebar_widgets - 20
	 * @see priscila_primary_sidebar_end - 30
	 *
	 * @since 1.0.0
	 */

	do_action( 'priscila_primary_sidebar' );

endif;
