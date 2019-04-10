<?php
/**
 * @package Multipurpose Portfolio
 * @subpackage multipurpose-portfolio
 * Setup the WordPress core custom header feature.
 *
 * @uses multipurpose_portfolio_header_style()
*/

function multipurpose_portfolio_custom_header_setup() {

	add_theme_support( 'custom-header', apply_filters( 'multipurpose_portfolio_custom_header_args', array(
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1284,
		'height'                 => 162,
		'wp-head-callback'       => 'multipurpose_portfolio_header_style',
	) ) );
}

add_action( 'after_setup_theme', 'multipurpose_portfolio_custom_header_setup' );

if ( ! function_exists( 'multipurpose_portfolio_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see multipurpose_portfolio_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'multipurpose_portfolio_header_style' );
function multipurpose_portfolio_header_style() {
	//Check if user has defined any header image.
	if ( get_header_image() ) :
	$custom_css = "
        #header{
			background-image:url('".esc_url(get_header_image())."');
			background-position: center top;
		}";
	   	wp_add_inline_style( 'multipurpose-portfolio-basic-style', $custom_css );
	endif;
}
endif; //multipurpose_portfolio_header_style