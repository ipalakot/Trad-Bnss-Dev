<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package priscila
 */

if ( ! function_exists( 'priscila_setup' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since 1.0.0
	 */
	function priscila_setup() {

		/**
		 * Make theme available for translation.
		 *
		 * Translations can be filed in the /languages/ directory.
		 *
		 * If you're building a theme based on priscila, use a find and replace
		 * to change 'priscila' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'priscila', PRISCILA_THEME_DIR . '/languages' );

		/* Add default posts and comments RSS feed links to head. */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Let WordPress manage the document title.
		 *
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 *
		 * @since 1.0.0
		 */
		add_theme_support( 'post-thumbnails' );

		/* No drop sizes. */
		add_image_size( 'slider', 1160, 9999 );
		add_image_size( 'slider_retina', 2320, 9999 );
		add_image_size( 'post_medium', 600, 9999 );
		add_image_size( 'post', 810, 9999 );
		add_image_size( 'post_retina', 1620, 9999 );

		/* Drop sizes. */
		add_image_size( 'post_drop_small', 270, 133, true );
		add_image_size( 'post_drop_medium', 540, 267, true );
		add_image_size( 'post_drop_full', 810, 400, true );
		add_image_size( 'post_drop_small_retina', 1080, 533, true );
		add_image_size( 'post_drop_medium_retina', 1350, 666, true );
		add_image_size( 'post_drop_full_retina', 1620, 800, true );

		/**
		 * Modifies the maximum width of the srcset attribute.
		 *
		 * @param int $max_width Width of the image.
		 *
		 * @since 1.0.0
		 */
		function modify_max_srcset_image_width( $max_width ) {

			$max_width = 2320;

			return $max_width;

		}

		add_filter( 'max_srcset_image_width', 'modify_max_srcset_image_width' );

		/**
		 * Switch default core markup for search form, comment form, and comments to output valid HTML5.
		 *
		 * @since 1.0.0
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/* Add theme support for selective refresh for widgets. */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 *
		 * @since 1.0.0
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

	}

endif;

add_action( 'after_setup_theme', 'priscila_setup' );

if ( ! function_exists( 'priscila_enqueue' ) ) :

	/**
	 * Loads styles & scripts.
	 *
	 * @since 1.0.0
	 */
	function priscila_enqueue() {

		/* CSS. */
		wp_enqueue_style( 'priscila-style', get_stylesheet_uri(), array(), '1.0.0', 'all' );
		wp_enqueue_style( 'priscila-style-min', PRISCILA_THEME_URI . 'style.min.css', array(), '1.0.0', 'all' );
		wp_enqueue_style( 'priscila-colors-style', PRISCILA_THEME_URI . 'style.css', array(), '1.0.0', 'all' );

		include PRISCILA_THEME_DIR . 'inc/inline-css.php';

		wp_add_inline_style( 'priscila-colors-style', $inline_styles );

		/* JS. */
		wp_enqueue_script( 'priscila-script-min', PRISCILA_THEME_URI . 'scripts.min.js', array(), '1.0.0', true );

		/* Extra. */
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) :

			wp_enqueue_script( 'comment-reply' );

		endif;

	}

endif;

add_action( 'wp_enqueue_scripts', 'priscila_enqueue' );

if ( ! function_exists( 'priscila_enqueue_fonts' ) ) :

	/**
	 * Enqueue Google Fonts using a function.
	 *
	 * @since 1.0.0
	 */
	function priscila_enqueue_fonts() {

		if ( ! is_admin() ) :

			/* Setup font arguments. */
			$query_args = array(
				'family' => 'Open+Sans:300,300i,400,400i,700,700i|Playfair+Display:400,400i,700,700i,900,900i&amp;subset=latin-ext',
			);

			/* A safe way to register a CSS style file for later use. */
			wp_register_style( 'google-fonts', add_query_arg( $query_args, '//fonts.googleapis.com/css' ), array(), '1.0.0', 'all' );

			/* A safe way to add/enqueue a CSS style file to a WordPress generated page. */
			wp_enqueue_style( 'google-fonts' );

		endif;

	}

endif;

add_action( 'wp_enqueue_scripts', 'priscila_enqueue_fonts' );

if ( ! function_exists( 'priscila_admin_enqueue' ) ) :

	/**
	 * Loads admin media scripts.
	 *
	 * @since 1.0.0
	 */
	function priscila_admin_enqueue() {

		wp_enqueue_style( 'priscila-custom-controls', PRISCILA_THEME_URI . 'assets/admin/custom-controls.css', array(), '1.0.0', 'all' );
		wp_enqueue_script( 'priscila-header-social-media', PRISCILA_THEME_URI . 'assets/admin/header-social-media.js', array( 'jquery' ), '1.0.0', true );

		wp_enqueue_media();

	}

endif;

add_action( 'admin_enqueue_scripts', 'priscila_admin_enqueue' );

if ( ! function_exists( 'priscila_customizer_premium_scripts' ) ) :

	/**
	 * Loads premium customizer scripts.
	 *
	 * @since 1.0.0
	 */
	function priscila_customizer_premium_scripts() {

		wp_enqueue_style( 'priscila-premium-section-style', PRISCILA_THEME_URI . 'assets/premium/customizer-premium.css', array(), '1.0.0', 'all' );
		wp_enqueue_script( 'priscila-premium-section-script', PRISCILA_THEME_URI . 'assets/premium/customizer-premium.js', array( 'jquery' ), '1.0.0', true );

	}

endif;

add_action( 'customize_controls_enqueue_scripts', 'priscila_customizer_premium_scripts' );

if ( ! function_exists( 'priscila_add_menus' ) ) :

	/**
	 * Register all menus.
	 *
	 * @since 1.0.0
	 */
	function priscila_add_menus() {

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Navigation', 'priscila' ),
			)
		);

		register_nav_menus(
			array(
				'footer' => esc_html__( 'Footer Navigation (It supports only the first level menu)', 'priscila' ),
			)
		);

	}

endif;

add_action( 'after_setup_theme', 'priscila_add_menus' );

if ( ! function_exists( 'priscila_register_widgets' ) ) :

	/**
	 * Register all widgets.
	 *
	 * @since 1.0.0
	 */
	function priscila_register_widgets() {

		/* Primary Sidebar. */
		register_sidebar(
			array(
				'name'          => esc_html__( 'Primary Sidebar', 'priscila' ),
				'id'            => 'primary',
				'description'   => esc_html__( 'Add widgets here.', 'priscila' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		/* Footer Sidebars. */
		$number_of_footer_widgets_to_register = 3;

		for ( $i = 1; $i <= $number_of_footer_widgets_to_register; $i++ ) :

			register_sidebar(
				array(
					'name'          => sprintf(
						/* translators: %d: The number of columns in the footer. */
						esc_html__( 'Footer Sidebar Column %d', 'priscila' ),
						$i
					),
					'id'            => "footer-{$i}",
					'description'   => esc_html__( 'Add widgets here.', 'priscila' ),
					'before_widget' => '<div class="widget footer-widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
				)
			);

		endfor;

	}

endif;

add_action( 'widgets_init', 'priscila_register_widgets' );

if ( ! function_exists( 'priscila_content_width' ) ) :

	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 *
	 * @since 1.0.0
	 */
	function priscila_content_width() {

		$GLOBALS['content_width'] = apply_filters( 'priscila_content_width', 810 );

	}

endif;

add_action( 'after_setup_theme', 'priscila_content_width', 0 );

if ( ! function_exists( 'priscila_pingback_header' ) ) :

	/**
	 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
	 *
	 * @since 1.0.0
	 */
	function priscila_pingback_header() {

		if ( is_singular() && pings_open() ) :

			echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';

		endif;

	}

endif;

add_action( 'wp_head', 'priscila_pingback_header' );

if ( ! function_exists( 'priscila_custom_add_image_size_names' ) ) :

	/**
	 * The function adds custom photo sizes to the dashboard.
	 *
	 * @param array $sizes Array with image size names.
	 *
	 * @since 1.0.0
	 */
	function priscila_custom_add_image_size_names( $sizes ) {

		return array_merge(
			$sizes,
			array(
				'post' => __( 'Post', 'priscila' ),
			)
		);

	}

endif;

add_filter( 'image_size_names_choose', 'priscila_custom_add_image_size_names' );

if ( ! function_exists( 'priscila_primary_nav_breakpoint_styles' ) ) :

	/**
	 * This function adds navigation inline styles related to the breakpoint.
	 *
	 * @since 1.0.0
	 */
	function priscila_primary_nav_breakpoint_styles() {

		$header_options = priscila_get_options( 'header' );

		wp_enqueue_style( 'priscila-navigation-breakpoint-style', PRISCILA_THEME_URI . 'style.css', array(), '1.0.0', 'all' );
		$breakpoint_min_width = absint( $header_options[ 'nav_breakpoint' ] );

		$custom_css = wp_strip_all_tags(
			"
      @media only screen and ( min-width: {$breakpoint_min_width}px ) {
        .primary-nav-container.hidden-mobile { position: static; visibility: visible; opacity: 1; }
        .hidden-desktop { display: none; }
      }
    "
		);

		wp_add_inline_style( 'priscila-navigation-breakpoint-style', $custom_css );

	}

endif;

add_action( 'wp_enqueue_scripts', 'priscila_primary_nav_breakpoint_styles' );
