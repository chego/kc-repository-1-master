<?php

if ( !defined( 'ABSPATH' ) ) { exit; }


/**
 * dahz_add_customizer_panels. Register Custom Panel To Customizer
 *
 * @param $wp_customize
 * @return void
 */
if ( !function_exists( 'dahz_add_customizer_panels' ) ) :

	function dahz_add_customizer_panels( $wp_customize ) {

		/* Add Header Panels */
	    $wp_customize->add_panel( 'df_customize_header_panel', array(
			'title' 	 	=> 'Header',
			'capability' 	=> 'manage_options',
			'priority'	 	=> 20
		) );

		/* Add Color Panel*/
		$wp_customize->add_panel( 'df_customize_color_panel', array(
			'title'			=> 'Color',
			'capability'	=> 'manage_options',
			'priority'	 	=> 60
		) );

	}
	add_action( 'customize_register', 'dahz_add_customizer_panels' );

endif;

/**
 * dahz_add_customizer_sections. Register Custom Sections To Customizer
 *
 * @param $wp_customize
 * @return void
 */
if ( !function_exists( 'dahz_add_customizer_sections' ) ) :

	function dahz_add_customizer_sections( $wp_customize ) {

		/* Add General Sections */
	    $wp_customize->add_section( 'df_customize_general_section', array(
			'title' 	 => esc_attr__( 'General Layout', 'applique' ),
			'capability' => 'manage_options',
			'priority'	 => 10
		) );

		/* Add Logo Sections */
	    $wp_customize->add_section( 'df_customize_logo_section', array(
			'title' 	 => 'Logo',
			'capability' => 'manage_options',
			'panel'		 => 'df_customize_header_panel',
		) );

		/* Add Navigation Sections */
	    $wp_customize->add_section( 'df_customize_nav_section', array(
			'title' 	 => esc_attr__( 'Navigations', 'applique' ),
			'capability' => 'manage_options',
			'panel'		 => 'df_customize_header_panel',
		) );

		/* Add Featured Sections */
	    $wp_customize->add_section( 'df_customize_feat_section', array(
			'title' 	 => esc_attr__( 'Featured Area', 'applique' ),
			'capability' => 'manage_options',
			'priority'	 => 40
		) );

		/* Add Post Sections */
	    $wp_customize->add_section( 'df_customize_post_section', array(
			'title' 	 => esc_attr__( 'Post Settings', 'applique' ),
			'capability' => 'manage_options',
			'priority'	 => 50
		) );

		/* Add Page Sections */
	    $wp_customize->add_section( 'df_customize_page_section', array(
			'title' 	 => esc_attr__( 'Page Settings', 'applique' ),
			'capability' => 'manage_options',
			'priority'	 => 60
		) );

		/* Add General Color Sections */
		$wp_customize->add_section( 'df_customize_general_color', array(
			'title'		 => esc_attr__( 'General', 'applique' ),
			'capability' => 'manage_options',
			'priority'	 => 70,
			'panel'		 => 'df_customize_color_panel'
		) );

		/* Add Button Color Sections */
	    $wp_customize->add_section( 'df_customize_button_section', array(
			'title' 	 => esc_attr__( 'Button', 'applique' ),
			'capability' => 'manage_options',
			'priority'	 => 80,
			'panel'		 => 'df_customize_color_panel'
		) );

		/* Add Widget Color Sections */
		$wp_customize->add_section( 'df_customize_widget_color_section', array(
			'title'		 => esc_attr__( 'Widget', 'applique' ),
			'capability' => 'manage_options',
			'priority'	 => 90,
			'panel'		 => 'df_customize_color_panel'
		) );

		/* Add Footer Sections */
	    $wp_customize->add_section( 'df_customize_foot_section', array(
			'title' 	 => esc_attr__( 'Footer', 'applique' ),
			'capability' => 'manage_options',
			'priority'	 => 100
		) );

		/* Add Ads Sections */
	    $wp_customize->add_section( 'df_customize_ads_section', array(
			'title' 	 => esc_attr__( 'Advertisement', 'applique' ),
			'capability' => 'manage_options',
			'priority'	 => 110
		) );

		/* Add Social Account Sections */
	    $wp_customize->add_section( 'df_customize_social_section', array(
			'title' 	 => esc_attr__( 'Social Account & Misc', 'applique' ),
			'capability' => 'manage_options',
			'priority'	 => 120
		) );

		/* Add Typography Sections */
	    $wp_customize->add_section( 'df_customize_typo_section', array(
			'title' 	 => esc_attr__( 'Typography', 'applique' ),
			'capability' => 'manage_options',
			'priority'	 => 130
		) );

		/* Add Page Loader Sections */
	    $wp_customize->add_section( 'df_customize_page_loader_section', array(
			'title' 	 => esc_attr__( 'Page Loader', 'applique' ),
			'capability' => 'manage_options',
			'priority'	 => 140
		) );

	    if ( class_exists('WooCommerce') ) {
		    $wp_customize->add_section( 'df_customize_woocommerce_section', array(
				'title' 	 => esc_attr__( 'WooCommerce', 'applique' ),
				'capability' => 'manage_options',
				'priority'	 => 150
			) );
	    }


		/* Add Custom CSS Sections */
	    $wp_customize->add_section( 'df_customize_custom_css_section', array(
			'title' 	 => esc_attr__( 'Custom CSS', 'applique' ),
			'capability' => 'manage_options',
			'priority'	 => 160
		) );

	}
	add_action( 'customize_register', 'dahz_add_customizer_sections' );

endif;

/**
 * dahz_remove_customizer_sections. Remove Unused Native Sections
 *
 * @param $wp_customize
 * @return void
 */
if ( !function_exists( 'dahz_remove_customizer_sections' ) ) :

	function dahz_remove_customizer_sections( $wp_customize ) {

		/* Remove Site Identity Sections */
	    $wp_customize->remove_section( 'title_tagline' );

	}
	add_action( 'customize_register', 'dahz_remove_customizer_sections' );

endif;

/**
 * dahz_register_options_settings. Register option settings To Customizer
 *
 * @param $wp_customize
 * @return void
 */
if ( !function_exists( 'dahz_register_options_settings' ) ) :

	function dahz_register_options_settings( $wp_customize ) {

		/* Register Logo Settings */
		require_once get_template_directory() . '/customizer/options-customizer/logo-options.php';
		/* Register Nav Settings */
		require_once get_template_directory() . '/customizer/options-customizer/nav-options.php';
		/* Register Footer Settings */
		require_once get_template_directory() . '/customizer/options-customizer/footer-options.php';
		/* Register Featured Settings */
		require_once get_template_directory() . '/customizer/options-customizer/feature-options.php';
		/* Register General Settings */
		require_once get_template_directory() . '/customizer/options-customizer/general-options.php';
		/* Register Ads Settings */
		require_once get_template_directory() . '/customizer/options-customizer/ads-options.php';
		/* Register Post Settings */
		require_once get_template_directory() . '/customizer/options-customizer/post-options.php';
		/* Register Social Settings */
		require_once get_template_directory() . '/customizer/options-customizer/social-options.php';
		/* Register Typo Settings */
		require_once get_template_directory() . '/customizer/options-customizer/typo-options.php';
		/* Register Custom CSS Settings */
		require_once get_template_directory() . '/customizer/options-customizer/custom-css-options.php';
		/* Register Color Settings */
		require_once get_template_directory() . '/customizer/options-customizer/color-options.php';
		/* Register Woocommerce Settings */
		require_once get_template_directory() . '/customizer/options-customizer/woocommerce-options.php';
	}
	add_action( 'customize_register', 'dahz_register_options_settings' );

endif;

/**
 * dahz_register_outputs_settings. Register output settings To Customizer
 *
 * @param $wp_customize
 * @return void
 */
if ( ! function_exists( 'dahz_register_outputs_settings' ) ) :

	function dahz_register_outputs_settings() {
		ob_start();
		echo '<style id="df-custom-css" type="text/css">';
			/* Register General Outputs */
			require_once get_template_directory() . '/customizer/outputs-customizer/general-outputs.php';
			/* Register Logo Outputs */
			require_once get_template_directory() . '/customizer/outputs-customizer/logo-outputs.php';
			/* Register Nav Outputs */
			require_once get_template_directory() . '/customizer/outputs-customizer/nav-outputs.php';
			/* Register Footer Outputs */
			require_once get_template_directory() . '/customizer/outputs-customizer/footer-outputs.php';
			/* Register Typography Outputs */
			require_once get_template_directory() . '/customizer/outputs-customizer/typo-outputs.php';
			/* Register Color Outputs */
			require_once get_template_directory() . '/customizer/outputs-customizer/color-outputs.php';
			/* Register Featured Area Outputs */
			require_once get_template_directory() . '/customizer/outputs-customizer/feature-outputs.php';
		echo '</style>' . "\n";
		$css = ob_get_contents(); ob_end_clean();

		// 1. Remove comments.
		// 2. Remove whitespace.
		// 3. Remove starting whitespace.
		$output = preg_replace( '#/\*.*?\*/#s', '', $css );            // 1
		$output = preg_replace( '/\s*([{}|:;,])\s+/', '$1', $output ); // 2
		$output = preg_replace( '/\s\s+(.*)/', '$1', $output );        // 3

		print $output;
	}

	add_action( 'wp_head', 'dahz_register_outputs_settings', 998 );

endif;

/**
 * dahz_register_custom_css_output. Register custom css output settings To Customizer
 *
 * @param $wp_customize
 * @return void
 */
if ( ! function_exists('dahz_register_custom_css_output') ) :

	function dahz_register_custom_css_output(){
		$customcss = get_theme_mod( 'df_custom_css' );
		if ( $customcss != '' ) {
	        echo '<!-- Custom CSS -->' . "\n";
	        echo '<style type="text/css">' . esc_html( $customcss ) . '</style>';
		}
	}
	add_action( 'wp_head', 'dahz_register_custom_css_output', 999 );
endif;