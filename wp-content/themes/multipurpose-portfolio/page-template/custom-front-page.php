<?php
/**
 * Template Name: Custom home page
 */

get_header(); ?>

<?php do_action('multipurpose_portfolio_above_banner_section'); ?>

<section id="banner"> 
  <?php $pages = array();
    $mod = intval( get_theme_mod( 'multipurpose_portfolio_banner_page' ));
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
      $i = 1;
  ?>
  <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
    <img src="<?php the_post_thumbnail_url('full'); ?>"/>
    <div class="banner-box">
      <div class="inner_carousel">
          <h2><?php the_title();?></h2> 
          <p><?php $excerpt = get_the_excerpt(); echo esc_html( multipurpose_portfolio_string_limit_words( $excerpt,20) ); ?></p>
          <div class ="read-more">
            <a href="<?php the_permalink(); ?>"><?php esc_html_e('ABOUT ME','multipurpose-portfolio'); ?></a>
          </div>                    
      </div>
    </div>
    <div class="social-media">
      <?php if( get_theme_mod( 'multipurpose_portfolio_facebook_url') != '') { ?>
        <a href="<?php echo esc_url( get_theme_mod( 'multipurpose_portfolio_facebook_url','' ) ); ?>"><i class="fab fa-facebook-f"></i></a>
      <?php } ?>
      <?php if( get_theme_mod( 'multipurpose_portfolio_twitter_url') != '') { ?>
        <a href="<?php echo esc_url( get_theme_mod( 'multipurpose_portfolio_twitter_url','' ) ); ?>"><i class="fab fa-twitter"></i></a>
      <?php } ?>
      <?php if( get_theme_mod( 'multipurpose_portfolio_insta_url') != '') { ?>
        <a href="<?php echo esc_url( get_theme_mod( 'multipurpose_portfolio_insta_url','' ) ); ?>"><i class="fab fa-instagram"></i></a>
      <?php } ?>
      <?php if( get_theme_mod( 'multipurpose_portfolio_pinterest_url') != '') { ?>
        <a href="<?php echo esc_url( get_theme_mod( 'multipurpose_portfolio_pinterest_url','' ) ); ?>"><i class="fab fa-pinterest-p"></i></a>
      <?php } ?> 
      <?php if( get_theme_mod( 'multipurpose_portfolio_googleplus_url') != '') { ?>
        <a href="<?php echo esc_url( get_theme_mod( 'multipurpose_portfolio_googleplus_url','' ) ); ?>"><i class="fab fa-google-plus-g"></i></i></a>
      <?php } ?>
      <?php if( get_theme_mod( 'multipurpose_portfolio_youtube_url') != '') { ?>
        <a href="<?php echo esc_url( get_theme_mod( 'multipurpose_portfolio_youtube_url','' ) ); ?>"><i class="fab fa-youtube"></i></a>
      <?php } ?>
    </div>
  <?php  endwhile; ?>
  <?php else : ?>
    <div class="no-postfound"></div>
    <?php endif;
    endif;?>
  <div class="clearfix"></div>
</section> 

<?php do_action('multipurpose_portfolio_below_banner_section'); ?>

<?php if( get_theme_mod('multipurpose_portfolio_services_title') != '' || get_theme_mod('multipurpose_portfolio_services_category') != ''){ ?>
  <section id="services">
    <div class="container">
      <?php if( get_theme_mod('multipurpose_portfolio_services_title') != ''){ ?>
        <h3><?php echo esc_html(get_theme_mod('multipurpose_portfolio_services_title','')); ?></h3>
      <?php }?>
      <div class="row">
        <?php 
          $catData=  get_theme_mod('multipurpose_portfolio_services_category');
            if($catData){
            $page_query = new WP_Query(array( 'category_name' => esc_html( $catData ,'multipurpose-portfolio')));?>
              <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
                <div class="col-lg-4 col-md-4">
                  <div class="service-content">
                    <img src="<?php the_post_thumbnail_url('full'); ?>"/>
                    <h4><a href="<?php echo esc_url( get_permalink() );?>"><?php the_title();?></a></h4>
                    <p><?php $excerpt = get_the_excerpt(); echo esc_html( multipurpose_portfolio_string_limit_words( $excerpt,10) ); ?></p>
                  </div>
                </div>
                <?php endwhile;
              wp_reset_postdata();
            } ?>
      </div>
    </div>
  </section>
<?php }?>

<?php do_action('multipurpose_portfolio_after_service_section'); ?>

<div class="container">
  <?php while ( have_posts() ) : the_post(); ?>
    <?php the_content(); ?>
  <?php endwhile; // end of the loop. ?>
</div>

<?php get_footer(); ?>