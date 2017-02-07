<?php

if ( !defined( 'ABSPATH' ) ) { exit; }

/* Featured: Enable */
$wp_customize->add_setting( 'df_feat_enable', array(
	'default'     		=> 1,
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_feat_enable', array(
	'label'       		=> esc_attr__( 'Enable Featured Area', 'applique' ),
	'section'     		=> 'df_customize_feat_section',
	'settings'     		=> 'df_feat_enable',
	'type'				=> 'checkbox',
) ) );

/* Featured: Category Select */
$wp_customize->add_setting( 'df_feat_cat', array(
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_feat_cat', array(
	'label'       		=> esc_attr__( 'Selected Featured Category', 'applique' ),
	'section'     		=> 'df_customize_feat_section',
	'settings'     		=> 'df_feat_cat',
	'type'				=> 'text',
	'description'		=> esc_html__( 'insert your category(s) slug here, Separate category with commas', 'applique' ),
) ) );

/* Featured: Enable */
$wp_customize->add_setting( 'df_feat_hide_cat', array(
	'default'     		=> 0,
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_feat_hide_cat', array(
	'label'       		=> esc_attr__( 'Hide Featured Category', 'applique' ),
	'section'     		=> 'df_customize_feat_section',
	'settings'     		=> 'df_feat_hide_cat',
	'type'				=> 'checkbox',
) ) );

/* Featured: Number Post */
$wp_customize->add_setting( 'df_feat_num', array(
	'default'     		=> '6',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new Customize_Number_Control( $wp_customize, 'df_feat_num', array(
	'label'       		=> esc_attr__( 'Amount of Posts', 'applique' ),
	'section'     		=> 'df_customize_feat_section',
	'settings'     		=> 'df_feat_num',
	'min'				=> '1',
	'max'				=> '12'
) ) );

/* Featured: Featured Area Type */
$wp_customize->add_setting( 'df_feat_type', array(
	'default'     		=> 'grid',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_feat_type', array(
	'label'       		=> esc_attr__( 'Featured Area Type', 'applique' ),
	'section'     		=> 'df_customize_feat_section',
	'settings'     		=> 'df_feat_type',
	'type'				=> 'radio',
	'choices'			=> array(
	                     		'slider' => esc_attr__( 'Slider', 'applique' ),
	                     		'grid' 	 => esc_attr__( 'Grid', 'applique' )
	                       )
) ) );

/* Featured: Slider Style */
$wp_customize->add_setting( 'df_slider_type', array(
	'default' 			=> '',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_slider_type', array(
	'label'				=> esc_attr__( 'Slider Type', 'applique' ),
	'section'			=> 'df_customize_feat_section',
	'settings'			=> 'df_slider_type',
	'type'				=> 'select',
	'choices'			=> array(
							'df-slider-1' => esc_attr__( 'Default', 'applique' ),
							'df-slider-2' => esc_attr__( 'Captioned below', 'applique' ),
							'df-slider-3' => esc_attr__( 'Single Boxed', 'applique' ),
							'df-slider-4' => esc_attr__( 'Single Full Width', 'applique' ),
						),
) ) );

/* Featured: Autoplay Slider */
$wp_customize->add_setting( 'df_enable_auto_slide', array(
	'default'     		=> 0,
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_enable_auto_slide', array(
	'label'       		=> esc_attr__( 'Enable Autoplay Slider', 'applique' ),
	'section'     		=> 'df_customize_feat_section',
	'settings'     		=> 'df_enable_auto_slide',
	'type'				=> 'checkbox'
) ) );

/* Featured: Featured Area Font Style */
$wp_customize->add_setting( 'df_featured_txt_style', array(
	'default' 			=> 'normal',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_featured_txt_style', array(
	'label'       		=> esc_attr__( 'Featured Area Font Style', 'applique' ),
	'section'     		=> 'df_customize_feat_section',
	'settings'			=> 'df_featured_txt_style',
	'description'		=> esc_attr__( 'Insert the name of font style you want. e.g. \'italic\'. You can found reference for the font style here http://www.w3schools.com/cssref/pr_font_font-style.asp', 'applique' ),
	'type'				=> 'text'
) ) );

/* Featured: Featured Area Text Transform */
$wp_customize->add_setting( 'df_featured_txt_trans', array(
	'default' 			=> 'italic',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_featured_txt_trans', array(
	'label'       		=> esc_attr__( 'Featured Area Text Transform', 'applique' ),
	'section'     		=> 'df_customize_feat_section',
	'settings'			=> 'df_featured_txt_trans',
	'description'		=> esc_attr__( 'Insert the text transform you want. e.g. \'normal\'. You can found reference for the font text transform here http://www.w3schools.com/cssref/pr_text_text-transform.asp', 'applique' ),
	'type'				=> 'text'
) ) );