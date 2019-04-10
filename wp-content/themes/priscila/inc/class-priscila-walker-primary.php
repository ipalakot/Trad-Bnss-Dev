<?php
/**
 * Nav Menu API: Walker_Nav_Menu class
 *
 * @package priscila
 * @since 1.0.0
 */

if ( ! class_exists( 'Priscila_Walker_Primary' ) ) :

	/**
	 * Priscila_Walker_Primary
	 *
	 * The class used to remodel the primary navigation extended by the core class used to implement an HTML list of nav menu items.
	 *
	 * @since 1.0.0
	 */
	class Priscila_Walker_Primary extends Walker_Nav_menu {

		/**
		 * What the class handles.
		 *
		 * @var string
		 * @see Walker::$tree_type
		 *
		 * @since 1.0.0
		 */
		public $tree_type = array( 'post_type', 'taxonomy', 'custom' );

		/**
		 * Database fields to use.
		 *
		 * @var array
		 * @see Walker::$db_fields
		 *
		 * @since 1.0.0
		 */
		public $db_fields = array(
			'parent' => 'menu_item_parent',
			'id'     => 'db_id',
		);

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
		 * Starts the list before the elements are added.
		 *
		 * @see Walker::start_lvl()
		 *
		 * @param string   $output Used to append additional content (passed by reference).
		 * @param int      $depth  Depth of menu item. Used for padding.
		 * @param stdClass $args   An object of wp_nav_menu() arguments.
		 *
		 * @since 1.0.0
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {

			$indent  = str_repeat( "\t", $depth );
			$output .= "{$indent}<ul class='primary-nav-dropdown depth-{$depth}' aria-haspopup='true' aria-expanded='false'>";

		}

		/**
		 * Starts the element output.
		 *
		 * @see Walker::start_el()
		 *
		 * @param string   $output Used to append additional content (passed by reference).
		 * @param WP_Post  $item   Menu item data object.
		 * @param int      $depth  Depth of menu item. Used for padding.
		 * @param stdClass $args   An object of wp_nav_menu() arguments.
		 * @param int      $id     Current item ID.
		 *
		 * @since 1.0.0
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			$li_attributes = '';
			$class_names   = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;

			$classes[] = "primary-nav-item primary-nav-item-{$item->ID}";
			$classes[] = 0 === $depth ? 'primary-nav-item-depth-0' : '';

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			$class_names = ' class="' . esc_attr( $class_names ) . '"';

			$id = apply_filters( 'nav_menu_item_id', 'primary-nav-item-' . $item->ID, $item, $args );
			$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . "<li {$id}{$class_names}{$li_attributes}>";

			$attributes  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
			$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
			$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
			$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
			$attributes .= $args->walker->has_children ? ' class="primary-nav-link primary-nav-link-parent "' : ' class="primary-nav-link "';

			$item_output  = $args->before;
			$item_output .= "<a {$attributes}>";
			$item_output .= $args->link_before . '<span>' . apply_filters( 'the_title', $item->title, $item->ID ) . "</span>{$args->link_after}</a>";
			$item_output .= $args->after;

			$button_text        = esc_html__( 'Show dropdown menu', 'priscila' );
			$button_arrow_class = ( 0 === $depth ) ? 'fa-angle-down' : 'fa-angle-right';

			$item_output .= $args->walker->has_children ? "<button type='button' class='primary-nav-dropdown-btn'><span class='fas {$button_arrow_class}' aria-hidden='true'></span><span class='screen-reader-text'>{$button_text}</span></button>" : '';
			$output      .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

		}

	}

	/* Get instance. */
	Priscila_Walker_Primary::get_instance();

endif;
