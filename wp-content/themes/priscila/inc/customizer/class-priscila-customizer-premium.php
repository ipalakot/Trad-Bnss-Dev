<?php
/**
 * Premium panel.
 *
 * @package priscila
 * @since 1.0.0
 */

if ( ! class_exists( 'Priscila_Customizer_Premium' ) && class_exists( 'WP_Customize_Section' ) ) :

	/**
	 * Priscila_Customizer_Premium
	 *
	 * @since 1.0.0
	 */
	class Priscila_Customizer_Premium extends WP_Customize_Section {

		/**
		 * Type of this section.
		 *
		 * @access public
		 * @var string
		 *
		 * @since 1.0.0
		 */
		public $type = 'premium';

		/**
		 * Premium button text.
		 *
		 * @access public
		 * @var string
		 *
		 * @since 1.0.0
		 */
		public $premium_text = '';

		/**
		 * Premium button link.
		 *
		 * @access public
		 * @var string
		 *
		 * @since 1.0.0
		 */
		public $premium_url = '';

		/**
		 * Add custom parameters to pass to the JS via JSON.
		 *
		 * @access public
		 * @return string
		 *
		 * @since  1.0.0
		 */
		public function json() {
			$json = parent::json();

			$json['premium_text'] = $this->premium_text;
			$json['premium_url']  = esc_url( $this->premium_url );

			return $json;
		}

		/**
		 * An Underscore (JS) template for rendering this panel’s container.
		 *
		 * Class variables for this panel class are available in the data JS object; export custom variables by overriding WP_Customize_Panel::json().
		 *
		 * @see WP_Customize_Panel::render_template()
		 * @link https://developer.wordpress.org/reference/classes/wp_customize_panel/render_template/
		 *
		 * @since 1.0.0
		 */
		protected function render_template() { ?>

			<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
				<h3 class="accordion-section-title">
					{{ data.title }}
					<# if ( data.premium_text && data.premium_url ) { #>
						<a href="{{ data.premium_url }}" class="button button-secondary alignright" target="_blank">{{ data.premium_text }}</a>
					<# } #>
				</h3>
			</li>

			<?php
		}

	}

endif;

if ( ! function_exists( 'priscila_premium_section' ) ) :

	/**
	 * Adds premium section.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	function priscila_premium_section( $wp_customize ) {

		/* Register custom section types. */
		$wp_customize->register_section_type( 'Priscila_Customizer_Premium' );

		/* Register sections. */
		$wp_customize->add_section(
			new Priscila_Customizer_Premium(
				$wp_customize,
				'customize-page-view-premium',
				array(
					'title'    => esc_html__( 'The premium version is in progress.', 'priscila' ),
					'priority' => 9999,
				)
			)
		);

	}

endif;

add_action( 'customize_register', 'priscila_premium_section' );
