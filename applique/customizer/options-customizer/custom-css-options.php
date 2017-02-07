<?php

if ( !defined( 'ABSPATH' ) ) { exit; }

$wp_customize->add_setting( 'df_custom_css', array(
	'default'			=> '',
	'capability'		=> 'edit_theme_options',
	'sanitize_callback' => 'esc_textarea'
) );

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,'df_custom_css', array(
	'label'				=> esc_attr__( 'Custom CSS', 'applique' ),
	'section'			=> 'df_customize_custom_css_section',
	'setting'			=> 'df_custom_css',
	'type'				=> 'textarea'
) ) );