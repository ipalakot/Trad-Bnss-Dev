<?php
/**
 * Content settings.
 *
 * Sets the sidebar position and the width of the content.
 *
 * @package priscila
 * @since 1.0.0
 */

if ( ! class_exists( 'Priscila_Customizer_Content' ) ) :

	/**
	 * Priscila_Customizer_Content
	 *
	 * @since 1.0.0
	 */
	class Priscila_Customizer_Content {

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

			add_action( 'customize_register', array( $this, 'content' ) );

		}

		/**
		 * Content settings.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 *
		 * @since 1.0.0
		 */
		public function content( $wp_customize ) {

			/* Sets sidebar position. */
			$wp_customize->add_setting(
				'priscila_sidebar_pos',
				array(
					'default'           => 'sidebar-right',
					'transport'         => 'refresh',
					'sanitize_callback' => 'priscila_customizer_sanitize_radio',
				)
			);

			$wp_customize->add_control(
				'priscila_sidebar_pos',
				array(
					'label'    => esc_html__( 'Set the sidebar position or hide it.', 'priscila' ),
					'section'  => 'priscila_content',
					'settings' => 'priscila_sidebar_pos',
					'type'     => 'radio',
					'choices'  => array(
						'sidebar-right'  => esc_html__( 'Right', 'priscila' ),
						'sidebar-left'   => esc_html__( 'Left', 'priscila' ),
						'' => esc_html__( 'Hidden', 'priscila' ),
					),
				)
			);

			/* Sets the width of the content. */
			$wp_customize->add_setting(
				'priscila_layout_width',
				array(
					'default'           => 'content-width-default',
					'transport'         => 'refresh',
					'sanitize_callback' => 'priscila_customizer_sanitize_radio',
				)
			);

			$wp_customize->add_control(
				'priscila_layout_width',
				array(
					'label'       => esc_html__( 'Set the width of the content.', 'priscila' ),
					'description' => esc_html__( 'The "full" option will only work if the sidebar is hidden.', 'priscila' ),
					'section'     => 'priscila_content',
					'settings'    => 'priscila_layout_width',
					'type'        => 'radio',
					'choices'     => array(
						'content-width-default' => esc_html__( 'Default', 'priscila' ),
						'content-width-full'    => esc_html__( 'Full', 'priscila' ),
					),
				)
			);

		}

	}

	/* Get instance. */
	Priscila_Customizer_Content::get_instance();

endif;
