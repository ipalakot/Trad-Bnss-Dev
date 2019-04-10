<?php
/**
 * Functions and definitions.
 *
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package priscila
 */

// Constants.
define( 'PRISCILA_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'PRISCILA_THEME_INCLUDES', trailingslashit( get_template_directory() . '/inc' ) );
define( 'PRISCILA_THEME_CUSTOMIZER', trailingslashit( get_template_directory() . '/inc/customizer' ) );
define( 'PRISCILA_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );

// Theme setup.
require_once PRISCILA_THEME_INCLUDES . 'options.php';
require_once PRISCILA_THEME_INCLUDES . 'setup.php';

// Helper Functions.
require_once PRISCILA_THEME_INCLUDES . 'custom-functions.php';

// Walker Classes.
require_once PRISCILA_THEME_INCLUDES . 'class-priscila-walker-primary.php';
require_once PRISCILA_THEME_INCLUDES . 'class-priscila-walker-comments.php';

 // Slider.
require_once PRISCILA_THEME_INCLUDES . 'slider.php';

// Template hooks & functions.
require_once PRISCILA_THEME_INCLUDES . 'template-hooks.php';
require_once PRISCILA_THEME_INCLUDES . 'template-functions.php';

// Customizer.
require_once PRISCILA_THEME_CUSTOMIZER . 'customizer.php';
require_once PRISCILA_THEME_CUSTOMIZER . 'class-priscila-customizer-structure.php';
require_once PRISCILA_THEME_CUSTOMIZER . 'class-priscila-customizer-custom-separator.php';
require_once PRISCILA_THEME_CUSTOMIZER . 'class-priscila-customizer-custom-social-media.php';
require_once PRISCILA_THEME_CUSTOMIZER . 'class-priscila-customizer-custom-checkbox.php';
require_once PRISCILA_THEME_CUSTOMIZER . 'class-priscila-customizer-header.php';
require_once PRISCILA_THEME_CUSTOMIZER . 'class-priscila-customizer-slider.php';
require_once PRISCILA_THEME_CUSTOMIZER . 'class-priscila-customizer-content.php';
require_once PRISCILA_THEME_CUSTOMIZER . 'class-priscila-customizer-footer.php';
require_once PRISCILA_THEME_CUSTOMIZER . 'class-priscila-customizer-colors.php';
require_once PRISCILA_THEME_CUSTOMIZER . 'class-priscila-customizer-premium.php';
