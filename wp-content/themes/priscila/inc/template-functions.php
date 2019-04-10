<?php
/**
 * Custom template & tag functions.
 *
 * @since 1.0.0
 *
 * @package priscila
 */

/*
--------------------------------------------------------------
BEFORE HEADER
--------------------------------------------------------------
*/

if ( ! function_exists( 'priscila_skip_links' ) ) :

	/**
	 * Displays skip links.
	 */
	function priscila_skip_links() {

		$content_options = priscila_get_options( 'content' );
		$sidebar_pos     = $content_options['sidebar_pos'];
		$is_sidebar      = is_active_sidebar( 'primary' ); ?>

		<a class='skip-link screen-reader-text' href='#content'><?php esc_html_e( 'Skip to content', 'priscila' ); ?></a>

		<?php if ( $is_sidebar && $sidebar_pos ) : ?>

			<a class='skip-link screen-reader-text' href='#secondary'><?php esc_html_e( 'Skip to sidebar', 'priscila' ); ?></a>

			<?php
		endif;

	}

endif;

/*
--------------------------------------------------------------
SITE HEADER
--------------------------------------------------------------
*/

if ( ! function_exists( 'priscila_header_social_media' ) ) :

	/**
	 * Displays social icons.
	 */
	function priscila_header_social_media() {

		$header_options = priscila_get_options( 'header' );
		$social_media   = explode( '|___|', $header_options['social_media'] );
		$slug           = explode( '|', $social_media[0] );
		$title          = explode( '|', $social_media[1] );
		$url            = explode( '|', $social_media[2] );
		$new_tab        = $header_options['social_media_new_tab'];
		$items_number   = max( count( $slug ), count( $url ) );

		if ( ! empty( $slug ) && ! empty( $url ) ) :
			?>

			<div class='site-header-social-media'>

				<ul class='site-header-social-media-list'>

					<?php for ( $i = 0; $i < $items_number; $i++ ) : ?>

						<?php if ( isset( $slug[ $i ] ) && $slug[ $i ] !== '' && isset( $url[ $i ] ) && $url[ $i ] !== '' ) : ?>

							<li class='site-header-social-media-item'>

								<a class='site-header-social-media-link' href='<?php echo esc_url( $url[ $i ] ); ?>' title='<?php echo esc_attr( $title[ $i ] ); ?>' <?php echo $new_tab ? esc_attr( 'target="_blank"' ) : ''; ?>>
									<span class='fab fa-<?php echo esc_attr( $slug[ $i ] ); ?>' aria-hidden='true'></span>
									<span class='screen-reader-text'>
										<?php
										printf(
											// translators: %s: The name of the social media. E.g. Facebook.
											esc_html__( 'Visit my %s', 'priscila' ),
											esc_html( $title[ $i ] )
										);
										?>
									</span>
								</a>

							</li>

						<?php endif; ?>

					<?php endfor; ?>

				</ul>

			</div>

			<?php
		endif;

	}

endif;

if ( ! function_exists( 'priscila_header_identity' ) ) :

	/**
	 * The custom logo, title & description for priscila theme.
	 */
	function priscila_header_identity() {
		?>

		<div class='site-header-container'>

			<div class='site-header-identity'>

				<a class='site-header-link' href='<?php echo esc_url( home_url( '/' ) ); ?>' rel='home'>

					<?php
					$is_logo = ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) ? true : false;

					echo ( is_front_page() && is_home() ) ? '<h1 class="site-header-title">' : '<p class="site-header-title">';

					if ( $is_logo ) :

						the_custom_logo();

					else :

						bloginfo( 'name' );

					endif;

					echo ( is_front_page() && is_home() ) ? '</h1>' : '</p>';
					?>

					<?php if ( ! $is_logo && ( get_bloginfo( 'description', 'display' ) || is_customize_preview() ) ) : ?>

						<p class='site-header-description'><?php bloginfo( 'description' ); ?></p>

					<?php endif; ?>

				</a>

			</div>

		<?php
	}

endif;

if ( ! function_exists( 'priscila_header_primary_navigation' ) ) :

	/**
	 * Displays the primary navigation.
	 */
	function priscila_header_primary_navigation() {

		$header_options    = priscila_get_options( 'header' );
		$search_visibility = $header_options['search_visibility'];
		$is_nav            = has_nav_menu( 'primary' );

		if ( $is_nav || $search_visibility ) :
			?>

				<div class='site-header-nav-container'>

					<nav id='primary-nav' class='primary-nav'>

						<button type='button' class='primary-nav-show-btn hidden-desktop'>
							<span class='fas fa-bars' aria-hidden='true'></span>
							<span class='screen-reader-text'><?php esc_html_e( 'Show Navigation', 'priscila' ); ?></span>
						</button>

						<div class='primary-nav-container hidden-mobile' aria-expanded='false'>

							<button type='button' class='primary-nav-hide-btn hidden-desktop'>
								<span class='fas fa-times' aria-hidden='true'></span>
								<span class='screen-reader-text'><?php esc_html_e( 'Hide Navigation', 'priscila' ); ?></span>
							</button>

							<?php
							if ( $is_nav ) :

								wp_nav_menu(
									array(
										'theme_location'  => 'primary',
										'container'       => '',
										'menu_id'         => 'primary-nav-list',
										'menu_class'      => 'primary-nav-list',
										'container_class' => '',
										'items_wrap'      => '<ul id="%1$s" class="%2$s" aria-expanded="false">%3$s</ul>',
										'walker'          => new Priscila_Walker_Primary(),
										'fallback_cb'     => false,
									)
								);

							endif;
							?>

						</div>

					</nav><!-- #primary-nav.primary-nav -->

					<?php if ( $search_visibility ) : ?>

						<div class='search-container' aria-expanded='false'>

							<div class='container'>

								<button type='button' class='search-hide-btn'>
									<span class='fas fa-times' aria-hidden='true'></span>
									<span class='screen-reader-text'><?php esc_html_e( 'Hide search engine', 'priscila' ); ?></span>
								</button>

								<?php get_search_form(); ?>

							</div>

						</div>

						<button type='button' class='search-show-btn'>
							<span class='fas fa-search' aria-hidden='true'></span>
							<span class='screen-reader-text'><?php esc_html_e( 'Show search engine', 'priscila' ); ?></span>
						</button>

					<?php endif; ?>

				</div>

			<?php endif; ?>

		</div>

		<?php
	}

endif;

/*
--------------------------------------------------------------
BEFORE CONTENT
--------------------------------------------------------------
*/

if ( ! function_exists( 'priscila_site_content_start' ) ) :

	/**
	 * Displays the beggining of the content.
	 */
	function priscila_site_content_start() {

		$content_options = priscila_get_options( 'content' );
		$sidebar_pos     = $content_options['sidebar_pos'];
		$layout_width    = $content_options['layout_width'];
		$class_names     = $sidebar_pos . ' ' . $layout_width;
		?>

		<div id="content" class="site-content <?php echo esc_attr( $class_names ); ?>">

		<?php
	}

endif;

/*
--------------------------------------------------------------
CONTENT AREA
--------------------------------------------------------------
*/

if ( ! function_exists( 'priscila_main_content_area_start' ) ) :

	/**
	 * Displays the beggining of the content area.
	 *
	 * @since 1.0.0
	 */
	function priscila_main_content_area_start() {
		?>

		<div id='primary' class='content-area'>

			<main id='main' class='site-main' role='main'>

		<?php
	}

endif;

if ( ! function_exists( 'priscila_main_content_area_end' ) ) :

	/**
	 * Displays the beggining of the content area.
	 *
	 * @since 1.0.0
	 */
	function priscila_main_content_area_end() {
		?>

		</main></div>

		<?php
	}

endif;

/*
--------------------------------------------------------------
AFTER CONTENT
--------------------------------------------------------------
*/

if ( ! function_exists( 'priscila_site_content_end' ) ) :

	/**
	 * Displays the end of the content.
	 *
	 * @since 1.0.0
	 */
	function priscila_site_content_end() {
		?>

		</div>

		<?php
	}

endif;

/*
--------------------------------------------------------------
POST CONTENT
--------------------------------------------------------------
*/

if ( ! function_exists( 'priscila_content_area_post_start' ) ) :

	/**
	 * Displays the start of the post.
	 *
	 * @since 1.0.0
	 */
	function priscila_content_area_post_start() {
		?>

		<article id='post-<?php the_ID(); ?>' <?php post_class(); ?>>

			<?php
			$img_id     = get_post_thumbnail_id();
			$img_alt    = get_post_meta( $img_id, '_wp_attachment_image_alt', true );
			$img_srcset = priscila_custom_srcset(
				$img_id,
				array(
					'post_drop_small',
					'post_drop_medium',
					'post_drop_full',
					'post_drop_small_retina',
					'post_drop_medium_retina',
					'post_drop_full_retina',
				)
			);
			?>

			<div class='post-<?php echo has_post_thumbnail() && ! empty( $img_srcset ) ? 'thumbnail' : 'no-thumbnail'; ?>-container'>

				<?php
				if ( has_post_thumbnail() && ! empty( $img_srcset ) ) :

					the_post_thumbnail(
						'post_drop',
						array(
							'srcset' => esc_attr( implode( ',', $img_srcset ) ),
							'alt'    => esc_attr( $img_alt ),
						)
					);

				endif;
				?>

			</div>  

			<div class="post-container">

				<div class='post-details'>
					<?php
					priscila_post_date();
					priscila_post_author();
					priscila_post_comments_number();
					?>
				</div>

					<div class="post-inner-container">

						<div class='post-categories'><?php priscila_post_categories( get_the_ID() ); ?></div>

						<header class='post-header'>
							<h2 class='post-header-title'>
								<a class='post-header-link' href='<?php echo esc_url( get_the_permalink() ); ?>' title='<?php the_title_attribute( array( 'echo' => false ) ); ?>'>
									<?php
									printf(
										wp_kses(
											/* translators: %s: Title of the post. */
											__( '<span class="screen-reader-text">Read more about</span> %s', 'priscila' ),
											array(
												'span' => array(
													'class' => array(),
												),
											)
										),
										wp_kses_post( get_the_title() )
									);
									?>
								</a>
							</h2>
						</header>

						<div class='post-excerpt'><?php priscila_excerpt(); ?></div>
						<div class='post-tags'><?php priscila_post_tags(); ?></div>

					</div>

				</div>

		</article>

		<?php

	}

endif;

/*
--------------------------------------------------------------
SINGLE POST CONTENT
--------------------------------------------------------------
*/

if ( ! function_exists( 'priscila_content_area_single_post_start' ) ) :

	/**
	 * Displays the start of the single post.
	 */
	function priscila_content_area_single_post_start() {
		?>

		<article id='post-<?php echo esc_attr( the_ID() ); ?>' <?php echo esc_attr( post_class() ); ?>>

			<?php
			$img_id     = get_post_thumbnail_id();
			$img_alt    = get_post_meta( $img_id, '_wp_attachment_image_alt', true );
			$img_srcset = priscila_custom_srcset(
				$img_id,
				array(
					'medium',
					'large',
					'post_medium',
					'post',
					'post_retina',
				)
			);
			?>

			<div class='post-<?php echo has_post_thumbnail() && ! empty( $img_srcset ) ? 'thumbnail' : 'no-thumbnail'; ?>-container'>
				<?php
				if ( has_post_thumbnail() && ! empty( $img_srcset ) ) :

					the_post_thumbnail(
						'post',
						array(
							'srcset' => esc_attr( implode( ',', $img_srcset ) ),
							'alt'    => esc_attr( $img_alt ),
						)
					);

				endif;
				?>
			</div>

			<div class="post-container">

				<div class='post-details'>
					<?php
					priscila_post_date();
					priscila_post_author();
					priscila_post_comments_number();
					?>
				</div>

				<div class="post-inner-container">

					<div class='post-categories'><?php priscila_post_categories( get_the_ID() ); ?></div>

					<?php priscila_page_header(); ?>

					<div class='post-content'><?php the_content(); ?></div>

					<?php 
					wp_link_pages(
						array(
							'before'      => '<div class="page-links">',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
						)
					);
					?>

					<div class='post-tags'><?php priscila_post_tags(); ?></div>

				</div>

			</div>

		</article>

		<?php 

	}

endif;

/*
--------------------------------------------------------------
SINGLE POST NAVIGATION
--------------------------------------------------------------
*/

if ( ! function_exists( 'priscila_single_post_navigation' ) ) :

	/**
	 * Displays the single post navigation.
	 *
	 * @since 1.0.0
	 */
	function priscila_single_post_navigation() {

		the_post_navigation(
			wp_parse_args(
				array(
					'prev_text' => sprintf(
						/* translators: %s: Title of the previous post. */
						esc_html__( 'Previous Post %s', 'priscila' ),
						'<span class="screen-reader-text">%title</span>'
					),
					'next_text' => sprintf(
						/* translators: %s: The title of the next post. */
						esc_html__( 'Next Post %s', 'priscila' ),
						'<span class="screen-reader-text">%title</span>'
					),
				)
			)
		);

	}

endif;

/*
--------------------------------------------------------------
PAGE CONTENT
--------------------------------------------------------------
*/

if ( ! function_exists( 'priscila_content_area_page_start' ) ) :

	/**
	 * Displays the start of the page.
	 */
	function priscila_content_area_page_start() {
		?>

		<article id='post-<?php the_ID(); ?>' <?php post_class(); ?>>

			<?php if ( has_post_thumbnail() ) : ?>

				<div class='page-thumbnail-container'><?php the_post_thumbnail( 'post' ); ?></div>  

			<?php endif; ?>

			<?php priscila_page_header(); ?>

			<div class="page-container">

				<?php 
				the_content();

				wp_link_pages(
					array(
						'before'      => '<div class="page-links">',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					)
				); ?>

			</div>

			<?php 
			if ( get_edit_post_link() ) :

				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Title of the post. */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'priscila' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					),
					'<span class="edit-link">',
					'</span>'
				);

			endif; ?>

		</article>

		<?php 

	}

endif;

/*
--------------------------------------------------------------
SEARCH CONTENT
--------------------------------------------------------------
*/

if ( ! function_exists( 'priscila_content_area_search_start' ) ) :

	/**
	 * Displays the beggining of the post content.
	 *
	 * @since 1.0.0
	 */
	function priscila_content_area_search_start() { ?>

		<article id='post-<?php the_ID(); ?>' <?php post_class(); ?>>

			<header class='post-header'>
				<h2 class='post-header-title'>
					<a class='post-header-link' href='<?php echo esc_url( get_the_permalink() ); ?>' title='<?php the_title_attribute( array( 'echo' => false ) ); ?>'>
						<?php
						printf(
							wp_kses(
								/* translators: %s: Title of the post. */
								__( '<span class="screen-reader-text">Read more about</span> %s', 'priscila' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							wp_kses_post( get_the_title() )
						);
						?>

					</a>
				</h2>
			</header>

			<div class='post-content'><?php priscila_excerpt(); ?></div>

		</article>

		<?php
	}

endif;

/*
--------------------------------------------------------------
ATTACHMENT CONTENT
--------------------------------------------------------------
*/

if ( ! function_exists( 'priscila_content_area_attachment_start' ) ) :

	/**
	 * Displays the beggining of the post content.
	 *
	 * @since 1.0.0
	 */
	function priscila_content_area_attachment_start() {
		?>

		<article id='post-<?php the_ID(); ?>' <?php post_class(); ?>>

			<div class='post-container'>

				<header class='post-header'>
					<h2 class='post-header-title'>
						<a class='post-header-link' href='<?php echo esc_url( get_the_permalink() ); ?>' title='<?php the_title_attribute( array( 'echo' => false ) ); ?>'>
							<?php
							printf(
								wp_kses(
									/* translators: %s: Title of the post. */
									__( '<span class="screen-reader-text">Read more about</span> %s', 'priscila' ),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								wp_kses_post( get_the_title() )
							);
							?>
						</a>
					</h2>
				</header>

				<div class='post-attachment-container'><?php echo wp_get_attachment_link( get_the_ID(), 'medium' ); ?></div>

				<?php user_can( wp_get_current_user(), 'administrator' ) ? edit_post_link( 'Edit', '', '', get_the_ID(), 'post-attachment-container-edit-link' ) : ''; ?>

			</div>

		</article>

		<?php
	}

endif;

/*
--------------------------------------------------------------
COMMENTS
--------------------------------------------------------------
*/

if ( ! function_exists( 'priscila_comments_start' ) ) :

	/**
	 * Displays comments start.
	 */
	function priscila_comments_start() {
		?>

		<div id="comments" class="comments-area">

			<h2 class='comments-title'>

				<?php
				$comment_count = get_comments_number();

				if ( '1' === $comment_count ) :

					printf(
						/* translators: %s: Title of the post. */
						esc_html__( 'One thought on %s.', 'priscila' ),
						'<span>&ldquo;' . wp_kses_post( get_the_title() ) . '&rdquo;</span>'
					);

				else :

					printf(
						esc_html(
							/* translators: %1$s: Number of comments. %2$s: Title of the post. */
							_nx( '%1$s thought on %2$s.', '%1$s thoughts on %2$s.', $comment_count, 'comments title', 'priscila' )
						),
						esc_html( number_format_i18n( $comment_count ) ),
						'<span>&ldquo;' . wp_kses_post( get_the_title() ) . '&rdquo;</span>'
					);

				endif;
				?>

			</h2>

			<?php the_comments_navigation(); ?>

			<ol class='comment-list'>

				<?php
				wp_list_comments(
					array(
						'style'      => 'ol',
						'short_ping' => true,
						'walker'     => new Priscila_Walker_Comments(),
					)
				);
				?>

			</ol>

			<?php 
			/* If comments are closed and there are comments, let's leave a little note, shall we?  */
			if ( ! comments_open() ) : ?>

				<p class='no-comments'><?php esc_html_e( 'Comments are closed.', 'priscila' ); ?></p>

			<?php endif; ?>

			<?php comment_form(); ?>

		</div>

		<?php 

	}

endif;

/*
--------------------------------------------------------------
404 PAGE
--------------------------------------------------------------
*/

if ( ! function_exists( 'priscila_404_area_start' ) ) :

	/**
	 * Displays the beggining of the 404 area.
	 *
	 * @since 1.0.0
	 */
	function priscila_404_area_start() {
		?>

		<section class="error-404 not-found">

			<?php priscila_page_header( '404' ); ?>

			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'priscila' ); ?></p>

			<?php get_search_form(); ?>

		</section>

		<?php 

	}

endif;

/*
--------------------------------------------------------------
NOT FOUND
--------------------------------------------------------------
*/

if ( ! function_exists( 'priscila_not_found_area_start' ) ) :

	/**
	 * Displays the start of the not found area.
	 *
	 * @since 1.0.0
	 */
	function priscila_not_found_area_start() {
		?>

		<section class='no-results not-found'>

		<?php
		priscila_page_header( 'nothing' );

		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				wp_kses(
					/* translators: %s: Link to the dashboard. */
					__( 'Ready to publish your first post? Get started <a href="%s">here</a>.', 'priscila' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				),
				esc_url( admin_url( 'post-new.php' ) )
			);

		else :

			if ( is_search() ) {
				?>

				<p class='page-content-none'><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'priscila' ); ?></p>

			<?php } else { ?>

				<p class='page-content-none'><?php esc_html_e( 'It seems we can not find what you are looking for. Perhaps searching can help.', 'priscila' ); ?></p>

				<?php
			}

			get_search_form();

		endif; ?>

		</section>

		<?php

	}

endif;

/*
--------------------------------------------------------------
PRIMARY SIDEBAR
--------------------------------------------------------------
*/

if ( ! function_exists( 'priscila_primary_sidebar_start' ) ) :

	/**
	 * Displays the start of the primary sidebar.
	 *
	 * @since 1.0.0
	 */
	function priscila_primary_sidebar_start() {
		?>

		<aside id="secondary" class="widget-area">

			<header>
				<h2 class='screen-reader-text'><?php esc_html_e( 'The section contains widgets', 'priscila' ); ?></h2>	
			</header>

			<?php dynamic_sidebar( 'primary' ); ?>

		</aside>

		<?php 
	}

endif;

/*
--------------------------------------------------------------
SITE FOOTER
--------------------------------------------------------------
*/

if ( ! function_exists( 'priscila_footer_start' ) ) :

	/**
	 * Displays the section of the footer widgets.
	 *
	 * @since 1.0.0
	 */
	function priscila_footer_start() {

		$footer_options = priscila_get_options( 'footer' );
		$copyright_text = $footer_options[ 'copyright_text' ];
		$active_col     = 0;
		$max_active_col = 3;

		for ( $i = 1; $i <= $max_active_col; $i++ ) :

			if ( is_active_sidebar( "footer-{$i}" ) ) :
				$active_col++;
			endif;
		endfor;

		if ( $active_col > 0 ) : ?>

			<section class='footer-widgets'>

				<header>
					<h2 class='screen-reader-text'><?php esc_html_e( 'Footer info section', 'priscila' ); ?></h2>
				</header>

				<div class='footer-widgets-container footer-widgets-container-columns-<?php echo esc_attr( $active_col ); ?>'>

					<?php
					for ( $i = 1; $i <= $max_active_col; $i++ ) :
						if ( is_active_sidebar( "footer-{$i}" ) ) :
							?>

					<div class="footer-widgets-column"><?php dynamic_sidebar( "footer-{$i}" ); ?></div>

							<?php
						endif;
					endfor;
					?>

				</div>

			</section><!-- .footer-widgets -->

			<?php
		endif;

		if ( has_nav_menu( 'footer' ) || $copyright_text !== '' ) : ?>

			<section class='footer-info'>

				<header>  
					<h2 class='screen-reader-text'><?php esc_html_e( 'The section contains information on copyright and first-level footer navigation', 'priscila' ); ?></h2>
				</header>

				<div class='footer-info-container'>

					<p class='footer-info-content'><?php echo esc_html( $copyright_text ); ?></p>

					<?php
					if ( has_nav_menu( 'footer' ) ) :

						wp_nav_menu(
							array(
								'theme_location'  => 'footer',
								'depth'           => 1,
								'container'       => '',
								'menu_id'         => '',
								'menu_class'      => 'footer-navigation-list ' . ( $copyright_text === '' ? 'footer-navigation-no-copyright' : '' ),
								'container_class' => '',
								'fallback_cb'     => false,
							)
						);

					endif;
					?>

				</div>

			</section><!-- .footer-info -->

			<?php
		endif;

	}

endif;
