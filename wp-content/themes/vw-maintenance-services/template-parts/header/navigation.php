<?php
/**
 * The template part for header
 *
 * @package VW Maintenance Services 
 * @subpackage vw_maintenance_services
 * @since VW Maintenance Services 1.0
 */
?>

<div class="toggle"><a class="toggleMenu" href="#"><?php esc_html_e('Menu','vw-maintenance-services'); ?></a></div>
<div id="header">
	<div class="container">
		<div class="menubar">
			<div class="row m-0">
				<div class="col-lg-9 col-md-9 p-0">
					<div class="nav">
						<?php wp_nav_menu( array('theme_location'  => 'primary') ); ?>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 pr-0">
					<?php if( get_theme_mod( 'vw_maintenance_services_top_btn_url') != '' | get_theme_mod( 'vw_maintenance_services_top_btn_text') != '') { ?>
						<div class="top-btn">
							<a href="<?php echo esc_url(get_theme_mod('vw_maintenance_services_top_btn_url',''));?>"><?php echo esc_html(get_theme_mod('vw_maintenance_services_top_btn_text',''));?></a>
						</div>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
</div>