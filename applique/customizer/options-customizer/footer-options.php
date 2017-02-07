<?php

if ( !defined( 'ABSPATH' ) ) { exit; }

/* Footer: Logo */
$wp_customize->add_setting( 'df_foot_logo', array(
	'default' 			=> get_template_directory_uri() . '/assets/images/footer-logos.png',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'df_foot_logo', array(
	'label'       		=> 'Logo',
	'section'     		=> 'df_customize_foot_section',
	'settings'     		=> 'df_foot_logo',
) ) );

/* Footer: Logo Height */
$wp_customize->add_setting( 'df_foot_logo_height', array(
	'default' 			=> '120',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_foot_logo_height', array(
	'label'       		=> esc_attr__( 'Logo Height (px)', 'applique' ),
	'section'     		=> 'df_customize_foot_section',
	'settings'			=> 'df_foot_logo_height',
	'description'		=> esc_attr__( 'This setting will only affect if your logo image already set.', 'applique' ),
	'type'				=> 'text'
) ) );

/* Footer: Copyright */
$wp_customize->add_setting( 'df_foot_copy', array(
	'default' 			=> '',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_textarea'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_foot_copy', array(
	'label'       		=> esc_attr__( 'Custom Copyright', 'applique' ),
	'section'     		=> 'df_customize_foot_section',
	'settings'			=> 'df_foot_copy',
	'type'				=> 'textarea'
) ) );

/* Footer: Bottom Range */
$wp_customize->add_setting( 'df_foot_btm_range', array(
	'default' 			=> '90',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_foot_btm_range', array(
	'label'       		=> esc_attr__( 'Bottom Range (px)', 'applique' ),
	'section'     		=> 'df_customize_foot_section',
	'settings'			=> 'df_foot_btm_range',
	'type'				=> 'text'
) ) );

/* Footer: Background Color */
$wp_customize->add_setting( 'df_foot_bg', array(
	'default' 			=> '#f7f7f3',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_foot_bg', array(
	'label'       		=> esc_attr__( 'Background Color', 'applique' ),
	'section'     		=> 'df_customize_foot_section',
	'settings'			=> 'df_foot_bg'
) ) );

/* Footer: Text Color */
$wp_customize->add_setting( 'df_foot_txt', array(
	'default' 			=> '#2e210f',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_foot_txt', array(
	'label'       		=> esc_attr__( 'Text Color', 'applique' ),
	'section'     		=> 'df_customize_foot_section',
	'settings'			=> 'df_foot_txt'
) ) );

/* Footer: Text Hover Color */
$wp_customize->add_setting( 'df_foot_txt_hvr', array(
	'default' 			=> '#a9997f',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_foot_txt_hvr', array(
	'label'       		=> esc_attr__( 'Text Hover Color', 'applique' ),
	'section'     		=> 'df_customize_foot_section',
	'settings'			=> 'df_foot_txt_hvr'
) ) );

/* Footer: Border Color */
$wp_customize->add_setting( 'df_foot_border', array(
	'default' 			=> '#f7f7f3',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'         => 'postMessage'
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_foot_border', array(
	'label'       		=> esc_attr__( 'Border Color', 'applique' ),
	'section'     		=> 'df_customize_foot_section',
	'settings'			=> 'df_foot_border'
) ) );