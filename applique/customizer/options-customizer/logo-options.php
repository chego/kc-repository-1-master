<?php

if ( !defined( 'ABSPATH' ) ) { exit; }

/* Logo: Site Title */
$wp_customize->add_setting( 'blogname', array(
	'default'           => get_option( 'blogname' ),
	'type'				=> 'option',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'blogname', array(
	'label'       		=> esc_attr__( 'Site Title', 'applique' ),
	'section'     		=> 'df_customize_logo_section',
	'settings'   		=> 'blogname',
	'type'       		=> 'text'
) ) );

/* Logo: Tagline */
$wp_customize->add_setting( 'blogdescription', array(
	'default'           => get_option( 'blogdescription' ),
	'type'				=> 'option',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'blogdescription', array(
	'label'       		=> esc_attr__( 'Tagline', 'applique' ),
	'section'     		=> 'df_customize_logo_section',
	'settings'   		=> 'blogdescription',
	'type'       		=> 'text'
) ) );

/* Logo: Site Icon */
$wp_customize->add_setting( 'site_icon', array(
	'default' 			=> get_template_directory_uri() . '/assets/images/Fav-1.jpg',
	'type'       		=> 'option',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Site_Icon_Control( $wp_customize, 'site_icon', array(
	'label'       		=> esc_attr__( 'Site Icon', 'applique' ),
	'description' 		=> esc_attr__( 'The Site Icon is used as a browser and app icon for your site. Icons must be square, and at least 512px wide and tall.', 'applique' ),
	'section'     		=> 'df_customize_logo_section',
	'height'      		=> 512,
	'width'       		=> 512
) ) );

/* Logo */
$wp_customize->add_setting( 'df_logo', array(
	'default' 			=> get_template_directory_uri() . '/assets/images/main-logo.png',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'df_logo', array(
	'label'       		=> 'Logo',
	'section'     		=> 'df_customize_logo_section',
	'settings'     		=> 'df_logo',
) ) );

/* Sticky Logo */
$wp_customize->add_setting( 'df_sticky_logo', array(
	'default' 			=> get_template_directory_uri() . '/assets/images/round.png',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'df_sticky_logo', array(
	'label'       		=> esc_attr__( 'Sticky Logo', 'applique' ),
	'section'     		=> 'df_customize_logo_section',
	'settings'     		=> 'df_sticky_logo',
) ) );

/* Logo: Height */
$wp_customize->add_setting( 'df_logo_height', array(
	'default' 			=> '214',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_logo_height', array(
	'label'       		=> esc_attr__( 'Logo Height (px)', 'applique' ),
	'section'     		=> 'df_customize_logo_section',
	'settings'			=> 'df_logo_height',
	'description'		=> esc_attr__( 'This setting will only affect if your logo image already set.', 'applique' ),
	'type'				=> 'text'
) ) );

/* Logo: Above Range */
$wp_customize->add_setting( 'df_logo_above_range', array(
	'default' 			=> '120',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_logo_above_range', array(
	'label'       		=> esc_attr__( 'Above Logo Range (px)', 'applique' ),
	'section'     		=> 'df_customize_logo_section',
	'settings'			=> 'df_logo_above_range',
	'type'				=> 'text'
) ) );

/* Logo: Below Padding */
$wp_customize->add_setting( 'df_logo_below_range', array(
	'default' 			=> '120',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_logo_below_range', array(
	'label'       		=> esc_attr__( 'Below Logo Range (px)', 'applique' ),
	'section'     		=> 'df_customize_logo_section',
	'settings'			=> 'df_logo_below_range',
	'type'				=> 'text'
) ) );

/* Logo: Background Color */
$wp_customize->add_setting( 'df_logo_bg_color', array(
	'default' 			=> '#948d80',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_logo_bg_color', array(
	'label'       		=> esc_attr__( 'Logo Background Color', 'applique' ),
	'section'     		=> 'df_customize_logo_section',
	'settings'			=> 'df_logo_bg_color',
) ) );

/* Logo: Background Image */
$wp_customize->add_setting( 'df_logo_bg_img', array(
	'default' 			=> get_template_directory_uri() . '/assets/images/bg-logo.jpg',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'df_logo_bg_img', array(
	'label'       		=> esc_attr__( 'Logo Background Image', 'applique' ),
	'section'     		=> 'df_customize_logo_section',
	'settings'			=> 'df_logo_bg_img',
) ) );

/* Logo: Background Parallax */
$wp_customize->add_setting( 'df_logo_bg_par', array(
	'default' 			=> 1,
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_logo_bg_par', array(
	'label'       		=> esc_attr__( 'Enable Background Parallax', 'applique' ),
	'section'     		=> 'df_customize_logo_section',
	'settings'			=> 'df_logo_bg_par',
	'type'				=> 'checkbox'
) ) );

/* Logo: Background Repeat */
$wp_customize->add_setting( 'df_logo_bg_rpt', array(
	'default' 			=> 'no-repeat',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_logo_bg_rpt', array(
	'label'       		=> esc_attr__( 'Logo Background Repeat', 'applique' ),
	'section'     		=> 'df_customize_logo_section',
	'settings'			=> 'df_logo_bg_rpt',
	'type'				=> 'select',
	'choices'			=> array(
	                     		'no-repeat' => esc_attr__( 'No Repeat', 'applique' ),
	                     		'repeat' 	=> esc_attr__( 'Tile', 'applique' ),
	                     		'repeat-x' 	=> esc_attr__( 'Tile Horizontally', 'applique' ),
	                     		'repeat-y' 	=> esc_attr__( 'Tile Vertically', 'applique' ),
	                       )
) ) );

/* Logo: Background Position */
$wp_customize->add_setting( 'df_logo_bg_pos', array(
	'default' 			=> 'left',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_logo_bg_pos', array(
	'label'       		=> esc_attr__( 'Logo Background Position', 'applique' ),
	'section'     		=> 'df_customize_logo_section',
	'settings'			=> 'df_logo_bg_pos',
	'type'				=> 'select',
	'choices'			=> array(
	                     		'left' 	 => esc_attr__( 'Left', 'applique' ),
	                     		'center' => esc_attr__( 'Center', 'applique' ),
	                     		'right'  => esc_attr__( 'Right', 'applique' ),
	                       )
) ) );

/* Logo: Background Size */
$wp_customize->add_setting( 'df_logo_bg_size', array(
	'default' 			=> '',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr',
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_logo_bg_size', array(
	'label'       		=> esc_attr__( 'Logo Background Size', 'applique' ),
	'section'     		=> 'df_customize_logo_section',
	'settings'			=> 'df_logo_bg_size',
	'type'				=> 'select',
	'choices'			=> array(
	                     		'auto' 	  => esc_attr__( 'Auto', 'applique' ),
	                     		'cover'   => esc_attr__( 'Cover', 'applique' ),
	                     		'contain' => esc_attr__( 'Contain', 'applique' ),
	                       )
) ) );

/* Logo: Border Color */
$wp_customize->add_setting( 'df_logo_border', array(
	'default' 			=> '#565148',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_logo_border', array(
	'label'       		=> esc_attr__( 'Border Color', 'applique' ),
	'section'     		=> 'df_customize_logo_section',
	'settings'			=> 'df_logo_border',
) ) );