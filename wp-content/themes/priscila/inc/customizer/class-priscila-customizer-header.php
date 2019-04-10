<?php
/**
 * Header settings.
 *
 * It adds social media, sets breakpoint for navigation and gives the option to hide the search engine in navigation.
 *
 * @package priscila
 * @since 1.0.0
 */

if ( ! class_exists( 'Priscila_Customizer_Header' ) && class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * Priscila_Customizer_Header
	 *
	 * @since 1.0.0
	 */
	class Priscila_Customizer_Header extends WP_Customize_Control {

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
		 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
		 * @param string               $id Control ID.
		 * @param array                $args Optional. Arguments to override class property defaults.
		 *
		 * @since 1.0.0
		 */
		public function __construct( $manager = null, $id = null, $args = array() ) {

			parent::__construct( $manager, $id, $args );

			$defaults = array(
				'min'  => 0,
				'max'  => 10,
				'step' => 1,
			);

			$args = wp_parse_args( $args, $defaults );

			$this->min  = $args['min'];
			$this->max  = $args['max'];
			$this->step = $args['step'];

			add_action( 'customize_register', array( $this, 'header' ) );

		}

		/**
		 * Header settings.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 *
		 * @since 1.0.0
		 */
		public function header( $wp_customize ) {

			$priority = 10;

			/* Hides or shows navigation. */
			$wp_customize->add_setting(
				'priscila_header_search_visibility',
				array(
					'default'           => true,
					'transport'         => 'refresh',
					'sanitize_callback' => 'priscila_customizer_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				'priscila_header_search_visibility',
				array(
					'label'    => esc_html__( 'Display search engine.', 'priscila' ),
					'section'  => 'priscila_header',
					'settings' => 'priscila_header_search_visibility',
					'type'     => 'checkbox',
					'priority' => $priority,
				)
			);

			$priority += 10;

			/* The function allows us to select breakpoint (in pixels) for our navigation. */
			$wp_customize->add_setting(
				'priscila_header_nav_breakpoint',
				array(
					'default'           => 992,
					'transport'         => 'refresh',
					'sanitize_callback' => 'absint',
				)
			);

			$wp_customize->add_control(
				new Priscila_Customizer_Header(
					$wp_customize,
					'priscila_header_nav_breakpoint',
					array(
						'label'       => esc_html__( 'Breakpoint.', 'priscila' ),
						'description' => esc_html__( 'Choose a breakpoint for navigation.', 'priscila' ),
						'section'     => 'priscila_header',
						'type'        => 'number',
						'max'         => 5000,
						'step'        => 10,
						'priority'    => $priority,
					)
				)
			);

			$priority += 10;

			// Separator.
			$wp_customize->add_setting(
				'priscila_header_separator',
				array(
					'default'           => '',
					'sanitize_callback' => 'priscila_sanitize_html',
				)
			);

			$wp_customize->add_control(
				new Priscila_Customizer_Custom_Separator(
					$wp_customize, 
					'priscila_header_separator',
					array(
						'settings' => 'priscila_header_separator',
						'section'  => 'priscila_header',
						'priority' => $priority,
					)
				)
			);

			$priority += 10;

			// Social media new page.
			$wp_customize->add_setting(
				'priscila_header_social_media_new_tab',
				array(
					'default'           => false,
					'sanitize_callback' => 'priscila_customizer_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				new Priscila_Customizer_Custom_Checkbox(
					$wp_customize,
					'priscila_header_social_media_new_tab',
					array(
						'label'    => esc_html__( 'Open a new page after clicking on social media', 'priscila' ),
						'type'     => 'checkbox',
						'settings' => 'priscila_header_social_media_new_tab',
						'section'  => 'priscila_header',
						'priority' => $priority,
					)
				)
			);

			$priority += 10;

			// Details.
			$wp_customize->add_setting(
				'priscila_header_social_media', 
				array(
				'default'           => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'priscila_sanitize_html',
				)
			);

			$wp_customize->add_control(
				new Priscila_Customizer_Custom_Social_Media(
					$wp_customize,
					'priscila_header_social_media',
					array(
						'label'    => esc_html__( 'Add your social media', 'priscila' ),
						'settings' => 'priscila_header_social_media',
						'section'  => 'priscila_header',
						'priority' => $priority,
					)
				)
			);

			$priority += 10;

		}

		/**
		 * Render the control's content.
		 *
		 * @see WP_Customize_Control::render_content()
		 *
		 * @since 1.0.0
		 */
		public function render_content() { ?>

			<label>

				<span class='customize-control-title'><?php echo esc_html( $this->label ); ?></span>
				<span class='customize-control-description'><?php echo esc_html( $this->description ); ?></span>
				<input class='range-slider' min='<?php echo esc_attr( $this->min ); ?>' max='<?php echo esc_attr( $this->max ); ?>' step='<?php echo esc_attr( $this->step ); ?>' type='range' <?php echo esc_url( $this->get_link() ); ?> value='<?php echo intval( $this->value() ); ?>'>
				<input type='number' <?php echo esc_url( $this->get_link() ); ?> value='<?php echo intval( $this->value() ); ?>' min='<?php echo esc_attr( $this->min ); ?>' max='<?php echo esc_attr( $this->max ); ?>' placeholder='<?php printf( /* translators: %d: The maximum number. */ esc_attr( 'Max: %d', 'priscila' ), 5000 ); ?>'>

			</label>

			<?php
		}

	}

	/* Get instance. */
	Priscila_Customizer_Header::get_instance();

endif;
