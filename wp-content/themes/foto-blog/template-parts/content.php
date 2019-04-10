<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Foto Blog
 */
?>
<article id="post-<?php the_ID(); ?>">
	<div class="post-item">
		<?php
			$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		?>

		<div class="featured-image" style="background-image: url( '<?php echo esc_url( $url ); ?>' )">
			<a class="cover-link" href="<?php the_permalink(); ?>"></a>
		</div>

		<div class="entry-container">
			<header class="entry-header">
				<div class="entry-meta">
					<?php foto_blog_entry_meta(); 
					foto_blog_posted_on(); ?>
				</div><!-- .entry-meta -->

				<?php
				if ( is_single() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div><!-- .entry-content -->

			<?php $readmore_text = foto_blog_get_option( 'readmore_text' );?>
			<div class="read-more">
				<a class="more-link" href="<?php the_permalink();?>"><?php echo esc_html($readmore_text);?></a>
			</div><!-- .read-more -->
		</div><!-- .entry-container -->
	</div><!-- .post-item -->
</article><!-- #post-## -->
