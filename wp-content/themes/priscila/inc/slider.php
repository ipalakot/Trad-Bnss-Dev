<?php
/**
 * Simple slider for priscila theme.
 *
 * @package priscila
 * @since 1.0.0
 */

if ( ! function_exists( 'priscila_content_slider' ) ) :

	/**
	 * Displays slider.
	 *
	 * There are several settings in the Customizer.
	 *
	 * @since 1.0.0
	 */
	function priscila_content_slider() {

		$slider_options = priscila_get_options( 'slider' );
		$orderby        = $slider_options[ 'orderby' ];
		$where          = $slider_options[ 'where' ];
		$autoplay       = $slider_options[ 'autoplay' ];
		$query          = new WP_Query(
			array(
				'post_type'      => 'post',
				'posts_per_page' => 5,
				'orderby'        => $orderby,
				'meta_query'     => array(
					array(
						'key'     => '_thumbnail_id',
						'value'   => '0',
						'compare' => '>=',
					),
				),
			)
		);

		$css          = '';
		$i            = 0;
		$posts_number = $query->found_posts;

		$template = esc_html( $where );

		switch ( $template ) :
			case 'homepage_posts_page':
				$template = ( is_home() || is_front_page() );
				break;
			case 'homepage':
				$template = ( is_front_page() );
				break;
			case 'posts_page':
				$template = ( is_home() );
				break;
			default:
				$template = false;
		endswitch;

		if ( $query->have_posts() && $posts_number > 0 && $template ) :

			$auto = ( $autoplay && $posts_number > 1 ) ? 'true' : 'false'; ?>

			<div id='slider' class='slider slider-auto-<?php echo esc_html( $auto ); ?>'>

				<ul class='slider-list'>

					<?php
					while ( $query->have_posts() ) :
						$query->the_post();

						$img_id     = get_post_thumbnail_id();
						$img_alt    = get_post_meta( $img_id, '_wp_attachment_image_alt', true );
						$img_srcset = priscila_custom_srcset(
							$img_id,
							array(
								'slider',
								'slider_retina',
								'post',
								'post_medium',
								'post_retina',
								'medium',
								'medium_large',
								'large',
							)
						);

						if ( has_post_thumbnail() && ! empty( $img_srcset ) ) :

							$active_slider = 0 === $i ? ' slider-item-active' : '';
							$aria_expanded = 0 === $i ? 'true' : 'false';
							$link          = esc_url( get_the_permalink() );
							$title         = wp_kses_post( get_the_title() );
							$more_text     = sprintf(
								wp_kses(
									/* translators: %s: Title of the post. */
									__( '<span class="screen-reader-text">Read </span>More<span class="screen-reader-text"> about %s</span>', 'priscila' ),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								$title
							);
							?>

							<li class='slider-item slider-item-<?php echo esc_attr( $i ), esc_attr( $active_slider ); ?>' aria-expanded='<?php echo esc_attr( $aria_expanded ); ?>'>

								<div class='slider-item-container'>
									<?php
										the_post_thumbnail(
											'medium',
											array(
												'aria-hidden' => esc_attr( 'true' ),
												'srcset' => esc_attr( implode( ',', $img_srcset ) ),
												'alt'    => esc_attr( $img_alt ),
											)
										);
									?>

									<?php priscila_post_categories( get_the_ID() ); ?>
									<p class='slider-item-title'><?php echo esc_html( $title ); ?></p>
									<a class='slider-item-link' title='<?php echo esc_attr( $title ); ?>' href='<?php echo esc_url( $link ); ?>'>
										<?php
											echo wp_kses(
												$more_text,
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
										<span class='fas fa-angle-right' aria-hidden='true'></span>
									</a>
								</div>

							</li>

							<?php
							/* Take a thumbnail url to prepare CSS styles (background images). */
							$url  = ( 0 === $i ) ? esc_url( get_the_post_thumbnail_url( get_the_ID(), 'slider' ) ) : esc_url( get_the_post_thumbnail_url( get_the_ID(), 'medium' ) );
							$css .= wp_strip_all_tags( ".slider-item-{$i} { background-image: url( {$url} ); }" );

							$i++;

						endif;

					endwhile;
					?>

				</ul>

				<?php if ( $posts_number > 1 ) : ?>

					<div class='slider-arrows'>

						<button type='button' class='slider-arrow slider-arrow-prev'>
							<span class='fas fa-angle-left' aria-hidden='true'></span>
							<span class='screen-reader-text'><?php esc_html_e( 'Show previous slide', 'priscila' ); ?></span>
						</button>

						<button type='button' class='slider-arrow slider-arrow-next'>
							<span class='fas fa-angle-right' aria-hidden='true'></span>
							<span class='screen-reader-text'><?php esc_html_e( 'Show next slide', 'priscila' ); ?></span>
						</button>

					</div>

				<?php endif; ?>

			</div>

			<?php
			/* Restore original Post Data. */ wp_reset_postdata();

		endif;

		/* Add inline styles to slider items. */
		wp_enqueue_style( 'priscila-slider-style', PRISCILA_THEME_URI . 'style.css', array(), '1.0.0', 'all' );
		wp_add_inline_style( 'priscila-slider-style', wp_strip_all_tags( $css ) );

	}

endif;
