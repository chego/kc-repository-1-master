<?php

if ( !defined( 'ABSPATH' ) ) { exit; }

/**
 * Page loader style switcher.
 */
if ( ! function_exists( 'df_loading_spinners' ) ) {

	function df_loading_spinners() {

		if ( get_theme_mod( 'df_enable_page_loader_animation', 0 ) == 0 )
			return;

		$loading_animation_style = get_theme_mod( 'df_loader_style', 'pulse' );

		switch ( $loading_animation_style ) {
			case 'double-pulse' :
				$spinner_html = df_loading_spinner_double_pulse();
				break;
			case 'cube' :
				$spinner_html = df_loading_spinner_cube();
				break;
			case 'rotate-cube' :
				$spinner_html = df_loading_spinner_rotating_cubes();
				break;
			case 'stripes' :
				$spinner_html = df_loading_spinner_stripes();
				break;
			case 'wave' :
				$spinner_html = df_loading_spinner_wave();
				break;
			case 'two-rotate' :
				$spinner_html = df_loading_spinner_two_rotating_circles();
				break;
			case 'five-rotate' :
				$spinner_html = df_loading_spinner_five_rotating_circles();
				break;
			default :
				$spinner_html = df_loading_spinner_pulse();
				break;
		}

		return $spinner_html;

	}

}

/**
 * Build HTML spinner pulse effect.
 */
if ( ! function_exists( 'df_loading_spinner_pulse' ) ) {

	function df_loading_spinner_pulse() {

		$df_loader_color = get_theme_mod( 'df_loader_color', '#e2e2e2' );

		$html = sprintf( '<div class="pulse" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );

		$html = wp_kses( $html, array( 'div' => array( 'class' => array(), 'style' => array() ) ) );

		return $html;

	}

}

/**
 * Build HTML double spinner pulse effect.
 */
if ( ! function_exists( 'df_loading_spinner_double_pulse' ) ) {

	function df_loading_spinner_double_pulse() {

		$df_loader_color = get_theme_mod( 'df_loader_color', '#e2e2e2' );

		$html  = '<div class="double_pulse">';
		$html .= sprintf( '<div class="double-bounce1" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );
		$html .= sprintf( '<div class="double-bounce2" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );
		$html .= '</div>';

		$html  = wp_kses( $html, array( 'div' => array( 'class' => array(), 'style' => array() ) ) );

		return $html;
	}

}

/**
 * Build HTML double spinner cube effect.
 */
if ( ! function_exists( 'df_loading_spinner_cube' ) ) {

	function df_loading_spinner_cube() {

		$df_loader_color = get_theme_mod( 'df_loader_color', '#e2e2e2' );

		$html = sprintf( '<div class="cube" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );

		$html = wp_kses( $html, array( 'div' => array( 'class' => array(), 'style' => array() ) ) );

		return $html;

	}

}

/**
 * Build HTML double spinner rotate cube effect.
 */
if ( ! function_exists( 'df_loading_spinner_rotating_cubes' ) ) {

	function df_loading_spinner_rotating_cubes() {

		$df_loader_color = get_theme_mod( 'df_loader_color', '#e2e2e2' );

		$html  = '<div class="rotating_cubes">';
		$html .= sprintf( '<div class="cube1" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );
		$html .= sprintf( '<div class="cube2" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );
		$html .= '</div>';

		$html  = wp_kses( $html, array( 'div' => array( 'class' => array(), 'style' => array() ) ) );

		return $html;

	}

}

/**
 * Build HTML double spinner stripes effect.
 */
if ( ! function_exists( 'df_loading_spinner_stripes' ) ) {

	function df_loading_spinner_stripes() {

		$df_loader_color = get_theme_mod( 'df_loader_color', '#e2e2e2' );

		$html  = '<div class="stripes">';
		$html .= sprintf( '<div class="rect1" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );
		$html .= sprintf( '<div class="rect2" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );
		$html .= sprintf( '<div class="rect3" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );
		$html .= sprintf( '<div class="rect4" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );
		$html .= sprintf( '<div class="rect5" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );
		$html .= '</div>';

		$html  = wp_kses( $html, array( 'div' => array( 'class' => array(), 'style' => array() ) ) );

		return $html;

	}

}

/**
 * Build HTML double spinner wave effect.
 */
if ( ! function_exists( 'df_loading_spinner_wave' ) ) {

	function df_loading_spinner_wave() {

		$df_loader_color = get_theme_mod( 'df_loader_color', '#e2e2e2' );

		$html  = '<div class="wave">';
		$html .= sprintf( '<div class="bounce1" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );
		$html .= sprintf( '<div class="bounce2" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );
		$html .= sprintf( '<div class="bounce3" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );
		$html .= '</div>';

		$html  = wp_kses( $html, array( 'div' => array( 'class' => array(), 'style' => array() ) ) );

		return $html;

	}

}

/**
 * Build HTML double spinner two rotate circles effect.
 */
if ( ! function_exists( 'df_loading_spinner_two_rotating_circles' ) ) {

	function df_loading_spinner_two_rotating_circles() {

		$df_loader_color = get_theme_mod( 'df_loader_color', '#e2e2e2' );

		$html  = '<div class="two_rotating_circles">';
		$html .= sprintf( '<div class="dot1" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );
		$html .= sprintf( '<div class="dot2" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );
		$html .= '</div>';

		$html  = wp_kses( $html, array( 'div' => array( 'class' => array(), 'style' => array() ) ) );

		return $html;

	}

}

/**
 * Build HTML double spinner five rotate circles effect.
 */
if ( ! function_exists( 'df_loading_spinner_five_rotating_circles' ) ) {

	function df_loading_spinner_five_rotating_circles() {

		$df_loader_color = get_theme_mod( 'df_loader_color', '#e2e2e2' );

		$html  = '<div class="five_rotating_circles">';
		$html .= '<div class="spinner-container container1">';
		$html .= sprintf( '<div class="circle1" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );
		$html .= sprintf( '<div class="circle2" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );
		$html .= sprintf( '<div class="circle3" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );
		$html .= sprintf( '<div class="circle4" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );
		$html .= '</div>';
		$html .= '<div class="spinner-container container2">';
		$html .= sprintf( '<div class="circle1" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );
		$html .= sprintf( '<div class="circle2" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );
		$html .= sprintf( '<div class="circle3" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );
		$html .= sprintf( '<div class="circle4" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );
		$html .= '</div>';
		$html .= '<div class="spinner-container container3">';
		$html .= sprintf( '<div class="circle1" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );
		$html .= sprintf( '<div class="circle2" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );
		$html .= sprintf( '<div class="circle3" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );
		$html .= sprintf( '<div class="circle4" style="background-color:%s"></div>', esc_attr( $df_loader_color ) );
		$html .= '</div>';
		$html .= '</div>';

		$html  = wp_kses( $html, array( 'div' => array( 'class' => array(), 'style' => array() ) ) );

		return $html;

	}

}