<?php

if ( !defined( 'ABSPATH' ) ) { exit; }


if ( !function_exists( 'df_load_frontend_style' ) ) {

	/**
	 * Function to enqueue theme css to `<head>`.
	 * This function is hooked to `wp_enqueue_scripts`.
	 *
	 * @return void
	 */
    function df_load_frontend_style() {

        $theme             = wp_get_theme();
        $heading_font_type = get_theme_mod( 'df_heading_txt_type', 'Prata' );
        $body_font_type    = get_theme_mod( 'df_body_txt_type', 'Crimson Text' );
        $nav_font_type     = get_theme_mod( 'df_nav_txt_type', 'Montserrat' );
        $meta_font_type    = get_theme_mod( 'df_meta_txt_type', 'Montserrat' );
        $btn_font_type     = get_theme_mod( 'df_btn_txt_type', 'Lato' );
        $subsets           = 'latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese';

        $google_font = add_query_arg( array(
            'family' => urlencode ( $heading_font_type . ':300,400,600,700,400italic|' . $body_font_type . ':300,400,600,700,400italic|' . $nav_font_type . ':300,400,600,700,400italic|' . $meta_font_type . ':300,400,600,700,400italic|' . $btn_font_type . ':300,400,600,700,400italic' ),
            'subset' => urlencode ( $subsets ),
        ), '//fonts.googleapis.com/css' );

        /* FontAwesome CSS */
        wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', false, '4.4.0', 'all' );

        /* Ionicons CSS */
        wp_enqueue_style( 'ionicons', get_template_directory_uri() . '/assets/css/ionicons.min.css', false, '2.0.1', 'all' );

        /* Owl Carousel CSS */
        wp_enqueue_style( 'OwlCarousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', false, '2.0.0', 'all' );

        /* Owl Carousel CSS */
        if ( get_theme_mod( 'df_enable_page_loader', 0 ) == 1 ) {
            wp_enqueue_style( 'PageLoader', get_template_directory_uri() . '/assets/css/page-loader.min.css', false, '2.0.0', 'all' );
        }

        /* Layout Style */
        wp_enqueue_style( 'df-layout', get_template_directory_uri() . '/assets/css/layout.min.css', false, $theme->get( 'Version' ), 'all' );

        /* Skin Style */
        if ( get_theme_mod( 'df_skin', 'df-skin-boxed' ) == 'df-skin-light' ) {
            wp_enqueue_style( 'df-skin-light', get_template_directory_uri() . '/assets/css/light.min.css', false, $theme->get( 'Version' ), 'all' );
        }

        if ( get_theme_mod( 'df_skin', 'df-skin-boxed' ) == 'df-skin-boxed' ) {
            wp_enqueue_style( 'df-skin-boxed', get_template_directory_uri() . '/assets/css/boxed.min.css', false, $theme->get( 'Version' ), 'all' );
        }

        if ( get_theme_mod( 'df_bw_hover' ) == 1 ) {
            wp_enqueue_style( 'df-glob-bw', get_template_directory_uri() . '/assets/css/glob-bw.css', false, $theme->get( 'Version' ), 'all' );
        }

        /* RTL */
        if ( is_rtl() ) {
            wp_enqueue_style( 'rtl', get_template_directory_uri() . '/assets/css/rtl.min.css', false, $theme->get( 'Version' ), 'all' );
        }

        /* Google Fonts */
        wp_enqueue_style( 'df-custom-font', $google_font, null, null, 'all' );

        if ( class_exists( 'WooCommerce' ) ) {
            wp_enqueue_style( 'df-woo-css', get_template_directory_uri() . '/assets/css/woocommerce.css', false, $theme->get( 'Version' ), 'all' );
        }
    }

	add_action( 'wp_enqueue_scripts', 'df_load_frontend_style', 20 );

}

if ( !function_exists( 'df_load_admin_style' ) || function_exists( 'vp_pfui_base_url' ) ) {

    /**
     * Function to enqueue theme css to `<head>`.
     * This function is hooked to `wp_enqueue_scripts`.
     *
     * @return void
     */
    function df_load_admin_style() {
        /* Post Format Tabs */
        wp_enqueue_style( 'df-admin-style', get_template_directory_uri() . '/assets/css/admin/admin.min.css', false, '1.0.0', 'all' );
        wp_enqueue_style( 'df-admin-install-demo', get_template_directory_uri() . '/assets/css/admin/admin-install-demo.min.css', false, '0.1.0', 'all' );
    }

    add_action( 'admin_enqueue_scripts', 'df_load_admin_style' );

}