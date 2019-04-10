<?php
/**
 * VW Maintenance Services Theme Customizer
 *
 * @package VW Maintenance Services
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vw_maintenance_services_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . 'inc/customize-homepage/class-customize-homepage.php' );

	//add home page setting pannel
	$wp_customize->add_panel( 'vw_maintenance_services_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'VW Settings', 'vw-maintenance-services' ),
	) );

	// Layout
	$wp_customize->add_section( 'vw_maintenance_services_left_right', array(
    	'title'      => __( 'General Settings', 'vw-maintenance-services' ),
		'panel' => 'vw_maintenance_services_panel_id'
	) );

	$wp_customize->add_setting('vw_maintenance_services_theme_options',array(
        'default' => __('Right Sidebar','vw-maintenance-services'),
        'sanitize_callback' => 'vw_maintenance_services_sanitize_choices'	        
	));
	$wp_customize->add_control('vw_maintenance_services_theme_options',array(
        'type' => 'select',
        'label' => __('Post Sidebar Layout','vw-maintenance-services'),
        'description' => __('Here you can change the sidebar layout for posts. ','vw-maintenance-services'),
        'section' => 'vw_maintenance_services_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-maintenance-services'),
            'Right Sidebar' => __('Right Sidebar','vw-maintenance-services'),
            'One Column' => __('One Column','vw-maintenance-services'),
            'Three Columns' => __('Three Columns','vw-maintenance-services'),
            'Four Columns' => __('Four Columns','vw-maintenance-services'),
            'Grid Layout' => __('Grid Layout','vw-maintenance-services')
        ),
	) );

	$wp_customize->add_setting('vw_maintenance_services_page_layout',array(
        'default' => __('One Column','vw-maintenance-services'),
        'sanitize_callback' => 'vw_maintenance_services_sanitize_choices'	        
	));
	$wp_customize->add_control('vw_maintenance_services_page_layout',array(
        'type' => 'select',
        'label' => __('Page Sidebar Layout','vw-maintenance-services'),
        'description' => __('Here you can change the sidebar layout for pages. ','vw-maintenance-services'),
        'section' => 'vw_maintenance_services_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-maintenance-services'),
            'Right Sidebar' => __('Right Sidebar','vw-maintenance-services'),
            'One Column' => __('One Column','vw-maintenance-services')
        ),
	) );

	//Topbar
	$wp_customize->add_section( 'vw_maintenance_services_topbar', array(
    	'title'      => __( 'Topbar Settings', 'vw-maintenance-services' ),
		'panel' => 'vw_maintenance_services_panel_id'
	) );

	$wp_customize->add_setting('vw_maintenance_services_header_call_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_maintenance_services_header_call_text',array(
		'label'	=> __('Add Phone Text.','vw-maintenance-services'),
		'input_attrs' => array(
            'placeholder' => __( 'Toll Free', 'vw-maintenance-services' ),
        ),
		'section'=> 'vw_maintenance_services_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_maintenance_services_header_call',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_maintenance_services_header_call',array(
		'label'	=> __('Add Phone No.','vw-maintenance-services'),
		'input_attrs' => array(
            'placeholder' => __( '+07 123 125 1234', 'vw-maintenance-services' ),
        ),
		'section'=> 'vw_maintenance_services_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_maintenance_services_top_btn_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_maintenance_services_top_btn_text',array(
		'label'	=> __('Add Button Text','vw-maintenance-services'),
		'input_attrs' => array(
            'placeholder' => __( 'GET APPOINTMENT', 'vw-maintenance-services' ),
        ),
		'section'=> 'vw_maintenance_services_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_maintenance_services_top_btn_url',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('vw_maintenance_services_top_btn_url',array(
		'label'	=> __('Add Button URL','vw-maintenance-services'),
		'input_attrs' => array(
            'placeholder' => __( 'https://www.example.com', 'vw-maintenance-services' ),
        ),
		'section'=> 'vw_maintenance_services_topbar',
		'type'=> 'url'
	));

	$wp_customize->add_setting('vw_maintenance_services_header_search',array(
       'default' => 'false',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('vw_maintenance_services_header_search',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Search','vw-maintenance-services'),
       'section' => 'vw_maintenance_services_topbar',
    ));
    
	//Slider
	$wp_customize->add_section( 'vw_maintenance_services_slidersettings' , array(
    	'title'      => __( 'Slider Section', 'vw-maintenance-services' ),
		'panel' => 'vw_maintenance_services_panel_id'
	) );

	$wp_customize->add_setting('vw_maintenance_services_slider_arrows',array(
       'default' => 'false',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('vw_maintenance_services_slider_arrows',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide slider','vw-maintenance-services'),
       'section' => 'vw_maintenance_services_slidersettings',
    ));

	for ( $count = 1; $count <= 4; $count++ ) {

		$wp_customize->add_setting( 'vw_maintenance_services_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'vw_maintenance_services_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'vw_maintenance_services_slider_page' . $count, array(
			'label'    => __( 'Select Slider Page', 'vw-maintenance-services' ),
			'description' => __('Slider image size (1500 x 590)','vw-maintenance-services'),
			'section'  => 'vw_maintenance_services_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}

	//Services section
	$wp_customize->add_section( 'vw_maintenance_services_services_section' , array(
    	'title'      => __( 'Our Services Section', 'vw-maintenance-services' ),
		'priority'   => null,
		'panel' => 'vw_maintenance_services_panel_id'
	) );

	$wp_customize->add_setting('vw_maintenance_services_section_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_maintenance_services_section_title',array(
		'label'	=> __('Section Title','vw-maintenance-services'),
		'input_attrs' => array(
            'placeholder' => __( 'Our Services', 'vw-maintenance-services' ),
        ),
		'section'=> 'vw_maintenance_services_services_section',
		'type'=> 'text'
	));

	$categories = get_categories();
	$cat_post = array();
	$cat_post[]= 'select';
	$i = 0;	
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_post[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('vw_maintenance_services_left_service',array(
		'default'	=> 'select',
		'sanitize_callback' => 'vw_maintenance_services_sanitize_choices',
	));
	$wp_customize->add_control('vw_maintenance_services_left_service',array(
		'type'    => 'select',
		'choices' => $cat_post,
		'label' => __('Select Category to display left services','vw-maintenance-services'),
		'description' => __('Image Size (250 x 250)','vw-maintenance-services'),
		'section' => 'vw_maintenance_services_services_section',
	));

	$wp_customize->add_setting( 'vw_maintenance_services_about', array(
		'default'           => '',
		'sanitize_callback' => 'vw_maintenance_services_sanitize_dropdown_pages'
	) );
	$wp_customize->add_control( 'vw_maintenance_services_about', array(
		'label'    => __( 'Select About us Page', 'vw-maintenance-services' ),
		'description' => __('Image size (350 x 500)','vw-maintenance-services'),
		'section'  => 'vw_maintenance_services_services_section',
		'type'     => 'dropdown-pages'
	) );

	$categories = get_categories();
	$cat_post = array();
	$cat_post[]= 'select';
	$i = 0;	
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_post[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('vw_maintenance_services_right_service',array(
		'default'	=> 'select',
		'sanitize_callback' => 'vw_maintenance_services_sanitize_choices',
	));
	$wp_customize->add_control('vw_maintenance_services_right_service',array(
		'type'    => 'select',
		'choices' => $cat_post,
		'label' => __('Select Category to display right services','vw-maintenance-services'),
		'description' => __('Image Size (250 x 250)','vw-maintenance-services'),
		'section' => 'vw_maintenance_services_services_section',
	));

	//Content Craetion
	$wp_customize->add_section( 'vw_maintenance_services_content_section' , array(
    	'title' => __( 'Customize Home Page', 'vw-maintenance-services' ),
		'priority' => null,
		'panel' => 'vw_maintenance_services_panel_id'
	) );

	$wp_customize->add_setting('vw_maintenance_services_content_creation_main_control', array(
		'sanitize_callback' => 'esc_html',
	) );

	$homepage= get_option( 'page_on_front' );

	$wp_customize->add_control(	new VW_Maintenance_Services_Content_Creation( $wp_customize, 'vw_maintenance_services_content_creation_main_control', array(
		'options' => array(
			esc_html__( 'First select static page in homepage setting for front page.Below given edit button is to customize Home Page. Just click on the edit option, add whatever elements you want to include in the homepage, save the changes and you are good to go.','vw-maintenance-services' ),
		),
		'section' => 'vw_maintenance_services_content_section',
		'button_url'  => admin_url( 'post.php?post='.$homepage.'&action=edit'),
		'button_text' => esc_html__( 'Edit', 'vw-maintenance-services' ),
	) ) );

	//Footer Text
	$wp_customize->add_section('vw_maintenance_services_footer',array(
		'title'	=> __('Footer','vw-maintenance-services'),
		'panel' => 'vw_maintenance_services_panel_id',
	));	
	
	$wp_customize->add_setting('vw_maintenance_services_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_maintenance_services_footer_text',array(
		'label'	=> __('Copyright Text','vw-maintenance-services'),
		'input_attrs' => array(
            'placeholder' => __( 'Copyright 2019, .....', 'vw-maintenance-services' ),
        ),
		'section'=> 'vw_maintenance_services_footer',
		'type'=> 'text'
	));	
}

add_action( 'customize_register', 'vw_maintenance_services_customize_register' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class VW_Maintenance_Services_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'VW_Maintenance_Services_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new VW_Maintenance_Services_Customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'priority'   => 9,
					'title'    => esc_html__( 'VW Maintenance Pro', 'vw-maintenance-services' ),
					'pro_text' => esc_html__( 'UPGRADE PRO', 'vw-maintenance-services' ),
					'pro_url'  => esc_url('https://www.vwthemes.com/themes/wordpress-maintenance-service-theme/'),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'vw-maintenance-services-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-maintenance-services-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
VW_Maintenance_Services_Customize::get_instance();