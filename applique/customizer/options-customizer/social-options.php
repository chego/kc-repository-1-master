<?php

if ( !defined( 'ABSPATH' ) ) { exit; }

/* Misc: Subscription Image */
$wp_customize->add_setting( 'df_subs_img', array(
	'default' 			=> 'http://dahz.daffyhazan.com/applique/shopping/wp-content/uploads/sites/8/2015/11/subscribe.jpg',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'df_subs_img', array(
	'label'       		=> __( 'Subscription Image', 'applique' ),
	'section'     		=> 'df_customize_social_section',
	'settings'			=> 'df_subs_img'
) ) );

/* Misc: Subscription */
$wp_customize->add_setting( 'df_subscription', array(
	'default' 			=> '',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'do_shortcode'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_subscription', array(
	'label'       		=> __( 'Subscription Shortcode', 'applique' ),
	'section'     		=> 'df_customize_social_section',
	'settings'			=> 'df_subscription',
	'type'				=> 'textarea'
) ) );

/* Misc: Archive Link */
$wp_customize->add_setting( 'df_archive_link', array(
	'default' 			=> 'http://dahz.daffyhazan.com/applique/outfit/archives/',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_archive_link', array(
	'label'       		=> __( 'Archive Url', 'applique' ),
	'section'     		=> 'df_customize_social_section',
	'settings'			=> 'df_archive_link',
	'type'				=> 'url'
) ) );

/* Social Account: Facebook */
$wp_customize->add_setting( 'df_facebook', array(
	'default' 			=> '#',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_facebook', array(
	'label'       		=> 'Facebook',
	'section'     		=> 'df_customize_social_section',
	'settings'			=> 'df_facebook',
	'type'				=> 'url'
) ) );

/* Social Account: Twitter */
$wp_customize->add_setting( 'df_twitter', array(
	'default' 			=> '#',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_twitter', array(
	'label'       		=> 'Twitter',
	'section'     		=> 'df_customize_social_section',
	'settings'			=> 'df_twitter',
	'type'				=> 'url'
) ) );

/* Social Account: Instagram */
$wp_customize->add_setting( 'df_instagram', array(
	'default' 			=> '#',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_instagram', array(
	'label'       		=> 'Instagram',
	'section'     		=> 'df_customize_social_section',
	'settings'			=> 'df_instagram',
	'type'				=> 'url'
) ) );

/* Social Account: Pinterest */
$wp_customize->add_setting( 'df_pinterest', array(
	'default' 			=> '#',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_pinterest', array(
	'label'       		=> 'Pinterest',
	'section'     		=> 'df_customize_social_section',
	'settings'			=> 'df_pinterest',
	'type'				=> 'url'
) ) );

/* Social Account: Bloglovin */
$wp_customize->add_setting( 'df_bloglovin', array(
	'default' 			=> '#',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_bloglovin', array(
	'label'       		=> 'Bloglovin',
	'section'     		=> 'df_customize_social_section',
	'settings'			=> 'df_bloglovin',
	'type'				=> 'url'
) ) );

/* Social Account: Google+ */
$wp_customize->add_setting( 'df_google_plus', array(
	'default' 			=> '',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_google_plus', array(
	'label'       		=> 'Google+',
	'section'     		=> 'df_customize_social_section',
	'settings'			=> 'df_google_plus',
	'type'				=> 'url'
) ) );

/* Social Account: Tumblr */
$wp_customize->add_setting( 'df_tumblr', array(
	'default' 			=> '',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_tumblr', array(
	'label'       		=> 'Tumblr',
	'section'     		=> 'df_customize_social_section',
	'settings'			=> 'df_tumblr',
	'type'				=> 'url'
) ) );

/* Social Account: Youtube */
$wp_customize->add_setting( 'df_youtube', array(
	'default' 			=> '',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_youtube', array(
	'label'       		=> 'Youtube',
	'section'     		=> 'df_customize_social_section',
	'settings'			=> 'df_youtube',
	'type'				=> 'url'
) ) );

/* Social Account: Dribble */
$wp_customize->add_setting( 'df_dribble', array(
	'default' 			=> '',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_dribble', array(
	'label'       		=> 'Dribble',
	'section'     		=> 'df_customize_social_section',
	'settings'			=> 'df_dribble',
	'type'				=> 'url'
) ) );

/* Social Account: Soundcloud */
$wp_customize->add_setting( 'df_soundcloud', array(
	'default' 			=> '',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_soundcloud', array(
	'label'       		=> 'Soundcloud',
	'section'     		=> 'df_customize_social_section',
	'settings'			=> 'df_soundcloud',
	'type'				=> 'url'
) ) );

/* Social Account: Vimeo */
$wp_customize->add_setting( 'df_vimeo', array(
	'default' 			=> '',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_vimeo', array(
	'label'       		=> 'Vimeo',
	'section'     		=> 'df_customize_social_section',
	'settings'			=> 'df_vimeo',
	'type'				=> 'url'
) ) );

/* Social Account: Linkedln */
$wp_customize->add_setting( 'df_linkedln', array(
	'default' 			=> '',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_linkedln', array(
	'label'       		=> 'Linkedln',
	'section'     		=> 'df_customize_social_section',
	'settings'			=> 'df_linkedln',
	'type'				=> 'url'
) ) );

/* Social Account: RSS Link */
$wp_customize->add_setting( 'df_rss', array(
	'default' 			=> '',
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_rss', array(
	'label'       		=> 'RSS Link',
	'section'     		=> 'df_customize_social_section',
	'settings'			=> 'df_rss',
	'type'				=> 'url'
) ) );