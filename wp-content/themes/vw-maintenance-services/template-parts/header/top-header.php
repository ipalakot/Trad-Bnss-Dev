<?php
/**
 * The template part for top header
 *
 * @package VW Maintenance Services 
 * @subpackage vw_maintenance_services
 * @since VW Maintenance Services 1.0
 */
?>

<div id="topbar">
  <div class="container">
    <div class="row m-0">
      <div class="col-lg-3 col-md-12">
        <div class="logo">
          <?php if( has_custom_logo() ){ vw_maintenance_services_the_custom_logo();
            }else{ ?>
              <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
              <?php $description = get_bloginfo( 'description', 'display' );
              if ( $description || is_customize_preview() ) : ?>
              <p class="site-description"><?php echo esc_html($description); ?></p>
          <?php endif; } ?>
        </div>
      </div>
      <div class="col-lg-5 col-md-6">
        <?php dynamic_sidebar('social-links'); ?>
      </div>
      <div class="col-lg-3 col-md-5">
        <?php if( get_theme_mod( 'vw_maintenance_services_header_call_text') != '' | get_theme_mod( 'vw_maintenance_services_header_call') != '') { ?>
          <p class="call-text"><i class="fas fa-phone"></i><?php echo esc_html(get_theme_mod('vw_maintenance_services_header_call_text',''));?></p>
          <p class="call-no"><?php echo esc_html(get_theme_mod('vw_maintenance_services_header_call',''));?></p>
        <?php }?>        
      </div>
      <div class="col-lg-1 col-md-1">
        <?php if( get_theme_mod( 'vw_maintenance_services_header_search') != '') { ?>
        <div class="search-box">
            <span><i class="fas fa-search"></i></span>
          </div>
        <?php }?>
      </div>
    </div>
    <div class="serach_outer">
      <div class="closepop"><i class="far fa-window-close"></i></div>
      <div class="serach_inner">
        <?php get_search_form(); ?>
      </div>
    </div>
  </div>
</div>