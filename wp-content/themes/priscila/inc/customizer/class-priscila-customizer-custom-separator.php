<?php
/**
 * Custom separator control for Customizer.
 *
 * @since 1.0.0
 *
 * @package priscila
 */

if ( ! class_exists( 'Priscila_Customizer_Custom_Separator' ) && class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * Priscila_Customizer_Custom_Separator.
	 */
	class Priscila_Customizer_Custom_Separator extends WP_Customize_Control {

		/**
		 * Instance.
		 *
		 * @access private
		 * @var object Class object.
		 */
		private static $instance;

		/**
		 * Initiator.
		 *
		 * @return object initialized object of class.
		 */
		public static function get_instance() {

			if ( ! isset( self::$instance ) ) :

				self::$instance = new self();

			endif;

			return self::$instance;

		}

		/**
		 * Constructor.
		 */
		public function __construct( $manager = null, $id = null, $args = array() ) {

			parent::__construct( $manager, $id, $args );

		}

		/**
		 * Renders content.
		 */
		public function render_content() {

			echo '<p><hr></p>';

		}

	}

	// Get instance.
	Priscila_Customizer_Custom_Separator::get_instance();

endif;
