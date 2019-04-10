<?php
/**
 * Front Page contact settings.
 *
 * @since 1.0.0
 *
 * @package priscila
 */

if ( ! class_exists( 'Priscila_Customizer_Custom_Social_Media' ) && class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * Priscila_Customizer_Custom_Social_Media.
	 *
	 * @since 1.0.0
	 */
	class Priscila_Customizer_Custom_Social_Media extends WP_Customize_Control {

		/**
		 * Instance.
		 *
		 * @access private
		 * @var object Class object.
		 *
		 * @since 1.0.0
		 */
		private static $instance;

		/**
		 * Initiator.
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
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct( $manager = null, $id = null, $args = array() ) {

			parent::__construct( $manager, $id, $args );

		}

		public function render_content() {
			?>

			<div class='custom-customizer-social-media-container'>

				<label for='_customize-input-<?php echo esc_attr( $this->id ); ?>' class='custom-customizer-social-media-title customize-control-title'><?php echo esc_html( $this->label ); ?></label>
				<p class='custom-customizer-social-media-desc'><?php echo wp_kses_post( $this->description ); ?></p>

				<input type='hidden' id='<?php echo esc_attr( $this->id ); ?>' name='<?php echo esc_attr( $this->id ); ?>' value='<?php echo esc_attr( $this->value() ); ?>' class='custom-customizer-social-media-final-val' data-customize-setting-link='<?php echo esc_attr( $this->id ); ?>'/>

				<div class='custom-customizer-social-media-items-container'>
					<div class='custom-customizer-social-media-item-container'>
						<select class='custom-customizer-social-media-item-title'>
							<option value='angellist'><?php echo esc_html( 'AngelList' ); ?></option>
							<option value='bandcamp'><?php echo esc_html( 'Bandcamp' ); ?></option>
							<option value='behance'><?php echo esc_html( 'Behance' ); ?></option>
							<option value='codepen'><?php echo esc_html( 'Codepen' ); ?></option>
							<option value='delicious'><?php echo esc_html( 'Delicious' ); ?></option>
							<option value='deviantart'><?php echo esc_html( 'deviantART' ); ?></option>
							<option value='digg'><?php echo esc_html( 'Digg' ); ?></option>
							<option value='dribbble'><?php echo esc_html( 'Dribbble' ); ?></option>
							<option value='etsy'><?php echo esc_html( 'Etsy' ); ?></option>
							<option value='facebook-f'><?php echo esc_html( 'Facebook' ); ?></option>
							<option value='flickr'><?php echo esc_html( 'Flickr' ); ?></option>
							<option value='foursquare'><?php echo esc_html( 'Foursquare' ); ?></option>
							<option value='google-plus-g'><?php echo esc_html( 'Google+' ); ?></option>
							<option value='houzz'><?php echo esc_html( 'Houzz' ); ?></option>
							<option value='instagram'><?php echo esc_html( 'Instagram' ); ?></option>
							<option value='imdb'><?php echo esc_html( 'IMDB' ); ?></option>
							<option value='lastfm'><?php echo esc_html( 'Last.fm' ); ?></option>
							<option value='linkedin'><?php echo esc_html( 'LinkedIn' ); ?></option>
							<option value='medium'><?php echo esc_html( 'Medium' ); ?></option>
							<option value='meetup'><?php echo esc_html( 'Meetup' ); ?></option>
							<option value='mixcloud'><?php echo esc_html( 'Mixcloud' ); ?></option>
							<option value='odnoklassniki'><?php echo esc_html( 'Odnoklassniki' ); ?></option>
							<option value='pinterest'><?php echo esc_html( 'Pinterest' ); ?></option>
							<option value='product-hunt'><?php echo esc_html( 'Product Hunt' ); ?></option>
							<option value='quora'><?php echo esc_html( 'Quora' ); ?></option>
							<option value='reddit'><?php echo esc_html( 'Reddit' ); ?></option>
							<option value='soundcloud'><?php echo esc_html( 'SoundCloud' ); ?></option>
							<option value='spotify'><?php echo esc_html( 'Spotify' ); ?></option>
							<option value='stack-exchange'><?php echo esc_html( 'Stack Exchange' ); ?></option>
							<option value='stack-overlow'><?php echo esc_html( 'Stack Overflow' ); ?></option>
							<option value='stumbleupon'><?php echo esc_html( 'StumbleUpon' ); ?></option>
							<option value='telegram'><?php echo esc_html( 'Telegram' ); ?></option>
							<option value='tripadvisor'><?php echo esc_html( 'TripAdvisor' ); ?></option>
							<option value='tumblr'><?php echo esc_html( 'Tumblr' ); ?></option>
							<option value='twitter'><?php echo esc_html( 'Twitter' ); ?></option>
							<option value='vimeo'><?php echo esc_html( 'Vimeo' ); ?></option>
							<option value='vine'><?php echo esc_html( 'Vine' ); ?></option>
							<option value='vk'><?php echo esc_html( 'VK' ); ?></option>
							<option value='weibo'><?php echo esc_html( 'Weibo' ); ?></option>
							<option value='yelp'><?php echo esc_html( 'Yelp' ); ?></option>
							<option value='youtube'><?php echo esc_html( 'Youtube' ); ?></option>
						</select>
						<input type='url' value='' class='custom-customizer-social-media-item-url' placeholder='http://'>
						<button type='button' class='custom-customizer-social-media-item-remover button-primary'><?php echo esc_html( 'X' ); ?></button>
					</div>
				</div>

				<button type='button' class='custom-customizer-social-media-item-increaser button-primary'><?php echo esc_html__( 'Add another information', 'priscila' ); ?></button>

			</div>

			<?php
		}

	}

	// Get instance.
	Priscila_Customizer_Custom_Social_Media::get_instance();

endif;
