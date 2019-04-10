<?php
/**
 * Structure settings.
 *
 * Adds panels and sections.
 *
 * @package priscila
 * @since 1.0.0
 */

if ( ! class_exists( 'Priscila_Customizer_Structure' ) ) :

	/**
	 * Priscila_Customizer_Structure
	 *
	 * @since 1.0.0
	 */
	class Priscila_Customizer_Structure {

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

			add_action( 'customize_register', array( $this, 'panels' ) );
			add_action( 'customize_register', array( $this, 'sections' ) );

		}

		/**
		 * Adds panels.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 *
		 * @since 1.0.0
		 */
		public function panels( $wp_customize ) {

			$wp_customize->add_panel(
				'priscila_options',
				array(
					'priority' => 10,
					'title'    => esc_html__( 'Priscila Options', 'priscila' ),
				)
			);

		}

		/**
		 * Adds sections.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 *
		 * @since 1.0.0
		 */
		public function sections( $wp_customize ) {

			/* Header section. */
			$wp_customize->add_section(
				'priscila_header',
				array(
					'title'       => esc_html__( 'Header', 'priscila' ),
					'panel'       => 'priscila_options',
					'description' => esc_html__( 'Add social media, set breakpoint for navigation and decide whether to show / hide search engine in navigation.', 'priscila' ),
				)
			);

			/* Slider section. */
			$wp_customize->add_section(
				'priscila_slider',
				array(
					'title'       => esc_html__( 'Slider', 'priscila' ),
					'panel'       => 'priscila_options',
					'description' => esc_html__( 'Set the order in which posts are displayed, where these posts are displayed, and whether the slides change automatically. The maximum number of slides in a free theme is 5. In order for the slide to display, the post must have featured image.', 'priscila' ),
				)
			);

			/* Content section. */
			$wp_customize->add_section(
				'priscila_content',
				array(
					'title'       => esc_html__( 'Content', 'priscila' ),
					'panel'       => 'priscila_options',
					'description' => esc_html__( 'Set the sidebar position and the width of the content.', 'priscila' ),
				)
			);

			/* Footer section. */
			$wp_customize->add_section(
				'priscila_footer',
				array(
					'title'       => esc_html__( 'Footer', 'priscila' ),
					'panel'       => 'priscila_options',
					'description' => esc_html__( 'Sets copyright text.', 'priscila' ),
				)
			);

			/* Colors section. */
			$wp_customize->add_section(
				'priscila_colors',
				array(
					'title'       => esc_html__( 'Colors', 'priscila' ),
					'panel'       => 'priscila_options',
					'description' => esc_html__( 'Sets the headings, text & accent color.', 'priscila' ),
				)
			);

		}

	}

	/* Get instance. */
	Priscila_Customizer_Structure::get_instance();

endif;
