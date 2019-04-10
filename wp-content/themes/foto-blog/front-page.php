<?php
/**
 * The template for displaying home page.
 * @package Foto Blog
 */

if ( 'posts' == get_option( 'show_on_front' ) ){ 
    get_header(); ?>
    <?php $enabled_sections = foto_blog_get_sections();
    if( is_array( $enabled_sections ) ) {
        foreach( $enabled_sections as $section ) {

            if( ( $section['id'] == 'featured-slider' ) ){ ?>
                <?php $disable_featured_slider = foto_blog_get_option( 'disable_featured_slider' );
                if( false ==$disable_featured_slider): ?>
                    <section id="<?php echo esc_attr( $section['id'] ); ?>">
                        <?php get_template_part( 'sections/section', esc_attr( $section['id'] ) ); ?>
                    </section>
            <?php endif; ?>

            <?php } elseif( $section['id'] == 'about-author' ) { ?>
                <?php $disable_about_author_section = foto_blog_get_option( 'disable_about_author_section' );
                if( false ==$disable_about_author_section): ?>
                    <section id="<?php echo esc_attr( $section['id'] ); ?>">
                        <div class="wrapper">
                            <?php get_template_part( 'sections/section', esc_attr( $section['id'] ) ); ?>
                        </div>
                    </section>
            <?php endif;

            }
        }
    }
    include( get_home_template() );

    get_footer();
} 
else{
    include( get_page_template() );
}