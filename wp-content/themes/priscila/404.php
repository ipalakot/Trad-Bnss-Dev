<?php
/**
 * The template for displaying 404 pages (not found).
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

/**
 * Displays the content of the 404 area.
 *
 * @see priscila_404_area_start - 10
 * @see priscila_404_area_content - 20
 * @see priscila_404_area_end - 30
 *
 * @since 1.0.0
 */

do_action( 'priscila_404_area' );

/**
 * Displays the end of the content area.
 *
 * @see priscila_main_content_area_end
 *
 * @since 1.0.0
 */

do_action( 'priscila_after_content_area' );

get_footer();
