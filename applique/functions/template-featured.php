<?php

if ( !defined( 'ABSPATH' ) ) { exit; }

if ( !function_exists( 'df_featured_area' ) ) {
	function df_featured_area() {

		/* Return False if location not in blog */
		if ( get_theme_mod( 'df_feat_enable', 1 ) == 0 )
			return;

		/* Return False if location not in blog */
		if ( is_singular() || is_search() || is_archive() || is_404() )
			return;

		global $post;

		$feat_cat 	= get_theme_mod( 'df_feat_cat' );
		$numb_cat 	= get_theme_mod( 'df_feat_num', '6' );
		$feat_type  = get_theme_mod( 'df_feat_type', 'grid' );
		$slider_type= get_theme_mod( 'df_slider_type', 'df-slider-1' );
		$size_img	= $feat_type == 'slider' ? 'feat-slider' : 'feat-grid';

		$container = '';
		if ( $feat_type == 'slider' && $slider_type == 'df-slider-3' )
			$container = 'container';

		$slider_class = '';
		if ( $feat_type == 'slider' ) {
			switch ( $slider_type ) {
				case 'df-slider-1':
					$slider_class = 'slider1'; // default
					break;
				case 'df-slider-2':
					$slider_class = 'slider2 owl-carousel'; // with caption
					break;
				case 'df-slider-3':
					$slider_class = 'slider3'; // single boxed
					break;
				case 'df-slider-4':
					$slider_class = 'slider4'; // single full width
					break;
				default:
					$slider_class = 'slider1';
					break;
			}
		}

		$feat = new WP_Query( array(
			'category_name'			=> esc_attr( $feat_cat ),
			'posts_per_page'		=> esc_attr( $numb_cat ),
			'post_status'			=> 'publish',
			'ignore_sticky_posts'	=> 1,
			'orderby' 				=> 'date',
			'order'   				=> 'DESC'
		) );

		$html = sprintf( '<div class="featured-area %1$s %2$s %3$s">', esc_attr( $container ), esc_attr( $feat_type ), esc_attr( $slider_class ) );

		if ( $feat_type == 'slider' && $slider_type != 'df-slider-2' ) {
			$html .= '<div class="owl-carousel">';
		}

		/* Check if have post */
		if ( $feat->have_posts() ) {
			/* Loop the post */
			while ( $feat->have_posts() ) { $feat->the_post();

				$title = wp_kses( get_the_title(), array( 'b' => array(), 'i' => array() ) );

				$html .= '<div class="item">';

				/* Check if post has a image. */
				if ( has_post_thumbnail() )
					$html .= '<div class="feat-img filter_bw">' . get_the_post_thumbnail( $post->ID, $size_img ) . '</div>';

				$html .= '<div class="df-feat-content">';
				$html .= '<div class="df-feat-inner">';
				$html .= '<div class="df-feat-cell">';
				$html .= '<div class="df-feat-wrap">';
				$html .= sprintf( '<div %s>', dahz_get_attr( 'entry-terms', 'category' ) );
				$html .= df_category( ',' );
				$html .= '</div>';
				if ( $slider_type == 'df-slider-1' || $slider_type == 'df-slider-3' && get_theme_mod( 'df_feat_hide_cat', 0 ) == 1 ) {
					$html .= '<div class="df-feat-sep"></div>';
				}
				$html .= sprintf( '<h1 class="display-2"><a href="%1$s">%2$s</a></h1>', esc_url( get_permalink() ), $title );
				if ( $slider_type == 'df-slider-1' || $slider_type == 'df-slider-3' ) {
					$html .= '<div class="df-feat-sep"></div>';
				}
				$html .= df_posted_on();
				$html .= '</div>'; // close div .df-feat-wrap
				if ( $slider_type == 'df-slider-4' && $feat_type == 'slider' ) {
					$html .= sprintf('<a class="more-link button outline small" href="%1$s">%2$s</a>', esc_url( get_permalink() ), esc_html__( 'Continue Reading', 'applique' ));
				}
				$html .= '</div>'; // close div .df-feat-cell
				$html .= '</div>'; // close div .df-feat-inner
				$html .= '</div>'; // close div .df-feat-content
				$html .= '</div>'; // close div .item

			}
		}

		if ( $feat_type == 'slider' && $slider_type != 'df-slider-2' ) {
			$html .= '</div>';
		}

		$html .= '</div>';

		/* Reset custom query back to normal. */
		wp_reset_postdata();

		return $html;
	}
}

if ( !function_exists( 'df_category' ) ) {
	function df_category( $sep ) {

		$once = 1;
		$html = '';

		if ( get_theme_mod( 'df_feat_hide_cat', 0 ) == 1 ) {

			$excluded_cat = get_theme_mod( 'df_feat_cat' );

			foreach( get_the_category() as $category ) {

				if ( $category->cat_ID != $excluded_cat ) {

					if ( $once == 1 ) {

						$html .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( $category->name ) . '" ' . '>'  . esc_html( $category->name ) . '</a>';

						$once = 0;

					} else {

						$html .= $sep . '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( $category->name ) . '" ' . '>' . esc_html( $category->name ) . '</a>';

					}
				}

			}

		}

		return $html;
	}
}