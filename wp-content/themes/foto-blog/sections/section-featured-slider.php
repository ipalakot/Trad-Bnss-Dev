<?php 
/**
 * Template part for displaying Featured Slider Section
 *
 *@package Foto Blog
 */
    $sr_content_type         = foto_blog_get_option( 'sr_content_type' );
    $number_of_sr_items      = foto_blog_get_option( 'number_of_sr_items' );
    $featured_slider_speed   = foto_blog_get_option( 'featured_slider_speed' );

    if( $sr_content_type == 'sr_page' ) :
        for( $i=1; $i<=$number_of_sr_items; $i++ ) :
            $featured_slider_posts[] = foto_blog_get_option( 'slider_page_'.$i );
        endfor;  
    elseif( $sr_content_type == 'sr_post' ) :
        for( $i=1; $i<=$number_of_sr_items; $i++ ) :
            $featured_slider_posts[] = foto_blog_get_option( 'slider_post_'.$i );
        endfor;
    endif;
    ?>
    <?php if( $sr_content_type == 'sr_page' ) : ?>
        <div class="featured-slider-wrapper" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": true, "speed": <?php echo esc_html( $featured_slider_speed ); ?>, "dots": false, "arrows":true, "autoplay": true, "fade": true }'>
            <?php $args = array (
                'post_type'     => 'page',
                'post_per_page' => count( $featured_slider_posts ),
                'post__in'      => $featured_slider_posts,
                'orderby'       =>'post__in',
            );   

            $loop = new WP_Query($args);                        
                if ( $loop->have_posts() ) :
                $i=-1;  
                    while ($loop->have_posts()) : $loop->the_post(); $i++;?>
                        <article class="slick-item" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');">
                            <div class="wrapper">
                                <div class="featured-content-wrapper">
                                    <header class="entry-header">
                                        <h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                                    </header>

                                    <div class="read-more">
                                        <?php $readmore_text = foto_blog_get_option( 'readmore_text' );?>
                                        <a href="<?php the_permalink();?>" class="more-link"><?php echo esc_html($readmore_text);?></a>
                                    </div><!-- .read-more -->
                                </div><!-- .featured-content-wrapper -->
                            </div><!-- .wrapper -->
                        </article><!-- .slick-item -->
                    <?php endwhile;?>
                    <?php wp_reset_postdata();
                endif;?>
        </div><!-- .featured-slider-wrapper -->

    <?php elseif( $sr_content_type == 'sr_post' ) : ?>
        <div class="featured-slider-wrapper" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": true, "speed": <?php echo esc_html( $featured_slider_speed ); ?>, "dots": false, "arrows":true, "autoplay": true, "fade": true }'>
            <?php $args = array (
                'post_type'     => 'post',
                'post_per_page' => count( $featured_slider_posts ),
                'post__in'      => $featured_slider_posts,
                'orderby'       =>'post__in',
                'ignore_sticky_posts' => true,
            );   

            $loop = new WP_Query($args);                        
                if ( $loop->have_posts() ) :
                $i=-1;  
                    while ($loop->have_posts()) : $loop->the_post(); $i++;?>
                        <article class="slick-item" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');">
                            <div class="wrapper">
                                <div class="featured-content-wrapper">
                                    <header class="entry-header">
                                        <h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                                    </header>

                                    <div class="read-more">
                                        <?php $readmore_text = foto_blog_get_option( 'readmore_text' );?>
                                        <a href="<?php the_permalink();?>" class="more-link"><?php echo esc_html($readmore_text);?></a>
                                    </div><!-- .read-more -->
                                </div><!-- .featured-content-wrapper -->
                            </div><!-- .wrapper -->
                        </article><!-- .slick-item -->
                    <?php endwhile;?>
                    <?php wp_reset_postdata();
                endif;?>
        </div><!-- .featured-slider-wrapper -->
    <?php endif;