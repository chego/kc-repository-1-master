<?php

if ( !defined( 'ABSPATH' ) ) { exit; }

/* General: Site Skin */
$wp_customize->add_setting( 'df_skin', array(
	'default' 			=> 'df-skin-boxed',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_skin', array(
	'label'       		=> esc_attr__( 'Skin', 'applique' ),
	'section'     		=> 'df_customize_general_section',
	'settings'     		=> 'df_skin',
	'type'				=> 'select',
	'choices'			=> array(
								'df-skin-light'	=> esc_attr__( 'Light', 'applique' ),
								'df-skin-bold'	=> esc_attr__( 'Bold', 'applique' ),
								'df-skin-boxed'	=> esc_attr__( 'Boxed', 'applique' ),
						   )
) ) );

/* General: Site Border Color */
$wp_customize->add_setting( 'df_framed', array(
	'default' 			=> 1,
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_framed', array(
	'label'       		=> esc_attr__( 'Enable Site Border', 'applique' ),
	'section'     		=> 'df_customize_general_section',
	'settings'     		=> 'df_framed',
	'type'     			=> 'checkbox'
) ) );

/* General: Site Border Color */
$wp_customize->add_setting( 'df_framed_color', array(
	'default' 			=> '#dad4ca',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_framed_color', array(
	'label'       		=> esc_attr__( 'Site Border Color', 'applique' ),
	'section'     		=> 'df_customize_general_section',
	'settings'     		=> 'df_framed_color',
) ) );

/* General: Black White Hover */
$wp_customize->add_setting( 'df_bw_hover', array(
	'default'			=> 0,
	'capability'		=> 'edit_theme_options',
	'sanitize_callback'	=> 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_bw_hover', array(
	'label'				=> esc_attr__( 'Enable Site Black &amp; White Hover', 'ren' ),
	'section'			=> 'df_customize_general_section',
	'settings'			=> 'df_bw_hover',
	'type'				=> 'checkbox'
) ) );

/* General: Dropcap Global Systems */
$wp_customize->add_setting( 'df_dropcap_switch', array(
	'default'			=> 0,
	'capability'		=> 'edit_theme_options',
	'sanitize_callback'	=> 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_dropcap_switch', array(
	'label'				=> esc_attr__( 'Enable Site Post Dropcap In First Letter', 'ren' ),
	'section'			=> 'df_customize_general_section',
	'settings'			=> 'df_dropcap_switch',
	'type'				=> 'checkbox'
) ) );

/* General: Blog Layout */
$wp_customize->add_setting( 'df_blog_layout', array(
	'default' 			=> 'fit_2_col',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_blog_layout', array(
	'label'       		=> esc_attr__( 'Blog Layout', 'applique' ),
	'section'     		=> 'df_customize_general_section',
	'settings'     		=> 'df_blog_layout',
	'type'				=> 'radio',
	'choices'			=> array(
								'standard'	=> esc_attr__( 'Standard', 'applique' ),
								'list'		=> esc_attr__( 'List', 'applique' ),
								'fit_2_col'	=> esc_attr__( 'Masonry 2 Columns', 'applique' ),
								'fit_3_col'	=> esc_attr__( 'Masonry 3 Columns', 'applique' ),
								'grid_full'	=> esc_attr__( 'First Full Grid Layout', 'applique' ),
								'list_full'	=> esc_attr__( 'First Full List Layout', 'applique' ),
								'new_fit_2_col'	=> esc_attr__( 'fitRows 2 Columns', 'applique' ),
						   )
) ) );

/* General: Archive Layout */
$wp_customize->add_setting( 'df_arch_layout', array(
	'default' 			=> 'fit_2_col',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_arch_layout', array(
	'label'       		=> esc_attr__( 'Archive Layout', 'applique' ),
	'section'     		=> 'df_customize_general_section',
	'settings'     		=> 'df_arch_layout',
	'type'				=> 'radio',
	'choices'			=> array(
								'standard'	=> esc_attr__( 'Standard', 'applique' ),
								'list'		=> esc_attr__( 'List', 'applique' ),
								'fit_2_col'	=> esc_attr__( 'Masonry 2 Columns', 'applique' ),
								'fit_3_col'	=> esc_attr__( 'Masonry 3 Columns', 'applique' ),
								'grid_full'	=> esc_attr__( 'First Full Grid Layout', 'applique' ),
								'list_full'	=> esc_attr__( 'First Full List Layout', 'applique' ),
								'new_fit_2_col'	=> esc_attr__( 'fitRows 2 Columns', 'applique' ),
						   )
) ) );

/* General: Disable Sidebar In Blog */
$wp_customize->add_setting( 'disable_sidebar_blog', array(
	'default' 			=> 1,
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'disable_sidebar_blog', array(
	'label'       		=> esc_attr__( 'Disable Sidebar On Blog', 'applique' ),
	'section'     		=> 'df_customize_general_section',
	'settings'     		=> 'disable_sidebar_blog',
	'type'				=> 'checkbox'
) ) );

/* General: Disable Sidebar In Singular */
$wp_customize->add_setting( 'disable_sidebar_singular', array(
	'default' 			=> 0,
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'disable_sidebar_singular', array(
	'label'       		=> esc_attr__( 'Disable Sidebar On Single Post or Page', 'applique' ),
	'section'     		=> 'df_customize_general_section',
	'settings'     		=> 'disable_sidebar_singular',
	'type'				=> 'checkbox'
) ) );

/* General: Disable Sidebar In Archive */
$wp_customize->add_setting( 'disable_sidebar_archive', array(
	'default' 			=> 1,
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'disable_sidebar_archive', array(
	'label'       		=> esc_attr__( 'Disable Sidebar On Archive', 'applique' ),
	'section'     		=> 'df_customize_general_section',
	'settings'     		=> 'disable_sidebar_archive',
	'type'				=> 'checkbox'
) ) );

/* General: Disable Floating Sidebar */
$wp_customize->add_setting( 'disable_floating_sidebar', array(
	'default' 			=> 1,
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'disable_floating_sidebar', array(
	'label'       		=> esc_attr__( 'Disable Floating Sidebar', 'applique' ),
	'section'     		=> 'df_customize_general_section',
	'settings'     		=> 'disable_floating_sidebar',
	'type'				=> 'checkbox'
) ) );

/* General: Pagination Blog/Archive */
$wp_customize->add_setting( 'df_pagination', array(
	'default' 			=> 'nextprev',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_pagination', array(
	'label'       		=> esc_attr__( 'Pagination Types', 'applique' ),
	'section'     		=> 'df_customize_general_section',
	'settings'     		=> 'df_pagination',
	'type'				=> 'select',
	'choices'			=> array(
	                     		'nextprev' => esc_attr__( 'Old And New', 'applique' ),
	                     		'number'   => esc_attr__( 'Number', 'applique' ),
	                     		'infinite' => esc_attr__( 'Infinite Scroll', 'applique' )
						   ),
) ) );

/* General: Post Summary Type */
$wp_customize->add_setting( 'df_summary_type', array(
	'default' 			=> 'excerpt',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_summary_type', array(
	'label'       		=> esc_attr__( 'Post Summary Types', 'applique' ),
	'section'     		=> 'df_customize_general_section',
	'settings'     		=> 'df_summary_type',
	'type'				=> 'radio',
	'description'		=> esc_attr__( 'This setting only affect when you choose post \'Standard\' layout in \'Blog Layout\' and \'Archive Layout\' options.', 'applique' ),
	'choices'			=> array(
	                     		'full' 	  => esc_attr__( 'Use Read More Tags', 'applique' ),
	                     		'excerpt' => esc_attr__( 'Use Excerpt', 'applique' )
						   ),
) ) );


/* Page Loader: Enable Loader */
$wp_customize->add_setting( 'df_enable_page_loader', array(
	'default' 			=> 0,
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_enable_page_loader', array(
	'label'       		=> esc_attr__( 'Enable Loader', 'applique' ),
	'section'     		=> 'df_customize_page_loader_section',
	'settings'     		=> 'df_enable_page_loader',
	'type'				=> 'checkbox'
) ) );

/* Page Loader: Enable Loader Animations */
$wp_customize->add_setting( 'df_enable_page_loader_animation', array(
	'default' 			=> 0,
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_enable_page_loader_animation', array(
	'label'       		=> esc_attr__( 'Enable Loader Animations', 'applique' ),
	'section'     		=> 'df_customize_page_loader_section',
	'settings'     		=> 'df_enable_page_loader_animation',
	'type'				=> 'checkbox'
) ) );

/* Page Loader: Style */
$wp_customize->add_setting( 'df_loader_style', array(
	'default' 			=> 'pulse',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_loader_style', array(
	'label'       		=> esc_attr__( 'Select Loading Animation Style', 'applique' ),
	'section'     		=> 'df_customize_page_loader_section',
	'settings'     		=> 'df_loader_style',
	'type'				=> 'radio',
	'choices'			=> array(
		'pulse'			=> esc_attr__( 'Pulse', 'applique' ),
		'double-pulse' 	=> esc_attr__( 'Double Pulse', 'applique' ),
		'cube' 			=> esc_attr__( 'Cube', 'applique' ),
		'rotate-cube'	=> esc_attr__( 'Rotating Cubes', 'applique' ),
		'stripes'		=> esc_attr__( 'Stripes', 'applique' ),
		'wave'			=> esc_attr__( 'Wave', 'applique' ),
		'two-rotate'	=> esc_attr__( 'Two Rotating Circles', 'applique' ),
		'five-rotate'	=> esc_attr__( 'Five Rotating Circles', 'applique' )
	),
) ) );

/* Page Loader: Color */
$wp_customize->add_setting( 'df_loader_color', array(
	'default' 			=> '#e2e2e2',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_loader_color', array(
	'label'       		=> esc_attr__( 'Loading Animation Color', 'applique' ),
	'section'     		=> 'df_customize_page_loader_section',
	'settings'     		=> 'df_loader_color'
) ) );

/* Page Loader: Page Color */
$wp_customize->add_setting( 'df_loader_background_color', array(
	'default' 			=> '#ffffff',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_loader_background_color', array(
	'label'       		=> esc_attr__( 'Loading Page Background', 'applique' ),
	'section'     		=> 'df_customize_page_loader_section',
	'settings'     		=> 'df_loader_background_color'
) ) );

/* Page Loader: Image */
$wp_customize->add_setting( 'df_loader_icon', array(
	'default' 			=> '',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'df_loader_icon', array(
	'label'       		=> esc_attr__( 'Loading Image', 'applique' ),
	'section'     		=> 'df_customize_page_loader_section',
	'settings'     		=> 'df_loader_icon'
) ) );