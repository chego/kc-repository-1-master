<?php

if ( !defined( 'ABSPATH' ) ) { exit; }


if ( ! function_exists( 'df_load_frontend_script' ) ) {

	/**
	 * Enqueue the comment reply JavaScript on singular entry screens.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function df_load_frontend_script() {

        $theme = wp_get_theme();

		/* TheiaStickySidebar */
		wp_register_script( 'stickySidebar', get_template_directory_uri() . '/assets/js/TheiaStickySidebar.js', array( 'jquery' ), '1.2.2', true );

		/* Owl Carousel */
		wp_enqueue_script( 'OwlCarousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '2.0.0', true );

		/* Waypoint */
		wp_enqueue_script( 'waypoint', get_template_directory_uri() . '/assets/js/waypoint.js', array( 'jquery' ), '4.0.0', true );

		/* Fitvids JS */
		wp_enqueue_script( 'FitVids', get_template_directory_uri() . '/assets/js/fitvids.js', array( 'jquery' ), '1.1', true );

		/* Resize JS */
		wp_enqueue_script( 'resize', get_template_directory_uri() . '/assets/js/debounced-resize.js', array( 'jquery' ), null, true );

		/* Parallax JS */
		wp_enqueue_script( 'parallax', get_template_directory_uri() . '/assets/js/parallax.js', array( 'jquery' ), '1.1.3', true );

		/* Grid JS */
		wp_enqueue_script( 'df-isotope', get_template_directory_uri() . '/assets/js/grid.js', array( 'jquery' ), '2.2.2', true );

		/* Infinite Scroll JS */
		wp_enqueue_script( 'inf-scr', get_template_directory_uri() . '/assets/js/infinite-scroll.js', array( 'jquery' ), '2.1.0', true );

		/* scrollDepth for analytics */
		wp_enqueue_script( 'df-scrlDepth', get_template_directory_uri() . '/assets/js/jquery.scrolldepth.js', array( 'jquery' ), NULL, true );

		/* Main Theme JS */
		wp_enqueue_script( 'df-main', get_template_directory_uri() . '/assets/js/main.min.js', array( 'jquery' ), $theme->get( 'Version' ), true );

		/* Comment Repeats */
	  	if ( is_singular() && get_option( 'thread_comments' ) && comments_open() ) {
	  		wp_enqueue_script( 'comment-reply' );
	  	}

	  	do_action( 'df_localization_string' );

	}

}

add_action( 'wp_enqueue_scripts', 'df_load_frontend_script', 5 );

function df_convert_string() {

	/* Navbar Border */
	$border = '';
	if ( get_theme_mod( 'df_nav_border', 1 ) == 1 ) {
		$border = 'border-top border-bottom';
		if ( get_theme_mod( 'df_nav_pos', 'nav_top' ) == 'nav_top' ) {
			$border = 'border-bottom';
		}
	}

	wp_localize_script( 'df-main', 'df', array(
		'navClass' => esc_attr( $border )
	) );

	wp_localize_script( 'OwlCarousel', 'carousel', array(
		'type' 		=> get_theme_mod( 'df_feat_type', 'grid' ),
		'auto_play'	=> get_theme_mod( 'df_enable_auto_slide', 0 ),
		'slide_type'=> get_theme_mod( 'df_slider_type' ),
	) );

	wp_localize_script( 'inf-scr', 'inf', array(
		'finishText' => esc_attr__( 'All Post Loaded', 'applique' )
	) );

}
add_action( 'df_localization_string', 'df_convert_string' );

if ( !function_exists( 'df_enqueue_metabox_options_script' ) ) {

    function df_enqueue_metabox_options_script() {

        wp_enqueue_script( 'meta-options-toggle', get_template_directory_uri() . '/assets/js/admin/admin.min.js', array( 'jquery' ), NULL, true );

    }

    add_action( 'admin_enqueue_scripts', 'df_enqueue_metabox_options_script' );

} // End df_enqueue_metabox_options_script()

if ( !function_exists( 'df_enqueue_customize_preview_script' ) ) {

    function df_enqueue_customize_preview_script() {

        wp_enqueue_script( 'df-customize-preview', get_template_directory_uri() . '/assets/js/admin/df-post-message.min.js', array( 'jquery' ), NULL, true );

    }

    add_action( 'customize_preview_init', 'df_enqueue_customize_preview_script' );

} // End df_enqueue_metabox_options_script()

if ( !function_exists( 'df_enqueue_import_demo_script' ) ) {

    function df_enqueue_import_demo_script() {

        wp_enqueue_script( 'df-import-demo', get_template_directory_uri() . '/assets/js/admin/df-import-demo.min.js', array( 'jquery' ), NULL, true );

    }

    add_action( 'admin_enqueue_scripts', 'df_enqueue_import_demo_script' );
}