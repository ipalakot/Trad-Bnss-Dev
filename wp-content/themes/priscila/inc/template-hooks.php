<?php
/**
 * Custom hooks for priscila theme.
 *
 * @since 1.0.0
 *
 * @package priscila
 */

// Before Header.
add_action( 'priscila_before_header', 'priscila_skip_links', 10 );

// Header.
add_action( 'priscila_header', 'priscila_header_social_media', 10 );
add_action( 'priscila_header', 'priscila_header_identity', 20 );
add_action( 'priscila_header', 'priscila_header_primary_navigation', 30 );

/* Before Content. */
add_action( 'priscila_before_content', 'priscila_site_content_start', 10 );
add_action( 'priscila_before_content', 'priscila_content_slider', 20 );

/* Before Content Area. */
add_action( 'priscila_before_content_area', 'priscila_main_content_area_start', 10 );

/* Content Area Post. */
add_action( 'priscila_content_area_post', 'priscila_content_area_post_start', 10 );

/* Content Area Single Post. */
add_action( 'priscila_content_area_single_post', 'priscila_content_area_single_post_start', 10 );

/* After Content Area Single Post. */
add_action( 'priscila_after_content_area_single_post', 'priscila_single_post_navigation', 10 );

/* Content Area Page. */
add_action( 'priscila_content_area_page', 'priscila_content_area_page_start', 10 );

/* Content Area Search. */
add_action( 'priscila_content_area_search', 'priscila_content_area_search_start', 10 );

/* Content Area Attachment. */
add_action( 'priscila_content_area_attachment', 'priscila_content_area_attachment_start', 10 );

/* After Content Area. */
add_action( 'priscila_after_content_area', 'priscila_main_content_area_end', 10 );

/* After Content. */
add_action( 'priscila_after_content', 'priscila_site_content_end', 10 );

/* Before Comments. */
add_action( 'priscila_comments', 'priscila_comments_start', 10 );

/* 404 Page. */
add_action( 'priscila_404_area', 'priscila_404_area_start', 10 );

/* Not found. */
add_action( 'priscila_not_found_area', 'priscila_not_found_area_start', 10 );

/* Primary Sidebar. */
add_action( 'priscila_primary_sidebar', 'priscila_primary_sidebar_start', 10 );

/* Footer. */
add_action( 'priscila_footer', 'priscila_footer_start', 10 );
