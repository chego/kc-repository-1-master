<?php

if ( !defined( 'ABSPATH' ) ) { exit; }

/*
 * Customizer Color Option Settings
 *
 * 1. General Color Options
 * 2. Button Color Options
 * 3. Widget Color Options
 */


// ======== 1. General Color Options ======== //

/* General : Body Background Color */
$wp_customize->add_setting( 'df_body_background_color', array(
	'default'			=> '#ede8e0',
	'capability'		=> 'edit_theme_options',
	'sanitize_callback'	=> 'sanitize_hex_color',
	'transport'			=> 'postMessage'
));

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_body_background_color', array(
	'label'				=> esc_attr__( 'Body Background Color', 'applique' ),
	'section'			=> 'df_customize_general_color',
	'settings'			=> 'df_body_background_color',
	'description'		=> esc_attr__( 'This setting affect on body background color.', 'applique' ),
) ) );


/* General : Content Background Color */
$wp_customize->add_setting( 'df_body_content_color', array(
	'default'			=> '#f7f7f3',
	'capability'		=> 'edit_theme_options',
	'sanitize_callback'	=> 'sanitize_hex_color',
	'transport'			=> 'postMessage'
));

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_body_content_color', array(
	'label'				=> esc_attr__( 'Content Background Color', 'applique' ),
	'section'			=> 'df_customize_general_color',
	'settings'			=> 'df_body_content_color',
	'description'		=> esc_attr__( 'This setting affect on content background color.', 'applique' ),
) ) );

/* General : Content Border Accent Color Options */
$wp_customize->add_setting( 'df_border_content_accent_color', array(
	'default'			=> '#d9d9d9',
	'capability'		=> 'edit_theme_options',
	'sanitize_callback'	=> 'sanitize_hex_color',
	'transport'			=> 'postMessage'
));

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_border_content_accent_color', array(
	'label'				=> esc_attr__( 'Content Border Accent Color', 'applique' ),
	'section'			=> 'df_customize_general_color',
	'settings'			=> 'df_border_content_accent_color',
	'description'		=> esc_attr__( 'This setting only available for standard & masonry layout in boxed skin.', 'applique' ),
) ) );

/* General : Accent Color Options */
$wp_customize->add_setting( 'df_accent_color', array(
	'default'			=> '#bba681',
	'capability'		=> 'edit_theme_options',
	'sanitize_callback'	=> 'sanitize_hex_color',
	'transport'			=> 'postMessage'
));

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_accent_color', array(
	'label'				=> esc_attr__( 'Accent Color', 'applique' ),
	'section'			=> 'df_customize_general_color',
	'settings'			=> 'df_accent_color',
	'description'		=> esc_attr__( 'This setting affect on link color.', 'applique' ),
) ) );

/* General : Accent Hover Color Options */
$wp_customize->add_setting( 'df_accent_color_hover', array(
	'default'			=> '#736f68',
	'capability'		=> 'edit_theme_options',
	'sanitize_callback'	=> 'sanitize_hex_color',
	'transport'			=> 'postMessage'
));

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_accent_color_hover', array(
	'label'				=> esc_attr__( 'Accent Hover Color', 'applique' ),
	'section'			=> 'df_customize_general_color',
	'settings'			=> 'df_accent_color_hover',
) ) );

/* General : Heading Color Options */
$wp_customize->add_setting( 'df_heading_color', array(
	'default'			=> '#31302e',
	'capability'		=> 'edit_theme_options',
	'sanitize_callback'	=> 'sanitize_hex_color',
	'transport'			=> 'postMessage'
));

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_heading_color', array(
	'label'				=> esc_attr__( 'Heading Color', 'applique' ),
	'section'			=> 'df_customize_general_color',
	'settings'			=> 'df_heading_color',
	'description'		=> esc_attr__( 'This setting affect on Heading Body Typography.', 'applique' ),
) ) );

/* General : Body Font Color Options */
$wp_customize->add_setting( 'df_body_font_color', array(
	'default'			=> '#6b6051',
	'capability'		=> 'edit_theme_options',
	'sanitize_callback'	=> 'sanitize_hex_color',
	'transport'			=> 'postMessage'
));

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_body_font_color', array(
	'label'				=> esc_attr__( 'Body Font Color', 'applique' ),
	'section'			=> 'df_customize_general_color',
	'settings'			=> 'df_body_font_color',
	'description'		=> esc_attr__( 'This setting affect on Body Font.', 'applique' ),
) ) );

/* General : Meta Font Color Options */
$wp_customize->add_setting( 'df_meta_font_color', array(
	'default'			=> '#2e210f',
	'capability'		=> 'edit_theme_options',
	'sanitize_callback'	=> 'sanitize_hex_color',
	'transport'			=> 'postMessage'
));

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_meta_font_color', array(
	'label'				=> esc_attr__( 'Meta Font Color', 'applique' ),
	'section'			=> 'df_customize_general_color',
	'settings'			=> 'df_meta_font_color',
	'description'		=> esc_attr__( 'This setting affect for meta text.', 'applique' ),
) ) );

/* General : Border Accent Color Options */
$wp_customize->add_setting( 'df_border_accent_color', array(
	'default'			=> '#c1beb8',
	'capability'		=> 'edit_theme_options',
	'sanitize_callback'	=> 'sanitize_hex_color',
	'transport'			=> 'postMessage'
));

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_border_accent_color', array(
	'label'				=> esc_attr__( 'Border Accent Color', 'applique' ),
	'section'			=> 'df_customize_general_color',
	'settings'			=> 'df_border_accent_color',
	'description'		=> esc_attr__( 'This setting affect on border color.', 'applique' ),
) ) );

// ======== 2. Button Color Options ======== //

/* Button : Fill Button Color Settings */
$wp_customize->add_setting( 'df_button_fill_color', array(
	'default'			=> '#565148',
	'capability'		=> 'edit_theme_options',
	'sanitize_callback'	=> 'sanitize_hex_color',
	'transport'			=> 'postMessage'
));

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_button_fill_color', array(
	'label'				=> esc_attr__( 'Button Fill Color', 'applique' ),
	'section'			=> 'df_customize_button_section',
	'settings'			=> 'df_button_fill_color'
) ) );

/* Button : Fill Button Hover Color Settings */
$wp_customize->add_setting( 'df_button_fill_hover_color', array(
	'default'			=> '#444444',
	'capability'		=> 'edit_theme_options',
	'sanitize_callback'	=> 'sanitize_hex_color',
	'transport'			=> 'postMessage'
));

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_button_fill_hover_color', array(
	'label'				=> esc_attr__( 'Button Fill Hover Color', 'applique' ),
	'section'			=> 'df_customize_button_section',
	'settings'			=> 'df_button_fill_hover_color'
) ) );

/* Button : Button Fill Font Hover Color Settings */
$wp_customize->add_setting( 'df_button_fill_font_color', array(
	'default'			=> '#ffffff',
	'capability'		=> 'edit_theme_options',
	'sanitize_callback'	=> 'sanitize_hex_color',
	'transport'			=> 'postMessage'
));

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_button_fill_font_color', array(
	'label'				=> esc_attr__( 'Button Fill Font Hover Color', 'applique' ),
	'section'			=> 'df_customize_button_section',
	'settings'			=> 'df_button_fill_font_color'
) ) );

/* Button : Outline Button Border Color Settings */
$wp_customize->add_setting( 'df_button_outline_border_color', array(
	'default'			=> '#c1beb8',
	'capability'		=> 'edit_theme_options',
	'sanitize_callback'	=> 'sanitize_hex_color',
	'transport'			=> 'postMessage'
));

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_button_outline_border_color', array(
	'label'				=> esc_attr__( 'Button Outline Border Color', 'applique' ),
	'section'			=> 'df_customize_button_section',
	'settings'			=> 'df_button_outline_border_color'
) ) );

/* Button : Outline Button Font Color Settings */
$wp_customize->add_setting( 'df_button_outline_font_color', array(
	'default'			=> '#c1beb8',
	'capability'		=> 'edit_theme_options',
	'sanitize_callback'	=> 'sanitize_hex_color',
	'transport'			=> 'postMessage'
));

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_button_outline_font_color', array(
	'label'				=> esc_attr__( 'Button Outline Font Color', 'applique' ),
	'section'			=> 'df_customize_button_section',
	'settings'			=> 'df_button_outline_font_color'
) ) );

/* Button : Outline Button Hover Color Settings */
$wp_customize->add_setting( 'df_button_outline_hover_color', array(
	'default'			=> '#565148',
	'capability'		=> 'edit_theme_options',
	'sanitize_callback'	=> 'sanitize_hex_color',
	'transport'			=> 'postMessage'
));

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_button_outline_hover_color', array(
	'label'				=> esc_attr__( 'Button Outline Hover Color', 'applique' ),
	'section'			=> 'df_customize_button_section',
	'settings'			=> 'df_button_outline_hover_color'
) ) );

/* Button : Outline Button Hover Font Color Settings */
$wp_customize->add_setting( 'df_button_outline_hover_font_color', array(
	'default'			=> '#FFFFFF',
	'capability'		=> 'edit_theme_options',
	'sanitize_callback'	=> 'sanitize_hex_color',
	'transport'			=> 'postMessage'
));

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_button_outline_hover_font_color', array(
	'label'				=> esc_attr__( 'Button Outline Hover Font Color', 'applique' ),
	'section'			=> 'df_customize_button_section',
	'settings'			=> 'df_button_outline_hover_font_color'
) ) );

// ======== 3. Widget Color Options ======== //

/* Widget : Widget Heading Color Settings */
$wp_customize->add_setting( 'df_widget_heading_color', array(
	'default'			=> '#070707',
	'capability'		=> 'edit_theme_options',
	'sanitize_callback'	=> 'sanitize_hex_color',
	'transport'			=> 'postMessage'
));

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'df_widget_heading_color', array(
	'label'				=> esc_attr__( 'Widget Heading Font Color', 'applique' ),
	'section'			=> 'df_customize_widget_color_section',
	'settings'			=> 'df_widget_heading_color'
) ) );