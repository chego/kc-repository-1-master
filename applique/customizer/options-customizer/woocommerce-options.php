<?php
if ( !defined( 'ABSPATH' ) ) { exit; }

/* WooCommerce: Disable On Shop Sidebar */
$wp_customize->add_setting( 'df_disable_woocommerce_sidebar', array(
	'default' 			=> 0,
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_disable_woocommerce_sidebar', array(
	'label'       		=> esc_attr__( 'Disable Sidebar on Shop & Archive page', 'applique' ),
	'section'     		=> 'df_customize_woocommerce_section',
	'settings'			=> 'df_disable_woocommerce_sidebar',
	'type'				=> 'checkbox'
) ) );

/* WooCommerce: Disable On Single Product Sidebar */
$wp_customize->add_setting( 'df_disable_woocommerce_single_sidebar', array(
	'default' 			=> 0,
	'capability' 		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_attr'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'df_disable_woocommerce_single_sidebar', array(
	'label'       		=> esc_attr__( 'Disable Sidebar on Product Page', 'applique' ),
	'section'     		=> 'df_customize_woocommerce_section',
	'settings'			=> 'df_disable_woocommerce_single_sidebar',
	'type'				=> 'checkbox'
) ) );