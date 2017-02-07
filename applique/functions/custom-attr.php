<?php

if ( !defined( 'ABSPATH' ) ) { exit; }

/**
 * `dahz_custom_attr_body` was function to customize attribute in branding of theme.
 * Hook function `dahz_attr_body` under `libraries/attr.php`.
 *
 * @param  string $attr
 * @return string
 */
function dahz_custom_attr_body( $attr ) {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

	$skin = array( 'df-skin-bold' );
	if ( get_theme_mod( 'df_skin', 'df-skin-boxed' ) == 'df-skin-light' ) {
		$skin = array( 'df-skin-light' );
	} else if ( get_theme_mod( 'df_skin', 'df-skin-boxed' ) == 'df-skin-boxed' ) {
		$skin = array( 'df-skin-boxed' );
	}

	if( $is_lynx ) {
		$classes[] = 'lynx';
	} elseif( $is_gecko ) {
		$classes[] = 'gecko';
	} elseif( $is_opera ) {
		$classes[] = 'opera';
	} elseif( $is_NS4 ) {
		$classes[] = 'ns4';
	} elseif( $is_safari ) {
		$classes[] = 'safari';
	} elseif( $is_chrome ) {
		$classes[] = 'chrome';
	} elseif( $is_IE ) {
		$classes[] = 'ie';
		if( preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version ) ) {
			$classes[] = 'ie' . $browser_version[1];
		}
	} else {
		$classes[] = 'unknown';
	}

	if( $is_iphone ) {
		$classes[] = 'iphone';
	}

	if ( stristr( $_SERVER['HTTP_USER_AGENT'], "mac" ) ) {
		$classes[] = 'osx';
	} elseif ( stristr( $_SERVER['HTTP_USER_AGENT'], "linux" ) ) {
		$classes[] = 'linux';
	} elseif ( stristr( $_SERVER['HTTP_USER_AGENT'], "windows" ) ) {
		$classes[] = 'windows';
	}

	$global_hover = array('');
	if ( $bw_concept = get_theme_mod( 'df_bw_hover' ) == 1 ) {
		$global_hover = array('glob-bw');
	}

	$new_class = array_merge( get_body_class(), $skin, $classes, $global_hover );

	$attr['class'] = join( ' ', $new_class );

	return $attr;
}
add_filter( 'dahz_attr_body', 'dahz_custom_attr_body' );

/**
 * `dahz_custom_attr_branding` was function to customize attribute in branding of theme.
 * Hook function `dahz_attr_branding` under `libraries/attr.php`.
 *
 * @param  string $attr
 * @return string
 */
function dahz_custom_attr_branding( $attr ) {

	$align  = ' aligncenter';
	if ( get_theme_mod( 'df_nav_pos', 'nav_top' ) == 'nav_btm_logo_left' ) {
		$align = '';
	}

	$attr['class'] = 'site-branding border-bottom' . esc_attr( $align );

	return $attr;
}
add_filter( 'dahz_attr_branding', 'dahz_custom_attr_branding' );

/**
 * `dahz_custom_attr_content` was function to customize attribute in content of theme.
 * Hook function `dahz_attr_content` under `libraries/attr.php`.
 *
 * @param  string $attr
 * @return string
 */
function dahz_custom_attr_content( $attr ) {

	$no_sidebar = ' col-md-8';
	if ( get_theme_mod( 'disable_sidebar_singular', 0 ) == 1 && is_singular() || ( class_exists('WooCommerce') && ( is_checkout() || is_account_page() || is_cart() ) ) ) :
		if ( get_theme_mod( 'df_single_wider_column', 0 ) == 1 ) {
			$no_sidebar = ' col-md-12 df-no-sidebar df-no-sidebar-wider';
		} else {
			$no_sidebar = ' col-md-8 col-md-push-2 df-no-sidebar';
		}
	elseif ( get_theme_mod( 'disable_sidebar_archive', 1 ) == 1 && ( is_archive() || is_search() ) ) :
		$no_sidebar = ' col-md-12 df-no-sidebar';
	elseif ( get_theme_mod( 'disable_sidebar_blog', 1 ) == 1 && ( is_home() ) ) :
		$no_sidebar = ' col-md-12 df-no-sidebar';
	endif;

	$attr['id']    = 'df-content';
	$attr['class'] = 'df-content' . esc_attr( $no_sidebar );

	return $attr;
}
add_filter( 'dahz_attr_content', 'dahz_custom_attr_content' );

/**
 * `dahz_custom_attr_sidebar` was function to customize attribute in sidebar of theme.
 * Hook function `dahz_attr_sidebar` under `libraries/attr.php`.
 *
 * @param  string $attr
 * @return string
 */
function dahz_custom_attr_sidebar( $attr ) {
	$attr['class'] = 'df-sidebar col-md-4';

	return $attr;
}
add_filter( 'dahz_attr_sidebar', 'dahz_custom_attr_sidebar' );

/**
 * `dahz_custom_attr_post` was function to customize attribute in post of theme.
 * Hook function `dahz_attr_post` under `libraries/attr.php`.
 *
 * @param  string $attr
 * @return string
 */
function dahz_custom_attr_post( $attr ) {

	global $wp_query;
	$df_col   = array();
	$is_blog  = is_home();
	$blog_lay = get_theme_mod( 'df_blog_layout', 'fit_2_col' );
	$arch_lay = get_theme_mod( 'df_arch_layout', 'fit_2_col' );

	if ( $is_blog && !is_sticky() ) {
		if ( $blog_lay == 'fit_2_col' ) {
			$df_col = array( 'col-md-6' );
		} elseif ( $blog_lay == 'fit_3_col' ) {
			$df_col = array( 'col-md-4' );
		} elseif ( $blog_lay == 'standard' ) {
			$df_col = array( 'df-standard' );
		} elseif ( $blog_lay == 'list' ) {
			$df_col = array( 'df-list' );
		} elseif ( $blog_lay == 'list_full' ) {
			$df_col = array( 'df-list-full' );
		} elseif ( $blog_lay == 'grid_full' ) {
			if ( $wp_query->current_post == 0 && !is_paged() ) {
				$df_col = array( 'df-grid-full' );
			} else {
				$df_col = array( 'df-grid-full col-md-6' );
			}
		} elseif ( $blog_lay == 'new_fit_2_col' ) {
			$df_col = array( 'df-new-fit col-md-6' );
		}
	} elseif ( ( is_archive() || is_search() ) ) {
		if ( $arch_lay == 'fit_2_col' ) {
			$df_col = array( 'col-md-6' );
		} elseif ( $arch_lay == 'fit_3_col' ) {
			$df_col = array( 'col-md-4' );
		} elseif ( $arch_lay == 'standard' ) {
			$df_col = array( 'df-standard' );
		} elseif ( $arch_lay == 'list' ) {
			$df_col = array( 'df-list' );
		} elseif ( $arch_lay == 'list_full' ) {
			$df_col = array( 'df-list-full' );
		} elseif ( $arch_lay == 'grid_full' ) {
			if ( $wp_query->current_post == 0 && !is_paged() ) {
				$df_col = array( 'df-grid-full' );
			} else {
				$df_col = array( 'df-grid-full col-md-6' );
			}
		} elseif ( $arch_lay == 'new_fit_2_col' ) {
			$df_col = array( 'df-new-fit col-md-6' );
		}
	}

	if ( is_sticky() && $is_blog && ( $blog_lay == 'fit_2_col' || $blog_lay == 'fit_3_col' ) ) {
		$df_col    = array( 'col-md-12' );
	}

	$df_sticky = is_sticky() ? array( 'df-sticky-post' ) : array();

	$new_class = array_merge( get_post_class(), $df_col, $df_sticky );

	$attr['class'] = join( ' ', $new_class );

	return $attr;
}
add_filter( 'dahz_attr_post', 'dahz_custom_attr_post' );

/**
 * `dahz_custom_attr_footer` was function to customize attribute in footer of theme.
 * Hook function `dahz_attr_footer` under `libraries/attr.php`.
 *
 * @param  string $attr
 * @return string
 */
function dahz_custom_attr_footer( $attr ) {
	$attr['class'] = 'site-footer aligncenter';

	return $attr;
}
add_filter( 'dahz_attr_footer', 'dahz_custom_attr_footer' );

/**
 * `dahz_custom_attr_title` was function to customize attribute in footer of theme.
 * Hook function `dahz_attr_entry-title` under `libraries/attr.php`.
 *
 * @param  string $attr
 * @return string
 */
function dahz_custom_attr_title( $attr ) {
	$display = '';

	if ( is_singular() ) {
		$display = ' display-1';
	}

	$attr['class'] = 'entry-title' . esc_attr( $display );

	return $attr;
}
add_filter( 'dahz_attr_entry-title', 'dahz_custom_attr_title' );

if ( !function_exists( 'df_blog_wrapper_classes' ) ) {
    function df_blog_wrapper_classes() {
        if ( is_single() ) return;

        $blog_std   = get_theme_mod( 'df_blog_layout', 'fit_2_col' );
        $arch_std   = get_theme_mod( 'df_arch_layout', 'fit_2_col' );
        $page_break = get_theme_mod( 'df_pagination', 'nextprev' );

        $blog = $paging = array();
        if ( ( ( is_home() || is_front_page() ) && $blog_std == 'fit_2_col' ) || ( ( is_search() || is_archive() ) && $arch_std == 'fit_2_col' ) ) :
            $blog = array( 'row', 'fit_2_col' );
        elseif ( ( ( is_home() || is_front_page() ) && $blog_std == 'fit_3_col' ) || ( ( is_search() || is_archive() ) && $arch_std == 'fit_3_col' ) ) :
            $blog = array( 'row', 'fit_3_col' );
        elseif ( ( ( is_home() || is_front_page() ) && $blog_std == 'new_fit_2_col' ) || ( ( is_search() || is_archive() ) && $arch_std == 'new_fit_2_col' ) ) :
        	$blog = array( 'row', 'new_fit_2_col' );
        endif;

        if ( $page_break == 'infinite' ) :
            $paging = array( 'isotope_ifncsr' );
        endif;

        $class = array_merge( $blog, $paging );

        $class = join( ' ', $class );

        printf( $class );

    }
    add_filter( 'df_wrap_class', 'df_blog_wrapper_classes' );
}

function add_menu_parent_class( $items ) {

    $parents = array();
    foreach ( $items as $item ) {
        if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
            $parents[] = $item->menu_item_parent;
        }
    }

    foreach ( $items as $item ) {
        if ( in_array( $item->ID, $parents ) ) {
            $item->classes[] = 'menu-parent-item';
        }
    }

    return $items;
}
add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class' );


if ( !function_exists('dahz_attr_wrap') ) {

	add_filter( 'dahz_attr_wrap', 'dahz_attr_wrap', 5 );
	/**
	 * This function is for defined the content wrapper class
	 *
	 * @package applique
	 * @since 1.4
	 * @author rama
	 */
	function dahz_attr_wrap() {

		$dropcap_switch = get_theme_mod( 'df_dropcap_switch' );

		$drop_class = '';
		if ( $dropcap_switch != '' ) {
			$drop_class = ' dropcap-activated';
		}

		$attr['id'] = 'wrapper';
		$attr['class'] = 'df-wrapper' . $drop_class;

		return $attr;

	}

}