<?php
/**
 * Footer settings.
 *
 * Sets copyright text.
 *
 * @package priscila
 * @since 1.0.0
 */

if ( ! class_exists( 'Priscila_Customizer_Footer' ) ) :

	/**
	 * Priscila_Customizer_Footer
	 *
	 * @since 1.0.0
	 */
	class Priscila_Customizer_Footer {

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

			add_action( 'customize_register', array( $this, 'footer' ) );

		}

		/**
		 * Footer settings.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 *
		 * @since 1.0.0
		 */
		public function footer( $wp_customize ) {

			/* Copyright text. */
			$wp_customize->add_setting(
				'priscila_copyright_text',
				array(
					'default'           => esc_html__( 'Copyright 2019', 'priscila' ),
					'transport'         => 'refresh',
					'sanitize_callback' => 'priscila_sanitize_html',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'priscila_copyright_text',
					array(
						'label'       => esc_html__( 'Copyright text.', 'priscila' ),
						'description' => esc_html__( 'Enter your own copyright text.', 'priscila' ),
						'type'        => 'text',
						'section'     => 'priscila_footer',
					)
				)
			);

		}

	}

	/* Get instance. */
	Priscila_Customizer_Footer::get_instance();

endif;
