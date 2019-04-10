<?php
/**
 * Typography control class.
 *
 * @since  1.0.0
 * @access public
 */

class VW_Maintenance_Services_Control_Typography extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'typography';

	/**
	 * Array 
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $l10n = array();

	/**
	 * Set up our control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @param  string  $id
	 * @param  array   $args
	 * @return void
	 */
	public function __construct( $manager, $id, $args = array() ) {

		// Let the parent class do its thing.
		parent::__construct( $manager, $id, $args );

		// Make sure we have labels.
		$this->l10n = wp_parse_args(
			$this->l10n,
			array(
				'color'       => esc_html__( 'Font Color', 'vw-maintenance-services' ),
				'family'      => esc_html__( 'Font Family', 'vw-maintenance-services' ),
				'size'        => esc_html__( 'Font Size',   'vw-maintenance-services' ),
				'weight'      => esc_html__( 'Font Weight', 'vw-maintenance-services' ),
				'style'       => esc_html__( 'Font Style',  'vw-maintenance-services' ),
				'line_height' => esc_html__( 'Line Height', 'vw-maintenance-services' ),
				'letter_spacing' => esc_html__( 'Letter Spacing', 'vw-maintenance-services' ),
			)
		);
	}

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'vw-maintenance-services-ctypo-customize-controls' );
		wp_enqueue_style(  'vw-maintenance-services-ctypo-customize-controls' );
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		// Loop through each of the settings and set up the data for it.
		foreach ( $this->settings as $setting_key => $setting_id ) {

			$this->json[ $setting_key ] = array(
				'link'  => $this->get_link( $setting_key ),
				'value' => $this->value( $setting_key ),
				'label' => isset( $this->l10n[ $setting_key ] ) ? $this->l10n[ $setting_key ] : ''
			);

			if ( 'family' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_families();

			elseif ( 'weight' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_weight_choices();

			elseif ( 'style' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_style_choices();
		}
	}

	/**
	 * Underscore JS template to handle the control's output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function content_template() { ?>

		<# if ( data.label ) { #>
			<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>

		<ul>

		<# if ( data.family && data.family.choices ) { #>

			<li class="typography-font-family">

				<# if ( data.family.label ) { #>
					<span class="customize-control-title">{{ data.family.label }}</span>
				<# } #>

				<select {{{ data.family.link }}}>

					<# _.each( data.family.choices, function( label, choice ) { #>
						<option value="{{ choice }}" <# if ( choice === data.family.value ) { #> selected="selected" <# } #>>{{ label }}</option>
					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.weight && data.weight.choices ) { #>

			<li class="typography-font-weight">

				<# if ( data.weight.label ) { #>
					<span class="customize-control-title">{{ data.weight.label }}</span>
				<# } #>

				<select {{{ data.weight.link }}}>

					<# _.each( data.weight.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.weight.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.style && data.style.choices ) { #>

			<li class="typography-font-style">

				<# if ( data.style.label ) { #>
					<span class="customize-control-title">{{ data.style.label }}</span>
				<# } #>

				<select {{{ data.style.link }}}>

					<# _.each( data.style.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.style.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.size ) { #>

			<li class="typography-font-size">

				<# if ( data.size.label ) { #>
					<span class="customize-control-title">{{ data.size.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.size.link }}} value="{{ data.size.value }}" />

			</li>
		<# } #>

		<# if ( data.line_height ) { #>

			<li class="typography-line-height">

				<# if ( data.line_height.label ) { #>
					<span class="customize-control-title">{{ data.line_height.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.line_height.link }}} value="{{ data.line_height.value }}" />

			</li>
		<# } #>

		<# if ( data.letter_spacing ) { #>

			<li class="typography-letter-spacing">

				<# if ( data.letter_spacing.label ) { #>
					<span class="customize-control-title">{{ data.letter_spacing.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.letter_spacing.link }}} value="{{ data.letter_spacing.value }}" />

			</li>
		<# } #>

		</ul>
	<?php }

	/**
	 * Returns the available fonts.  Fonts should have available weights, styles, and subsets.
	 *
	 * @todo Integrate with Google fonts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_fonts() { return array(); }

	/**
	 * Returns the available font families.
	 *
	 * @todo Pull families from `get_fonts()`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	function get_font_families() {

		return array(
			'' => __( 'No Fonts', 'vw-maintenance-services' ),
        'Abril Fatface' => __( 'Abril Fatface', 'vw-maintenance-services' ),
        'Acme' => __( 'Acme', 'vw-maintenance-services' ),
        'Anton' => __( 'Anton', 'vw-maintenance-services' ),
        'Architects Daughter' => __( 'Architects Daughter', 'vw-maintenance-services' ),
        'Arimo' => __( 'Arimo', 'vw-maintenance-services' ),
        'Arsenal' => __( 'Arsenal', 'vw-maintenance-services' ),
        'Arvo' => __( 'Arvo', 'vw-maintenance-services' ),
        'Alegreya' => __( 'Alegreya', 'vw-maintenance-services' ),
        'Alfa Slab One' => __( 'Alfa Slab One', 'vw-maintenance-services' ),
        'Averia Serif Libre' => __( 'Averia Serif Libre', 'vw-maintenance-services' ),
        'Bangers' => __( 'Bangers', 'vw-maintenance-services' ),
        'Boogaloo' => __( 'Boogaloo', 'vw-maintenance-services' ),
        'Bad Script' => __( 'Bad Script', 'vw-maintenance-services' ),
        'Bitter' => __( 'Bitter', 'vw-maintenance-services' ),
        'Bree Serif' => __( 'Bree Serif', 'vw-maintenance-services' ),
        'BenchNine' => __( 'BenchNine', 'vw-maintenance-services' ),
        'Cabin' => __( 'Cabin', 'vw-maintenance-services' ),
        'Cardo' => __( 'Cardo', 'vw-maintenance-services' ),
        'Courgette' => __( 'Courgette', 'vw-maintenance-services' ),
        'Cherry Swash' => __( 'Cherry Swash', 'vw-maintenance-services' ),
        'Cormorant Garamond' => __( 'Cormorant Garamond', 'vw-maintenance-services' ),
        'Crimson Text' => __( 'Crimson Text', 'vw-maintenance-services' ),
        'Cuprum' => __( 'Cuprum', 'vw-maintenance-services' ),
        'Cookie' => __( 'Cookie', 'vw-maintenance-services' ),
        'Chewy' => __( 'Chewy', 'vw-maintenance-services' ),
        'Days One' => __( 'Days One', 'vw-maintenance-services' ),
        'Dosis' => __( 'Dosis', 'vw-maintenance-services' ),
        'Droid Sans' => __( 'Droid Sans', 'vw-maintenance-services' ),
        'Economica' => __( 'Economica', 'vw-maintenance-services' ),
        'Fredoka One' => __( 'Fredoka One', 'vw-maintenance-services' ),
        'Fjalla One' => __( 'Fjalla One', 'vw-maintenance-services' ),
        'Francois One' => __( 'Francois One', 'vw-maintenance-services' ),
        'Frank Ruhl Libre' => __( 'Frank Ruhl Libre', 'vw-maintenance-services' ),
        'Gloria Hallelujah' => __( 'Gloria Hallelujah', 'vw-maintenance-services' ),
        'Great Vibes' => __( 'Great Vibes', 'vw-maintenance-services' ),
        'Handlee' => __( 'Handlee', 'vw-maintenance-services' ),
        'Hammersmith One' => __( 'Hammersmith One', 'vw-maintenance-services' ),
        'Inconsolata' => __( 'Inconsolata', 'vw-maintenance-services' ),
        'Indie Flower' => __( 'Indie Flower', 'vw-maintenance-services' ),
        'IM Fell English SC' => __( 'IM Fell English SC', 'vw-maintenance-services' ),
        'Julius Sans One' => __( 'Julius Sans One', 'vw-maintenance-services' ),
        'Josefin Slab' => __( 'Josefin Slab', 'vw-maintenance-services' ),
        'Josefin Sans' => __( 'Josefin Sans', 'vw-maintenance-services' ),
        'Kanit' => __( 'Kanit', 'vw-maintenance-services' ),
        'Lobster' => __( 'Lobster', 'vw-maintenance-services' ),
        'Lato' => __( 'Lato', 'vw-maintenance-services' ),
        'Lora' => __( 'Lora', 'vw-maintenance-services' ),
        'Libre Baskerville' => __( 'Libre Baskerville', 'vw-maintenance-services' ),
        'Lobster Two' => __( 'Lobster Two', 'vw-maintenance-services' ),
        'Merriweather' => __( 'Merriweather', 'vw-maintenance-services' ),
        'Monda' => __( 'Monda', 'vw-maintenance-services' ),
        'Montserrat' => __( 'Montserrat', 'vw-maintenance-services' ),
        'Muli' => __( 'Muli', 'vw-maintenance-services' ),
        'Marck Script' => __( 'Marck Script', 'vw-maintenance-services' ),
        'Noto Serif' => __( 'Noto Serif', 'vw-maintenance-services' ),
        'Open Sans' => __( 'Open Sans', 'vw-maintenance-services' ),
        'Overpass' => __( 'Overpass', 'vw-maintenance-services' ),
        'Overpass Mono' => __( 'Overpass Mono', 'vw-maintenance-services' ),
        'Oxygen' => __( 'Oxygen', 'vw-maintenance-services' ),
        'Orbitron' => __( 'Orbitron', 'vw-maintenance-services' ),
        'Patua One' => __( 'Patua One', 'vw-maintenance-services' ),
        'Pacifico' => __( 'Pacifico', 'vw-maintenance-services' ),
        'Padauk' => __( 'Padauk', 'vw-maintenance-services' ),
        'Playball' => __( 'Playball', 'vw-maintenance-services' ),
        'Playfair Display' => __( 'Playfair Display', 'vw-maintenance-services' ),
        'PT Sans' => __( 'PT Sans', 'vw-maintenance-services' ),
        'Philosopher' => __( 'Philosopher', 'vw-maintenance-services' ),
        'Permanent Marker' => __( 'Permanent Marker', 'vw-maintenance-services' ),
        'Poiret One' => __( 'Poiret One', 'vw-maintenance-services' ),
        'Quicksand' => __( 'Quicksand', 'vw-maintenance-services' ),
        'Quattrocento Sans' => __( 'Quattrocento Sans', 'vw-maintenance-services' ),
        'Raleway' => __( 'Raleway', 'vw-maintenance-services' ),
        'Rubik' => __( 'Rubik', 'vw-maintenance-services' ),
        'Rokkitt' => __( 'Rokkitt', 'vw-maintenance-services' ),
        'Russo One' => __( 'Russo One', 'vw-maintenance-services' ),
        'Righteous' => __( 'Righteous', 'vw-maintenance-services' ),
        'Slabo' => __( 'Slabo', 'vw-maintenance-services' ),
        'Source Sans Pro' => __( 'Source Sans Pro', 'vw-maintenance-services' ),
        'Shadows Into Light Two' => __( 'Shadows Into Light Two', 'vw-maintenance-services'),
        'Shadows Into Light' => __( 'Shadows Into Light', 'vw-maintenance-services' ),
        'Sacramento' => __( 'Sacramento', 'vw-maintenance-services' ),
        'Shrikhand' => __( 'Shrikhand', 'vw-maintenance-services' ),
        'Tangerine' => __( 'Tangerine', 'vw-maintenance-services' ),
        'Ubuntu' => __( 'Ubuntu', 'vw-maintenance-services' ),
        'VT323' => __( 'VT323', 'vw-maintenance-services' ),
        'Varela Round' => __( 'Varela Round', 'vw-maintenance-services' ),
        'Vampiro One' => __( 'Vampiro One', 'vw-maintenance-services' ),
        'Vollkorn' => __( 'Vollkorn', 'vw-maintenance-services' ),
        'Volkhov' => __( 'Volkhov', 'vw-maintenance-services' ),
        'Yanone Kaffeesatz' => __( 'Yanone Kaffeesatz', 'vw-maintenance-services' )
		);
	}

	/**
	 * Returns the available font weights.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_weight_choices() {

		return array(
			'' => esc_html__( 'No Fonts weight', 'vw-maintenance-services' ),
			'100' => esc_html__( 'Thin',       'vw-maintenance-services' ),
			'300' => esc_html__( 'Light',      'vw-maintenance-services' ),
			'400' => esc_html__( 'Normal',     'vw-maintenance-services' ),
			'500' => esc_html__( 'Medium',     'vw-maintenance-services' ),
			'700' => esc_html__( 'Bold',       'vw-maintenance-services' ),
			'900' => esc_html__( 'Ultra Bold', 'vw-maintenance-services' ),
		);
	}

	/**
	 * Returns the available font styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_style_choices() {

		return array(
			'' => esc_html__( 'No Fonts Style', 'vw-maintenance-services' ),
			'normal'  => esc_html__( 'Normal', 'vw-maintenance-services' ),
			'italic'  => esc_html__( 'Italic', 'vw-maintenance-services' ),
			'oblique' => esc_html__( 'Oblique', 'vw-maintenance-services' )
		);
	}
}
