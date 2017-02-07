<?php

if ( !defined( 'ABSPATH' ) ) { exit; }

/* Ads: Header Upload Image */
$wp_customize->add_setting( 'df_ads_head_img', array(
	'default' 			=> '',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'df_ads_head_img', array(
	'label'       		=> esc_attr__( 'Header Ads Image', 'applique' ),
	'section'     		=> 'df_customize_ads_section',
	'settings'			=> 'df_ads_head_img',
) ) );

/* Ads: Header URL */
$wp_customize->add_setting( 'df_ads_head_url', array(
	'default' 			=> 'http://',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_ads_head_url', array(
	'label'       		=> esc_attr__( 'Header Ads URL', 'applique' ),
	'section'     		=> 'df_customize_ads_section',
	'settings'			=> 'df_ads_head_url',
	'type'				=> 'url'
) ) );

/* Ads: Header Embed Code */
$wp_customize->add_setting( 'df_ads_head_embed', array(
	'default' 			=> '',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'dahz_sanitize_textarea'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_ads_head_embed', array(
	'label'       		=> esc_attr__( 'Header Ads Code', 'applique' ),
	'section'     		=> 'df_customize_ads_section',
	'settings'			=> 'df_ads_head_embed',
	'description'		=> esc_attr__( 'Paste ads code here. This will override Header Ads Image and Header Ads URL', 'applique' ),
	'type'				=> 'textarea'
) ) );

/* Ads: Footer Upload Image */
$wp_customize->add_setting( 'df_ads_foot_img', array(
	'default' 			=> '',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'df_ads_foot_img', array(
	'label'       		=> esc_attr__( 'Footer Ads Image', 'applique' ),
	'section'     		=> 'df_customize_ads_section',
	'settings'			=> 'df_ads_foot_img',
) ) );

/* Ads: Footer URL */
$wp_customize->add_setting( 'df_ads_foot_url', array(
	'default' 			=> 'http://',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_ads_foot_url', array(
	'label'       		=> esc_attr__( 'Footer Ads URL', 'applique' ),
	'section'     		=> 'df_customize_ads_section',
	'settings'			=> 'df_ads_foot_url',
	'type'				=> 'url'
) ) );

/* Ads: Footer Embed Code */
$wp_customize->add_setting( 'df_ads_foot_embed', array(
	'default' 			=> '',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'dahz_sanitize_textarea'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_ads_foot_embed', array(
	'label'       		=> esc_attr__( 'Footer Ads Code', 'applique' ),
	'section'     		=> 'df_customize_ads_section',
	'settings'			=> 'df_ads_foot_embed',
	'description'		=> esc_attr__( 'Paste ads code here. This will override Footer Ads Image and Footer Ads URL', 'applique' ),
	'type'				=> 'textarea'
) ) );