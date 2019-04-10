<?php
/**
 * Theme options.
 *
 * @since 1.0.0
 *
 * @package priscila
 */

if ( ! function_exists( 'priscila_get_options' ) ) :

	/**
	 * Options from Customizer.
	 *
	 * @since 1.0.0
	 */
	function priscila_get_options( $option = '' ) {

		if ( ! $option || $option === 'core' ) :

			// Core.
			$core = array(
				'custom_logo' => get_theme_mod( 'custom_logo' ),
			);

			if ( $option === 'core' ) :

				return $core;

			endif;

		endif;

		if ( ! $option || $option === 'cls' ) :

			// Colors.
			$cls = array(
				'accent_color'       => get_theme_mod( 'priscila_accent_color', '#BB5A44' ),
				'accent_color_hover' => get_theme_mod( 'priscila_accent_color_hover', '#964836' ),
				'heading_color'      => get_theme_mod( 'priscila_heading_color', '#404040' ),
				'text_color'         => get_theme_mod( 'priscila_text_color', '#767676' ),
			);

			if ( $option === 'cls' ) :

				return $cls;

			endif;

		endif;

		if ( ! $option || $option === 'header' ) :

			// Main header.
			$header = array(
				'search_visibility'    => get_theme_mod( 'priscila_header_search_visibility', true ),
				'nav_breakpoint'       => get_theme_mod( 'priscila_header_nav_breakpoint', 992 ),
				'social_media_new_tab' => get_theme_mod( 'priscila_header_social_media_new_tab', false ),
				'social_media'         => get_theme_mod( 'priscila_header_social_media', '' ),
			);

			if ( $option === 'header' ) :

				return $header;

			endif;

		endif;

		if ( ! $option || $option === 'content' ) :

			// Content.
			$content = array(
				'sidebar_pos'               => get_theme_mod( 'priscila_sidebar_pos', 'sidebar-right' ),
				'layout_width'               => get_theme_mod( 'priscila_layout_width', 'content-width-default' ),
			);

			if ( $option === 'content' ) :

				return $content;

			endif;

		endif;

		if ( ! $option || $option === 'footer' ) :

			// Footer.
			$footer = array(
				'copyright_text' => get_theme_mod( 'priscila_copyright_text', esc_html__( 'Copyright 2019', 'priscila' ) ),
			);

			if ( $option === 'footer' ) :

				return $footer;

			endif;

		endif;

		if ( ! $option || $option === 'slider' ) :

			// Slider.
			$slider = array(
				'orderby'  => get_theme_mod( 'priscila_slider_orderby', 'rand' ),
				'where'    => get_theme_mod( 'priscila_slider_where', 'homepage_posts_page' ),
				'autoplay' => get_theme_mod( 'priscila_slider_autoplay', true ),
			);

			if ( $option === 'slider' ) :

				return $slider;

			endif;

		endif;

		$options = array(
			'core'    => $core,
			'cls'     => $cls,
			'header'  => $header,
			'content' => $content,
			'footer'  => $footer,
			'slider'  => $slider,
		);

		return apply_filters( 'priscila_get_options', $options );

	}

endif;
