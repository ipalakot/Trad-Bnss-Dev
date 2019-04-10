<?php
/**
 * The template for displaying search results pages.
 *
 * @package priscila
 * @since 1.0.0
 */

get_header();

/**
 * Displays the beggining of the content area.
 *
 * @see priscila_main_content_area_start
 *
 * @since 1.0.0
 */

do_action( 'priscila_before_content_area' );

if ( have_posts() ) :

	priscila_page_header( 'search' );

	get_template_part( 'loop' );

	the_posts_navigation();

else :

	/**
	 * Displays not found area.
	 *
	 * @see priscila_not_found_area_start - 10
	 * @see priscila_not_found_area_content - 20
	 * @see priscila_not_found_area_end - 30
	 *
	 * @since 1.0.0
	 */

	do_action( 'priscila_not_found_area' );

endif;

/**
 * Displays the end of the content area.
 *
 * @see priscila_main_content_area_end
 *
 * @since 1.0.0
 */

do_action( 'priscila_after_content_area' );

get_sidebar();
get_footer();
