<?php

/**
 * Applique Child Theme Function File
 */

// Register style file from parents theme
add_action( 'wp_enqueue_scripts', 'applique_child_theme_styles' );

function applique_child_theme_styles() {

	wp_enqueue_style( 'df-layout', get_template_directory_uri() . '/assets/css/layout.min.css', false, '1.0.0', 'all' );

	if ( is_rtl() )
		wp_enqueue_style( 'rtl', get_template_directory_uri() . '/assets/css/rtl.min.css', false, '1.0.0', 'all' );

    if ( get_theme_mod( 'df_skin', 'df-skin-boxed' ) == 'df-skin-light' )
        wp_enqueue_style( 'df-skin-light', get_template_directory_uri() . '/assets/css/light.min.css', false, '1.0.0', 'all' );

    if ( get_theme_mod( 'df_skin', 'df-skin-boxed' ) == 'df-skin-boxed' )
            wp_enqueue_style( 'df-skin-boxed', get_template_directory_uri() . '/assets/css/boxed.min.css', false, '1.0.0', 'all' );


	wp_enqueue_style( 'df-layout-child', get_stylesheet_directory_uri() . '/style.css', array('df-layout'), false );
}

function custom_excerpt_length( $length ) {
	return 5;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


// ACF: Theme Option
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page('Theme Option');
}

//Including "Show Branding Checkbox" in Customizer
function evp_customize_register( $wp_customize )
  {
    $wp_customize->add_setting( 'show_hide_logo', array(
    'default'           => 1,
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_attr',
  ));

  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'show_hide_logo', array(
    'label'         => esc_attr__( 'Show Branding', 'applique' ),
    'section'       => 'df_customize_logo_section',
    'settings'      => 'show_hide_logo',
    'type'          => 'checkbox'
  )));
}
add_action( 'customize_register', 'evp_customize_register');
