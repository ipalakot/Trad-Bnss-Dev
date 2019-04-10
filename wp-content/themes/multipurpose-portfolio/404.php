<?php
/**
 * The template for displaying 404 pages (Not Found).
 * @package Multipurpose Portfolio
 */

get_header(); ?>

<div class="container">
	<div class="notfound">
		<h1><?php esc_html_e('404 Not Found', 'multipurpose-portfolio' ); ?></h1>
		<p class="text-404"><?php esc_html_e( 'Looks like you have taken a wrong turn','multipurpose-portfolio' );  ?></p>
		<p class="text-404"><?php esc_html_e( 'Dont worry it happens to the best of us.', 'multipurpose-portfolio' ); ?></p>
		<div class="read-moresec">
    		<a href="<?php echo esc_url( home_url() ); ?>" class="button"><?php esc_html_e( 'Return to the home page', 'multipurpose-portfolio' ); ?></a>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
	
<?php get_footer(); ?>