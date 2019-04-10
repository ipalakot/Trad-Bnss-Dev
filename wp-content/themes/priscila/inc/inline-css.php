<?php
/**
 * Inline styles from Customizer.
 *
 * @since 1.0.0
 *
 * @package priscila
 */

$colors_options     = priscila_get_options( 'cls' );
$accent_color       = sanitize_hex_color( $colors_options[ 'accent_color' ] );
$accent_color_hover = sanitize_hex_color( $colors_options[ 'accent_color_hover' ] );
$heading_color      = sanitize_hex_color( $colors_options[ 'heading_color' ] );
$text_color         = sanitize_hex_color( $colors_options[ 'text_color' ] );

$inline_styles = wp_strip_all_tags(
	"
	a,
	a:visited,
	.widget_recent_comments a,
	.widget_recent_comments a:visited,
	.widget_tag_cloud a,
	.widget_tag_cloud a:visited,
	.widget_calendar tbody td a,
	.widget_calendar tbody td a:visited {
		color: {$accent_color};
	}

	a:hover,
	a:focus,
	a:active,
	.slider-item-container .post-categories-list a:hover, 
	.slider-item-container .post-categories-list a:focus, 
	.slider-item-container .post-categories-list a:active,
	.content-area .post .post-header-title a:hover, 
	.content-area .post .post-header-title a:focus, 
	.content-area .post .post-header-title a:active,
	.widget_pages a:hover, 
	.widget_pages a:focus, 
	.widget_pages a:active, 
	.widget_archive a:hover, 
	.widget_archive a:focus, 
	.widget_archive a:active, 
	.widget_recent_entries a:hover, 
	.widget_recent_entries a:focus, 
	.widget_recent_entries a:active,
	.widget_recent_comments a:hover, 
	.widget_recent_comments a:focus, 
	.widget_recent_comments a:active,
	.widget_tag_cloud a:hover, 
	.widget_tag_cloud a:focus, 
	.widget_tag_cloud a:active,
	.widget_meta a:hover, 
	.widget_meta a:focus, 
	.widget_meta a:active,
	.widget_calendar tbody td a:hover, 
	.widget_calendar tbody td a:focus, 
	.widget_calendar tbody td a:active,
	.footer-widgets .widget.widget_pages a:hover,
	.footer-widgets .widget.widget_pages a:focus,
	.footer-widgets .widget.widget_pages a:active,
	.footer-widgets .widget.widget_archive a:hover,
	.footer-widgets .widget.widget_archive a:focus,
	.footer-widgets .widget.widget_archive a:active,
	.footer-widgets .widget.widget_recent_entries a:hover,
	.footer-widgets .widget.widget_recent_entries a:focus,
	.footer-widgets .widget.widget_recent_entries a:active,
	.footer-widgets .widget.widget_nav_menu a:hover,
	.footer-widgets .widget.widget_nav_menu a:focus, 
	.footer-widgets .widget.widget_nav_menu a:active, 
	.footer-widgets .widget.widget_meta a:hover, 
	.footer-widgets .widget.widget_meta a:focus, 
	.footer-widgets .widget.widget_meta a:active,
	.primary-nav-dropdown-btn:hover, 
	.primary-nav-dropdown-btn:focus, 
	.primary-nav-dropdown-btn:active {
		color: {$accent_color_hover};
	}

	button,
	.site-header .search-show-btn,
	.slider-item-link,
	.content-area .post-categories a,
	.search-form .search-button,
	.widget_categories a,
	.widget_calendar tfoot td a,
	input[type='button'], 
	input[type='reset'], 
	input[type='submit'] {
		background: {$accent_color};
	}

	button:hover,
	button:focus,
	button:active,
	.site-header .search-show-btn:hover,
	.site-header .search-show-btn:focus,
	.site-header .search-show-btn:active,
	.slider-item-link:hover,
	.slider-item-link:focus,
	.slider-item-link:active,
	.slider-arrow:hover,
	.slider-arrow:focus,
	.slider-arrow:active,
	.content-area .post-categories a:hover,
	.content-area .post-categories a:focus,
	.content-area .post-categories a:active,
	.search-container .search-button:hover, 
	.search-container .search-button:focus, 
	.search-container .search-button:active,
	.search-form .search-button:hover, 
	.search-form .search-button:focus, 
	.search-form .search-button:active,
	.widget_categories a:hover, 
	.widget_categories a:focus, 
	.widget_categories a:active,
	.widget_calendar tfoot td a:hover, 
	.widget_calendar tfoot td a:focus, 
	.widget_calendar tfoot td a:active,
	input[type='button']:hover, 
	input[type='button']:focus, 
	input[type='button']:active, 
	input[type='reset']:hover, input[type='reset']:focus,
	input[type='reset']:active,
	input[type='submit']:hover,
	input[type='submit']:focus,
	input[type='submit']:active {
		background: {$accent_color_hover};
	}

	h1, h2, h3, h4, h5, h6,
	.post-header-title .post-header-link,
	.post-header-title .post-header-link:visited {
		color: {$heading_color};
	}

	body,
	.content-area .post-excerpt {
		color: {$text_color};
	}
"
);
