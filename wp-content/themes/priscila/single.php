<?php
/**
 * The template for displaying all single posts.
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

	get_template_part( 'loop' );

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
