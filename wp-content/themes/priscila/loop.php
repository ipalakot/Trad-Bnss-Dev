<?php
/**
 * The loop template file.
 *
 * Included on pages like archive.php, index.php, page.php, search.php and single.php to display a loop of posts.
 *
 * @package priscila
 * @since 1.0.0
 */

$template = priscila_loop_content_template();

while ( have_posts() ) :

	the_post();

	/**
	 * Include the Post-Format-specific template for the content.
	 * If you want to override this in a child theme, then include a file
	 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
	 */

	get_template_part( 'template-parts/content', $template );

	/* If single or page & if comments are open or we have at least one comment, load up the comment template. */
	if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) ) :

		comments_template();

	endif;

endwhile; /* End while loop. */
