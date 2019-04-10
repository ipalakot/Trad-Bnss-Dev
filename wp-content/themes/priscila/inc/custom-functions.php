<?php
/**
 * Helper functions & filters.
 *
 * @since 1.0.0
 *
 * @package priscila
 */

if ( ! function_exists( 'priscila_additional_body_classes' ) ) :

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 *
	 * @since 1.0.0
	 */
	function priscila_additional_body_classes( $classes ) {

		$content_options = priscila_get_options( 'content' );
		$sidebar_pos     = $content_options['sidebar_pos'];

		/* Adds a class of hfeed to non-singular pages. */
		if ( ! is_singular() ) :

			$classes[] = 'hfeed';

		endif;

		/* Adds a class of no-sidebar when there is no sidebar present. */
		if ( ! is_active_sidebar( 'primary' ) || $sidebar_pos === '' ) :

			$classes[] = 'no-sidebar';

		endif;

		return $classes;

	}

endif;

add_filter( 'body_class', 'priscila_additional_body_classes' );

if ( ! function_exists( 'priscila_add_class_to_archive_description' ) ) :

	/**
	 * Adds custom class to the archive description paragraph.
	 *
	 * @see priscila_page_header
	 * @param string $archive_description The value describes the entire archive description of the html code.
	 * @return string With the class added to the paragraph.
	 *
	 * @since 1.0.0
	 */
	function priscila_add_class_to_archive_description( $archive_description ) {

		return str_replace( '<p>', '<p class="page-header-description">', $archive_description );

	}

endif;

add_filter( 'get_the_archive_description', 'priscila_add_class_to_archive_description' );

if ( ! function_exists( 'priscila_page_header' ) ) :

	/**
	 * Displays the page header.
	 *
	 * @param string $template The value describes for which template we create a header. Default ''.
	 *
	 * @since 1.0.0
	 */
	function priscila_page_header( $template = '' ) {
		?>

		<header class='page-header'>

			<?php if ( 'index' === $template ) : ?>

				<h1 class='page-header-title screen-reader-text'>
					<?php echo single_post_title( '', false ) !== '' ? wp_kses_post( single_post_title( '', false ) ) : wp_kses_post( get_bloginfo( 'name' ) ); ?>
				</h1>

			<?php elseif ( 'archive' === $template ) : ?>

				<h1 class='page-header-title'><?php echo wp_kses_post( get_the_archive_title() ); ?></h1>
				<?php
					echo wp_kses(
						get_the_archive_description(),
						array(
							'p' => array(
								'class' => array(),
							),
						)
					);
				?>

			<?php elseif ( 'search' === $template ) : ?>

				<h1 class='page-header-title'>
					<?php
					printf(
						/* translators: %s: Search query. */
						esc_html__( 'Search sesults for: %s', 'priscila' ),
						'<span>' . get_search_query() . '</span>'
					);
					?>
				</h1>

			<?php elseif ( '404' === $template ) : ?>

				<h1 class='page-header-title'><?php esc_html_e( 'The requested page can not be found', 'priscila' ); ?></h1>

			<?php elseif ( 'nothing' === $template ) : ?>

				<h1 class='page-header-title'><?php esc_html_e( 'Nothing Found', 'priscila' ); ?></h1>

			<?php else : ?>

				<h1 class='page-header-title'><?php echo wp_kses_post( get_the_title() ); ?></h1>

			<?php endif; ?>

		</header>

		<?php
	}

endif;

if ( ! function_exists( 'priscila_modify_tag_widget_sizes' ) ) :

	/**
	 * Modify the font size of tag widget.
	 *
	 * @param array $args Array of tag widget parameters.
	 * @return array With modified font size parameters.
	 *
	 * @since 1.0.0
	 */
	function priscila_modify_tag_widget_sizes( $args ) {

		$args['smallest'] = '10';
		$args['largest']  = '16';

		return $args;

	}

endif;

add_filter( 'widget_tag_cloud_args', 'priscila_modify_tag_widget_sizes' );

if ( ! function_exists( 'priscila_modify_wp_list_categories_count' ) ) :

	/**
	 * Wrap the post count in a span tag.
	 *
	 * @param string $links Links.
	 * @return string Links with added span tag.
	 *
	 * @since 1.0.0
	 */
	function priscila_modify_wp_list_categories_count( $links ) {

		$links = str_replace( '</a> (', '</a> <span>(', $links );
		$links = str_replace( ')', ')</span>', $links );

		return $links;

	}

endif;

add_filter( 'wp_list_categories', 'priscila_modify_wp_list_categories_count' );

if ( ! function_exists( 'priscila_modify_custom_logo' ) ) :

	/**
	 * Remove default link from custom logo.
	 *
	 * @since 1.0.0
	 *
	 * @return string Default logo with removed default link.
	 */
	function priscila_modify_custom_logo( $logo ) {

		$core_options = priscila_get_options( 'core' );

		return wp_get_attachment_image(
			$core_options[ 'custom_logo' ],
			'full',
			false,
			array(
				'class' => 'custom-logo',
				'alt'   => esc_html__( 'Site logo', 'priscila' ),
			)
		);

	}

endif;

add_filter( 'get_custom_logo', 'priscila_modify_custom_logo' );

if ( ! function_exists( 'set_custom_excerpt_length' ) ) :

	/**
	 * Sets the length of the text.
	 *
	 * @see priscila_excerpt
	 * @global $custom_excerpt_length
	 * @param int $length Length of the excerpt.
	 * @return int
	 *
	 * @since 1.0.0
	 */
	function set_custom_excerpt_length( $length ) {

		global $custom_excerpt_length;

		if ( ! isset( $custom_excerpt_length ) ) :

			return $length;

		endif;

		return $custom_excerpt_length;

	}

endif;

if ( ! function_exists( 'set_custom_excerpt_more' ) ) :

	/**
	 * Sets the custom excerpt more.
	 *
	 * @see priscila_excerpt
	 * @global $custom_excerpt_more
	 * @param string $more Excerpt more html code.
	 * @return string
	 *
	 * @since 1.0.0
	 */
	function set_custom_excerpt_more( $more ) {

		global $custom_excerpt_more;

		if ( ! isset( $custom_excerpt_more ) ) :

			return $more;

		endif;

		return $custom_excerpt_more;

	}

endif;

if ( ! function_exists( 'priscila_excerpt' ) ) :

	/**
	 * The custom post excerpt.
	 *
	 * @see set_custom_excerpt_length
	 * @see set_custom_excerpt_more
	 * @param int  $length Length of the excerpt. Default 50.
	 * @param int  $post_id Id of the post. Default ''.
	 * @param bool $link Add a link or not. Accepts true, false. Default true.
	 * @return void
	 *
	 * @since 1.0.0
	 */
	function priscila_excerpt( $length = 50, $post_id = '', $link = true ) {

		global $custom_excerpt_length, $custom_excerpt_more, $post;
		$custom_excerpt_length = $length;
		$custom_excerpt_more   = '...';

		$post_id = ( '' !== $post_id ) ? $post_id : $post->ID;

		add_filter( 'excerpt_length', 'set_custom_excerpt_length', 999 );
		add_filter( 'excerpt_more', 'set_custom_excerpt_more', 999 );
		?>

		<p><?php echo esc_html( get_the_excerpt( $post_id ) ); ?>

		<?php if ( true === $link ) : ?>

			<a href='<?php echo esc_url( get_permalink( $post_id ) ); ?>' 
			title='
			<?php
			echo esc_attr(
				the_title_attribute(
					array(
						'echo' => false,
					)
				)
			);
			?>
			'>

				<?php
				printf(
					wp_kses( /* translators: %s: Title of the post. */
						__( '<span class="screen-reader-text">Read </span><span class="excerpt-more">More</span><span class="screen-reader-text"> about %s</span>', 'priscila' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title( $post_id ) )
				);
				?>

			</a>

		<?php endif; ?>

		</p>

		<?php
		remove_filter( 'excerpt_length', 'set_custom_excerpt_length', 999 );
		remove_filter( 'excerpt_more', 'set_custom_excerpt_more', 999 );

	}

endif;

if ( ! function_exists( 'priscila_loop_content_template' ) ) :

	/**
	 * Checks which template is currently in use and returns an adequate string.
	 *
	 * @return string
	 *
	 * @since 1.0.0
	 */
	function priscila_loop_content_template() {

		if ( is_search() ) :

			return 'search';

		elseif ( is_attachment() ) :

			return 'attachment';

		elseif ( is_single() ) :

			return 'single';

		else :

			return get_post_type();

		endif;

	}

endif;

if ( ! function_exists( 'priscila_change_default_get_search_form' ) ) :

	/**
	 * Modify the default search form.
	 *
	 * @link https://developer.wordpress.org/reference/functions/get_search_form/
	 * @param string $form Default WordPress search form.
	 * @return string Modified version of default search form.
	 *
	 * @since 1.0.0
	 */
	function priscila_change_default_get_search_form( $form ) {

		$unique_id        = esc_attr( uniqid( 'search-form-' ) );
		$link             = esc_url( home_url( '/' ) );
		$query            = get_search_query();
		$placeholder_text = esc_attr_x( 'Search:', 'Search engine placeholder', 'priscila' );
		$label_text       = _x( 'Search for:', 'Label', 'priscila' );
		$btn_text         = _x( 'Search', 'Submit button text', 'priscila' );

		return "
			<form role='search' method='get' class='search-form' action='{$link}'>
			<label for='{$unique_id}'><span class='screen-reader-text'>{$label_text}</span></label>
			<input type='search' id='{$unique_id}' class='search-field' placeholder='{$placeholder_text}' value='{$query}' name='s' />
			<button type='submit' class='search-button'><span class='fas fa-search' aria-hidden='true'></span><span class='screen-reader-text'>{$btn_text}</span></button>
			</form>
		";

	}

endif;

add_filter( 'get_search_form', 'priscila_change_default_get_search_form' );

if ( ! function_exists( 'priscila_post_date' ) ) :

	/**
	 * Post date.
	 *
	 * @link http://php.net/manual/en/class.datetime.php
	 *
	 * @since 1.0.0
	 */
	function priscila_post_date() {

		$time = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) :

			$time = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';

		endif;

		$time = sprintf(
			$time,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);
		?>

		<span class='post-date'>
			<?php
				printf(
					/* translators: %s: Post date. */
					esc_html_x( 'Date: %s', 'post date', 'priscila' ),
					wp_kses(
						$time,
						array(
							'time' => array(
								'class'    => array(),
								'datetime' => array(),
							),
						)
					)
				);
			?>
		</span>

		<?php
	}

endif;

if ( ! function_exists( 'priscila_post_author' ) ) :

	/**
	 * Post author.
	 *
	 * @since 1.0.0
	 */
	function priscila_post_author() {
		?>

		<span class='post-author'><?php echo esc_html_x( 'Author:', 'Post author', 'priscila' ); ?>
			<a href='<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>' title='<?php echo esc_attr( 'Show all posts by ' . get_the_author(), 'priscila' ); ?>'><?php echo esc_html( get_the_author() ); ?> </a>
		</span>

		<?php
	}

endif;

if ( ! function_exists( 'priscila_post_comments_number' ) ) :

	/**
	 * Post comment number.
	 *
	 * @since 1.0.0
	 */
	function priscila_post_comments_number() {

		printf(
			'<span class="post-comments">%s</span>',
			sprintf(
				wp_kses(
					/* translators: %s: Link to the comments section. */
					_nx(
						'Comment: %s',
						'Comments: %s',
						esc_html( get_comments_number() ),
						'Post comments',
						'priscila'
					),
					array(
						'a' => array(
							'href'  => array(),
							'title' => array(),
						),
					)
				),
				'<a href="' . esc_url( get_comments_link() ) . '" title="' . sprintf(
					/* translators: %s: Topic name. */
					esc_html__( 'Go to the comments section of the topic %s', 'priscila' ),
					wp_kses_post( get_the_title() )
				) . '">' . esc_html( number_format_i18n( get_comments_number() ) ) . '</a>'
			)
		);

	}

endif;

if ( ! function_exists( 'priscila_post_categories' ) ) :

	/**
	 * Post categories.
	 *
	 * @param int $post_id Id of the post. Default ''.
	 *
	 * @since 1.0.0
	 */
	function priscila_post_categories( $post_id = '' ) {

		$cat_list = '';
		$post_id  = isset( $post_id ) ? $post_id : $post->ID;

		foreach ( wp_get_post_categories( $post_id ) as $id => $category_id ) :

			$link            = get_category_link( $category_id );
			$link_title_attr = sprintf( esc_attr( 'Show all posts in category %s', 'priscila' ), get_cat_name( $category_id ) );
			$name            = sprintf(
				wp_kses(
					/* translators: %s: The name of the selected category. */
					__( '<span class="screen-reader-text">Category</span> %s', 'priscila' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_cat_name( $category_id )
			);

			$cat_list .= "<li><a href='{$link}' title='{$link_title_attr}'>{$name}</a></li>";

		endforeach;
		?>

		<ul class='post-categories-list'>
			<?php
				echo wp_kses(
					$cat_list,
					array(
						'li'   => array(),
						'span' => array( 'class' => array() ),
						'a'    => array(
							'href'  => array(),
							'title' => array(),
						),
					)
				);
			?>
		</ul>

		<?php
	}

endif;

if ( ! function_exists( 'priscila_post_tags' ) ) :

	/**
	 * Post tags.
	 *
	 * @param int $post_id Id of the post. Default ''.
	 *
	 * @since 1.0.0
	 */
	function priscila_post_tags( $post_id = '' ) {

		$tag_list = '';
		$post_id  = isset( $post_id ) ? $post_id : $post->ID;

		if ( ! get_the_tags( $post_id ) ) :

			return;

		endif;

		foreach ( get_the_tags( $post_id ) as $id => $tag_id ) :

			$link            = get_tag_link( $tag_id );
			$name            = esc_html( get_tag( $tag_id )->name );
			$link_title_attr = sprintf(
				/* translators: %s: The name of the tag. */
				esc_html__( 'Show all posts containing the tag %s', 'priscila' ),
				esc_attr( $name )
			);

			$tag_list .= "<li><a href='{$link}' title='{$link_title_attr}'><span>&#35;</span>{$name}</a></li>";

		endforeach;
		?>

		<ul class='post-tags-list'>
			<?php
				echo wp_kses(
					$tag_list,
					array(
						'li'   => array(),
						'span' => array( 'class' => array() ),
						'a'    => array(
							'href'  => array(),
							'title' => array(),
						),
					)
				);
			?>
		</ul>

		<?php
	}

endif;

if ( ! function_exists( 'priscila_custom_srcset' ) ) :

	/**
	 * Returns the srcset attribute based on the given image size.
	 *
	 * @param int   $img_id Post thumbnail ID. Default ''.
	 * @param array $sizes An array with the expected sizes. Default array().
	 * @return array An array with the expected srcset values.
	 *
	 * @since 1.0.0
	 */
	function priscila_custom_srcset( $img_id = '', $sizes = array() ) {

		/* Get an array with image size names. */
		$img_size_names = get_intermediate_image_sizes();

		/* Convert how many size names we have. */
		$img_sizes_length = count( $img_size_names );

		/* Get an array with image sizes. */
		$img_metadata = wp_get_attachment_metadata( $img_id );

		if ( empty( $img_metadata ) ) :

			return;

		endif;

		$img_sizes = $img_metadata['sizes'];

		/* We start with an empty array. */
		$srcset_arr = array();

		for ( $i = 0; $i < $img_sizes_length; $i++ ) :

			/* We check whether there is a name in the array $img_size_names from the $sizes array we have given, and whether there is a picture of a given width in the $img_sizes array. */
			if ( in_array( $img_size_names[ $i ], $sizes, true ) && isset( $img_sizes[ $img_size_names[ $i ] ]['width'] ) ) :

				array_push( $srcset_arr, wp_get_attachment_image_url( $img_id, $img_size_names[ $i ] ) . " {$img_sizes[ $img_size_names[ $i ] ][ 'width' ]}w" );

			endif;

		endfor;

		return $srcset_arr;

	}

endif;
