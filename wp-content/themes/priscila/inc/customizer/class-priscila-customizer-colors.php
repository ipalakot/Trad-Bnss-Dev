<?php
/**
 * Color settings.
 *
 * Sets the headings, text & accent color.
 *
 * @package priscila
 * @since 1.0.0
 */

if ( ! class_exists( 'Priscila_Customizer_Colors' ) ) :

	/**
	 * Priscila_Customizer_Colors
	 *
	 * @since 1.0.0
	 */
	class Priscila_Customizer_Colors {

		/**
		 * Instance
		 *
		 * @access private
		 * @var object Class object.
		 *
		 * @since 1.0.0
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @return object initialized object of class.
		 *
		 * @since 1.0.0
		 */
		public static function get_instance() {

			if ( ! isset( self::$instance ) ) :

				self::$instance = new self();

			endif;

			return self::$instance;

		}

		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			add_action( 'customize_register', array( $this, 'colors' ) );

		}

		/**
		 * Color settings.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 *
		 * @since 1.0.0
		 */
		public function colors( $wp_customize ) {

			/* Sets accent color. */
			$wp_customize->add_setting(
				'priscila_accent_color',
				array(
					'default'           => '#BB5A44',
					'transport'         => 'refresh',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'priscila_accent_color',
					array(
						'description' => esc_html__( 'Accent color.', 'priscila' ),
						'section'     => 'priscila_colors',
					)
				)
			);

			/* Sets accent color on hover. */
			$wp_customize->add_setting(
				'priscila_accent_color_hover',
				array(
					'default'           => '#964836',
					'transport'         => 'refresh',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'priscila_accent_color_hover',
					array(
						'description' => esc_html__( 'Accent color on hover.', 'priscila' ),
						'section'     => 'priscila_colors',
					)
				)
			);

			/* Sets heading color. */
			$wp_customize->add_setting(
				'priscila_heading_color',
				array(
					'default'           => '#404040',
					'transport'         => 'refresh',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'priscila_heading_color',
					array(
						'description' => esc_html__( 'Heading color.', 'priscila' ),
						'section'     => 'priscila_colors',
					)
				)
			);

			/* Sets text color. */
			$wp_customize->add_setting(
				'priscila_text_color',
				array(
					'default'           => '#767676',
					'transport'         => 'refresh',
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'priscila_text_color',
					array(
						'description' => esc_html__( 'Text color.', 'priscila' ),
						'section'     => 'priscila_colors',
					)
				)
			);

		}

	}

	/* Get instance. */
	Priscila_Customizer_Colors::get_instance();

endif;
