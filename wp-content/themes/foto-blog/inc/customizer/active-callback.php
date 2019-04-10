<?php
/**
 * Active callback functions.
 *
 * @package Foto Blog
 */

function foto_blog_about_author_active( $control ) {
    if( $control->manager->get_setting( 'theme_options[disable_about_author_section]' )->value() == true ) {
        return false;
    }else{
        return true;
    }
}

function foto_blog_about_author_page( $control ) {
    $content_type = $control->manager->get_setting( 'theme_options[ss_content_type]' )->value();
    return ( foto_blog_about_author_active( $control ) && ( 'ss_page' == $content_type ) );
}

function foto_blog_about_author_post( $control ) {
    $content_type = $control->manager->get_setting( 'theme_options[ss_content_type]' )->value();
    return ( foto_blog_about_author_active( $control ) && ( 'ss_post' == $content_type ) );
}

function foto_blog_slider_active( $control ) {
    if( $control->manager->get_setting( 'theme_options[disable_featured_slider]' )->value() == true ) {
        return false;
    }else{
        return true;
    }
}

function foto_blog_slider_page( $control ) {
    $content_type = $control->manager->get_setting( 'theme_options[sr_content_type]' )->value();
    return ( foto_blog_slider_active( $control ) && ( 'sr_page' == $content_type ) );
}

function foto_blog_slider_post( $control ) {
    $content_type = $control->manager->get_setting( 'theme_options[sr_content_type]' )->value();
    return ( foto_blog_slider_active( $control ) && ( 'sr_post' == $content_type ) );
}

/**
 * Active Callback for top bar section
 */

function foto_blog_social_links_active( $control ) {
    if( $control->manager->get_setting( 'theme_options[show_header_social_links]' )->value() == true ) {
        return true;
    }else{
        return false;
    }
}