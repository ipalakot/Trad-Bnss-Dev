<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @since 1.0.0
 *
 * @package priscila
 */

	/**
	 * Displays the end of the content.
	 *
	 * @see priscila_site_content_end
	 */

	do_action( 'priscila_after_content' ); ?>

	<footer id="colophon" class="site-footer">

		<?php
		/**
		 * Displays the page footer.
		 *
		 * @see priscila_footer_start - 10
		 * @see priscila_footer_widgets - 20
		 * @see priscila_footer_info - 30
		 * @see priscila_footer_end - 40
		 */

		do_action( 'priscila_footer' ); ?>

	</footer>

</div><!-- .site-container -->

<?php wp_footer(); ?>

</body>
</html>
