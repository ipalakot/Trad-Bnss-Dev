<?php
/**
 * Comment API: Walker_Comment class
 *
 * @package priscila
 * @since 1.0.0
 */

if ( ! class_exists( 'Priscila_Walker_Comments' ) ) :

	/**
	 * Priscila_Walker_Comments
	 *
	 * The class used to remodel the comments section extended by the core walker class used to create an HTML list of comments.
	 *
	 * @since 1.0.0
	 */
	class Priscila_Walker_Comments extends Walker_Comment {

		/**
		 * What the class handles.
		 *
		 * @var string
		 * @see Walker::$tree_type
		 *
		 * @since 1.0.0
		 */
		public $tree_type = 'comment';

		/**
		 * Database fields to use.
		 *
		 * @var array
		 * @see Walker::$db_fields
		 *
		 * @since 1.0.0
		 */
		public $db_fields = array(
			'parent' => 'comment_parent',
			'id'     => 'comment_ID',
		);

		/**
		 * Instance
		 *
		 * @access private
		 * @var object Class object.
		 *
		 * @since 1.0.0
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @return object initialized object of class.
		 *
		 * @since 1.0.0
		 */
		public static function get_instance() {

			if ( ! isset( self::$instance ) ) :

				self::$instance = new self();

			endif;

			return self::$instance;

		}

		/**
		 * Starts the list before the elements are added.
		 *
		 * @see Walker::start_lvl()
		 * @global int $comment_depth
		 *
		 * @param string $output Used to append additional content (passed by reference).
		 * @param int    $depth  Optional. Depth of the current comment. Default 0.
		 * @param array  $args   Optional. Uses 'style' argument for type of HTML list. Default empty array.
		 *
		 * @since 1.0.0
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {

			$comment_depth = $depth + 2;
			$output       .= '<section class="child-comments comments-list">';

		}

		/**
		 * Ends the list of items after the elements are added.
		 *
		 * @see Walker::end_lvl()
		 * @global int $comment_depth
		 *
		 * @param string $output Used to append additional content (passed by reference).
		 * @param int    $depth  Optional. Depth of the current comment. Default 0.
		 * @param array  $args   Optional. Will only append content if style argument value is 'ol' or 'ul'.
		 *                       Default empty array.
		 *
		 * @since 1.0.0
		 */
		public function end_lvl( &$output, $depth = 0, $args = array() ) {

			$comment_depth = $depth + 2;
			$output       .= '</section>';

		}

		/**
		 * Starts the element output.
		 *
		 * @see Walker::start_el()
		 * @see wp_list_comments()
		 * @global int        $comment_depth
		 * @global WP_Comment $comment
		 *
		 * @param string     $output  Used to append additional content. Passed by reference.
		 * @param WP_Comment $comment Comment data object.
		 * @param int        $depth   Optional. Depth of the current comment in reference to parents. Default 0.
		 * @param array      $args    Optional. An array of arguments. Default empty array.
		 * @param int        $id      Optional. ID of the current comment. Default 0 (unused).
		 *
		 * @since 1.0.0
		 */
		public function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {

			$output .= '<div class="comments-wrapper">';

			$depth++;
			$comment_depth = $depth;

			$parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' );

			if ( 'article' === $args['style'] ) :

				$tag       = 'article';
				$add_below = 'comment';

			else :

				$tag       = 'article';
				$add_below = 'comment';

			endif;

			$output .= '<article ' . comment_class( ( empty( $args['has_children'] ) ? '' : 'parent' ), null, null, false ) . ' id="comment-' . $comment->comment_ID . '" itemprop="comment" itemscope itemtype="http://schema.org/Comment">';

			$output .= '<div class="comment-meta post-meta" role="complementary">';
			$output .= ( get_avatar( $comment, 65, '', 'Gravatar of the author' ) ) ? '<figure class="gravatar">' . get_avatar( $comment, 65, '', 'Gravatar of the author' ) . '</figure>' : '';

			$output .= '<div class="comment-details">';
			$output .= '<h3 class="comment-author">';
			$output .= '<a class="comment-author-link" href="' . $comment->comment_author_url . '" itemprop="author">' . $comment->comment_author . '</a>';
			$output .= '</h3>';
			$output .= '<time class="comment-meta-item" datetime="' . get_comment_date( 'Y-m-d', $comment->comment_ID ) . 'T' . get_comment_date( 'H:iP', $comment->comment_ID ) . '" itemprop="datePublished">' . get_comment_date( 'jS F Y H:i', $comment->comment_ID ) . '</time>';
			$output .= '<p class="comment-meta-item"><a href="' . get_edit_comment_link( $comment->comment_ID ) . '">' . esc_html__( 'Edit this comment', 'priscila' ) . '</a></p>';

			if ( '0' === $comment->comment_approved ) :

				$output .= '<p class="comment-meta-item">Your comment is awaiting moderation.</p>';

			endif;

			$output .= '</div>';
			$output .= '</div>';

			$output .= '<div class="comment-content post-content" itemprop="text">';

			add_filter( 'get_comment_text', 'wpautop' );

			$output .= get_comment_text( $comment->comment_ID );

			remove_filter( 'get_comment_text', 'wpautop' );

			$output .= '<p>' . get_comment_reply_link(
				array_merge(
					$args,
					array(
						'add_below' => $add_below,
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
					)
				),
				$comment
			) . '</p>';

			$output .= '</div>';

			$output .= '</article>';

		}

		/**
		 * Ends the element output, if needed.
		 *
		 * @see Walker::end_el()
		 * @see wp_list_comments()
		 *
		 * @param string     $output  Used to append additional content. Passed by reference.
		 * @param WP_Comment $comment The current comment object. Default current comment.
		 * @param int        $depth   Optional. Depth of the current comment. Default 0.
		 * @param array      $args    Optional. An array of arguments. Default empty array.
		 *
		 * @since 1.0.0
		 */
		public function end_el( &$output, $comment, $depth = 0, $args = array() ) {

			$output .= '</div>';

		}

	}

	/* Get instance. */
	Priscila_Walker_Comments::get_instance();

endif;
