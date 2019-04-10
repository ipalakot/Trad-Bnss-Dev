<?php
/**
 * Custom checkbox control for Customizer.
 *
 * @since 1.0.0
 *
 * @package priscila
 */

if ( ! class_exists( 'Priscila_Customizer_Custom_Checkbox' ) && class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * Priscila_Customizer_Custom_Checkbox.
	 */
	class Priscila_Customizer_Custom_Checkbox extends WP_Customize_Control {

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
		public function render_content() { ?>

			<div class="checkbox_switch">

				<div class="onoffswitch">
				   <input type="checkbox" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" class="onoffswitch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?>>
				   <label class="onoffswitch-label" for="<?php echo esc_attr($this->id); ?>"></label>
				</div>

				<span class="customize-control-title onoffswitch_label"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo wp_kses_post($this->description); ?></p>

			</div>

			<?php
		}

	}

	// Get instance.
	Priscila_Customizer_Custom_Checkbox::get_instance();

endif;
