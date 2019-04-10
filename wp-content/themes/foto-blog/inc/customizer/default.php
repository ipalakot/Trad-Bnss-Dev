<?php
/**
 * Default theme options.
 *
 * @package Foto Blog
 */

if ( ! function_exists( 'foto_blog_get_default_theme_options' ) ) :

	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
function foto_blog_get_default_theme_options() {

	$defaults = array();

    $defaults['show_header_social_links'] 	= true;
    $defaults['header_social_links']		= array();

	// Featured Slider Section
	$defaults['disable_featured_slider']		= true;
	$defaults['number_of_sr_items']				= 3;
	$defaults['featured_slider_speed']			= 1500;
	$defaults['sr_content_type']				= 'sr_page';

	// About Author Section
	$defaults['disable_about_author_section']	= true;
	$defaults['number_of_ss_items']				= 3;
	$defaults['ss_content_type']				= 'ss_page';

	//General Section
	$defaults['readmore_text']					= esc_html__('Continue Reading','foto-blog');
	$defaults['excerpt_length']					= 25;
	$defaults['layout_options_blog']			= 'no-sidebar';
	$defaults['layout_options_archive']			= 'no-sidebar';
	$defaults['layout_options_page']			= 'right-sidebar';	
	$defaults['layout_options_single']			= 'right-sidebar';	
	$defaults['layout_options_boxed']			= 'full-width';		

	//Footer section 		
	$defaults['copyright_text']				= esc_html__( 'Copyright &copy; All rights reserved.', 'foto-blog' );

	// Pass through filter.
	$defaults = apply_filters( 'foto_blog_filter_default_theme_options', $defaults );
	return $defaults;
}

endif;

/**
*  Get theme options
*/
if ( ! function_exists( 'foto_blog_get_option' ) ) :

	/**
	 * Get theme option
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	function foto_blog_get_option( $key ) {

		$default_options = foto_blog_get_default_theme_options();
		if ( empty( $key ) ) {
			return;
		}

		$theme_options = (array)get_theme_mod( 'theme_options' );
		$theme_options = wp_parse_args( $theme_options, $default_options );

		$value = null;

		if ( isset( $theme_options[ $key ] ) ) {
			$value = $theme_options[ $key ];
		}

		return $value;

	}

endif;