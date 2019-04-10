<?php
/**
 * The header for priscila theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">.
 *
 * @since 1.0.0
 *
 * @package priscila
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset='<?php bloginfo( 'charset' ); ?>'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<link rel='profile' href='https://gmpg.org/xfn/11'>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class='site-container'>

	<?php
	/**
	 * Displays skip links & social icons.
	 *
	 * @see priscila_skip_links - 10
	 * @see priscila_social_icons - 20
	 *
	 * @since 1.0.0
	 */

	do_action( 'priscila_before_header' );

	$header_options = priscila_get_options( 'header' );
	$nav_bp         = $header_options[ 'nav_breakpoint' ];
	$is_search      = $header_options[ 'search_visibility' ] ? '' : 'no-search';
	$is_nav         = has_nav_menu( 'primary' ) ? '' : 'no-nav';
	$class_names    = $is_nav . ' ' . $is_search; ?>

	<header id='masthead' class='site-header <?php echo esc_attr( $class_names ); ?>' data-nav='<?php echo esc_attr( $nav_bp ); ?>'>

		<?php
		/**
		 * Displays the site header.
		 *
		 * @since 1.0.0
		 *
		 * @see priscila_header_social_media       - 10
		 * @see priscila_header_identity           - 20
		 * @see priscila_header_primary_navigation - 30
		 */

		do_action( 'priscila_header' ); ?>

	</header>

	<?php
	/**
	 * Displays the beggining of the content & slider.
	 *
	 * @see priscila_site_content_start - 10
	 * @see priscila_content_slider - 20
	 *
	 * @since 1.0.0
	 */

	do_action( 'priscila_before_content' );
