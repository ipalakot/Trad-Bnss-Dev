<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Foto Blog
 */
/**
* Hook - foto_blog_action_doctype.
*
* @hooked foto_blog_doctype -  10
*/
do_action( 'foto_blog_action_doctype' );
?>
<head>
<?php
/**
* Hook - foto_blog_action_head.
*
* @hooked foto_blog_head -  10
*/
do_action( 'foto_blog_action_head' );
?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php

/**
* Hook - foto_blog_action_before.
*
* @hooked foto_blog_page_start - 10
*/
do_action( 'foto_blog_action_before' );

/**
*
* @hooked foto_blog_header_start - 10
*/
do_action( 'foto_blog_action_before_header' );

/**
*
*@hooked foto_blog_site_branding - 10
*@hooked foto_blog_header_end - 15 
*/
do_action('foto_blog_action_header');

/**
*
* @hooked foto_blog_content_start - 10
*/
do_action( 'foto_blog_action_before_content' );

/**
 * Banner start
 * 
 * @hooked foto_blog_banner_header - 10
*/
do_action( 'foto_blog_banner_header' );  
