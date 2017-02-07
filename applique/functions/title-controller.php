<?php

if ( !defined( 'ABSPATH' ) ) { exit; }

/**
 * Output title controller to front-end
 * @return void
 */
function applique_title_controller() {
	do_action( 'applique_title_controller' );
}

/**
 * Build title sections in page
 *
 * @return string
 */
function df_singular_title() {

	if ( !is_page() ) return;

	$subtitle = get_post_meta( get_the_ID(), 'df_subtitle', true );
	$title 	  = wp_kses( get_the_title(), array( 'b' => array(), 'i' => array() ) );

	/* Print Html Output */
	$html  = '<div class="df-header-title aligncenter">';

	$html .= '<div class="container">';

	/* Print Subtitle of Page */
	if ( $subtitle != '' ) {
		$html .= sprintf( '<div class="df-page-subtitle">%s</div>', esc_attr( $subtitle ) );
	}

	/* Print Title of Page */
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
add_action( 'applique_title_controller', 'df_singular_title' );

/**
 * Build title sections in single post
 *
 * @return string
 */
function df_single_title() {

	if ( !is_single() || ( class_exists('WooCommerce') && is_product() ) ) return;

	$title = wp_kses( get_the_title(), array( 'b' => array(), 'i' => array() ) );

	/* Print Html Output */
	$html  = '<div class="df-header-title aligncenter">';

	$html .= '<div class="container">';

	/* Print Category of Post */
	$html .= sprintf( '<div class="df-single-category">%s</div>', df_category_blog() );

	/* Print Title of Post */
	$html .= sprintf( '<div class="df-header"><h1 %1$s>%2$s</h1></div>', dahz_get_attr( 'entry-title' ), $title );

	/* Print Post Date And Comments of Post */
	if ( get_theme_mod( 'df_hide_comment_link', 0 ) == 0 || get_theme_mod( 'df_hide_date', 0 ) == 0 ) {
		$html .= '<div class="df-post-on">';

		/* Comments */
		if ( comments_open() && get_theme_mod( 'df_hide_comment_link', 0 ) == 0 )
			$html .= df_posted_comment();

		/* Date */
	    if ( get_theme_mod( 'df_hide_date', 0 ) == 0 )
			$html .= sprintf( ' <i class="ion-ios-clock-outline"></i> %s', df_posted_on() );

		$html .= '</div>'; // End .df-post-on
	}

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

	print( $html );

}
add_action( 'applique_title_controller', 'df_single_title' );

/**
 * Build title sections in archive page
 *
 * @return string
 */
function df_archive_title() {

	if ( !is_archive() && !is_search() ) return;

	$term_id = NULL;
	if ( is_category() ) {
		$term_id = get_query_var('cat');
	} elseif ( is_tax() ) {
		$current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$term_id = $current_term->term_id;
	} elseif ( is_tag() ) {
		$term_id = get_query_var('tag_id');
	}

	$taxonomy_image_url = get_option( 'taxonomy_image' . $term_id );

	$bg_color = 'style="background-color: #FFFFFF;"';
	$add_cls  = '';
	if( !empty( $taxonomy_image_url ) ) {
		$attachment_id = get_attachment_id_by_url( $taxonomy_image_url );
	    if ( !empty( $attachment_id ) ) {
			if ( is_category() || is_tag() ) {
				$add_cls  = 'df-add_image';
				$bg_color = 'style="background-image: url(' . taxonomy_image( $term_id ) . ');"';
			}
		}
	}

	/* Print Html Output */
	$html  = sprintf( '<div class="df-header-title aligncenter %1$s" %2$s>', esc_attr( $add_cls ), $bg_color );

	$html .= '<div class="container">';

	/* Print Title of Archive */
	if ( is_search() ) {
		$html .= sprintf( '<div class="df-header"><span>%1$s</span><h1 %3$s>%2$s</h1></div>', esc_attr__( 'Search Result For', 'applique' ), get_search_query(), 'class="entry-title display-1" itemprop="headline"' );
	} elseif ( is_category() ) {
		$html .= sprintf( '<div class="df-header"><span>%1$s</span><h1 %3$s>%2$s</h1></div>', esc_attr__( 'Browsing Categories', 'applique' ), single_cat_title( '', false ), 'class="entry-title display-1" itemprop="headline"' );
	} elseif ( is_tag() ) {
		$html .= sprintf( '<div class="df-header"><span>%1$s</span><h1 %3$s>%2$s</h1></div>', esc_attr__( 'Browsing Tags', 'applique' ), single_cat_title( '', false ), 'class="entry-title display-1" itemprop="headline"' );
	} elseif ( is_author() ) {
		$html .= sprintf( '<div class="df-header"><span>%1$s</span><h1 %3$s>%2$s</h1></div>', esc_attr__( 'All Post By', 'applique' ), get_the_author(), 'class="entry-title display-1" itemprop="headline"' );
	} elseif ( is_date() ) {
		$post_date = sprintf( '<meta itemprop="datePublished" content="%1$s">%2$s', get_the_date( 'c' ), get_the_date() );

		$html .= sprintf(
			'<div class="df-header"><span>%1$s</span><h1 class="entry-title display-1" itemprop="headline"><time %2$s>%3$s</time></h1></div>',
			esc_attr__( 'Archive For', 'applique' ),
			dahz_get_attr( 'entry-published' ),
			$post_date
		);
	} elseif ( is_shop() ) {
		$html .= sprintf( '<div class="df-header"><h1 %3$s>%1$s</h1></div>', esc_attr__( 'Shop', 'applique' ), get_the_author(), 'class="entry-title display-1" itemprop="headline"' );
	}

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
add_action( 'applique_title_controller', 'df_archive_title' );