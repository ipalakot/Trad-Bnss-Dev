<?php
/**
 * Theme functions related to structure.
 *
 * This file contains structural hook functions.
 *
 * @package Foto Blog
 */

if ( ! function_exists( 'foto_blog_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since 1.0.0
	 */
function foto_blog_doctype() {
	?><!DOCTYPE html> <html <?php language_attributes(); ?>><?php
}
endif;

add_action( 'foto_blog_action_doctype', 'foto_blog_doctype', 10 );


if ( ! function_exists( 'foto_blog_head' ) ) :
	/**
	 * Header Codes.
	 *
	 * @since 1.0.0
	 */
function foto_blog_head() {
	?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php
}
endif;
add_action( 'foto_blog_action_head', 'foto_blog_head', 10 );

if ( ! function_exists( 'foto_blog_page_start' ) ) :
	/**
	 * Add Skip to content.
	 *
	 * @since 1.0.0
	 */
	function foto_blog_page_start() {
	?><div id="page" class="site"><a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'foto-blog' ); ?></a><?php
	}
endif;

add_action( 'foto_blog_action_before', 'foto_blog_page_start', 10 );

if ( ! function_exists( 'foto_blog_header_start' ) ) :
	/**
	 * Header Start.
	 *
	 * @since 1.0.0
	 */
	function foto_blog_header_start() {

        $show_social  = foto_blog_get_option( 'show_header_social_links' );
  		?>

        <div id="top-bar" class="top-bar-widgets col-2">
            <div class="wrapper">
                <?php if ( $show_social ){ ?>
                    <div class="widget widget_social_icons">
                       <?php foto_blog_render_social_links(); ?>
                    </div><!-- .widget_social_icons -->
                <?php } ?>

                <div class="widget widget_search_form">
                    <ul>
                    	<?php echo get_search_form(); ?>
                    </ul>
                </div><!-- .widget_search_form -->
            </div><!-- .wrapper -->
        </div><!-- #top-bar -->

		<header id="masthead" class="site-header" role="banner"><?php
	}
endif;
add_action( 'foto_blog_action_before_header', 'foto_blog_header_start' );

if ( ! function_exists( 'foto_blog_header_end' ) ) :
	/**
	 * Header Start.
	 *
	 * @since 1.0.0
	 */
	function foto_blog_header_end() {

		?></header> <!-- header ends here --><?php
	}
endif;
add_action( 'foto_blog_action_header', 'foto_blog_header_end', 15 );

if ( ! function_exists( 'foto_blog_content_start' ) ) :
	/**
	 * Header End.
	 *
	 * @since 1.0.0
	 */
	function foto_blog_content_start() { 
	?>
	<div id="content" class="site-content">
	<?php 

	}
endif;

add_action( 'foto_blog_action_before_content', 'foto_blog_content_start', 10 );

if ( ! function_exists( 'foto_blog_footer_start' ) ) :
	/**
	 * Footer Start.
	 *
	 * @since 1.0.0
	 */
	function foto_blog_footer_start() {
		if( !(is_home() || is_front_page()) ){
			echo '</div>';
		} ?>
		</div>
		<footer id="colophon" class="site-footer" role="contentinfo"><?php
	}
endif;
add_action( 'foto_blog_action_before_footer', 'foto_blog_footer_start' );

if ( ! function_exists( 'foto_blog_footer_end' ) ) :
	/**
	 * Footer End.
	 *
	 * @since 1.0.0
	 */
	function foto_blog_footer_end() {?>
		</footer><div class="backtotop"><i class="fa fa-angle-up"></i></div><?php
	}
endif;
add_action( 'foto_blog_action_after_footer', 'foto_blog_footer_end' );
