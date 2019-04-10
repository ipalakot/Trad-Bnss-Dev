<?php
/**
 * Customizer functions.
 *
 * @package priscila
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'priscila_customizer_sanitize_radio' ) ) :

	/**
	 * Select sanitization callback example.
	 *
	 * - Sanitization: select
	 * - Control: select, radio
	 *
	 * Sanitization callback for 'select' and 'radio' type controls.
	 * This callback sanitizes `$input` as a slug, and then validates `$input` against the choices defined for the control.
	 *
	 * @see sanitize_key()
	 * @link https://developer.wordpress.org/reference/functions/sanitize_key/
	 *
	 * @see $wp_customize->get_control()
	 * @link https://developer.wordpress.org/reference/classes/wp_customize_manager/get_control/
	 *
	 * @param string               $input Slug to sanitize.
	 * @param WP_Customize_Setting $setting Setting instance.
	 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
	 *
	 * @since 1.0.0
	 */
	function priscila_customizer_sanitize_radio( $input, $setting ) {

		/* Ensure input is a slug. */
		$input = sanitize_key( $input );

		/* Get list of choices from the control associated with the setting. */
		$choices = $setting->manager->get_control( $setting->id )->choices;

		/* If the input is a valid key, return it; otherwise, return the default. */
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

	}

endif;

if ( ! function_exists( 'priscila_customizer_sanitize_checkbox' ) ) :

	/**
	 * Checkbox sanitization callback example.
	 *
	 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
	 * as a boolean value, either true or false.
	 *
	 * @param bool $checked Whether the checkbox is checked.
	 * @return bool Whether the checkbox is checked.
	 *
	 * @since 1.0.0
	 */
	function priscila_customizer_sanitize_checkbox( $checked ) {

		/* Boolean check. */
		return ( ( isset( $checked ) && true === $checked ) ? true : false );

	}

endif;

if ( ! function_exists( 'priscila_sanitize_html' ) ) :

	/**
	 * HTML sanitization callback example.
	 *
	 * - Sanitization: html
	 * - Control: text, textarea
	 *
	 * Sanitization callback for 'html' type text inputs. This callback sanitizes `$html`
	 * for HTML allowable in posts.
	 *
	 * NOTE: wp_filter_post_kses() can be passed directly as `$wp_customize->add_setting()`
	 * 'sanitize_callback'. It is wrapped in a callback here merely for example purposes.
	 *
	 * @see wp_filter_post_kses() https://developer.wordpress.org/reference/functions/wp_filter_post_kses/
	 *
	 * @param string $html HTML to sanitize.
	 * @return string Sanitized HTML.
	 */
	function priscila_sanitize_html( $html ) {

		return wp_filter_post_kses( $html );

	}

endif;
