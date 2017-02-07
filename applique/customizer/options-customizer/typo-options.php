<?php

if ( !defined( 'ABSPATH' ) ) { exit; }

/* Typo: Heading Font Family */
$wp_customize->add_setting( 'df_heading_txt_type', array(
	'default' 			=> 'Prata',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_heading_txt_type', array(
	'label'       		=> esc_attr__( 'Headings Font Type', 'applique' ),
	'section'     		=> 'df_customize_typo_section',
	'settings'			=> 'df_heading_txt_type',
	'description'		=> esc_attr__( 'Insert the name of font family you want. e.g. \'Playfair Display\'. You can found font lists https://www.google.com/fonts', 'applique' ),
	'type'				=> 'text'
) ) );

/* Typo: Heading Font Weight */
$wp_customize->add_setting( 'df_heading_txt_weight', array(
	'default' 			=> '400',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_heading_txt_weight', array(
	'label'       		=> esc_attr__( 'Headings Font Weight', 'applique' ),
	'section'     		=> 'df_customize_typo_section',
	'settings'			=> 'df_heading_txt_weight',
	'type'				=> 'text'
) ) );

/* Typo: Body Font Family */
$wp_customize->add_setting( 'df_body_txt_type', array(
	'default' 			=> 'Crimson Text',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_body_txt_type', array(
	'label'       		=> esc_attr__( 'Body Font Type', 'applique' ),
	'section'     		=> 'df_customize_typo_section',
	'settings'			=> 'df_body_txt_type',
	'description'		=> esc_attr__( 'Insert the name of font family you want. e.g. \'PT Serif\'. You can found font lists https://www.google.com/fonts', 'applique' ),
	'type'				=> 'text'
) ) );

/* Typo: Body Font Weight */
$wp_customize->add_setting( 'df_body_txt_weight', array(
	'default' 			=> '400',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_body_txt_weight', array(
	'label'       		=> esc_attr__( 'Body Font Weight', 'applique' ),
	'section'     		=> 'df_customize_typo_section',
	'settings'			=> 'df_body_txt_weight',
	'type'				=> 'text'
) ) );

/* Typo: Navigations Font Family */
$wp_customize->add_setting( 'df_nav_txt_type', array(
	'default' 			=> 'Montserrat',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_nav_txt_type', array(
	'label'       		=> esc_attr__( 'Navigations Font Type', 'applique' ),
	'section'     		=> 'df_customize_typo_section',
	'settings'			=> 'df_nav_txt_type',
	'description'		=> esc_attr__( 'Insert the name of font family you want. e.g. \'Montserrat\'. You can found font lists https://www.google.com/fonts', 'applique' ),
	'type'				=> 'text'
) ) );

/* Typo: Navigations Font Weight */
$wp_customize->add_setting( 'df_nav_txt_weight', array(
	'default' 			=> '400',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_nav_txt_weight', array(
	'label'       		=> esc_attr__( 'Navigations Font Weight', 'applique' ),
	'section'     		=> 'df_customize_typo_section',
	'settings'			=> 'df_nav_txt_weight',
	'type'				=> 'text'
) ) );

/* Typo: Postmeta Font Family */
$wp_customize->add_setting( 'df_meta_txt_type', array(
	'default' 			=> 'Montserrat',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_meta_txt_type', array(
	'label'       		=> esc_attr__( 'Postmeta Font Type', 'applique' ),
	'section'     		=> 'df_customize_typo_section',
	'settings'			=> 'df_meta_txt_type',
	'description'		=> esc_attr__( 'Insert the name of font family you want. e.g. \'Montserrat\'. You can found font lists https://www.google.com/fonts', 'applique' ),
	'type'				=> 'text'
) ) );

/* Typo: Postmeta Font Weight */
$wp_customize->add_setting( 'df_meta_txt_weight', array(
	'default' 			=> '400',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_meta_txt_weight', array(
	'label'       		=> esc_attr__( 'Postmeta Font Weight', 'applique' ),
	'section'     		=> 'df_customize_typo_section',
	'settings'			=> 'df_meta_txt_weight',
	'type'				=> 'text'
) ) );

/* Typo: Button Font Family */
$wp_customize->add_setting( 'df_btn_txt_type', array(
	'default' 			=> 'Lato',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_btn_txt_type', array(
	'label'       		=> esc_attr__( 'Button Font Type', 'applique' ),
	'section'     		=> 'df_customize_typo_section',
	'settings'			=> 'df_btn_txt_type',
	'description'		=> esc_attr__( 'Insert the name of font family you want. e.g. \'Montserrat\'. You can found font lists https://www.google.com/fonts', 'applique' ),
	'type'				=> 'text'
) ) );

/* Typo: Button Font Weight */
$wp_customize->add_setting( 'df_btn_txt_weight', array(
	'default' 			=> '400',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_btn_txt_weight', array(
	'label'       		=> esc_attr__( 'Button Font Weight', 'applique' ),
	'section'     		=> 'df_customize_typo_section',
	'settings'			=> 'df_btn_txt_weight',
	'type'				=> 'text'
) ) );