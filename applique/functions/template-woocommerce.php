<?php

if ( !defined('ABSPATH') ) { exit; }

/**
 * Custom function for woocommerce support
 *
 * @since 1.4.3
 * @author N.Ramadani
 * @package Applique/functions
 *
 */

if ( !function_exists('df_single_product_title') ) {

	add_action( 'df_woo_product_title', 'df_single_product_title', 20 );
	/**
	 *
	 * df_single_product_title hooked
	 * for df_woo_product_title on single-product.php
	 *
	 * @since 1.4.3
	 * @author N.Ramadani
	 * @package Applique/functions
	 */
	function df_single_product_title() {

		if ( !is_single() ) return;

		$title = wp_kses( get_the_title(), array( 'b' => array(), 'i' => array() ) );

		/* Print Html Output */
		$html  = '<div class="df-header-title aligncenter">';

		$html .= '<div class="container">';

		/* Print Category of Post */
		$html .= sprintf( '<div class="df-single-category">%s</div>', df_category_blog() );

		/* Print Title of Post */
		$html .= sprintf( '<div class="df-header"><h1 %1$s>%2$s</h1></div>', dahz_get_attr( 'entry-title' ), $title );

		/* Print Breadcrumb */
		if ( class_exists( 'breadcrumb_navxt' ) ) {
			$html .= sprintf(
				'<div class="df-breadcrumb" %1$s>%2$s</div>',
				esc_html( 'xmlns:v="http://rdf.data-vocabulary.org/#"' ),
				bcn_display( true )
			);
		}

		$html .= '</div>';

		$html .= '</div>';

		printf( $html );
	}
}

if ( !function_exists('df_product_add_to_cart_text') ) {

	add_filter( 'woocommerce_product_add_to_cart_text' , 'df_product_add_to_cart_text' );
	/**
	 *
	 * df_product_add_to_cart_text hooked
	 * for woocommerce_product_add_to_cart_text
	 * this function is for change default woocommerce archive add to cart button text
	 *
	 * @since 1.4.3
	 * @author N.Ramadani
	 * @package Applique/functions
	 */
	function df_product_add_to_cart_text() {
		global $product;
		
		$product_type = $product->product_type;
		
		switch ( $product_type ) {
			case 'external':
				return __( 'Buy product', 'woocommerce' );
			break;
			case 'grouped':
				return __( 'View products', 'woocommerce' );
			break;
			case 'simple':
				return __( 'Add cart', 'woocommerce' );
			break;
			case 'variable':
				return __( 'Select options', 'woocommerce' );
			break;
			default:
				return __( 'Read more', 'woocommerce' );
		}
		
	}
}


if ( !function_exists('df_product_single_add_to_cart_text') ) {

	add_filter( 'woocommerce_product_single_add_to_cart_text', 'df_product_single_add_to_cart_text' );    // 2.1 +
	/**
	 *
	 * df_product_single_add_to_cart_text hooked
	 * for woocommerce_product_single_add_to_cart_text
	 * this function is for change default woocommerce single add to cart button text
	 *
	 * @since 1.4.3
	 * @author N.Ramadani
	 * @package Applique/functions
	 */
	function df_product_single_add_to_cart_text() {
	 
		return __( 'Add Cart', 'woocommerce' );
	 
	}

}

if (  !function_exists( 'df_woocommerce_template_loop_product_title' ) ) {

	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
	add_action( 'woocommerce_shop_loop_item_title', 'df_woocommerce_template_loop_product_title', 10 );
	/**
	 * Show the product title in the product loop. By default this is an H3.
	 */
	function df_woocommerce_template_loop_product_title() {
		echo '<h4>' . get_the_title() . '</h4>';
	}
}

if ( !function_exists( 'df_woocommerce_output_related_products' ) ) {
	add_action( 'woocommerce_after_cart', 'df_woocommerce_output_related_products' );
	function df_woocommerce_output_related_products() {

		$args = array(
			'posts_per_page' 	=> 4,
			'columns' 			=> 4,
			'orderby' 			=> 'rand'
		);

		woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );
	}
}

if ( !function_exists('dahz_custom_woo_attr_content') ) {

	add_filter( 'dahz_attr_woo_content', 'dahz_custom_woo_attr_content' );

	function dahz_custom_woo_attr_content( $attr ) {

		$no_sidebar = ' col-md-8';

		if ( get_theme_mod( 'df_disable_woocommerce_single_sidebar', 0 ) == 1 && is_product() ) :
			$no_sidebar = ' col-md-8 col-md-push-2 df-no-sidebar';
		elseif ( get_theme_mod( 'df_disable_woocommerce_sidebar', 0 ) == 1 && (  is_shop() || is_product_category() || is_product_category()  ) ) :
			$no_sidebar = ' col-md-12 df-no-sidebar';
		elseif ( is_checkout() ) :
			$no_sidebar = ' col-md-12 df-no-sidebar';
		endif;


		$attr['id']    = 'df-content';
		$attr['class'] = 'df-content' . esc_attr( $no_sidebar );

		return $attr;
	}

}