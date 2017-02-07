<?php

if ( !defined( 'ABSPATH' ) ) { exit; }

/* Post: Hide Categories */
$wp_customize->add_setting( 'df_hide_category', array(
	'default' 			=> 0,
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_hide_category', array(
	'label'       		=> esc_attr__( 'Hide Category', 'applique' ),
	'section'     		=> 'df_customize_post_section',
	'settings'			=> 'df_hide_category',
	'type'				=> 'checkbox'
) ) );

/* Post: Hide Date */
$wp_customize->add_setting( 'df_hide_date', array(
	'default' 			=> 0,
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_hide_date', array(
	'label'       		=> esc_attr__( 'Hide Date', 'applique' ),
	'section'     		=> 'df_customize_post_section',
	'settings'			=> 'df_hide_date',
	'type'				=> 'checkbox'
) ) );

/* Post: Hide Tags */
$wp_customize->add_setting( 'df_hide_tags', array(
	'default' 			=> 0,
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_hide_tags', array(
	'label'       		=> esc_attr__( 'Hide Tags', 'applique' ),
	'section'     		=> 'df_customize_post_section',
	'settings'			=> 'df_hide_tags',
	'type'				=> 'checkbox'
) ) );

/* Post: Hide Share */
$wp_customize->add_setting( 'df_hide_share', array(
	'default' 			=> 0,
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_hide_share', array(
	'label'       		=> esc_attr__( 'Hide Shares', 'applique' ),
	'section'     		=> 'df_customize_post_section',
	'settings'			=> 'df_hide_share',
	'type'				=> 'checkbox'
) ) );

/* Post: Hide Comments Link */
$wp_customize->add_setting( 'df_hide_comment_link', array(
	'default' 			=> 0,
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_hide_comment_link', array(
	'label'       		=> esc_attr__( 'Hide Comment Link', 'applique' ),
	'section'     		=> 'df_customize_post_section',
	'settings'			=> 'df_hide_comment_link',
	'type'				=> 'checkbox'
) ) );

/* Post: Hide Author Box */
$wp_customize->add_setting( 'df_hide_author_box', array(
	'default' 			=> 0,
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_hide_author_box', array(
	'label'       		=> esc_attr__( 'Hide Author Box', 'applique' ),
	'section'     		=> 'df_customize_post_section',
	'settings'			=> 'df_hide_author_box',
	'type'				=> 'checkbox'
) ) );

/* Post: Hide Related Post */
$wp_customize->add_setting( 'df_hide_rel_post', array(
	'default' 			=> 0,
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_hide_rel_post', array(
	'label'       		=> esc_attr__( 'Hide Related Posts', 'applique' ),
	'section'     		=> 'df_customize_post_section',
	'settings'			=> 'df_hide_rel_post',
	'type'				=> 'checkbox'
) ) );

/* Post: Hide Feature Image */
$wp_customize->add_setting( 'df_hide_feat_img', array(
	'default' 			=> 0,
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_hide_feat_img', array(
	'label'       		=> esc_attr__( 'Disable Featured Image on single post', 'applique' ),
	'section'     		=> 'df_customize_post_section',
	'settings'			=> 'df_hide_feat_img',
	'type'				=> 'checkbox'
) ) );

/* Post: Hide Like */
$wp_customize->add_setting( 'df_hide_like', array(
	'default' 			=> 0,
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_hide_like', array(
	'label'       		=> esc_attr__( 'Show Like Post', 'applique' ),
	'section'     		=> 'df_customize_post_section',
	'settings'			=> 'df_hide_like',
	'type'				=> 'checkbox'
) ) );


/* Post: Enable wider column on single post*/
$wp_customize->add_setting( 'df_single_wider_column', array(
	'default' 			=> 0,
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_single_wider_column', array(
	'label'       		=> esc_attr__( 'Enable Wider Column', 'applique' ),
	'section'     		=> 'df_customize_post_section',
	'settings'			=> 'df_single_wider_column',
	'type'				=> 'checkbox'
) ) );

/* Page: Hide Share */
$wp_customize->add_setting( 'df_share_page', array(
	'default' 			=> 0,
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_share_page', array(
	'label'       		=> esc_attr__( 'Hide Share Page', 'applique' ),
	'section'     		=> 'df_customize_page_section',
	'settings'			=> 'df_share_page',
	'type'				=> 'checkbox'
) ) );

/* Page: Hide Like */
$wp_customize->add_setting( 'df_like_page', array(
	'default' 			=> 1,
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_like_page', array(
	'label'       		=> esc_attr__( 'Hide Like Page', 'applique' ),
	'section'     		=> 'df_customize_page_section',
	'settings'			=> 'df_like_page',
	'type'				=> 'checkbox'
) ) );
