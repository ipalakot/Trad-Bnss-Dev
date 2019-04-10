<?php
/**
 * Template Name: Custom Home Page
 */

get_header(); ?>

<?php do_action( 'vw_maintenance_services_before_slider' ); ?>

<?php if( get_theme_mod( 'vw_maintenance_services_slider_arrows') != '') { ?>

<section id="slider">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
    <?php $pages = array();
      for ( $count = 1; $count <= 4; $count++ ) {
        $mod = intval( get_theme_mod( 'vw_maintenance_services_slider_page' . $count ));
        if ( 'page-none-selected' != $mod ) {
          $pages[] = $mod;
        }
      }
      if( !empty($pages) ) :
        $args = array(
          'post_type' => 'page',
          'post__in' => $pages,
          'orderby' => 'post__in'
        );
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) :
          $i = 1;
    ?>     
    <div class="carousel-inner" role="listbox">
      <?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
          <img src="<?php the_post_thumbnail_url('full'); ?>"/>
          <div class="carousel-caption">
            <div class="inner_carousel">
              <h2><?php the_title(); ?></h2>
              <p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_maintenance_services_string_limit_words( $excerpt,15 ) ); ?></p>
              <div class="more-btn">
                <a class="view-more" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e( 'Read More', 'vw-maintenance-services' ); ?><i class="fa fa-angle-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      <?php $i++; endwhile; 
      wp_reset_postdata();?>
    </div>
    <?php else : ?>
        <div class="no-postfound"></div>
    <?php endif;
    endif;?>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
    </a>
  </div>
  <div class="clearfix"></div>
</section>

<?php } ?>

<?php do_action( 'vw_maintenance_services_after_slider' ); ?>

<section id="services-section">
  <div class="container">
    <?php if( get_theme_mod( 'vw_maintenance_services_section_title') != '') { ?>
      <h3><?php echo esc_html(get_theme_mod('vw_maintenance_services_section_title',''));?></h3>
    <?php }?>
    <div class="row">
      <div class="col-lg-4 col-md-4"> 
        <?php
          $catData =  get_theme_mod('vw_maintenance_services_left_service','');
          if($catData){
          $page_query = new WP_Query(array( 'category_name' => esc_html($catData,'vw-maintenance-services'))); ?>
          <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
            <div class="left-services">
              <div class="row">
                <div class="col-lg-8 col-md-8">
                  <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                  <p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_maintenance_services_string_limit_words( $excerpt,10 ) ); ?></p>
                </div>
                <div class="col-lg-4 col-md-4 p-md-0">
                  <?php the_post_thumbnail(); ?>
                </div>
              </div>
            </div>
          <?php endwhile;
          wp_reset_postdata();
        } ?>
      </div>
      <div class="col-lg-4 col-md-4">
        <?php $pages = array();
          $mod = absint( get_theme_mod( 'vw_maintenance_services_about','vw-maintenance-services'));
          if ( 'page-none-selected' != $mod ) {
            $pages[] = $mod;
          }
          if( !empty($pages) ) :
            $args = array(
              'post_type' => 'page',
              'post__in' => $pages,
              'orderby' => 'post__in'
            );
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) :
              $count = 0;
              while ( $query->have_posts() ) : $query->the_post(); ?>
              <div class="box">
                <?php the_post_thumbnail(); ?>
                <div class="box-content">
                  <div class="content">
                    <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <p class="post"><?php $excerpt = get_the_excerpt(); echo esc_html( vw_maintenance_services_string_limit_words( $excerpt,15 ) ); ?></p>
                  </div>
                </div>
              </div>
              <?php $count++; endwhile; ?>
            <?php else : ?>
              <div class="no-postfound"></div>
            <?php endif;
          endif;
          wp_reset_postdata();
        ?>
      </div>
      <div class="col-lg-4 col-md-4"> 
        <?php
          $catData =  get_theme_mod('vw_maintenance_services_right_service','');
          if($catData){
          $page_query = new WP_Query(array( 'category_name' => esc_html($catData,'vw-maintenance-services'))); ?>
          <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
            <div class="right-services">
              <div class="row">
                <div class="col-lg-4 col-md-4 p-md-0">
                  <?php the_post_thumbnail(); ?>
                </div>
                <div class="col-lg-8 col-md-8">
                  <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                  <p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_maintenance_services_string_limit_words( $excerpt,10 ) ); ?></p>
                </div>
              </div>
            </div>
          <?php endwhile;
          wp_reset_postdata();
        } ?>
      </div>
    </div>
  </div>
</section>

<?php do_action( 'vw_maintenance_services_after_services' ); ?>

<div id="content-vw">
  <div class="container">
    <?php while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?>
  </div>
</div>

<?php get_footer(); ?>