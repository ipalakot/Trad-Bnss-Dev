<?php
/**
 * The template part for displaying post
 * @package Multipurpose Portfolio
 * @subpackage multipurpose_portfolio
 * @since 1.0
 */
?>
<div class="blog-sec animated fadeInDown">
  <?php if(has_post_thumbnail()) { ?>
    <?php the_post_thumbnail(); ?>   
  <?php }?>
  <h3><a href="<?php echo esc_url(get_permalink() ); ?>"><?php the_title(); ?></a></h3>
  <div class="post-info">
    <i class="fa fa-calendar" aria-hidden="true"></i><span class="entry-date"><?php echo esc_html( get_the_date()); ?></span>
    <i class="fa fa-user" aria-hidden="true"></i><span class="entry-author"> <?php the_author(); ?></span>
    <i class="fa fa-comments" aria-hidden="true"></i><span class="entry-comments"> <?php comments_number( __('0 Comments','multipurpose-portfolio'), __('0 Comments','multipurpose-portfolio'), __('% Comments','multipurpose-portfolio') ); ?></span> 
  </div>
  <p><?php the_excerpt(); ?></p>
  <div class="blogbtn">
    <a href="<?php echo esc_url( get_permalink() );?>" class="blogbutton-small" title="<?php esc_attr_e( 'Read Full', 'multipurpose-portfolio' ); ?>"><?php esc_html_e('Read Full','multipurpose-portfolio'); ?></a>
  </div>
</div>