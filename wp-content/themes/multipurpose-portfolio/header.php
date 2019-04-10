<?php
/**
 * The Header for our theme.
 * @package Multipurpose Portfolio
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width">
  <link rel="profile" href="<?php echo esc_url( __( 'http://gmpg.org/xfn/11', 'multipurpose-portfolio' ) ); ?>">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="header">
	<div class="container">
		<div class="top-bar">
		    <div class="row">
		    	<div class="offset-lg-3 col-lg-9">
		    		<div class="row">
				      	<div class="col-lg-3 col-md-3">
					        <div class="call">
					          	<?php if ( get_theme_mod('multipurpose_portfolio_call','') != "" ) {?>
					            	<p><i class="fas fa-phone-volume"></i><?php echo esc_html(get_theme_mod('multipurpose_portfolio_call','')); ?></p>
					          	<?php }?>
					        </div>
				      	</div>
				      	<div class="col-lg-4 col-md-4">
					        <div class="mail">
					          	<?php if ( get_theme_mod('multipurpose_portfolio_email','') != "" ) {?>
					            	<p><i class="fas fa-envelope"></i><?php echo esc_html(get_theme_mod('multipurpose_portfolio_email','')); ?></p>
					          	<?php }?>
					        </div>
				      	</div>
				    </div>
			    </div>
		    </div>
		</div>
		<div class="row">
			<div class="col-lg-3 col-md-3 pr-0">
				<div class="logo">
		          	<?php if( has_custom_logo() ){ multipurpose_portfolio_the_custom_logo();
		           		}else{ ?>
		          	<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		          	<?php $description = get_bloginfo( 'description', 'display' );
		         		if ( $description || is_customize_preview() ) : ?> 
		            	<p class="site-description"><?php echo esc_html($description); ?></p>
		          	<?php endif; }?>
		        </div>
			</div>
			<div class="col-lg-9 col-md-9 pl-0">
				<div class="after-logo">
					<div class="row">
				    	<div class="col-lg-11 col-md-11">
				    		<div class="toggle">
								<a class="toggleMenu" href="#"><?php esc_html_e('Menu','multipurpose-portfolio'); ?></a>
							</div>
				    		<div class="nav">
						      <?php wp_nav_menu( array('theme_location'  => 'primary') ); ?>
						    </div>
				    	</div>
				    	<div class="search-box col-lg-1 col-md-1 pl-0">
				           <i class="fas fa-search"></i>
				        </div>
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
	</div>
</div>