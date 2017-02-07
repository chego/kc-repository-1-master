<?php

if ( !defined( 'ABSPATH' ) ) { exit; }

/* Navbar: Height */
$wp_customize->add_setting( 'df_nav_pos', array(
	'default' 			=> 'nav_top',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_nav_pos', array(
	'label'       		=> esc_attr__( 'Navigation Position', 'applique' ),
	'section'     		=> 'df_customize_nav_section',
	'settings'			=> 'df_nav_pos',
	'type'				=> 'radio',
	'choices'			=> array(
	                     		'nav_top' 			=> esc_attr__( 'Above Center-Aligned Logo', 'applique' ),
	                     		'nav_btm' 			=> esc_attr__( 'Below Center-Aligned Logo', 'applique' )
	                       )
) ) );

/* Navbar: Background Color */
$wp_customize->add_setting( 'df_nav_bg_color', array(
	'default' 			=> '#565148',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_nav_bg_color', array(
	'label'       		=> esc_attr__( 'Navigation Background Color', 'applique' ),
	'section'     		=> 'df_customize_nav_section',
	'settings'			=> 'df_nav_bg_color',
) ) );

/* Navbar: Text Color */
$wp_customize->add_setting( 'df_nav_txt_color', array(
	'default' 			=> '#ffffff',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_nav_txt_color', array(
	'label'       		=> esc_attr__( 'Navigation Text Color', 'applique' ),
	'section'     		=> 'df_customize_nav_section',
	'settings'			=> 'df_nav_txt_color',
) ) );

/* Navbar: Text Hover Color */
$wp_customize->add_setting( 'df_nav_txt_hvr_color', array(
	'default' 			=> '#d1c9bd',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_nav_txt_hvr_color', array(
	'label'       		=> esc_attr__( 'Navigation Text Hover Color', 'applique' ),
	'section'     		=> 'df_customize_nav_section',
	'settings'			=> 'df_nav_txt_hvr_color',
) ) );

/* Navbar: Enable Navigation Border */
$wp_customize->add_setting( 'df_nav_border', array(
	'default' 			=> 0,
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_nav_border', array(
	'label'       		=> esc_attr__( 'Enable Border', 'applique' ),
	'section'     		=> 'df_customize_nav_section',
	'settings'			=> 'df_nav_border',
	'type'				=> 'checkbox'
) ) );

/* Navbar: Navigations Border Color */
$wp_customize->add_setting( 'df_nav_border_color', array(
	'default' 			=> '#565148',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_nav_border_color', array(
	'label'       		=> esc_attr__( 'Navigations Border Color', 'applique' ),
	'section'     		=> 'df_customize_nav_section',
	'settings'			=> 'df_nav_border_color',
) ) );

/* Navbar: Submenu Background Color */
$wp_customize->add_setting( 'df_subnav_bg_color', array(
	'default' 			=> '#f5f5f0',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_subnav_bg_color', array(
	'label'       		=> esc_attr__( 'Submenu Background Color', 'applique' ),
	'section'     		=> 'df_customize_nav_section',
	'settings'			=> 'df_subnav_bg_color',
) ) );

/* Navbar: Submenu Text Color */
$wp_customize->add_setting( 'df_subnav_txt_color', array(
	'default' 			=> '#6b6051',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_subnav_txt_color', array(
	'label'       		=> esc_attr__( 'Submenu Text Color', 'applique' ),
	'section'     		=> 'df_customize_nav_section',
	'settings'			=> 'df_subnav_txt_color',
) ) );

/* Navbar: Submenu Text Hover Color */
$wp_customize->add_setting( 'df_subnav_txt_hvr_color', array(
	'default' 			=> '#ffffff',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_subnav_txt_hvr_color', array(
	'label'       		=> esc_attr__( 'Submenu Text Hover Color', 'applique' ),
	'section'     		=> 'df_customize_nav_section',
	'settings'			=> 'df_subnav_txt_hvr_color',
) ) );

/* Navbar: Submenu Background Hover Color */
$wp_customize->add_setting( 'df_subnav_bg_hvr_color', array(
	'default' 			=> '#565148',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_subnav_bg_hvr_color', array(
	'label'       		=> esc_attr__( 'Submenu Background Hover Color', 'applique' ),
	'section'     		=> 'df_customize_nav_section',
	'settings'			=> 'df_subnav_bg_hvr_color',
) ) );

/* Navbar: Submenu Border Color */
$wp_customize->add_setting( 'df_sub_border_color', array(
	'default' 			=> '#565148',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_sub_border_color', array(
	'label'       		=> esc_attr__( 'Submenu Border Color', 'applique' ),
	'section'     		=> 'df_customize_nav_section',
	'settings'			=> 'df_sub_border_color',
) ) );

/* Navbar: Navigation Text Transform */
$wp_customize->add_setting( 'df_nav_text_trans', array(
	'default'			=> 'uppercase',
	'capability'		=> 'edit_theme_options',
	'sanitize_callback'	=> 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_nav_text_trans', array(
	'label'				=> esc_attr__( 'Navbar Text Transform', 'applique' ),
	'section'			=> 'df_customize_nav_section',
	'settings'			=> 'df_nav_text_trans',
	'description'		=> esc_attr__( 'Insert the text transform you want. e.g. \'capitalize\'. You can found reference for the font text transform here http://www.w3schools.com/cssref/pr_text_text-transform.asp', 'applique' ),
	'type'				=> 'text'
) ) );