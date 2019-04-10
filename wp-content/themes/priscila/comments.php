<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments and the comment form.
 *
 * @package priscila
 * @since 1.0.0
 */

if ( post_password_required() ) :

	return;

endif;

if ( have_comments() ) :

	/**
	 * Displays the comments.
	 *
	 * @see priscila_comments_title - 10
	 * @see priscila_comments_navigation - 20
	 * @see priscila_comments_list - 30
	 * @see priscila_comments_navigation - 40
	 * @see priscila_comments_closed_note - 50
	 *
	 * @since 1.0.0
	 */

	do_action( 'priscila_comments' );

endif;
