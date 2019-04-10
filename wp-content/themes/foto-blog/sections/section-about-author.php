<?php 
/**
 * Template part for displaying Services Section
 *
 *@package Foto Blog
 */

    $ss_content_type     = foto_blog_get_option( 'ss_content_type' );
    $number_of_ss_column = foto_blog_get_option( 'number_of_ss_column' );
    $number_of_ss_items  = foto_blog_get_option( 'number_of_ss_items' );

    if( $ss_content_type == 'ss_page' ) :
        for( $i=1; $i<=$number_of_ss_items; $i++ ) :
            $about_author_posts[] = foto_blog_get_option( 'about_author_page_'.$i );
        endfor;  
    elseif( $ss_content_type == 'ss_post' ) :
        for( $i=1; $i<=$number_of_ss_items; $i++ ) :
            $about_author_posts[] = foto_blog_get_option( 'about_author_post_'.$i );
        endfor;
    endif;
    ?>

    <?php if( $ss_content_type == 'ss_page' ) : ?>
        <div class="section-content col-3">
            <?php $args = array (
                'post_type'     => 'page',
                'post_per_page' => count( $about_author_posts ),
                'post__in'      => $about_author_posts,
                'orderby'       =>'post__in',
            );   

            $loop = new WP_Query($args);                        
            if ( $loop->have_posts() ) :
            $i=-1;  
                while ($loop->have_posts()) : $loop->the_post(); $i++;?>
                
                <article>
                    <div class="course-item-wrapper" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');">                    
                        <div class="entry-container">
                            <a href="<?php the_permalink();?>" class="post-title"><?php the_title();?></a>
                        </div><!-- .entry-container -->
                    </div><!-- .course-item-wrapper -->
                </article>

              <?php endwhile;?>
              <?php wp_reset_postdata(); ?>
            <?php endif;?>
        </div>

    <?php elseif( $ss_content_type == 'ss_post' ) : ?>
        <div class="section-content col-3">
            <?php $args = array (
                'post_type'     => 'post',
                'post_per_page' => count( $about_author_posts ),
                'post__in'      => $about_author_posts,
                'orderby'       =>'post__in',
                'ignore_sticky_posts' => true,
            );   

            $loop = new WP_Query($args);                        
            if ( $loop->have_posts() ) :
            $i=-1;  
                while ($loop->have_posts()) : $loop->the_post(); $i++;?>
                
                <article>
                    <div class="course-item-wrapper" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');">                    
                        <div class="entry-container">
                            <div class="entry-meta">
                                <?php foto_blog_entry_meta(); ?>
                            </div><!-- .entry-meta -->

                            <a href="<?php the_permalink();?>" class="post-title"><?php the_title();?></a>
                        </div><!-- .entry-container -->
                    </div><!-- .course-item-wrapper -->
                </article>

              <?php endwhile;?>
              <?php wp_reset_postdata(); ?>
            <?php endif;?>
        </div> 
    <?php endif;
