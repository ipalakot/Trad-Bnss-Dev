<?php
/**
 * Slider settings.
 *
 * Sets the order in which posts are displayed, where these posts are displayed, and whether the slides change automatically.
 *
 * @package priscila
 * @since 1.0.0
 */

if ( ! class_exists( 'Priscila_Customizer_Slider' ) ) :

	/**
	 * Priscila_Customizer_Slider
	 *
	 * @since 1.0.0
	 */
	class Priscila_Customizer_Slider {

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

			add_action( 'customize_register', array( $this, 'slider' ) );

		}

		/**
		 * Slider settings.
		 *
		 * @since 1.0.0
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function slider( $wp_customize ) {

			/* Sets slider orderby. */
			$wp_customize->add_setting(
				'priscila_slider_orderby',
				array(
					'default'           => 'rand',
					'transport'         => 'refresh',
					'sanitize_callback' => 'priscila_customizer_sanitize_radio',
				)
			);

			$wp_customize->add_control(
				'priscila_slider_orderby',
				array(
					'label'       => esc_html__( 'Set the display order of posts.', 'priscila' ),
					'description' => esc_html__( 'Sticky posts are the first. ', 'priscila' ),
					'section'     => 'priscila_slider',
					'settings'    => 'priscila_slider_orderby',
					'type'        => 'radio',
					'choices'     => array(
						'rand'      => esc_html__( 'Random', 'priscila' ),
						'post_date' => esc_html__( 'Order based on the date', 'priscila' ),
					),
				)
			);

			/* Sets where the slider is displayed. */
			$wp_customize->add_setting(
				'priscila_slider_where',
				array(
					'default'           => 'homepage_posts_page',
					'transport'         => 'refresh',
					'sanitize_callback' => 'priscila_customizer_sanitize_radio',
				)
			);

			$wp_customize->add_control(
				'priscila_slider_where',
				array(
					'label'    => esc_html__( 'Set on which pages the slider is displayed.', 'priscila' ),
					'section'  => 'priscila_slider',
					'settings' => 'priscila_slider_where',
					'type'     => 'radio',
					'choices'  => array(
						'homepage_posts_page' => esc_html__( 'Homepage & Posts Page', 'priscila' ),
						'homepage'            => esc_html__( 'Homepage', 'priscila' ),
						'posts_page'          => esc_html__( 'Posts Page', 'priscila' ),
						'hidden'              => esc_html__( 'Hide the slider', 'priscila' ),
					),
				)
			);

			/* Sets whether the slider works automatically. */
			$wp_customize->add_setting(
				'priscila_slider_autoplay',
				array(
					'default'           => true,
					'sanitize_callback' => 'priscila_customizer_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				'priscila_slider_autoplay',
				array(
					'label'       => esc_html__( 'Change the slide automatically.', 'priscila' ),
					'description' => esc_html__( 'The slide changes every 5 seconds.', 'priscila' ),
					'section'     => 'priscila_slider',
					'settings'    => 'priscila_slider_autoplay',
					'type'        => 'checkbox',
				)
			);

		}

	}

	/* Get instance. */
	Priscila_Customizer_Slider::get_instance();

endif;
