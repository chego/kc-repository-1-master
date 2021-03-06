<?php

if ( !defined( 'ABSPATH' ) ) { exit; }

if ( !function_exists( 'df_title_post' ) ) {

    /**
     * `df_title_post` function to get title in the post.
     *  Call in `templates/contents/content-{type}.php
     */

    function df_title_post() {
        /* Return Null if not in singular page/post. */

        if ( is_singular() ) return;
        /* Define several variables used in conditional. */

        $blog    = ( get_theme_mod( 'df_blog_layout', 'fit_2_col' ) ); // Blog Layout
        $arch    = ( get_theme_mod( 'df_arch_layout', 'fit_2_col' ) ); // Archive Layout
        $blog_pg = ( is_home() && is_front_page() ); // Blog Page
        $arch_pg = ( is_archive() ); // Archive Page
        $html    = '';

        $align = ' aligncenter';

        if ( !is_sticky() ) {

            if ( ( $blog_pg && $blog == 'list' ) || ( ( $arch_pg || is_search() ) && $arch == 'list' ) ) {

                $align = '';

            }

        }

        $display = '';

        if ( !is_sticky() ) {

            if ( ( $blog_pg && $blog == 'standard' ) || ( ( $arch_pg || is_search() ) && $arch == 'standard' ) ) {

                $display = ' display-3';

            }

        }

        $title = get_the_title();

        if ( is_sticky() ) {

            $title = wp_trim_words( get_the_title(), '4' );

        }

        /* Print Html Output */

        $html .= sprintf( '<div class="df-post-title %s" onclick="void(0)">', esc_attr( $align ) );

        if ( !is_sticky() ) {

            if ( ( $blog_pg && $blog == 'standard' ) || ( ( $arch_pg || is_search() ) && $arch == 'standard' ) ) {

                $html .= '<div class="boxed-wrap">';

            }

        }

        if ( !is_sticky() && ( $blog == 'new_fit_2_col' || $arch == 'new_fit_2_col' ) ) {
            $html .= '<div class="df-post-title-inner">';
        }

        /* Print Category of Post */

        if ( get_theme_mod( 'df_hide_category', 0 ) == 0 ) {

            $html .= sprintf( '<div class="df-single-category">%s</div>', df_category_blog() );

        }

        /* Print Title of Post */

        $html .= sprintf(

            '<h2 class="entry-title %1$s" itemprop="headline" ><a href="%2$s" title="%3$s">%3$s</a></h2>',

            esc_attr( $display ),

            esc_url( get_the_permalink() ),

            wp_kses( $title, array( 'b' => array(), 'i' => array() ) )

        );

        /* Print Post Date And Comments of Post */

        if ( get_theme_mod( 'df_hide_date', 0 ) == 0 ) {

            $html .= sprintf( '<div class="df-post-on">%s</div>', df_posted_on() );

        }

        if ( !is_sticky() && ( $blog == 'new_fit_2_col' || $arch == 'new_fit_2_col' ) ) {
            $html .= '</div>';
        }

        if ( !is_sticky() ) {

            if ( ( $blog_pg && $blog == 'standard' ) || ( ( $arch_pg || is_search() ) && $arch == 'standard' ) ) {

                $html .= '</div>';

            }

        }

        if ( !is_sticky() ) {
            
            if (  ( $blog_pg && $blog == 'new_fit_2_col' ) || ( ( $arch_pg || is_search() ) && $arch == 'new_fit_2_col' )  ) {
               
                $hide_like_post = get_theme_mod( 'df_hide_like', 0 ) == 0;
                $hide_like_page = get_theme_mod( 'df_like_page', 1 ) == 0;
                $post_type      = get_post_type();

                $html .= '<div class="df-postmeta-wrapper">';

                $html .= '<div class="df-postmeta">';

                $html .= '<div class="col-left alignleft">';
                $html .= df_posted_comment();
                $html .= '</div>'; // end .col-left.alignleft

                $html .= '<div class="col-right alignright">';

                if ( function_exists( 'zilla_likes' ) ) :

                    if ( ( $post_type == 'page' && $hide_like_page ) || ( $post_type == 'post' && $hide_like_post ) ) :

                        global $zilla_likes;

                        $html .= '<div class="like-btn">';

                        $html .= $zilla_likes->do_likes();

                        $html .= '</div>';

                    endif;

                endif;

                $html .= df_share();

                $html .= '</div>';// end .col-right.alignright

                $html .= '</div>';
                $html .= '</div>';
                
            }

        }

        $html .= '</div>'; // end .df-post-title

        return $html;

    }

}



if ( !function_exists( 'df_title_page' ) ) {

    /**
     * `df_title_page` function to get title in the post.
     *  Call in `templates/contents/content-search.php
     */

    function df_title_page() {

        /* Return Null if not in singular page/post. */

        if ( is_singular() ) return;

        /* Define several variables used in conditional. */

        $arch     = ( get_theme_mod( 'df_arch_layout', 'fit_2_col' ) ); // Archive Layout
        $arch_pg  = ( is_archive() ); // Archive Page
        $subtitle = get_post_meta( get_the_ID(), 'df_subtitle', true );

        $align = ' aligncenter';

        if ( is_search() && $arch == 'list' )

            $align = '';
            $display = '';

        if ( is_search() && $arch == 'standard' )

            $display = ' display-3';

        /* Print Html Output */

        $html  = sprintf( '<div class="df-post-title" onclick="void(0)">', esc_attr( $align ) );

        /* Print Subtitle of Page */

        if ( get_post_meta( get_the_ID(), 'df_subtitle', true ) != '' )

            $html .= sprintf( '<div class="df-page-subtitle">%s</div>', esc_attr( $subtitle ) );

        /* Print Title of Page */

        $html .= sprintf(

            '<h2 class="entry-title %1$s" itemprop="headline" ><a href="%2$s">%3$s</a></h2>',

            esc_attr( $display ),

            esc_url( get_the_permalink() ),

            wp_kses( get_the_title(), array( 'b' => array(), 'i' => array() ) )

        );

        $html .= '</div>'; // end .df-post-title

        return $html;

    }



}



if ( !function_exists( 'df_feature_image' ) ) {

    /**
     * `df_feature_image` function to get image in the post.
     *  hooked to `df_top_posts`, call in `templates/contents/content-{type}.php
     */

    function df_feature_image() {
        global $wp_query;

        /* Return Null if post/page doesn't have image. */

        if ( is_single() && get_post_type() == 'post' && get_theme_mod( 'df_hide_feat_img', 0 ) == 1 )
            return;

        /* Define several variables used in conditional. */

        $col = $html = '';
        $blog_std = ( get_theme_mod( 'df_blog_layout', 'fit_2_col' ) == 'standard' ); // Blog Layout
        $blog_lst = ( get_theme_mod( 'df_blog_layout', 'fit_2_col' ) == 'list' ); // Blog Layout
        $blog_lay = get_theme_mod( 'df_blog_layout', 'fit_2_col' ); // Blog Layout
        $arch_std = ( get_theme_mod( 'df_arch_layout', 'fit_2_col' ) == 'standard' ); // Archive Layout
        $arch_lst = ( get_theme_mod( 'df_arch_layout', 'fit_2_col' ) == 'list' ); // Archive Layout
        $arch_lay = get_theme_mod( 'df_arch_layout', 'fit_2_col' ); // Archive Layout
        $blog_pg  = ( is_home() || is_front_page() ); // Blog Page
        $arch_pg  = ( is_archive() ); // Archive Page
        $size     = 'loop-blog';

        $dummy_image = get_template_directory_uri() . '/assets/images/grid-dummy.jpg';

        /* Image Size */
        if ( is_singular() || ( !is_sticky() && ( $blog_pg && $blog_std ) ) || ( !is_sticky() && ( ( $arch_pg || is_search() ) && $arch_std ) ) )
            $size = 'full';

        if ( is_sticky() && ( is_archive() || is_search() ) )
            $size = 'full';

        if ( ( ( ( $blog_pg && ( $blog_lay == 'grid_full' || $blog_lay == 'list_full' ) ) || ( ( $arch_pg || is_search() ) && ( $arch_lay == 'grid_full' || $arch_lay == 'list_full' ) ) ) && ( $wp_query->current_post == 0 && !is_paged() ) ) )
            $size = 'full';

        if ( is_sticky() && ( is_home() || is_front_page() ) )
            $size = 'sticky-img';

        /* Image Column */

        if ( ( is_sticky() && $blog_pg ) || ( $blog_pg && $blog_lst ) || ( ( $arch_pg || is_search() ) && $arch_lst ) )
            $col = 'col-md-6';

        if ( ( ( $blog_pg && $blog_lay == 'list_full' ) || ( ( $arch_pg || is_search() ) && $arch_lay == 'list_full' ) ) && $wp_query->current_post != 0 )
            $col = 'col-md-6';

        if ( !is_sticky() && get_theme_mod( 'disable_sidebar_archive', 1 ) == 1 && ( $arch_pg || is_search() ) && $arch_lst ) :
            $col = 'col-md-4';
        elseif ( !is_sticky() && get_theme_mod( 'disable_sidebar_blog', 1 ) == 1 && ( is_home() || is_front_page() ) && $blog_lst ) :
            $col = 'col-md-4';
        endif;

        $filter_bw = !is_singular() ? 'filter_bw' : '';

        $html .= sprintf( '<div class="featured-media %s '.$filter_bw.'">', esc_attr( $col ));
        $html .= !is_singular() ? sprintf( '<a href="%s">', esc_url( get_permalink() ) ) : '';
        if (has_post_thumbnail()) {
            $html .= get_the_post_thumbnail( get_the_ID(), $size );
        }
        $html .= !is_singular() ? '</a>' : '';
        $html .= df_post_icons();
        $html .= '</div>';

        print( $html );

    }

    add_action( 'df_featured_media', 'df_feature_image' );

}



if ( !function_exists( 'df_postmeta_blog' ) ) {

    /**
     * `df_postmeta_blog` function to get image in the post.
     *  hooked to `df_post_bottom`, call in `templates/contents/content-*.php
     */

    function df_postmeta_blog() {
        global $post;

        $hide_like_post = get_theme_mod( 'df_hide_like', 0 );
        $hide_like_page = get_theme_mod( 'df_like_page', 0 );
        $df_share_page  = get_theme_mod( 'df_share_page', 0 ) ;
        $post_type      = get_post_type();

        if (  !comments_open() && $hide_like_page == 1 && $df_share_page == 1  ) return;

        /* Return Null if post/page doesn't have image. */

        // if ( !is_single() ) return;

        $html = '<div class="df-postmeta-wrapper">';

        $html .= '<div class="df-postmeta border-top">';

        $html .= '<div class="clear"></div>';

        $html .= '<div class="col-left alignleft">';

        $html .= df_posted_comment();

        $html .= '</div>'; // end .col-left.alignleft

        $html .= '<div class="col-right alignright">';



        if ( function_exists( 'zilla_likes' ) ) :

            if ( ( $post_type == 'page' && $hide_like_page ) || ( $post_type == 'post' && $hide_like_post ) ) :

                global $zilla_likes;

                $html .= '<div class="like-btn">';

                $html .= $zilla_likes->do_likes();

                $html .= '</div>';

            endif;

        endif;



        $html .= df_share();

        $html .= '</div>';// end .col-right.alignright

        $html .= '<div class="clear"></div>';

        $html .= '</div>';

        $html .= '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="8px" viewBox="550 5 100 8">

                    <g>

                        <polygon fill="#231F20" points="24.629,8.174 30.374,13 30.925,13 24.629,7.711   "/>

                        <polygon fill="#231F20" points="26.034,5 35.558,13 36.108,13 26.586,5   "/>

                        <polygon fill="#231F20" points="31.415,5 40.94,13 41.489,13 31.966,5    "/>

                        <polygon fill="#231F20" points="36.465,5 45.801,12.842 46.231,12.741 37.017,5   "/>

                        <polygon fill="#231F20" points="48.755,10.627 42.058,5 41.506,5 48.325,10.728   "/>

                        <polygon fill="#231F20" points="51.237,8.441 47.144,5 46.592,5 50.808,8.542     "/>

                        <polygon fill="#231F20" points="53.657,6.223 52.202,5 51.649,5 53.228,6.324     "/>

                        <polygon fill="#231F20" points="55.733,5 46.849,13 47.392,13 56.276,5   "/>

                        <polygon fill="#231F20" points="60.874,5 51.987,13 52.532,13 61.417,5   "/>

                        <polygon fill="#231F20" points="66.455,5 66.015,5 57.128,13 57.671,13 66.536,5.018  "/>

                        <polygon fill="#231F20" points="68.174,7.684 62.269,13 62.812,13 68.174,8.172 68.174,8.174 73.919,13 74.47,13 68.174,7.711  "/>

                        <polygon fill="#231F20" points="24.629,11.547 26.358,13 26.909,13 24.629,11.085     "/>

                        <polygon fill="#231F20" points="68.174,11.025 65.979,13 66.522,13 68.174,11.514 68.174,11.547 69.903,13 70.454,13

                            68.174,11.085   "/>

                        <polygon fill="#231F20" points="69.579,5 79.103,13 79.653,13 70.131,5   "/>

                        <polygon fill="#231F20" points="74.96,5 84.485,13 85.035,13 75.511,5    "/>

                        <polygon fill="#231F20" points="80.01,5 89.346,12.842 89.777,12.741 80.562,5    "/>

                        <polygon fill="#231F20" points="92.3,10.627 85.603,5 85.051,5 91.87,10.728  "/>

                        <polygon fill="#231F20" points="94.782,8.441 90.688,5 90.137,5 94.353,8.542     "/>

                        <polygon fill="#231F20" points="97.202,6.223 95.747,5 95.194,5 96.772,6.324     "/>

                        <polygon fill="#231F20" points="99.278,5 90.395,13 90.937,13 99.821,5   "/>

                        <polygon fill="#231F20" points="104.419,5 95.532,13 96.077,13 104.962,5     "/>

                        <polygon fill="#231F20" points="110,5 109.56,5 100.673,13 101.216,13 110.081,5.018  "/>

                        <polygon fill="#231F20" points="111.719,7.684 105.813,13 106.356,13 111.719,8.172 111.719,8.174 117.464,13 118.015,13

                            111.719,7.711   "/>

                        <polygon fill="#231F20" points="111.719,11.025 109.524,13 110.067,13 111.719,11.514 111.719,11.547 113.448,13 113.999,13

                            111.719,11.085  "/>

                        <polygon fill="#231F20" points="113.124,5 122.647,13 123.198,13 113.676,5   "/>

                        <polygon fill="#231F20" points="118.505,5 128.03,13 128.58,13 119.056,5     "/>

                        <polygon fill="#231F20" points="123.555,5 132.891,12.842 133.322,12.741 124.106,5   "/>

                        <polygon fill="#231F20" points="135.845,10.627 129.147,5 128.596,5 135.415,10.728   "/>

                        <polygon fill="#231F20" points="138.327,8.441 134.233,5 133.682,5 137.897,8.542     "/>

                        <polygon fill="#231F20" points="140.747,6.223 139.292,5 138.739,5 140.317,6.324     "/>

                        <polygon fill="#231F20" points="142.823,5 133.939,13 134.481,13 143.366,5   "/>

                        <polygon fill="#231F20" points="147.964,5 139.077,13 139.622,13 148.507,5   "/>

                        <polygon fill="#231F20" points="153.545,5 153.104,5 144.218,13 144.761,13 153.626,5.018     "/>

                        <polygon fill="#231F20" points="155.264,7.684 149.358,13 149.901,13 155.264,8.172 155.264,8.174 161.009,13 161.56,13

                            155.264,7.711   "/>

                        <polygon fill="#231F20" points="155.264,11.025 153.069,13 153.612,13 155.264,11.514 155.264,11.547 156.993,13 157.544,13

                            155.264,11.085  "/>

                        <polygon fill="#231F20" points="156.669,5 166.192,13 166.743,13 157.221,5   "/>

                        <polygon fill="#231F20" points="162.05,5 171.575,13 172.125,13 162.601,5    "/>

                        <polygon fill="#231F20" points="167.1,5 176.436,12.842 176.867,12.741 167.651,5     "/>

                        <polygon fill="#231F20" points="179.39,10.627 172.692,5 172.141,5 178.96,10.728     "/>

                        <polygon fill="#231F20" points="181.872,8.441 177.778,5 177.227,5 181.442,8.542     "/>

                        <polygon fill="#231F20" points="184.292,6.223 182.837,5 182.284,5 183.862,6.324     "/>

                        <polygon fill="#231F20" points="186.368,5 177.484,13 178.026,13 186.911,5   "/>

                        <polygon fill="#231F20" points="191.509,5 182.622,13 183.167,13 192.052,5   "/>

                        <polygon fill="#231F20" points="197.09,5 196.649,5 187.763,13 188.306,13 197.171,5.018  "/>

                        <polygon fill="#231F20" points="198.809,7.684 192.903,13 193.446,13 198.809,8.172 198.809,8.174 204.554,13 205.104,13

                            198.809,7.711   "/>

                        <polygon fill="#231F20" points="198.809,11.025 196.614,13 197.157,13 198.809,11.514 198.809,11.547 200.538,13 201.089,13

                            198.809,11.085  "/>

                        <polygon fill="#231F20" points="200.214,5 209.737,13 210.288,13 200.766,5   "/>

                        <polygon fill="#231F20" points="205.595,5 215.12,13 215.67,13 206.146,5     "/>

                        <polygon fill="#231F20" points="210.645,5 219.98,12.842 220.412,12.741 211.196,5    "/>

                        <polygon fill="#231F20" points="222.935,10.627 216.237,5 215.686,5 222.505,10.728   "/>

                        <polygon fill="#231F20" points="225.417,8.441 221.323,5 220.771,5 224.987,8.542     "/>

                        <polygon fill="#231F20" points="227.837,6.223 226.382,5 225.829,5 227.407,6.324     "/>

                        <polygon fill="#231F20" points="229.913,5 221.029,13 221.571,13 230.456,5   "/>

                        <polygon fill="#231F20" points="235.054,5 226.167,13 226.712,13 235.597,5   "/>

                        <polygon fill="#231F20" points="240.635,5 240.194,5 231.308,13 231.851,13 240.716,5.018     "/>

                        <polygon fill="#231F20" points="242.354,7.684 236.448,13 236.991,13 242.354,8.172 242.354,8.174 248.099,13 248.649,13

                            242.354,7.711   "/>

                        <polygon fill="#231F20" points="242.354,11.025 240.159,13 240.702,13 242.354,11.514 242.354,11.547 244.083,13 244.634,13

                            242.354,11.085  "/>

                        <polygon fill="#231F20" points="243.759,5 253.282,13 253.833,13 244.311,5   "/>

                        <polygon fill="#231F20" points="249.14,5 258.665,13 259.215,13 249.69,5     "/>

                        <polygon fill="#231F20" points="254.189,5 263.525,12.842 263.957,12.741 254.741,5   "/>

                        <polygon fill="#231F20" points="266.479,10.627 259.782,5 259.23,5 266.05,10.728     "/>

                        <polygon fill="#231F20" points="268.962,8.441 264.868,5 264.316,5 268.532,8.542     "/>

                        <polygon fill="#231F20" points="271.382,6.223 269.927,5 269.374,5 270.952,6.324     "/>

                        <polygon fill="#231F20" points="273.458,5 264.574,13 265.116,13 274.001,5   "/>

                        <polygon fill="#231F20" points="278.599,5 269.712,13 270.257,13 279.142,5   "/>

                        <polygon fill="#231F20" points="284.18,5 283.739,5 274.853,13 275.396,13 284.261,5.018  "/>

                        <polygon fill="#231F20" points="285.898,7.684 279.993,13 280.536,13 285.898,8.172 285.898,8.174 291.644,13 292.194,13

                            285.898,7.711   "/>

                        <polygon fill="#231F20" points="285.898,11.025 283.704,13 284.247,13 285.898,11.514 285.898,11.547 287.628,13 288.179,13

                            285.898,11.085  "/>

                        <polygon fill="#231F20" points="287.304,5 296.827,13 297.378,13 287.855,5   "/>

                        <polygon fill="#231F20" points="292.685,5 302.21,13 302.76,13 293.235,5     "/>

                        <polygon fill="#231F20" points="297.734,5 307.07,12.842 307.502,12.741 298.286,5    "/>

                        <polygon fill="#231F20" points="310.024,10.627 303.327,5 302.775,5 309.595,10.728   "/>

                        <polygon fill="#231F20" points="312.507,8.441 308.413,5 307.861,5 312.077,8.542     "/>

                        <polygon fill="#231F20" points="314.927,6.223 313.472,5 312.919,5 314.497,6.324     "/>

                        <polygon fill="#231F20" points="317.003,5 308.119,13 308.661,13 317.546,5   "/>

                        <polygon fill="#231F20" points="322.144,5 313.257,13 313.802,13 322.687,5   "/>

                        <polygon fill="#231F20" points="327.725,5 327.284,5 318.397,13 318.94,13 327.806,5.018  "/>

                        <polygon fill="#231F20" points="329.443,7.684 323.538,13 324.081,13 329.443,8.172 329.443,8.174 335.188,13 335.739,13

                            329.443,7.711   "/>

                        <polygon fill="#231F20" points="329.443,11.025 327.249,13 327.792,13 329.443,11.514 329.443,11.547 331.173,13 331.724,13

                            329.443,11.085  "/>

                        <polygon fill="#231F20" points="330.849,5 340.372,13 340.923,13 331.4,5     "/>

                        <polygon fill="#231F20" points="336.229,5 345.755,13 346.305,13 336.78,5    "/>

                        <polygon fill="#231F20" points="341.279,5 350.615,12.842 351.047,12.741 341.831,5   "/>

                        <polygon fill="#231F20" points="353.569,10.627 346.872,5 346.32,5 353.14,10.728     "/>

                        <polygon fill="#231F20" points="356.052,8.441 351.958,5 351.406,5 355.622,8.542     "/>

                        <polygon fill="#231F20" points="358.472,6.223 357.017,5 356.464,5 358.042,6.324     "/>

                        <polygon fill="#231F20" points="360.548,5 351.664,13 352.206,13 361.091,5   "/>

                        <polygon fill="#231F20" points="365.688,5 356.802,13 357.347,13 366.231,5   "/>

                        <polygon fill="#231F20" points="371.27,5 370.829,5 361.942,13 362.485,13 371.351,5.018  "/>

                        <polygon fill="#231F20" points="372.988,7.684 367.083,13 367.626,13 372.988,8.172 372.988,8.174 378.733,13 379.284,13

                            372.988,7.711   "/>

                        <polygon fill="#231F20" points="372.988,11.025 370.794,13 371.337,13 372.988,11.514 372.988,11.547 374.718,13 375.269,13

                            372.988,11.085  "/>

                        <polygon fill="#231F20" points="374.394,5 383.917,13 384.468,13 374.945,5   "/>

                        <polygon fill="#231F20" points="379.774,5 389.3,13 389.85,13 380.325,5  "/>

                        <polygon fill="#231F20" points="384.824,5 394.16,12.842 394.592,12.741 385.376,5    "/>

                        <polygon fill="#231F20" points="397.114,10.627 390.417,5 389.865,5 396.685,10.728   "/>

                        <polygon fill="#231F20" points="399.597,8.441 395.503,5 394.951,5 399.167,8.542     "/>

                        <polygon fill="#231F20" points="402.017,6.223 400.562,5 400.009,5 401.587,6.324     "/>

                        <polygon fill="#231F20" points="404.093,5 395.209,13 395.751,13 404.636,5   "/>

                        <polygon fill="#231F20" points="409.233,5 400.347,13 400.892,13 409.776,5   "/>

                        <polygon fill="#231F20" points="414.814,5 414.374,5 405.487,13 406.03,13 414.896,5.018  "/>

                        <polygon fill="#231F20" points="416.533,7.684 410.628,13 411.171,13 416.533,8.172 416.533,8.174 422.278,13 422.829,13

                            416.533,7.711   "/>

                        <polygon fill="#231F20" points="416.533,11.025 414.339,13 414.882,13 416.533,11.514 416.533,11.547 418.263,13 418.813,13

                            416.533,11.085  "/>

                        <polygon fill="#231F20" points="417.938,5 427.462,13 428.013,13 418.49,5    "/>

                        <polygon fill="#231F20" points="423.319,5 432.845,13 433.395,13 423.87,5    "/>

                        <polygon fill="#231F20" points="428.369,5 437.705,12.842 438.137,12.741 428.921,5   "/>

                        <polygon fill="#231F20" points="440.659,10.627 433.962,5 433.41,5 440.229,10.728    "/>

                        <polygon fill="#231F20" points="443.142,8.441 439.048,5 438.496,5 442.712,8.542     "/>

                        <polygon fill="#231F20" points="445.562,6.223 444.106,5 443.554,5 445.132,6.324     "/>

                        <polygon fill="#231F20" points="447.638,5 438.754,13 439.296,13 448.181,5   "/>

                        <polygon fill="#231F20" points="452.778,5 443.892,13 444.437,13 453.321,5   "/>

                        <polygon fill="#231F20" points="458.359,5 457.919,5 449.032,13 449.575,13 458.44,5.018  "/>

                        <polygon fill="#231F20" points="460.078,7.684 454.173,13 454.716,13 460.078,8.172 460.078,8.174 465.823,13 466.374,13

                            460.078,7.711   "/>

                        <polygon fill="#231F20" points="460.078,11.025 457.884,13 458.427,13 460.078,11.514 460.078,11.547 461.808,13 462.358,13

                            460.078,11.085  "/>

                        <polygon fill="#231F20" points="461.483,5 471.007,13 471.558,13 462.035,5   "/>

                        <polygon fill="#231F20" points="466.864,5 476.39,13 476.939,13 467.415,5    "/>

                        <polygon fill="#231F20" points="471.914,5 481.25,12.842 481.682,12.741 472.466,5    "/>

                        <polygon fill="#231F20" points="484.204,10.627 477.507,5 476.955,5 483.774,10.728   "/>

                        <polygon fill="#231F20" points="486.687,8.441 482.593,5 482.041,5 486.257,8.542     "/>

                        <polygon fill="#231F20" points="489.106,6.223 487.651,5 487.099,5 488.677,6.324     "/>

                        <polygon fill="#231F20" points="491.183,5 482.299,13 482.841,13 491.726,5   "/>

                        <polygon fill="#231F20" points="496.323,5 487.437,13 487.981,13 496.866,5   "/>

                        <polygon fill="#231F20" points="501.904,5 501.464,5 492.577,13 493.12,13 501.985,5.018  "/>

                        <polygon fill="#231F20" points="503.623,7.684 497.718,13 498.261,13 503.623,8.172 503.623,8.174 509.368,13 509.919,13

                            503.623,7.711   "/>

                        <polygon fill="#231F20" points="503.623,11.025 501.429,13 501.972,13 503.623,11.514 503.623,11.547 505.353,13 505.903,13

                            503.623,11.085  "/>

                        <polygon fill="#231F20" points="505.028,5 514.552,13 515.103,13 505.58,5    "/>

                        <polygon fill="#231F20" points="510.409,5 519.935,13 520.484,13 510.96,5    "/>

                        <polygon fill="#231F20" points="515.459,5 524.795,12.842 525.227,12.741 516.011,5   "/>

                        <polygon fill="#231F20" points="527.749,10.627 521.052,5 520.5,5 527.319,10.728     "/>

                        <polygon fill="#231F20" points="530.231,8.441 526.138,5 525.586,5 529.802,8.542     "/>

                        <polygon fill="#231F20" points="532.651,6.223 531.196,5 530.644,5 532.222,6.324     "/>

                        <polygon fill="#231F20" points="534.728,5 525.844,13 526.386,13 535.271,5   "/>

                        <polygon fill="#231F20" points="539.868,5 530.981,13 531.526,13 540.411,5   "/>

                        <polygon fill="#231F20" points="545.449,5 545.009,5 536.122,13 536.665,13 545.53,5.018  "/>

                        <polygon fill="#231F20" points="547.168,7.684 541.263,13 541.806,13 547.168,8.172 547.168,8.174 552.913,13 553.464,13

                            547.168,7.711   "/>

                        <polygon fill="#231F20" points="547.168,11.025 544.974,13 545.517,13 547.168,11.514 547.168,11.547 548.897,13 549.448,13

                            547.168,11.085  "/>

                        <polygon fill="#231F20" points="548.573,5 558.097,13 558.647,13 549.125,5   "/>

                        <polygon fill="#231F20" points="553.954,5 563.479,13 564.029,13 554.505,5   "/>

                        <polygon fill="#231F20" points="559.004,5 568.34,12.842 568.771,12.741 559.556,5    "/>

                        <polygon fill="#231F20" points="571.294,10.627 564.597,5 564.045,5 570.864,10.728   "/>

                        <polygon fill="#231F20" points="573.776,8.441 569.683,5 569.131,5 573.347,8.542     "/>

                        <polygon fill="#231F20" points="576.196,6.223 574.741,5 574.188,5 575.767,6.324     "/>

                        <polygon fill="#231F20" points="578.272,5 569.389,13 569.931,13 578.815,5   "/>

                        <polygon fill="#231F20" points="583.413,5 574.526,13 575.071,13 583.956,5   "/>

                        <polygon fill="#231F20" points="588.994,5 588.554,5 579.667,13 580.21,13 589.075,5.018  "/>

                        <polygon fill="#231F20" points="590.713,7.684 584.808,13 585.351,13 590.713,8.172 590.713,8.174 596.458,13 597.009,13

                            590.713,7.711   "/>

                        <polygon fill="#231F20" points="590.713,11.025 588.519,13 589.062,13 590.713,11.514 590.713,11.547 592.442,13 592.993,13

                            590.713,11.085  "/>

                        <polygon fill="#231F20" points="592.118,5 601.642,13 602.192,13 592.67,5    "/>

                        <polygon fill="#231F20" points="597.499,5 607.024,13 607.574,13 598.05,5    "/>

                        <polygon fill="#231F20" points="602.549,5 611.885,12.842 612.316,12.741 603.101,5   "/>

                        <polygon fill="#231F20" points="614.839,10.627 608.142,5 607.59,5 614.409,10.728    "/>

                        <polygon fill="#231F20" points="617.321,8.441 613.228,5 612.676,5 616.892,8.542     "/>

                        <polygon fill="#231F20" points="619.741,6.223 618.286,5 617.733,5 619.312,6.324     "/>

                        <polygon fill="#231F20" points="621.817,5 612.934,13 613.476,13 622.36,5    "/>

                        <polygon fill="#231F20" points="626.958,5 618.071,13 618.616,13 627.501,5   "/>

                        <polygon fill="#231F20" points="632.539,5 632.099,5 623.212,13 623.755,13 632.62,5.018  "/>

                        <polygon fill="#231F20" points="634.258,7.684 628.353,13 628.896,13 634.258,8.172 634.258,8.174 640.003,13 640.554,13

                            634.258,7.711   "/>

                        <polygon fill="#231F20" points="634.258,11.025 632.063,13 632.606,13 634.258,11.514 634.258,11.547 635.987,13 636.538,13

                            634.258,11.085  "/>

                        <polygon fill="#231F20" points="635.663,5 645.187,13 645.737,13 636.215,5   "/>

                        <polygon fill="#231F20" points="641.044,5 650.569,13 651.119,13 641.595,5   "/>

                        <polygon fill="#231F20" points="646.094,5 655.43,12.842 655.861,12.741 646.646,5    "/>

                        <polygon fill="#231F20" points="658.384,10.627 651.687,5 651.135,5 657.954,10.728   "/>

                        <polygon fill="#231F20" points="660.866,8.441 656.772,5 656.221,5 660.437,8.542     "/>

                        <polygon fill="#231F20" points="663.286,6.223 661.831,5 661.278,5 662.856,6.324     "/>

                        <polygon fill="#231F20" points="665.362,5 656.479,13 657.021,13 665.905,5   "/>

                        <polygon fill="#231F20" points="670.503,5 661.616,13 662.161,13 671.046,5   "/>

                        <polygon fill="#231F20" points="676.084,5 675.644,5 666.757,13 667.3,13 676.165,5.018   "/>

                        <polygon fill="#231F20" points="677.803,7.684 671.897,13 672.44,13 677.803,8.172 677.803,8.174 683.548,13 684.099,13

                            677.803,7.711   "/>

                        <polygon fill="#231F20" points="677.803,11.025 675.608,13 676.151,13 677.803,11.514 677.803,11.547 679.532,13 680.083,13

                            677.803,11.085  "/>

                        <polygon fill="#231F20" points="679.208,5 688.731,13 689.282,13 679.76,5    "/>

                        <polygon fill="#231F20" points="684.589,5 694.114,13 694.664,13 685.14,5    "/>

                        <polygon fill="#231F20" points="689.639,5 698.975,12.842 699.406,12.741 690.19,5    "/>

                        <polygon fill="#231F20" points="701.929,10.627 695.231,5 694.68,5 701.499,10.728    "/>

                        <polygon fill="#231F20" points="704.411,8.441 700.317,5 699.766,5 703.981,8.542     "/>

                        <polygon fill="#231F20" points="706.831,6.223 705.376,5 704.823,5 706.401,6.324     "/>

                        <polygon fill="#231F20" points="708.907,5 700.023,13 700.565,13 709.45,5    "/>

                        <polygon fill="#231F20" points="714.048,5 705.161,13 705.706,13 714.591,5   "/>

                        <polygon fill="#231F20" points="719.629,5 719.188,5 710.302,13 710.845,13 719.71,5.018  "/>

                        <polygon fill="#231F20" points="721.348,7.684 715.442,13 715.985,13 721.348,8.172 721.348,8.174 727.093,13 727.644,13

                            721.348,7.711   "/>

                        <polygon fill="#231F20" points="721.348,11.025 719.153,13 719.696,13 721.348,11.514 721.348,11.547 723.077,13 723.628,13

                            721.348,11.085  "/>

                        <polygon fill="#231F20" points="722.753,5 732.276,13 732.827,13 723.305,5   "/>

                        <polygon fill="#231F20" points="728.134,5 737.659,13 738.209,13 728.685,5   "/>

                        <polygon fill="#231F20" points="733.184,5 742.52,12.842 742.951,12.741 733.735,5    "/>

                        <polygon fill="#231F20" points="745.474,10.627 738.776,5 738.225,5 745.044,10.728   "/>

                        <polygon fill="#231F20" points="747.956,8.441 743.862,5 743.311,5 747.526,8.542     "/>

                        <polygon fill="#231F20" points="750.376,6.223 748.921,5 748.368,5 749.946,6.324     "/>

                        <polygon fill="#231F20" points="752.452,5 743.568,13 744.11,13 752.995,5    "/>

                        <polygon fill="#231F20" points="757.593,5 748.706,13 749.251,13 758.136,5   "/>

                        <polygon fill="#231F20" points="763.174,5 762.733,5 753.847,13 754.39,13 763.255,5.018  "/>

                        <polygon fill="#231F20" points="764.893,7.684 758.987,13 759.53,13 764.893,8.172 764.893,8.174 770.638,13 771.188,13

                            764.893,7.711   "/>

                        <polygon fill="#231F20" points="764.893,11.025 762.698,13 763.241,13 764.893,11.514 764.893,11.547 766.622,13 767.173,13

                            764.893,11.085  "/>

                        <polygon fill="#231F20" points="766.298,5 775.821,13 776.372,13 766.85,5    "/>

                        <polygon fill="#231F20" points="771.679,5 781.204,13 781.754,13 772.229,5   "/>

                        <polygon fill="#231F20" points="776.729,5 786.064,12.842 786.496,12.741 777.28,5    "/>

                        <polygon fill="#231F20" points="789.019,10.627 782.321,5 781.77,5 788.589,10.728    "/>

                        <polygon fill="#231F20" points="791.501,8.441 787.407,5 786.855,5 791.071,8.542     "/>

                        <polygon fill="#231F20" points="793.921,6.223 792.466,5 791.913,5 793.491,6.324     "/>

                        <polygon fill="#231F20" points="795.997,5 787.113,13 787.655,13 796.54,5    "/>

                        <polygon fill="#231F20" points="801.138,5 792.251,13 792.796,13 801.681,5   "/>

                        <polygon fill="#231F20" points="806.719,5 806.278,5 797.392,13 797.935,13 806.8,5.018   "/>

                        <polygon fill="#231F20" points="808.438,7.684 802.532,13 803.075,13 808.438,8.172 808.438,8.174 814.183,13 814.733,13

                            808.438,7.711   "/>

                        <polygon fill="#231F20" points="808.438,11.025 806.243,13 806.786,13 808.438,11.514 808.438,11.547 810.167,13 810.718,13

                            808.438,11.085  "/>

                        <polygon fill="#231F20" points="809.843,5 819.366,13 819.917,13 810.395,5   "/>

                        <polygon fill="#231F20" points="815.224,5 824.749,13 825.299,13 815.774,5   "/>

                        <polygon fill="#231F20" points="820.273,5 829.609,12.842 830.041,12.741 820.825,5   "/>

                        <polygon fill="#231F20" points="832.563,10.627 825.866,5 825.314,5 832.134,10.728   "/>

                        <polygon fill="#231F20" points="835.046,8.441 830.952,5 830.4,5 834.616,8.542   "/>

                        <polygon fill="#231F20" points="837.466,6.223 836.011,5 835.458,5 837.036,6.324     "/>

                        <polygon fill="#231F20" points="839.542,5 830.658,13 831.2,13 840.085,5     "/>

                        <polygon fill="#231F20" points="844.683,5 835.796,13 836.341,13 845.226,5   "/>

                        <polygon fill="#231F20" points="850.264,5 849.823,5 840.937,13 841.479,13 850.345,5.018     "/>

                        <polygon fill="#231F20" points="851.982,7.684 846.077,13 846.62,13 851.982,8.172 851.982,8.174 857.728,13 858.278,13

                            851.982,7.711   "/>

                        <polygon fill="#231F20" points="851.982,11.025 849.788,13 850.331,13 851.982,11.514 851.982,11.547 853.712,13 854.263,13

                            851.982,11.085  "/>

                        <polygon fill="#231F20" points="853.388,5 862.911,13 863.462,13 853.939,5   "/>

                        <polygon fill="#231F20" points="858.769,5 868.294,13 868.844,13 859.319,5   "/>

                        <polygon fill="#231F20" points="863.818,5 873.154,12.842 873.586,12.741 864.37,5    "/>

                        <polygon fill="#231F20" points="876.108,10.627 869.411,5 868.859,5 875.679,10.728   "/>

                        <polygon fill="#231F20" points="878.591,8.441 874.497,5 873.945,5 878.161,8.542     "/>

                        <polygon fill="#231F20" points="881.011,6.223 879.556,5 879.003,5 880.581,6.324     "/>

                        <polygon fill="#231F20" points="883.087,5 874.203,13 874.745,13 883.63,5    "/>

                        <polygon fill="#231F20" points="888.228,5 879.341,13 879.886,13 888.771,5   "/>

                        <polygon fill="#231F20" points="893.809,5 893.368,5 884.481,13 885.024,13 893.89,5.018  "/>

                        <polygon fill="#231F20" points="895.527,7.684 889.622,13 890.165,13 895.527,8.172 895.527,8.174 901.272,13 901.823,13

                            895.527,7.711   "/>

                        <polygon fill="#231F20" points="895.527,11.025 893.333,13 893.876,13 895.527,11.514 895.527,11.547 897.257,13 897.808,13

                            895.527,11.085  "/>

                        <polygon fill="#231F20" points="896.933,5 906.456,13 907.007,13 897.484,5   "/>

                        <polygon fill="#231F20" points="902.313,5 911.839,13 912.389,13 902.864,5   "/>

                        <polygon fill="#231F20" points="907.363,5 916.699,12.842 917.131,12.741 907.915,5   "/>

                        <polygon fill="#231F20" points="919.653,10.627 912.956,5 912.404,5 919.224,10.728   "/>

                        <polygon fill="#231F20" points="922.136,8.441 918.042,5 917.49,5 921.706,8.542  "/>

                        <polygon fill="#231F20" points="924.556,6.223 923.101,5 922.548,5 924.126,6.324     "/>

                        <polygon fill="#231F20" points="926.632,5 917.748,13 918.29,13 927.175,5    "/>

                        <polygon fill="#231F20" points="931.772,5 922.886,13 923.431,13 932.315,5   "/>

                        <polygon fill="#231F20" points="937.354,5 936.913,5 928.026,13 928.569,13 937.435,5.018     "/>

                        <polygon fill="#231F20" points="939.072,7.684 933.167,13 933.71,13 939.072,8.172 939.072,8.174 944.817,13 945.368,13

                            939.072,7.711   "/>

                        <polygon fill="#231F20" points="939.072,11.025 936.878,13 937.421,13 939.072,11.514 939.072,11.547 940.802,13 941.353,13

                            939.072,11.085  "/>

                        <polygon fill="#231F20" points="940.478,5 950.001,13 950.552,13 941.029,5   "/>

                        <polygon fill="#231F20" points="945.858,5 955.384,13 955.934,13 946.409,5   "/>

                        <polygon fill="#231F20" points="950.908,5 960.244,12.842 960.676,12.741 951.46,5    "/>

                        <polygon fill="#231F20" points="963.198,10.627 956.501,5 955.949,5 962.769,10.728   "/>

                        <polygon fill="#231F20" points="965.681,8.441 961.587,5 961.035,5 965.251,8.542     "/>

                        <polygon fill="#231F20" points="968.101,6.223 966.646,5 966.093,5 967.671,6.324     "/>

                        <polygon fill="#231F20" points="970.177,5 961.293,13 961.835,13 970.72,5    "/>

                        <polygon fill="#231F20" points="975.317,5 966.431,13 966.976,13 975.86,5    "/>

                        <polygon fill="#231F20" points="980.898,5 980.458,5 971.571,13 972.114,13 980.979,5.018     "/>

                        <polygon fill="#231F20" points="982.617,7.684 976.712,13 977.255,13 982.617,8.172 982.617,8.174 988.362,13 988.913,13

                            982.617,7.711   "/>

                        <polygon fill="#231F20" points="982.617,11.025 980.423,13 980.966,13 982.617,11.514 982.617,11.547 984.347,13 984.897,13

                            982.617,11.085  "/>

                        <polygon fill="#231F20" points="984.022,5 993.546,13 994.097,13 984.574,5   "/>

                        <polygon fill="#231F20" points="989.403,5 998.929,13 999.479,13 989.954,5   "/>

                        <polygon fill="#231F20" points="994.453,5 1003.789,12.842 1004.221,12.741 995.005,5     "/>

                        <polygon fill="#231F20" points="1006.743,10.627 1000.046,5 999.494,5 1006.313,10.728    "/>

                        <polygon fill="#231F20" points="1009.226,8.441 1005.132,5 1004.58,5 1008.796,8.542  "/>

                        <polygon fill="#231F20" points="1011.646,6.223 1010.19,5 1009.638,5 1011.216,6.324  "/>

                        <polygon fill="#231F20" points="1013.722,5 1004.838,13 1005.38,13 1014.265,5    "/>

                        <polygon fill="#231F20" points="1018.862,5 1009.976,13 1010.521,13 1019.405,5   "/>

                        <polygon fill="#231F20" points="1024.443,5 1024.003,5 1015.116,13 1015.659,13 1024.524,5.018    "/>

                        <polygon fill="#231F20" points="1026.162,7.684 1020.257,13 1020.8,13 1026.162,8.172 1026.162,8.174 1031.907,13 1032.458,13

                            1026.162,7.711  "/>

                        <polygon fill="#231F20" points="1026.162,11.025 1023.968,13 1024.511,13 1026.162,11.514 1026.162,11.547 1027.892,13

                            1028.442,13 1026.162,11.085     "/>

                        <polygon fill="#231F20" points="1027.567,5 1037.091,13 1037.642,13 1028.119,5   "/>

                        <polygon fill="#231F20" points="1032.948,5 1042.474,13 1043.023,13 1033.499,5   "/>

                        <polygon fill="#231F20" points="1037.998,5 1047.334,12.842 1047.766,12.741 1038.55,5    "/>

                        <polygon fill="#231F20" points="1050.288,10.627 1043.591,5 1043.039,5 1049.858,10.728   "/>

                        <polygon fill="#231F20" points="1052.771,8.441 1048.677,5 1048.125,5 1052.341,8.542     "/>

                        <polygon fill="#231F20" points="1055.19,6.223 1053.735,5 1053.183,5 1054.761,6.324  "/>

                        <polygon fill="#231F20" points="1057.267,5 1048.383,13 1048.925,13 1057.81,5    "/>

                        <polygon fill="#231F20" points="1062.407,5 1053.521,13 1054.065,13 1062.95,5    "/>

                        <polygon fill="#231F20" points="1067.988,5 1067.548,5 1058.661,13 1059.204,13 1068.069,5.018    "/>

                        <polygon fill="#231F20" points="1069.707,7.684 1063.802,13 1064.345,13 1069.707,8.172 1069.707,8.174 1075.452,13 1076.003,13

                            1069.707,7.711  "/>

                        <polygon fill="#231F20" points="1069.707,11.025 1067.513,13 1068.056,13 1069.707,11.514 1069.707,11.547 1071.437,13

                            1071.987,13 1069.707,11.085     "/>

                        <polygon fill="#231F20" points="1071.112,5 1080.636,13 1081.187,13 1071.664,5   "/>

                        <polygon fill="#231F20" points="1076.493,5 1086.019,13 1086.568,13 1077.044,5   "/>

                        <polygon fill="#231F20" points="1081.543,5 1090.879,12.842 1091.311,12.741 1082.095,5   "/>

                        <polygon fill="#231F20" points="1093.833,10.627 1087.136,5 1086.584,5 1093.403,10.728   "/>

                        <polygon fill="#231F20" points="1096.315,8.441 1092.222,5 1091.67,5 1095.886,8.542  "/>

                        <polygon fill="#231F20" points="1098.735,6.223 1097.28,5 1096.728,5 1098.306,6.324  "/>

                        <polygon fill="#231F20" points="1100.812,5 1091.928,13 1092.47,13 1101.354,5    "/>

                        <polygon fill="#231F20" points="1105.952,5 1097.065,13 1097.61,13 1106.495,5    "/>

                        <polygon fill="#231F20" points="1111.533,5 1111.093,5 1102.206,13 1102.749,13 1111.614,5.018    "/>

                        <polygon fill="#231F20" points="1113.252,7.684 1107.347,13 1107.89,13 1113.252,8.172 1113.252,8.174 1118.997,13 1119.548,13

                            1113.252,7.711  "/>

                        <polygon fill="#231F20" points="1113.252,11.025 1111.058,13 1111.601,13 1113.252,11.514 1113.252,11.547 1114.981,13

                            1115.532,13 1113.252,11.085     "/>

                        <polygon fill="#231F20" points="1114.657,5 1124.181,13 1124.731,13 1115.209,5   "/>

                        <polygon fill="#231F20" points="1120.038,5 1129.563,13 1130.113,13 1120.589,5   "/>

                        <polygon fill="#231F20" points="1125.088,5 1134.424,12.842 1134.855,12.741 1125.64,5    "/>

                        <polygon fill="#231F20" points="1137.378,10.627 1130.681,5 1130.129,5 1136.948,10.728   "/>

                        <polygon fill="#231F20" points="1139.86,8.441 1135.767,5 1135.215,5 1139.431,8.542  "/>

                        <polygon fill="#231F20" points="1142.28,6.223 1140.825,5 1140.272,5 1141.851,6.324  "/>

                        <polygon fill="#231F20" points="1144.356,5 1135.473,13 1136.015,13 1144.899,5   "/>

                        <polygon fill="#231F20" points="1149.497,5 1140.61,13 1141.155,13 1150.04,5     "/>

                        <polygon fill="#231F20" points="1155.078,5 1154.638,5 1145.751,13 1146.294,13 1155.159,5.018    "/>

                        <polygon fill="#231F20" points="1156.797,7.684 1150.892,13 1151.435,13 1156.797,8.172 1156.797,8.174 1162.542,13 1163.093,13

                            1156.797,7.711  "/>

                        <polygon fill="#231F20" points="1156.797,11.025 1154.603,13 1155.146,13 1156.797,11.514 1156.797,11.547 1158.526,13

                            1159.077,13 1156.797,11.085     "/>

                        <polygon fill="#231F20" points="1158.202,5 1167.726,13 1168.276,13 1158.754,5   "/>

                        <polygon fill="#231F20" points="1163.583,5 1173.108,13 1173.658,13 1164.134,5   "/>

                        <polygon fill="#231F20" points="1168.633,5 1177.969,12.842 1178.4,12.741 1169.185,5     "/>

                        <polygon fill="#231F20" points="1180.923,10.627 1174.226,5 1173.674,5 1180.493,10.728   "/>

                        <polygon fill="#231F20" points="1183.405,8.441 1179.312,5 1178.76,5 1182.976,8.542  "/>

                        <polygon fill="#231F20" points="1185.825,6.223 1184.37,5 1183.817,5 1185.396,6.324  "/>

                        <polygon fill="#231F20" points="1187.901,5 1179.018,13 1179.56,13 1188.444,5    "/>

                        <polygon fill="#231F20" points="1193.042,5 1184.155,13 1184.7,13 1193.585,5     "/>

                        <polygon fill="#231F20" points="1189.296,13 1189.839,13 1194.629,8.688 1194.629,8.199   "/>

                        <polygon fill="#231F20" points="1194.629,13 1194.629,12.827 1194.437,13     "/>

                    </g>

                  </svg>';

        $html .= '</div>';



        print( $html );

    }

    add_action( 'df_post_bottom', 'df_postmeta_blog', 10 );

}


if ( !function_exists( 'df_author_biography' ) ) {

    /**
     * Build author biography sections.
     *
     * @return string
     */

    function df_author_biography() {

        if ( !is_single() || get_theme_mod( 'df_hide_author_box', 0 ) == 1 ) return;

        $html  = '<div class="df-post-author">';

        /* Author Avatar */
        $html .= sprintf( '<div class="author-img">%s</div>',  get_avatar( get_the_author_meta( 'email' ), '100' )  );

        /* Author Content */
        $html .= '<div class="author-content">';


        /* Author Name */
        $html .= sprintf( '<h3 class="author-name display-4"><a href="%1$s">%2$s</a></h5>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_attr( get_the_author() ) );



        /* Author Descriptions */
        $html .= sprintf( '<p>%s</p>', esc_attr( get_the_author_meta( 'description' ) ) );


        /* Author Social Media */
        $html .= '<ul class="author-social">';



        if ( get_the_author_meta( 'facebook' ) != '') {
            $html .= sprintf( '<li><a target="_blank" class="author-social df-facebook" href="%s">Facebook</a></li>', esc_url( get_the_author_meta( 'facebook' ) ) );
        }

        if ( get_the_author_meta( 'twitter' ) != '') {
            $html .= sprintf( '<li><a target="_blank" class="author-social df-twitter" href="%s">Twitter</a></li>', esc_url( get_the_author_meta( 'twitter' ) ) );
        }

        if ( get_the_author_meta( 'instagram' ) != '' ) {
            $html .= sprintf( '<li><a target="_blank" class="author-social df-instagram" href="%s">Instagram</a></li>', esc_url( get_the_author_meta( 'instagram' ) ) );
        }



        $html .= '</ul>'; // end .author-social

        $html .= '</div>'; // end .author-content

        $html .= '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="8px" viewBox="550 5 100 8">

                    <g>

                        <polygon fill="#231F20" points="24.629,8.174 30.374,13 30.925,13 24.629,7.711   "/>

                        <polygon fill="#231F20" points="26.034,5 35.558,13 36.108,13 26.586,5   "/>

                        <polygon fill="#231F20" points="31.415,5 40.94,13 41.489,13 31.966,5    "/>

                        <polygon fill="#231F20" points="36.465,5 45.801,12.842 46.231,12.741 37.017,5   "/>

                        <polygon fill="#231F20" points="48.755,10.627 42.058,5 41.506,5 48.325,10.728   "/>

                        <polygon fill="#231F20" points="51.237,8.441 47.144,5 46.592,5 50.808,8.542     "/>

                        <polygon fill="#231F20" points="53.657,6.223 52.202,5 51.649,5 53.228,6.324     "/>

                        <polygon fill="#231F20" points="55.733,5 46.849,13 47.392,13 56.276,5   "/>

                        <polygon fill="#231F20" points="60.874,5 51.987,13 52.532,13 61.417,5   "/>

                        <polygon fill="#231F20" points="66.455,5 66.015,5 57.128,13 57.671,13 66.536,5.018  "/>

                        <polygon fill="#231F20" points="68.174,7.684 62.269,13 62.812,13 68.174,8.172 68.174,8.174 73.919,13 74.47,13 68.174,7.711  "/>

                        <polygon fill="#231F20" points="24.629,11.547 26.358,13 26.909,13 24.629,11.085     "/>

                        <polygon fill="#231F20" points="68.174,11.025 65.979,13 66.522,13 68.174,11.514 68.174,11.547 69.903,13 70.454,13

                            68.174,11.085   "/>

                        <polygon fill="#231F20" points="69.579,5 79.103,13 79.653,13 70.131,5   "/>

                        <polygon fill="#231F20" points="74.96,5 84.485,13 85.035,13 75.511,5    "/>

                        <polygon fill="#231F20" points="80.01,5 89.346,12.842 89.777,12.741 80.562,5    "/>

                        <polygon fill="#231F20" points="92.3,10.627 85.603,5 85.051,5 91.87,10.728  "/>

                        <polygon fill="#231F20" points="94.782,8.441 90.688,5 90.137,5 94.353,8.542     "/>

                        <polygon fill="#231F20" points="97.202,6.223 95.747,5 95.194,5 96.772,6.324     "/>

                        <polygon fill="#231F20" points="99.278,5 90.395,13 90.937,13 99.821,5   "/>

                        <polygon fill="#231F20" points="104.419,5 95.532,13 96.077,13 104.962,5     "/>

                        <polygon fill="#231F20" points="110,5 109.56,5 100.673,13 101.216,13 110.081,5.018  "/>

                        <polygon fill="#231F20" points="111.719,7.684 105.813,13 106.356,13 111.719,8.172 111.719,8.174 117.464,13 118.015,13

                            111.719,7.711   "/>

                        <polygon fill="#231F20" points="111.719,11.025 109.524,13 110.067,13 111.719,11.514 111.719,11.547 113.448,13 113.999,13

                            111.719,11.085  "/>

                        <polygon fill="#231F20" points="113.124,5 122.647,13 123.198,13 113.676,5   "/>

                        <polygon fill="#231F20" points="118.505,5 128.03,13 128.58,13 119.056,5     "/>

                        <polygon fill="#231F20" points="123.555,5 132.891,12.842 133.322,12.741 124.106,5   "/>

                        <polygon fill="#231F20" points="135.845,10.627 129.147,5 128.596,5 135.415,10.728   "/>

                        <polygon fill="#231F20" points="138.327,8.441 134.233,5 133.682,5 137.897,8.542     "/>

                        <polygon fill="#231F20" points="140.747,6.223 139.292,5 138.739,5 140.317,6.324     "/>

                        <polygon fill="#231F20" points="142.823,5 133.939,13 134.481,13 143.366,5   "/>

                        <polygon fill="#231F20" points="147.964,5 139.077,13 139.622,13 148.507,5   "/>

                        <polygon fill="#231F20" points="153.545,5 153.104,5 144.218,13 144.761,13 153.626,5.018     "/>

                        <polygon fill="#231F20" points="155.264,7.684 149.358,13 149.901,13 155.264,8.172 155.264,8.174 161.009,13 161.56,13

                            155.264,7.711   "/>

                        <polygon fill="#231F20" points="155.264,11.025 153.069,13 153.612,13 155.264,11.514 155.264,11.547 156.993,13 157.544,13

                            155.264,11.085  "/>

                        <polygon fill="#231F20" points="156.669,5 166.192,13 166.743,13 157.221,5   "/>

                        <polygon fill="#231F20" points="162.05,5 171.575,13 172.125,13 162.601,5    "/>

                        <polygon fill="#231F20" points="167.1,5 176.436,12.842 176.867,12.741 167.651,5     "/>

                        <polygon fill="#231F20" points="179.39,10.627 172.692,5 172.141,5 178.96,10.728     "/>

                        <polygon fill="#231F20" points="181.872,8.441 177.778,5 177.227,5 181.442,8.542     "/>

                        <polygon fill="#231F20" points="184.292,6.223 182.837,5 182.284,5 183.862,6.324     "/>

                        <polygon fill="#231F20" points="186.368,5 177.484,13 178.026,13 186.911,5   "/>

                        <polygon fill="#231F20" points="191.509,5 182.622,13 183.167,13 192.052,5   "/>

                        <polygon fill="#231F20" points="197.09,5 196.649,5 187.763,13 188.306,13 197.171,5.018  "/>

                        <polygon fill="#231F20" points="198.809,7.684 192.903,13 193.446,13 198.809,8.172 198.809,8.174 204.554,13 205.104,13

                            198.809,7.711   "/>

                        <polygon fill="#231F20" points="198.809,11.025 196.614,13 197.157,13 198.809,11.514 198.809,11.547 200.538,13 201.089,13

                            198.809,11.085  "/>

                        <polygon fill="#231F20" points="200.214,5 209.737,13 210.288,13 200.766,5   "/>

                        <polygon fill="#231F20" points="205.595,5 215.12,13 215.67,13 206.146,5     "/>

                        <polygon fill="#231F20" points="210.645,5 219.98,12.842 220.412,12.741 211.196,5    "/>

                        <polygon fill="#231F20" points="222.935,10.627 216.237,5 215.686,5 222.505,10.728   "/>

                        <polygon fill="#231F20" points="225.417,8.441 221.323,5 220.771,5 224.987,8.542     "/>

                        <polygon fill="#231F20" points="227.837,6.223 226.382,5 225.829,5 227.407,6.324     "/>

                        <polygon fill="#231F20" points="229.913,5 221.029,13 221.571,13 230.456,5   "/>

                        <polygon fill="#231F20" points="235.054,5 226.167,13 226.712,13 235.597,5   "/>

                        <polygon fill="#231F20" points="240.635,5 240.194,5 231.308,13 231.851,13 240.716,5.018     "/>

                        <polygon fill="#231F20" points="242.354,7.684 236.448,13 236.991,13 242.354,8.172 242.354,8.174 248.099,13 248.649,13

                            242.354,7.711   "/>

                        <polygon fill="#231F20" points="242.354,11.025 240.159,13 240.702,13 242.354,11.514 242.354,11.547 244.083,13 244.634,13

                            242.354,11.085  "/>

                        <polygon fill="#231F20" points="243.759,5 253.282,13 253.833,13 244.311,5   "/>

                        <polygon fill="#231F20" points="249.14,5 258.665,13 259.215,13 249.69,5     "/>

                        <polygon fill="#231F20" points="254.189,5 263.525,12.842 263.957,12.741 254.741,5   "/>

                        <polygon fill="#231F20" points="266.479,10.627 259.782,5 259.23,5 266.05,10.728     "/>

                        <polygon fill="#231F20" points="268.962,8.441 264.868,5 264.316,5 268.532,8.542     "/>

                        <polygon fill="#231F20" points="271.382,6.223 269.927,5 269.374,5 270.952,6.324     "/>

                        <polygon fill="#231F20" points="273.458,5 264.574,13 265.116,13 274.001,5   "/>

                        <polygon fill="#231F20" points="278.599,5 269.712,13 270.257,13 279.142,5   "/>

                        <polygon fill="#231F20" points="284.18,5 283.739,5 274.853,13 275.396,13 284.261,5.018  "/>

                        <polygon fill="#231F20" points="285.898,7.684 279.993,13 280.536,13 285.898,8.172 285.898,8.174 291.644,13 292.194,13

                            285.898,7.711   "/>

                        <polygon fill="#231F20" points="285.898,11.025 283.704,13 284.247,13 285.898,11.514 285.898,11.547 287.628,13 288.179,13

                            285.898,11.085  "/>

                        <polygon fill="#231F20" points="287.304,5 296.827,13 297.378,13 287.855,5   "/>

                        <polygon fill="#231F20" points="292.685,5 302.21,13 302.76,13 293.235,5     "/>

                        <polygon fill="#231F20" points="297.734,5 307.07,12.842 307.502,12.741 298.286,5    "/>

                        <polygon fill="#231F20" points="310.024,10.627 303.327,5 302.775,5 309.595,10.728   "/>

                        <polygon fill="#231F20" points="312.507,8.441 308.413,5 307.861,5 312.077,8.542     "/>

                        <polygon fill="#231F20" points="314.927,6.223 313.472,5 312.919,5 314.497,6.324     "/>

                        <polygon fill="#231F20" points="317.003,5 308.119,13 308.661,13 317.546,5   "/>

                        <polygon fill="#231F20" points="322.144,5 313.257,13 313.802,13 322.687,5   "/>

                        <polygon fill="#231F20" points="327.725,5 327.284,5 318.397,13 318.94,13 327.806,5.018  "/>

                        <polygon fill="#231F20" points="329.443,7.684 323.538,13 324.081,13 329.443,8.172 329.443,8.174 335.188,13 335.739,13

                            329.443,7.711   "/>

                        <polygon fill="#231F20" points="329.443,11.025 327.249,13 327.792,13 329.443,11.514 329.443,11.547 331.173,13 331.724,13

                            329.443,11.085  "/>

                        <polygon fill="#231F20" points="330.849,5 340.372,13 340.923,13 331.4,5     "/>

                        <polygon fill="#231F20" points="336.229,5 345.755,13 346.305,13 336.78,5    "/>

                        <polygon fill="#231F20" points="341.279,5 350.615,12.842 351.047,12.741 341.831,5   "/>

                        <polygon fill="#231F20" points="353.569,10.627 346.872,5 346.32,5 353.14,10.728     "/>

                        <polygon fill="#231F20" points="356.052,8.441 351.958,5 351.406,5 355.622,8.542     "/>

                        <polygon fill="#231F20" points="358.472,6.223 357.017,5 356.464,5 358.042,6.324     "/>

                        <polygon fill="#231F20" points="360.548,5 351.664,13 352.206,13 361.091,5   "/>

                        <polygon fill="#231F20" points="365.688,5 356.802,13 357.347,13 366.231,5   "/>

                        <polygon fill="#231F20" points="371.27,5 370.829,5 361.942,13 362.485,13 371.351,5.018  "/>

                        <polygon fill="#231F20" points="372.988,7.684 367.083,13 367.626,13 372.988,8.172 372.988,8.174 378.733,13 379.284,13

                            372.988,7.711   "/>

                        <polygon fill="#231F20" points="372.988,11.025 370.794,13 371.337,13 372.988,11.514 372.988,11.547 374.718,13 375.269,13

                            372.988,11.085  "/>

                        <polygon fill="#231F20" points="374.394,5 383.917,13 384.468,13 374.945,5   "/>

                        <polygon fill="#231F20" points="379.774,5 389.3,13 389.85,13 380.325,5  "/>

                        <polygon fill="#231F20" points="384.824,5 394.16,12.842 394.592,12.741 385.376,5    "/>

                        <polygon fill="#231F20" points="397.114,10.627 390.417,5 389.865,5 396.685,10.728   "/>

                        <polygon fill="#231F20" points="399.597,8.441 395.503,5 394.951,5 399.167,8.542     "/>

                        <polygon fill="#231F20" points="402.017,6.223 400.562,5 400.009,5 401.587,6.324     "/>

                        <polygon fill="#231F20" points="404.093,5 395.209,13 395.751,13 404.636,5   "/>

                        <polygon fill="#231F20" points="409.233,5 400.347,13 400.892,13 409.776,5   "/>

                        <polygon fill="#231F20" points="414.814,5 414.374,5 405.487,13 406.03,13 414.896,5.018  "/>

                        <polygon fill="#231F20" points="416.533,7.684 410.628,13 411.171,13 416.533,8.172 416.533,8.174 422.278,13 422.829,13

                            416.533,7.711   "/>

                        <polygon fill="#231F20" points="416.533,11.025 414.339,13 414.882,13 416.533,11.514 416.533,11.547 418.263,13 418.813,13

                            416.533,11.085  "/>

                        <polygon fill="#231F20" points="417.938,5 427.462,13 428.013,13 418.49,5    "/>

                        <polygon fill="#231F20" points="423.319,5 432.845,13 433.395,13 423.87,5    "/>

                        <polygon fill="#231F20" points="428.369,5 437.705,12.842 438.137,12.741 428.921,5   "/>

                        <polygon fill="#231F20" points="440.659,10.627 433.962,5 433.41,5 440.229,10.728    "/>

                        <polygon fill="#231F20" points="443.142,8.441 439.048,5 438.496,5 442.712,8.542     "/>

                        <polygon fill="#231F20" points="445.562,6.223 444.106,5 443.554,5 445.132,6.324     "/>

                        <polygon fill="#231F20" points="447.638,5 438.754,13 439.296,13 448.181,5   "/>

                        <polygon fill="#231F20" points="452.778,5 443.892,13 444.437,13 453.321,5   "/>

                        <polygon fill="#231F20" points="458.359,5 457.919,5 449.032,13 449.575,13 458.44,5.018  "/>

                        <polygon fill="#231F20" points="460.078,7.684 454.173,13 454.716,13 460.078,8.172 460.078,8.174 465.823,13 466.374,13

                            460.078,7.711   "/>

                        <polygon fill="#231F20" points="460.078,11.025 457.884,13 458.427,13 460.078,11.514 460.078,11.547 461.808,13 462.358,13

                            460.078,11.085  "/>

                        <polygon fill="#231F20" points="461.483,5 471.007,13 471.558,13 462.035,5   "/>

                        <polygon fill="#231F20" points="466.864,5 476.39,13 476.939,13 467.415,5    "/>

                        <polygon fill="#231F20" points="471.914,5 481.25,12.842 481.682,12.741 472.466,5    "/>

                        <polygon fill="#231F20" points="484.204,10.627 477.507,5 476.955,5 483.774,10.728   "/>

                        <polygon fill="#231F20" points="486.687,8.441 482.593,5 482.041,5 486.257,8.542     "/>

                        <polygon fill="#231F20" points="489.106,6.223 487.651,5 487.099,5 488.677,6.324     "/>

                        <polygon fill="#231F20" points="491.183,5 482.299,13 482.841,13 491.726,5   "/>

                        <polygon fill="#231F20" points="496.323,5 487.437,13 487.981,13 496.866,5   "/>

                        <polygon fill="#231F20" points="501.904,5 501.464,5 492.577,13 493.12,13 501.985,5.018  "/>

                        <polygon fill="#231F20" points="503.623,7.684 497.718,13 498.261,13 503.623,8.172 503.623,8.174 509.368,13 509.919,13

                            503.623,7.711   "/>

                        <polygon fill="#231F20" points="503.623,11.025 501.429,13 501.972,13 503.623,11.514 503.623,11.547 505.353,13 505.903,13

                            503.623,11.085  "/>

                        <polygon fill="#231F20" points="505.028,5 514.552,13 515.103,13 505.58,5    "/>

                        <polygon fill="#231F20" points="510.409,5 519.935,13 520.484,13 510.96,5    "/>

                        <polygon fill="#231F20" points="515.459,5 524.795,12.842 525.227,12.741 516.011,5   "/>

                        <polygon fill="#231F20" points="527.749,10.627 521.052,5 520.5,5 527.319,10.728     "/>

                        <polygon fill="#231F20" points="530.231,8.441 526.138,5 525.586,5 529.802,8.542     "/>

                        <polygon fill="#231F20" points="532.651,6.223 531.196,5 530.644,5 532.222,6.324     "/>

                        <polygon fill="#231F20" points="534.728,5 525.844,13 526.386,13 535.271,5   "/>

                        <polygon fill="#231F20" points="539.868,5 530.981,13 531.526,13 540.411,5   "/>

                        <polygon fill="#231F20" points="545.449,5 545.009,5 536.122,13 536.665,13 545.53,5.018  "/>

                        <polygon fill="#231F20" points="547.168,7.684 541.263,13 541.806,13 547.168,8.172 547.168,8.174 552.913,13 553.464,13

                            547.168,7.711   "/>

                        <polygon fill="#231F20" points="547.168,11.025 544.974,13 545.517,13 547.168,11.514 547.168,11.547 548.897,13 549.448,13

                            547.168,11.085  "/>

                        <polygon fill="#231F20" points="548.573,5 558.097,13 558.647,13 549.125,5   "/>

                        <polygon fill="#231F20" points="553.954,5 563.479,13 564.029,13 554.505,5   "/>

                        <polygon fill="#231F20" points="559.004,5 568.34,12.842 568.771,12.741 559.556,5    "/>

                        <polygon fill="#231F20" points="571.294,10.627 564.597,5 564.045,5 570.864,10.728   "/>

                        <polygon fill="#231F20" points="573.776,8.441 569.683,5 569.131,5 573.347,8.542     "/>

                        <polygon fill="#231F20" points="576.196,6.223 574.741,5 574.188,5 575.767,6.324     "/>

                        <polygon fill="#231F20" points="578.272,5 569.389,13 569.931,13 578.815,5   "/>

                        <polygon fill="#231F20" points="583.413,5 574.526,13 575.071,13 583.956,5   "/>

                        <polygon fill="#231F20" points="588.994,5 588.554,5 579.667,13 580.21,13 589.075,5.018  "/>

                        <polygon fill="#231F20" points="590.713,7.684 584.808,13 585.351,13 590.713,8.172 590.713,8.174 596.458,13 597.009,13

                            590.713,7.711   "/>

                        <polygon fill="#231F20" points="590.713,11.025 588.519,13 589.062,13 590.713,11.514 590.713,11.547 592.442,13 592.993,13

                            590.713,11.085  "/>

                        <polygon fill="#231F20" points="592.118,5 601.642,13 602.192,13 592.67,5    "/>

                        <polygon fill="#231F20" points="597.499,5 607.024,13 607.574,13 598.05,5    "/>

                        <polygon fill="#231F20" points="602.549,5 611.885,12.842 612.316,12.741 603.101,5   "/>

                        <polygon fill="#231F20" points="614.839,10.627 608.142,5 607.59,5 614.409,10.728    "/>

                        <polygon fill="#231F20" points="617.321,8.441 613.228,5 612.676,5 616.892,8.542     "/>

                        <polygon fill="#231F20" points="619.741,6.223 618.286,5 617.733,5 619.312,6.324     "/>

                        <polygon fill="#231F20" points="621.817,5 612.934,13 613.476,13 622.36,5    "/>

                        <polygon fill="#231F20" points="626.958,5 618.071,13 618.616,13 627.501,5   "/>

                        <polygon fill="#231F20" points="632.539,5 632.099,5 623.212,13 623.755,13 632.62,5.018  "/>

                        <polygon fill="#231F20" points="634.258,7.684 628.353,13 628.896,13 634.258,8.172 634.258,8.174 640.003,13 640.554,13

                            634.258,7.711   "/>

                        <polygon fill="#231F20" points="634.258,11.025 632.063,13 632.606,13 634.258,11.514 634.258,11.547 635.987,13 636.538,13

                            634.258,11.085  "/>

                        <polygon fill="#231F20" points="635.663,5 645.187,13 645.737,13 636.215,5   "/>

                        <polygon fill="#231F20" points="641.044,5 650.569,13 651.119,13 641.595,5   "/>

                        <polygon fill="#231F20" points="646.094,5 655.43,12.842 655.861,12.741 646.646,5    "/>

                        <polygon fill="#231F20" points="658.384,10.627 651.687,5 651.135,5 657.954,10.728   "/>

                        <polygon fill="#231F20" points="660.866,8.441 656.772,5 656.221,5 660.437,8.542     "/>

                        <polygon fill="#231F20" points="663.286,6.223 661.831,5 661.278,5 662.856,6.324     "/>

                        <polygon fill="#231F20" points="665.362,5 656.479,13 657.021,13 665.905,5   "/>

                        <polygon fill="#231F20" points="670.503,5 661.616,13 662.161,13 671.046,5   "/>

                        <polygon fill="#231F20" points="676.084,5 675.644,5 666.757,13 667.3,13 676.165,5.018   "/>

                        <polygon fill="#231F20" points="677.803,7.684 671.897,13 672.44,13 677.803,8.172 677.803,8.174 683.548,13 684.099,13

                            677.803,7.711   "/>

                        <polygon fill="#231F20" points="677.803,11.025 675.608,13 676.151,13 677.803,11.514 677.803,11.547 679.532,13 680.083,13

                            677.803,11.085  "/>

                        <polygon fill="#231F20" points="679.208,5 688.731,13 689.282,13 679.76,5    "/>

                        <polygon fill="#231F20" points="684.589,5 694.114,13 694.664,13 685.14,5    "/>

                        <polygon fill="#231F20" points="689.639,5 698.975,12.842 699.406,12.741 690.19,5    "/>

                        <polygon fill="#231F20" points="701.929,10.627 695.231,5 694.68,5 701.499,10.728    "/>

                        <polygon fill="#231F20" points="704.411,8.441 700.317,5 699.766,5 703.981,8.542     "/>

                        <polygon fill="#231F20" points="706.831,6.223 705.376,5 704.823,5 706.401,6.324     "/>

                        <polygon fill="#231F20" points="708.907,5 700.023,13 700.565,13 709.45,5    "/>

                        <polygon fill="#231F20" points="714.048,5 705.161,13 705.706,13 714.591,5   "/>

                        <polygon fill="#231F20" points="719.629,5 719.188,5 710.302,13 710.845,13 719.71,5.018  "/>

                        <polygon fill="#231F20" points="721.348,7.684 715.442,13 715.985,13 721.348,8.172 721.348,8.174 727.093,13 727.644,13

                            721.348,7.711   "/>

                        <polygon fill="#231F20" points="721.348,11.025 719.153,13 719.696,13 721.348,11.514 721.348,11.547 723.077,13 723.628,13

                            721.348,11.085  "/>

                        <polygon fill="#231F20" points="722.753,5 732.276,13 732.827,13 723.305,5   "/>

                        <polygon fill="#231F20" points="728.134,5 737.659,13 738.209,13 728.685,5   "/>

                        <polygon fill="#231F20" points="733.184,5 742.52,12.842 742.951,12.741 733.735,5    "/>

                        <polygon fill="#231F20" points="745.474,10.627 738.776,5 738.225,5 745.044,10.728   "/>

                        <polygon fill="#231F20" points="747.956,8.441 743.862,5 743.311,5 747.526,8.542     "/>

                        <polygon fill="#231F20" points="750.376,6.223 748.921,5 748.368,5 749.946,6.324     "/>

                        <polygon fill="#231F20" points="752.452,5 743.568,13 744.11,13 752.995,5    "/>

                        <polygon fill="#231F20" points="757.593,5 748.706,13 749.251,13 758.136,5   "/>

                        <polygon fill="#231F20" points="763.174,5 762.733,5 753.847,13 754.39,13 763.255,5.018  "/>

                        <polygon fill="#231F20" points="764.893,7.684 758.987,13 759.53,13 764.893,8.172 764.893,8.174 770.638,13 771.188,13

                            764.893,7.711   "/>

                        <polygon fill="#231F20" points="764.893,11.025 762.698,13 763.241,13 764.893,11.514 764.893,11.547 766.622,13 767.173,13

                            764.893,11.085  "/>

                        <polygon fill="#231F20" points="766.298,5 775.821,13 776.372,13 766.85,5    "/>

                        <polygon fill="#231F20" points="771.679,5 781.204,13 781.754,13 772.229,5   "/>

                        <polygon fill="#231F20" points="776.729,5 786.064,12.842 786.496,12.741 777.28,5    "/>

                        <polygon fill="#231F20" points="789.019,10.627 782.321,5 781.77,5 788.589,10.728    "/>

                        <polygon fill="#231F20" points="791.501,8.441 787.407,5 786.855,5 791.071,8.542     "/>

                        <polygon fill="#231F20" points="793.921,6.223 792.466,5 791.913,5 793.491,6.324     "/>

                        <polygon fill="#231F20" points="795.997,5 787.113,13 787.655,13 796.54,5    "/>

                        <polygon fill="#231F20" points="801.138,5 792.251,13 792.796,13 801.681,5   "/>

                        <polygon fill="#231F20" points="806.719,5 806.278,5 797.392,13 797.935,13 806.8,5.018   "/>

                        <polygon fill="#231F20" points="808.438,7.684 802.532,13 803.075,13 808.438,8.172 808.438,8.174 814.183,13 814.733,13

                            808.438,7.711   "/>

                        <polygon fill="#231F20" points="808.438,11.025 806.243,13 806.786,13 808.438,11.514 808.438,11.547 810.167,13 810.718,13

                            808.438,11.085  "/>

                        <polygon fill="#231F20" points="809.843,5 819.366,13 819.917,13 810.395,5   "/>

                        <polygon fill="#231F20" points="815.224,5 824.749,13 825.299,13 815.774,5   "/>

                        <polygon fill="#231F20" points="820.273,5 829.609,12.842 830.041,12.741 820.825,5   "/>

                        <polygon fill="#231F20" points="832.563,10.627 825.866,5 825.314,5 832.134,10.728   "/>

                        <polygon fill="#231F20" points="835.046,8.441 830.952,5 830.4,5 834.616,8.542   "/>

                        <polygon fill="#231F20" points="837.466,6.223 836.011,5 835.458,5 837.036,6.324     "/>

                        <polygon fill="#231F20" points="839.542,5 830.658,13 831.2,13 840.085,5     "/>

                        <polygon fill="#231F20" points="844.683,5 835.796,13 836.341,13 845.226,5   "/>

                        <polygon fill="#231F20" points="850.264,5 849.823,5 840.937,13 841.479,13 850.345,5.018     "/>

                        <polygon fill="#231F20" points="851.982,7.684 846.077,13 846.62,13 851.982,8.172 851.982,8.174 857.728,13 858.278,13

                            851.982,7.711   "/>

                        <polygon fill="#231F20" points="851.982,11.025 849.788,13 850.331,13 851.982,11.514 851.982,11.547 853.712,13 854.263,13

                            851.982,11.085  "/>

                        <polygon fill="#231F20" points="853.388,5 862.911,13 863.462,13 853.939,5   "/>

                        <polygon fill="#231F20" points="858.769,5 868.294,13 868.844,13 859.319,5   "/>

                        <polygon fill="#231F20" points="863.818,5 873.154,12.842 873.586,12.741 864.37,5    "/>

                        <polygon fill="#231F20" points="876.108,10.627 869.411,5 868.859,5 875.679,10.728   "/>

                        <polygon fill="#231F20" points="878.591,8.441 874.497,5 873.945,5 878.161,8.542     "/>

                        <polygon fill="#231F20" points="881.011,6.223 879.556,5 879.003,5 880.581,6.324     "/>

                        <polygon fill="#231F20" points="883.087,5 874.203,13 874.745,13 883.63,5    "/>

                        <polygon fill="#231F20" points="888.228,5 879.341,13 879.886,13 888.771,5   "/>

                        <polygon fill="#231F20" points="893.809,5 893.368,5 884.481,13 885.024,13 893.89,5.018  "/>

                        <polygon fill="#231F20" points="895.527,7.684 889.622,13 890.165,13 895.527,8.172 895.527,8.174 901.272,13 901.823,13

                            895.527,7.711   "/>

                        <polygon fill="#231F20" points="895.527,11.025 893.333,13 893.876,13 895.527,11.514 895.527,11.547 897.257,13 897.808,13

                            895.527,11.085  "/>

                        <polygon fill="#231F20" points="896.933,5 906.456,13 907.007,13 897.484,5   "/>

                        <polygon fill="#231F20" points="902.313,5 911.839,13 912.389,13 902.864,5   "/>

                        <polygon fill="#231F20" points="907.363,5 916.699,12.842 917.131,12.741 907.915,5   "/>

                        <polygon fill="#231F20" points="919.653,10.627 912.956,5 912.404,5 919.224,10.728   "/>

                        <polygon fill="#231F20" points="922.136,8.441 918.042,5 917.49,5 921.706,8.542  "/>

                        <polygon fill="#231F20" points="924.556,6.223 923.101,5 922.548,5 924.126,6.324     "/>

                        <polygon fill="#231F20" points="926.632,5 917.748,13 918.29,13 927.175,5    "/>

                        <polygon fill="#231F20" points="931.772,5 922.886,13 923.431,13 932.315,5   "/>

                        <polygon fill="#231F20" points="937.354,5 936.913,5 928.026,13 928.569,13 937.435,5.018     "/>

                        <polygon fill="#231F20" points="939.072,7.684 933.167,13 933.71,13 939.072,8.172 939.072,8.174 944.817,13 945.368,13

                            939.072,7.711   "/>

                        <polygon fill="#231F20" points="939.072,11.025 936.878,13 937.421,13 939.072,11.514 939.072,11.547 940.802,13 941.353,13

                            939.072,11.085  "/>

                        <polygon fill="#231F20" points="940.478,5 950.001,13 950.552,13 941.029,5   "/>

                        <polygon fill="#231F20" points="945.858,5 955.384,13 955.934,13 946.409,5   "/>

                        <polygon fill="#231F20" points="950.908,5 960.244,12.842 960.676,12.741 951.46,5    "/>

                        <polygon fill="#231F20" points="963.198,10.627 956.501,5 955.949,5 962.769,10.728   "/>

                        <polygon fill="#231F20" points="965.681,8.441 961.587,5 961.035,5 965.251,8.542     "/>

                        <polygon fill="#231F20" points="968.101,6.223 966.646,5 966.093,5 967.671,6.324     "/>

                        <polygon fill="#231F20" points="970.177,5 961.293,13 961.835,13 970.72,5    "/>

                        <polygon fill="#231F20" points="975.317,5 966.431,13 966.976,13 975.86,5    "/>

                        <polygon fill="#231F20" points="980.898,5 980.458,5 971.571,13 972.114,13 980.979,5.018     "/>

                        <polygon fill="#231F20" points="982.617,7.684 976.712,13 977.255,13 982.617,8.172 982.617,8.174 988.362,13 988.913,13

                            982.617,7.711   "/>

                        <polygon fill="#231F20" points="982.617,11.025 980.423,13 980.966,13 982.617,11.514 982.617,11.547 984.347,13 984.897,13

                            982.617,11.085  "/>

                        <polygon fill="#231F20" points="984.022,5 993.546,13 994.097,13 984.574,5   "/>

                        <polygon fill="#231F20" points="989.403,5 998.929,13 999.479,13 989.954,5   "/>

                        <polygon fill="#231F20" points="994.453,5 1003.789,12.842 1004.221,12.741 995.005,5     "/>

                        <polygon fill="#231F20" points="1006.743,10.627 1000.046,5 999.494,5 1006.313,10.728    "/>

                        <polygon fill="#231F20" points="1009.226,8.441 1005.132,5 1004.58,5 1008.796,8.542  "/>

                        <polygon fill="#231F20" points="1011.646,6.223 1010.19,5 1009.638,5 1011.216,6.324  "/>

                        <polygon fill="#231F20" points="1013.722,5 1004.838,13 1005.38,13 1014.265,5    "/>

                        <polygon fill="#231F20" points="1018.862,5 1009.976,13 1010.521,13 1019.405,5   "/>

                        <polygon fill="#231F20" points="1024.443,5 1024.003,5 1015.116,13 1015.659,13 1024.524,5.018    "/>

                        <polygon fill="#231F20" points="1026.162,7.684 1020.257,13 1020.8,13 1026.162,8.172 1026.162,8.174 1031.907,13 1032.458,13

                            1026.162,7.711  "/>

                        <polygon fill="#231F20" points="1026.162,11.025 1023.968,13 1024.511,13 1026.162,11.514 1026.162,11.547 1027.892,13

                            1028.442,13 1026.162,11.085     "/>

                        <polygon fill="#231F20" points="1027.567,5 1037.091,13 1037.642,13 1028.119,5   "/>

                        <polygon fill="#231F20" points="1032.948,5 1042.474,13 1043.023,13 1033.499,5   "/>

                        <polygon fill="#231F20" points="1037.998,5 1047.334,12.842 1047.766,12.741 1038.55,5    "/>

                        <polygon fill="#231F20" points="1050.288,10.627 1043.591,5 1043.039,5 1049.858,10.728   "/>

                        <polygon fill="#231F20" points="1052.771,8.441 1048.677,5 1048.125,5 1052.341,8.542     "/>

                        <polygon fill="#231F20" points="1055.19,6.223 1053.735,5 1053.183,5 1054.761,6.324  "/>

                        <polygon fill="#231F20" points="1057.267,5 1048.383,13 1048.925,13 1057.81,5    "/>

                        <polygon fill="#231F20" points="1062.407,5 1053.521,13 1054.065,13 1062.95,5    "/>

                        <polygon fill="#231F20" points="1067.988,5 1067.548,5 1058.661,13 1059.204,13 1068.069,5.018    "/>

                        <polygon fill="#231F20" points="1069.707,7.684 1063.802,13 1064.345,13 1069.707,8.172 1069.707,8.174 1075.452,13 1076.003,13

                            1069.707,7.711  "/>

                        <polygon fill="#231F20" points="1069.707,11.025 1067.513,13 1068.056,13 1069.707,11.514 1069.707,11.547 1071.437,13

                            1071.987,13 1069.707,11.085     "/>

                        <polygon fill="#231F20" points="1071.112,5 1080.636,13 1081.187,13 1071.664,5   "/>

                        <polygon fill="#231F20" points="1076.493,5 1086.019,13 1086.568,13 1077.044,5   "/>

                        <polygon fill="#231F20" points="1081.543,5 1090.879,12.842 1091.311,12.741 1082.095,5   "/>

                        <polygon fill="#231F20" points="1093.833,10.627 1087.136,5 1086.584,5 1093.403,10.728   "/>

                        <polygon fill="#231F20" points="1096.315,8.441 1092.222,5 1091.67,5 1095.886,8.542  "/>

                        <polygon fill="#231F20" points="1098.735,6.223 1097.28,5 1096.728,5 1098.306,6.324  "/>

                        <polygon fill="#231F20" points="1100.812,5 1091.928,13 1092.47,13 1101.354,5    "/>

                        <polygon fill="#231F20" points="1105.952,5 1097.065,13 1097.61,13 1106.495,5    "/>

                        <polygon fill="#231F20" points="1111.533,5 1111.093,5 1102.206,13 1102.749,13 1111.614,5.018    "/>

                        <polygon fill="#231F20" points="1113.252,7.684 1107.347,13 1107.89,13 1113.252,8.172 1113.252,8.174 1118.997,13 1119.548,13

                            1113.252,7.711  "/>

                        <polygon fill="#231F20" points="1113.252,11.025 1111.058,13 1111.601,13 1113.252,11.514 1113.252,11.547 1114.981,13

                            1115.532,13 1113.252,11.085     "/>

                        <polygon fill="#231F20" points="1114.657,5 1124.181,13 1124.731,13 1115.209,5   "/>

                        <polygon fill="#231F20" points="1120.038,5 1129.563,13 1130.113,13 1120.589,5   "/>

                        <polygon fill="#231F20" points="1125.088,5 1134.424,12.842 1134.855,12.741 1125.64,5    "/>

                        <polygon fill="#231F20" points="1137.378,10.627 1130.681,5 1130.129,5 1136.948,10.728   "/>

                        <polygon fill="#231F20" points="1139.86,8.441 1135.767,5 1135.215,5 1139.431,8.542  "/>

                        <polygon fill="#231F20" points="1142.28,6.223 1140.825,5 1140.272,5 1141.851,6.324  "/>

                        <polygon fill="#231F20" points="1144.356,5 1135.473,13 1136.015,13 1144.899,5   "/>

                        <polygon fill="#231F20" points="1149.497,5 1140.61,13 1141.155,13 1150.04,5     "/>

                        <polygon fill="#231F20" points="1155.078,5 1154.638,5 1145.751,13 1146.294,13 1155.159,5.018    "/>

                        <polygon fill="#231F20" points="1156.797,7.684 1150.892,13 1151.435,13 1156.797,8.172 1156.797,8.174 1162.542,13 1163.093,13

                            1156.797,7.711  "/>

                        <polygon fill="#231F20" points="1156.797,11.025 1154.603,13 1155.146,13 1156.797,11.514 1156.797,11.547 1158.526,13

                            1159.077,13 1156.797,11.085     "/>

                        <polygon fill="#231F20" points="1158.202,5 1167.726,13 1168.276,13 1158.754,5   "/>

                        <polygon fill="#231F20" points="1163.583,5 1173.108,13 1173.658,13 1164.134,5   "/>

                        <polygon fill="#231F20" points="1168.633,5 1177.969,12.842 1178.4,12.741 1169.185,5     "/>

                        <polygon fill="#231F20" points="1180.923,10.627 1174.226,5 1173.674,5 1180.493,10.728   "/>

                        <polygon fill="#231F20" points="1183.405,8.441 1179.312,5 1178.76,5 1182.976,8.542  "/>

                        <polygon fill="#231F20" points="1185.825,6.223 1184.37,5 1183.817,5 1185.396,6.324  "/>

                        <polygon fill="#231F20" points="1187.901,5 1179.018,13 1179.56,13 1188.444,5    "/>

                        <polygon fill="#231F20" points="1193.042,5 1184.155,13 1184.7,13 1193.585,5     "/>

                        <polygon fill="#231F20" points="1189.296,13 1189.839,13 1194.629,8.688 1194.629,8.199   "/>

                        <polygon fill="#231F20" points="1194.629,13 1194.629,12.827 1194.437,13     "/>

                    </g>

                  </svg>';


        $html .= '</div>'; // end .df-post-author

        echo( $html );

    }

    add_action( 'df_post_bottom', 'df_author_biography', 20 );

}

if ( !function_exists( 'df_related_post' ) ) {

    /**
     * Build related post sections.
     *
     * @return string
     */

    function df_related_post() {
        if ( ( wp_count_posts()->publish == '' ) || !is_single() || get_theme_mod( 'df_hide_rel_post', 0 ) == 1 ) return;

        $html = '';

        $term_list = wp_get_post_terms( get_the_ID(), 'category', array( 'fields' => 'slugs' ) );

        $new = new wp_query( array(

            'post_type'           => 'post',

            'post_status'         => 'publish',

            'post__not_in'        => array( get_the_ID() ),

            'posts_per_page'      => 3, // Number of related posts to display.

            'ignore_sticky_posts' => 1,

            'orderby'             => 'rand',

            'tax_query'           => array(

                array(

                    'taxonomy'  => 'category',

                    'field'     => 'slug',

                    'terms'     => $term_list

                ) )

        ) );



        if ( $new->have_posts() ) :

            $html .= '<div class="df-related-post">';

            $html .= sprintf( '<h3 class="related-post-title display-4 aligncenter">%s</h3>', esc_attr__( 'You May Also Like', 'applique' ) );

            $html .= '<div class="row">';

            while ( $new->have_posts() ) : $new->the_post();

                $title = wp_kses( get_the_title(), array( 'b' => array(), 'i' => array() ) );

                $html .= '<div class="wrapper col-md-4">';

                if ( has_post_thumbnail() ) :

                    /* Display Post Thumbnail */

                    $html .= '<div class="featured-media">';

                    $html .= get_the_post_thumbnail( get_the_ID() , 'loop-blog' );

                    $html .= '</div>'; // .featured-media

                else:

                    /* Display Post Thumbnail */

                    $html .= '<div class="featured-media">';

                    $html .= sprintf( '<img src="%1$s/assets/images/placeholder.png" alt="%2$s" />', esc_url( get_template_directory_uri() ), esc_attr( get_the_title() ) );

                    $html .= '</div>'; // .featured-media

                endif;

                /* Display Content */

                $html .= '<div class="related-post-content">';

                $html .= '<div class="inner-wrapper">';

                $html .= df_category_blog();

                $html .= sprintf( '<h4 class="related-title"><a href="%1$s">%2$s</a></h4>', esc_url( get_the_permalink() ), $title );

                $html .= sprintf( '<a href="%1$s" class="read-more button small outline">%2$s</a>', esc_url( get_the_permalink() ), esc_attr__( 'Read More', 'applique' ) );

                $html .= '</div>'; // end .inner-wrapper

                $html .= '</div>'; // end .related-post-content

                $html .= '</div>'; // end .wrapper

            endwhile;

            $html .= '</div>'; // end .row

            $html .= '<div class="clear"></div>'; // clearing float

            $html .= '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="8px" viewBox="550 5 100 8">

                    <g>

                        <polygon fill="#231F20" points="24.629,8.174 30.374,13 30.925,13 24.629,7.711   "/>

                        <polygon fill="#231F20" points="26.034,5 35.558,13 36.108,13 26.586,5   "/>

                        <polygon fill="#231F20" points="31.415,5 40.94,13 41.489,13 31.966,5    "/>

                        <polygon fill="#231F20" points="36.465,5 45.801,12.842 46.231,12.741 37.017,5   "/>

                        <polygon fill="#231F20" points="48.755,10.627 42.058,5 41.506,5 48.325,10.728   "/>

                        <polygon fill="#231F20" points="51.237,8.441 47.144,5 46.592,5 50.808,8.542     "/>

                        <polygon fill="#231F20" points="53.657,6.223 52.202,5 51.649,5 53.228,6.324     "/>

                        <polygon fill="#231F20" points="55.733,5 46.849,13 47.392,13 56.276,5   "/>

                        <polygon fill="#231F20" points="60.874,5 51.987,13 52.532,13 61.417,5   "/>

                        <polygon fill="#231F20" points="66.455,5 66.015,5 57.128,13 57.671,13 66.536,5.018  "/>

                        <polygon fill="#231F20" points="68.174,7.684 62.269,13 62.812,13 68.174,8.172 68.174,8.174 73.919,13 74.47,13 68.174,7.711  "/>

                        <polygon fill="#231F20" points="24.629,11.547 26.358,13 26.909,13 24.629,11.085     "/>

                        <polygon fill="#231F20" points="68.174,11.025 65.979,13 66.522,13 68.174,11.514 68.174,11.547 69.903,13 70.454,13

                            68.174,11.085   "/>

                        <polygon fill="#231F20" points="69.579,5 79.103,13 79.653,13 70.131,5   "/>

                        <polygon fill="#231F20" points="74.96,5 84.485,13 85.035,13 75.511,5    "/>

                        <polygon fill="#231F20" points="80.01,5 89.346,12.842 89.777,12.741 80.562,5    "/>

                        <polygon fill="#231F20" points="92.3,10.627 85.603,5 85.051,5 91.87,10.728  "/>

                        <polygon fill="#231F20" points="94.782,8.441 90.688,5 90.137,5 94.353,8.542     "/>

                        <polygon fill="#231F20" points="97.202,6.223 95.747,5 95.194,5 96.772,6.324     "/>

                        <polygon fill="#231F20" points="99.278,5 90.395,13 90.937,13 99.821,5   "/>

                        <polygon fill="#231F20" points="104.419,5 95.532,13 96.077,13 104.962,5     "/>

                        <polygon fill="#231F20" points="110,5 109.56,5 100.673,13 101.216,13 110.081,5.018  "/>

                        <polygon fill="#231F20" points="111.719,7.684 105.813,13 106.356,13 111.719,8.172 111.719,8.174 117.464,13 118.015,13

                            111.719,7.711   "/>

                        <polygon fill="#231F20" points="111.719,11.025 109.524,13 110.067,13 111.719,11.514 111.719,11.547 113.448,13 113.999,13

                            111.719,11.085  "/>

                        <polygon fill="#231F20" points="113.124,5 122.647,13 123.198,13 113.676,5   "/>

                        <polygon fill="#231F20" points="118.505,5 128.03,13 128.58,13 119.056,5     "/>

                        <polygon fill="#231F20" points="123.555,5 132.891,12.842 133.322,12.741 124.106,5   "/>

                        <polygon fill="#231F20" points="135.845,10.627 129.147,5 128.596,5 135.415,10.728   "/>

                        <polygon fill="#231F20" points="138.327,8.441 134.233,5 133.682,5 137.897,8.542     "/>

                        <polygon fill="#231F20" points="140.747,6.223 139.292,5 138.739,5 140.317,6.324     "/>

                        <polygon fill="#231F20" points="142.823,5 133.939,13 134.481,13 143.366,5   "/>

                        <polygon fill="#231F20" points="147.964,5 139.077,13 139.622,13 148.507,5   "/>

                        <polygon fill="#231F20" points="153.545,5 153.104,5 144.218,13 144.761,13 153.626,5.018     "/>

                        <polygon fill="#231F20" points="155.264,7.684 149.358,13 149.901,13 155.264,8.172 155.264,8.174 161.009,13 161.56,13

                            155.264,7.711   "/>

                        <polygon fill="#231F20" points="155.264,11.025 153.069,13 153.612,13 155.264,11.514 155.264,11.547 156.993,13 157.544,13

                            155.264,11.085  "/>

                        <polygon fill="#231F20" points="156.669,5 166.192,13 166.743,13 157.221,5   "/>

                        <polygon fill="#231F20" points="162.05,5 171.575,13 172.125,13 162.601,5    "/>

                        <polygon fill="#231F20" points="167.1,5 176.436,12.842 176.867,12.741 167.651,5     "/>

                        <polygon fill="#231F20" points="179.39,10.627 172.692,5 172.141,5 178.96,10.728     "/>

                        <polygon fill="#231F20" points="181.872,8.441 177.778,5 177.227,5 181.442,8.542     "/>

                        <polygon fill="#231F20" points="184.292,6.223 182.837,5 182.284,5 183.862,6.324     "/>

                        <polygon fill="#231F20" points="186.368,5 177.484,13 178.026,13 186.911,5   "/>

                        <polygon fill="#231F20" points="191.509,5 182.622,13 183.167,13 192.052,5   "/>

                        <polygon fill="#231F20" points="197.09,5 196.649,5 187.763,13 188.306,13 197.171,5.018  "/>

                        <polygon fill="#231F20" points="198.809,7.684 192.903,13 193.446,13 198.809,8.172 198.809,8.174 204.554,13 205.104,13

                            198.809,7.711   "/>

                        <polygon fill="#231F20" points="198.809,11.025 196.614,13 197.157,13 198.809,11.514 198.809,11.547 200.538,13 201.089,13

                            198.809,11.085  "/>

                        <polygon fill="#231F20" points="200.214,5 209.737,13 210.288,13 200.766,5   "/>

                        <polygon fill="#231F20" points="205.595,5 215.12,13 215.67,13 206.146,5     "/>

                        <polygon fill="#231F20" points="210.645,5 219.98,12.842 220.412,12.741 211.196,5    "/>

                        <polygon fill="#231F20" points="222.935,10.627 216.237,5 215.686,5 222.505,10.728   "/>

                        <polygon fill="#231F20" points="225.417,8.441 221.323,5 220.771,5 224.987,8.542     "/>

                        <polygon fill="#231F20" points="227.837,6.223 226.382,5 225.829,5 227.407,6.324     "/>

                        <polygon fill="#231F20" points="229.913,5 221.029,13 221.571,13 230.456,5   "/>

                        <polygon fill="#231F20" points="235.054,5 226.167,13 226.712,13 235.597,5   "/>

                        <polygon fill="#231F20" points="240.635,5 240.194,5 231.308,13 231.851,13 240.716,5.018     "/>

                        <polygon fill="#231F20" points="242.354,7.684 236.448,13 236.991,13 242.354,8.172 242.354,8.174 248.099,13 248.649,13

                            242.354,7.711   "/>

                        <polygon fill="#231F20" points="242.354,11.025 240.159,13 240.702,13 242.354,11.514 242.354,11.547 244.083,13 244.634,13

                            242.354,11.085  "/>

                        <polygon fill="#231F20" points="243.759,5 253.282,13 253.833,13 244.311,5   "/>

                        <polygon fill="#231F20" points="249.14,5 258.665,13 259.215,13 249.69,5     "/>

                        <polygon fill="#231F20" points="254.189,5 263.525,12.842 263.957,12.741 254.741,5   "/>

                        <polygon fill="#231F20" points="266.479,10.627 259.782,5 259.23,5 266.05,10.728     "/>

                        <polygon fill="#231F20" points="268.962,8.441 264.868,5 264.316,5 268.532,8.542     "/>

                        <polygon fill="#231F20" points="271.382,6.223 269.927,5 269.374,5 270.952,6.324     "/>

                        <polygon fill="#231F20" points="273.458,5 264.574,13 265.116,13 274.001,5   "/>

                        <polygon fill="#231F20" points="278.599,5 269.712,13 270.257,13 279.142,5   "/>

                        <polygon fill="#231F20" points="284.18,5 283.739,5 274.853,13 275.396,13 284.261,5.018  "/>

                        <polygon fill="#231F20" points="285.898,7.684 279.993,13 280.536,13 285.898,8.172 285.898,8.174 291.644,13 292.194,13

                            285.898,7.711   "/>

                        <polygon fill="#231F20" points="285.898,11.025 283.704,13 284.247,13 285.898,11.514 285.898,11.547 287.628,13 288.179,13

                            285.898,11.085  "/>

                        <polygon fill="#231F20" points="287.304,5 296.827,13 297.378,13 287.855,5   "/>

                        <polygon fill="#231F20" points="292.685,5 302.21,13 302.76,13 293.235,5     "/>

                        <polygon fill="#231F20" points="297.734,5 307.07,12.842 307.502,12.741 298.286,5    "/>

                        <polygon fill="#231F20" points="310.024,10.627 303.327,5 302.775,5 309.595,10.728   "/>

                        <polygon fill="#231F20" points="312.507,8.441 308.413,5 307.861,5 312.077,8.542     "/>

                        <polygon fill="#231F20" points="314.927,6.223 313.472,5 312.919,5 314.497,6.324     "/>

                        <polygon fill="#231F20" points="317.003,5 308.119,13 308.661,13 317.546,5   "/>

                        <polygon fill="#231F20" points="322.144,5 313.257,13 313.802,13 322.687,5   "/>

                        <polygon fill="#231F20" points="327.725,5 327.284,5 318.397,13 318.94,13 327.806,5.018  "/>

                        <polygon fill="#231F20" points="329.443,7.684 323.538,13 324.081,13 329.443,8.172 329.443,8.174 335.188,13 335.739,13

                            329.443,7.711   "/>

                        <polygon fill="#231F20" points="329.443,11.025 327.249,13 327.792,13 329.443,11.514 329.443,11.547 331.173,13 331.724,13

                            329.443,11.085  "/>

                        <polygon fill="#231F20" points="330.849,5 340.372,13 340.923,13 331.4,5     "/>

                        <polygon fill="#231F20" points="336.229,5 345.755,13 346.305,13 336.78,5    "/>

                        <polygon fill="#231F20" points="341.279,5 350.615,12.842 351.047,12.741 341.831,5   "/>

                        <polygon fill="#231F20" points="353.569,10.627 346.872,5 346.32,5 353.14,10.728     "/>

                        <polygon fill="#231F20" points="356.052,8.441 351.958,5 351.406,5 355.622,8.542     "/>

                        <polygon fill="#231F20" points="358.472,6.223 357.017,5 356.464,5 358.042,6.324     "/>

                        <polygon fill="#231F20" points="360.548,5 351.664,13 352.206,13 361.091,5   "/>

                        <polygon fill="#231F20" points="365.688,5 356.802,13 357.347,13 366.231,5   "/>

                        <polygon fill="#231F20" points="371.27,5 370.829,5 361.942,13 362.485,13 371.351,5.018  "/>

                        <polygon fill="#231F20" points="372.988,7.684 367.083,13 367.626,13 372.988,8.172 372.988,8.174 378.733,13 379.284,13

                            372.988,7.711   "/>

                        <polygon fill="#231F20" points="372.988,11.025 370.794,13 371.337,13 372.988,11.514 372.988,11.547 374.718,13 375.269,13

                            372.988,11.085  "/>

                        <polygon fill="#231F20" points="374.394,5 383.917,13 384.468,13 374.945,5   "/>

                        <polygon fill="#231F20" points="379.774,5 389.3,13 389.85,13 380.325,5  "/>

                        <polygon fill="#231F20" points="384.824,5 394.16,12.842 394.592,12.741 385.376,5    "/>

                        <polygon fill="#231F20" points="397.114,10.627 390.417,5 389.865,5 396.685,10.728   "/>

                        <polygon fill="#231F20" points="399.597,8.441 395.503,5 394.951,5 399.167,8.542     "/>

                        <polygon fill="#231F20" points="402.017,6.223 400.562,5 400.009,5 401.587,6.324     "/>

                        <polygon fill="#231F20" points="404.093,5 395.209,13 395.751,13 404.636,5   "/>

                        <polygon fill="#231F20" points="409.233,5 400.347,13 400.892,13 409.776,5   "/>

                        <polygon fill="#231F20" points="414.814,5 414.374,5 405.487,13 406.03,13 414.896,5.018  "/>

                        <polygon fill="#231F20" points="416.533,7.684 410.628,13 411.171,13 416.533,8.172 416.533,8.174 422.278,13 422.829,13

                            416.533,7.711   "/>

                        <polygon fill="#231F20" points="416.533,11.025 414.339,13 414.882,13 416.533,11.514 416.533,11.547 418.263,13 418.813,13

                            416.533,11.085  "/>

                        <polygon fill="#231F20" points="417.938,5 427.462,13 428.013,13 418.49,5    "/>

                        <polygon fill="#231F20" points="423.319,5 432.845,13 433.395,13 423.87,5    "/>

                        <polygon fill="#231F20" points="428.369,5 437.705,12.842 438.137,12.741 428.921,5   "/>

                        <polygon fill="#231F20" points="440.659,10.627 433.962,5 433.41,5 440.229,10.728    "/>

                        <polygon fill="#231F20" points="443.142,8.441 439.048,5 438.496,5 442.712,8.542     "/>

                        <polygon fill="#231F20" points="445.562,6.223 444.106,5 443.554,5 445.132,6.324     "/>

                        <polygon fill="#231F20" points="447.638,5 438.754,13 439.296,13 448.181,5   "/>

                        <polygon fill="#231F20" points="452.778,5 443.892,13 444.437,13 453.321,5   "/>

                        <polygon fill="#231F20" points="458.359,5 457.919,5 449.032,13 449.575,13 458.44,5.018  "/>

                        <polygon fill="#231F20" points="460.078,7.684 454.173,13 454.716,13 460.078,8.172 460.078,8.174 465.823,13 466.374,13

                            460.078,7.711   "/>

                        <polygon fill="#231F20" points="460.078,11.025 457.884,13 458.427,13 460.078,11.514 460.078,11.547 461.808,13 462.358,13

                            460.078,11.085  "/>

                        <polygon fill="#231F20" points="461.483,5 471.007,13 471.558,13 462.035,5   "/>

                        <polygon fill="#231F20" points="466.864,5 476.39,13 476.939,13 467.415,5    "/>

                        <polygon fill="#231F20" points="471.914,5 481.25,12.842 481.682,12.741 472.466,5    "/>

                        <polygon fill="#231F20" points="484.204,10.627 477.507,5 476.955,5 483.774,10.728   "/>

                        <polygon fill="#231F20" points="486.687,8.441 482.593,5 482.041,5 486.257,8.542     "/>

                        <polygon fill="#231F20" points="489.106,6.223 487.651,5 487.099,5 488.677,6.324     "/>

                        <polygon fill="#231F20" points="491.183,5 482.299,13 482.841,13 491.726,5   "/>

                        <polygon fill="#231F20" points="496.323,5 487.437,13 487.981,13 496.866,5   "/>

                        <polygon fill="#231F20" points="501.904,5 501.464,5 492.577,13 493.12,13 501.985,5.018  "/>

                        <polygon fill="#231F20" points="503.623,7.684 497.718,13 498.261,13 503.623,8.172 503.623,8.174 509.368,13 509.919,13

                            503.623,7.711   "/>

                        <polygon fill="#231F20" points="503.623,11.025 501.429,13 501.972,13 503.623,11.514 503.623,11.547 505.353,13 505.903,13

                            503.623,11.085  "/>

                        <polygon fill="#231F20" points="505.028,5 514.552,13 515.103,13 505.58,5    "/>

                        <polygon fill="#231F20" points="510.409,5 519.935,13 520.484,13 510.96,5    "/>

                        <polygon fill="#231F20" points="515.459,5 524.795,12.842 525.227,12.741 516.011,5   "/>

                        <polygon fill="#231F20" points="527.749,10.627 521.052,5 520.5,5 527.319,10.728     "/>

                        <polygon fill="#231F20" points="530.231,8.441 526.138,5 525.586,5 529.802,8.542     "/>

                        <polygon fill="#231F20" points="532.651,6.223 531.196,5 530.644,5 532.222,6.324     "/>

                        <polygon fill="#231F20" points="534.728,5 525.844,13 526.386,13 535.271,5   "/>

                        <polygon fill="#231F20" points="539.868,5 530.981,13 531.526,13 540.411,5   "/>

                        <polygon fill="#231F20" points="545.449,5 545.009,5 536.122,13 536.665,13 545.53,5.018  "/>

                        <polygon fill="#231F20" points="547.168,7.684 541.263,13 541.806,13 547.168,8.172 547.168,8.174 552.913,13 553.464,13

                            547.168,7.711   "/>

                        <polygon fill="#231F20" points="547.168,11.025 544.974,13 545.517,13 547.168,11.514 547.168,11.547 548.897,13 549.448,13

                            547.168,11.085  "/>

                        <polygon fill="#231F20" points="548.573,5 558.097,13 558.647,13 549.125,5   "/>

                        <polygon fill="#231F20" points="553.954,5 563.479,13 564.029,13 554.505,5   "/>

                        <polygon fill="#231F20" points="559.004,5 568.34,12.842 568.771,12.741 559.556,5    "/>

                        <polygon fill="#231F20" points="571.294,10.627 564.597,5 564.045,5 570.864,10.728   "/>

                        <polygon fill="#231F20" points="573.776,8.441 569.683,5 569.131,5 573.347,8.542     "/>

                        <polygon fill="#231F20" points="576.196,6.223 574.741,5 574.188,5 575.767,6.324     "/>

                        <polygon fill="#231F20" points="578.272,5 569.389,13 569.931,13 578.815,5   "/>

                        <polygon fill="#231F20" points="583.413,5 574.526,13 575.071,13 583.956,5   "/>

                        <polygon fill="#231F20" points="588.994,5 588.554,5 579.667,13 580.21,13 589.075,5.018  "/>

                        <polygon fill="#231F20" points="590.713,7.684 584.808,13 585.351,13 590.713,8.172 590.713,8.174 596.458,13 597.009,13

                            590.713,7.711   "/>

                        <polygon fill="#231F20" points="590.713,11.025 588.519,13 589.062,13 590.713,11.514 590.713,11.547 592.442,13 592.993,13

                            590.713,11.085  "/>

                        <polygon fill="#231F20" points="592.118,5 601.642,13 602.192,13 592.67,5    "/>

                        <polygon fill="#231F20" points="597.499,5 607.024,13 607.574,13 598.05,5    "/>

                        <polygon fill="#231F20" points="602.549,5 611.885,12.842 612.316,12.741 603.101,5   "/>

                        <polygon fill="#231F20" points="614.839,10.627 608.142,5 607.59,5 614.409,10.728    "/>

                        <polygon fill="#231F20" points="617.321,8.441 613.228,5 612.676,5 616.892,8.542     "/>

                        <polygon fill="#231F20" points="619.741,6.223 618.286,5 617.733,5 619.312,6.324     "/>

                        <polygon fill="#231F20" points="621.817,5 612.934,13 613.476,13 622.36,5    "/>

                        <polygon fill="#231F20" points="626.958,5 618.071,13 618.616,13 627.501,5   "/>

                        <polygon fill="#231F20" points="632.539,5 632.099,5 623.212,13 623.755,13 632.62,5.018  "/>

                        <polygon fill="#231F20" points="634.258,7.684 628.353,13 628.896,13 634.258,8.172 634.258,8.174 640.003,13 640.554,13

                            634.258,7.711   "/>

                        <polygon fill="#231F20" points="634.258,11.025 632.063,13 632.606,13 634.258,11.514 634.258,11.547 635.987,13 636.538,13

                            634.258,11.085  "/>

                        <polygon fill="#231F20" points="635.663,5 645.187,13 645.737,13 636.215,5   "/>

                        <polygon fill="#231F20" points="641.044,5 650.569,13 651.119,13 641.595,5   "/>

                        <polygon fill="#231F20" points="646.094,5 655.43,12.842 655.861,12.741 646.646,5    "/>

                        <polygon fill="#231F20" points="658.384,10.627 651.687,5 651.135,5 657.954,10.728   "/>

                        <polygon fill="#231F20" points="660.866,8.441 656.772,5 656.221,5 660.437,8.542     "/>

                        <polygon fill="#231F20" points="663.286,6.223 661.831,5 661.278,5 662.856,6.324     "/>

                        <polygon fill="#231F20" points="665.362,5 656.479,13 657.021,13 665.905,5   "/>

                        <polygon fill="#231F20" points="670.503,5 661.616,13 662.161,13 671.046,5   "/>

                        <polygon fill="#231F20" points="676.084,5 675.644,5 666.757,13 667.3,13 676.165,5.018   "/>

                        <polygon fill="#231F20" points="677.803,7.684 671.897,13 672.44,13 677.803,8.172 677.803,8.174 683.548,13 684.099,13

                            677.803,7.711   "/>

                        <polygon fill="#231F20" points="677.803,11.025 675.608,13 676.151,13 677.803,11.514 677.803,11.547 679.532,13 680.083,13

                            677.803,11.085  "/>

                        <polygon fill="#231F20" points="679.208,5 688.731,13 689.282,13 679.76,5    "/>

                        <polygon fill="#231F20" points="684.589,5 694.114,13 694.664,13 685.14,5    "/>

                        <polygon fill="#231F20" points="689.639,5 698.975,12.842 699.406,12.741 690.19,5    "/>

                        <polygon fill="#231F20" points="701.929,10.627 695.231,5 694.68,5 701.499,10.728    "/>

                        <polygon fill="#231F20" points="704.411,8.441 700.317,5 699.766,5 703.981,8.542     "/>

                        <polygon fill="#231F20" points="706.831,6.223 705.376,5 704.823,5 706.401,6.324     "/>

                        <polygon fill="#231F20" points="708.907,5 700.023,13 700.565,13 709.45,5    "/>

                        <polygon fill="#231F20" points="714.048,5 705.161,13 705.706,13 714.591,5   "/>

                        <polygon fill="#231F20" points="719.629,5 719.188,5 710.302,13 710.845,13 719.71,5.018  "/>

                        <polygon fill="#231F20" points="721.348,7.684 715.442,13 715.985,13 721.348,8.172 721.348,8.174 727.093,13 727.644,13

                            721.348,7.711   "/>

                        <polygon fill="#231F20" points="721.348,11.025 719.153,13 719.696,13 721.348,11.514 721.348,11.547 723.077,13 723.628,13

                            721.348,11.085  "/>

                        <polygon fill="#231F20" points="722.753,5 732.276,13 732.827,13 723.305,5   "/>

                        <polygon fill="#231F20" points="728.134,5 737.659,13 738.209,13 728.685,5   "/>

                        <polygon fill="#231F20" points="733.184,5 742.52,12.842 742.951,12.741 733.735,5    "/>

                        <polygon fill="#231F20" points="745.474,10.627 738.776,5 738.225,5 745.044,10.728   "/>

                        <polygon fill="#231F20" points="747.956,8.441 743.862,5 743.311,5 747.526,8.542     "/>

                        <polygon fill="#231F20" points="750.376,6.223 748.921,5 748.368,5 749.946,6.324     "/>

                        <polygon fill="#231F20" points="752.452,5 743.568,13 744.11,13 752.995,5    "/>

                        <polygon fill="#231F20" points="757.593,5 748.706,13 749.251,13 758.136,5   "/>

                        <polygon fill="#231F20" points="763.174,5 762.733,5 753.847,13 754.39,13 763.255,5.018  "/>

                        <polygon fill="#231F20" points="764.893,7.684 758.987,13 759.53,13 764.893,8.172 764.893,8.174 770.638,13 771.188,13

                            764.893,7.711   "/>

                        <polygon fill="#231F20" points="764.893,11.025 762.698,13 763.241,13 764.893,11.514 764.893,11.547 766.622,13 767.173,13

                            764.893,11.085  "/>

                        <polygon fill="#231F20" points="766.298,5 775.821,13 776.372,13 766.85,5    "/>

                        <polygon fill="#231F20" points="771.679,5 781.204,13 781.754,13 772.229,5   "/>

                        <polygon fill="#231F20" points="776.729,5 786.064,12.842 786.496,12.741 777.28,5    "/>

                        <polygon fill="#231F20" points="789.019,10.627 782.321,5 781.77,5 788.589,10.728    "/>

                        <polygon fill="#231F20" points="791.501,8.441 787.407,5 786.855,5 791.071,8.542     "/>

                        <polygon fill="#231F20" points="793.921,6.223 792.466,5 791.913,5 793.491,6.324     "/>

                        <polygon fill="#231F20" points="795.997,5 787.113,13 787.655,13 796.54,5    "/>

                        <polygon fill="#231F20" points="801.138,5 792.251,13 792.796,13 801.681,5   "/>

                        <polygon fill="#231F20" points="806.719,5 806.278,5 797.392,13 797.935,13 806.8,5.018   "/>

                        <polygon fill="#231F20" points="808.438,7.684 802.532,13 803.075,13 808.438,8.172 808.438,8.174 814.183,13 814.733,13

                            808.438,7.711   "/>

                        <polygon fill="#231F20" points="808.438,11.025 806.243,13 806.786,13 808.438,11.514 808.438,11.547 810.167,13 810.718,13

                            808.438,11.085  "/>

                        <polygon fill="#231F20" points="809.843,5 819.366,13 819.917,13 810.395,5   "/>

                        <polygon fill="#231F20" points="815.224,5 824.749,13 825.299,13 815.774,5   "/>

                        <polygon fill="#231F20" points="820.273,5 829.609,12.842 830.041,12.741 820.825,5   "/>

                        <polygon fill="#231F20" points="832.563,10.627 825.866,5 825.314,5 832.134,10.728   "/>

                        <polygon fill="#231F20" points="835.046,8.441 830.952,5 830.4,5 834.616,8.542   "/>

                        <polygon fill="#231F20" points="837.466,6.223 836.011,5 835.458,5 837.036,6.324     "/>

                        <polygon fill="#231F20" points="839.542,5 830.658,13 831.2,13 840.085,5     "/>

                        <polygon fill="#231F20" points="844.683,5 835.796,13 836.341,13 845.226,5   "/>

                        <polygon fill="#231F20" points="850.264,5 849.823,5 840.937,13 841.479,13 850.345,5.018     "/>

                        <polygon fill="#231F20" points="851.982,7.684 846.077,13 846.62,13 851.982,8.172 851.982,8.174 857.728,13 858.278,13

                            851.982,7.711   "/>

                        <polygon fill="#231F20" points="851.982,11.025 849.788,13 850.331,13 851.982,11.514 851.982,11.547 853.712,13 854.263,13

                            851.982,11.085  "/>

                        <polygon fill="#231F20" points="853.388,5 862.911,13 863.462,13 853.939,5   "/>

                        <polygon fill="#231F20" points="858.769,5 868.294,13 868.844,13 859.319,5   "/>

                        <polygon fill="#231F20" points="863.818,5 873.154,12.842 873.586,12.741 864.37,5    "/>

                        <polygon fill="#231F20" points="876.108,10.627 869.411,5 868.859,5 875.679,10.728   "/>

                        <polygon fill="#231F20" points="878.591,8.441 874.497,5 873.945,5 878.161,8.542     "/>

                        <polygon fill="#231F20" points="881.011,6.223 879.556,5 879.003,5 880.581,6.324     "/>

                        <polygon fill="#231F20" points="883.087,5 874.203,13 874.745,13 883.63,5    "/>

                        <polygon fill="#231F20" points="888.228,5 879.341,13 879.886,13 888.771,5   "/>

                        <polygon fill="#231F20" points="893.809,5 893.368,5 884.481,13 885.024,13 893.89,5.018  "/>

                        <polygon fill="#231F20" points="895.527,7.684 889.622,13 890.165,13 895.527,8.172 895.527,8.174 901.272,13 901.823,13

                            895.527,7.711   "/>

                        <polygon fill="#231F20" points="895.527,11.025 893.333,13 893.876,13 895.527,11.514 895.527,11.547 897.257,13 897.808,13

                            895.527,11.085  "/>

                        <polygon fill="#231F20" points="896.933,5 906.456,13 907.007,13 897.484,5   "/>

                        <polygon fill="#231F20" points="902.313,5 911.839,13 912.389,13 902.864,5   "/>

                        <polygon fill="#231F20" points="907.363,5 916.699,12.842 917.131,12.741 907.915,5   "/>

                        <polygon fill="#231F20" points="919.653,10.627 912.956,5 912.404,5 919.224,10.728   "/>

                        <polygon fill="#231F20" points="922.136,8.441 918.042,5 917.49,5 921.706,8.542  "/>

                        <polygon fill="#231F20" points="924.556,6.223 923.101,5 922.548,5 924.126,6.324     "/>

                        <polygon fill="#231F20" points="926.632,5 917.748,13 918.29,13 927.175,5    "/>

                        <polygon fill="#231F20" points="931.772,5 922.886,13 923.431,13 932.315,5   "/>

                        <polygon fill="#231F20" points="937.354,5 936.913,5 928.026,13 928.569,13 937.435,5.018     "/>

                        <polygon fill="#231F20" points="939.072,7.684 933.167,13 933.71,13 939.072,8.172 939.072,8.174 944.817,13 945.368,13

                            939.072,7.711   "/>

                        <polygon fill="#231F20" points="939.072,11.025 936.878,13 937.421,13 939.072,11.514 939.072,11.547 940.802,13 941.353,13

                            939.072,11.085  "/>

                        <polygon fill="#231F20" points="940.478,5 950.001,13 950.552,13 941.029,5   "/>

                        <polygon fill="#231F20" points="945.858,5 955.384,13 955.934,13 946.409,5   "/>

                        <polygon fill="#231F20" points="950.908,5 960.244,12.842 960.676,12.741 951.46,5    "/>

                        <polygon fill="#231F20" points="963.198,10.627 956.501,5 955.949,5 962.769,10.728   "/>

                        <polygon fill="#231F20" points="965.681,8.441 961.587,5 961.035,5 965.251,8.542     "/>

                        <polygon fill="#231F20" points="968.101,6.223 966.646,5 966.093,5 967.671,6.324     "/>

                        <polygon fill="#231F20" points="970.177,5 961.293,13 961.835,13 970.72,5    "/>

                        <polygon fill="#231F20" points="975.317,5 966.431,13 966.976,13 975.86,5    "/>

                        <polygon fill="#231F20" points="980.898,5 980.458,5 971.571,13 972.114,13 980.979,5.018     "/>

                        <polygon fill="#231F20" points="982.617,7.684 976.712,13 977.255,13 982.617,8.172 982.617,8.174 988.362,13 988.913,13

                            982.617,7.711   "/>

                        <polygon fill="#231F20" points="982.617,11.025 980.423,13 980.966,13 982.617,11.514 982.617,11.547 984.347,13 984.897,13

                            982.617,11.085  "/>

                        <polygon fill="#231F20" points="984.022,5 993.546,13 994.097,13 984.574,5   "/>

                        <polygon fill="#231F20" points="989.403,5 998.929,13 999.479,13 989.954,5   "/>

                        <polygon fill="#231F20" points="994.453,5 1003.789,12.842 1004.221,12.741 995.005,5     "/>

                        <polygon fill="#231F20" points="1006.743,10.627 1000.046,5 999.494,5 1006.313,10.728    "/>

                        <polygon fill="#231F20" points="1009.226,8.441 1005.132,5 1004.58,5 1008.796,8.542  "/>

                        <polygon fill="#231F20" points="1011.646,6.223 1010.19,5 1009.638,5 1011.216,6.324  "/>

                        <polygon fill="#231F20" points="1013.722,5 1004.838,13 1005.38,13 1014.265,5    "/>

                        <polygon fill="#231F20" points="1018.862,5 1009.976,13 1010.521,13 1019.405,5   "/>

                        <polygon fill="#231F20" points="1024.443,5 1024.003,5 1015.116,13 1015.659,13 1024.524,5.018    "/>

                        <polygon fill="#231F20" points="1026.162,7.684 1020.257,13 1020.8,13 1026.162,8.172 1026.162,8.174 1031.907,13 1032.458,13

                            1026.162,7.711  "/>

                        <polygon fill="#231F20" points="1026.162,11.025 1023.968,13 1024.511,13 1026.162,11.514 1026.162,11.547 1027.892,13

                            1028.442,13 1026.162,11.085     "/>

                        <polygon fill="#231F20" points="1027.567,5 1037.091,13 1037.642,13 1028.119,5   "/>

                        <polygon fill="#231F20" points="1032.948,5 1042.474,13 1043.023,13 1033.499,5   "/>

                        <polygon fill="#231F20" points="1037.998,5 1047.334,12.842 1047.766,12.741 1038.55,5    "/>

                        <polygon fill="#231F20" points="1050.288,10.627 1043.591,5 1043.039,5 1049.858,10.728   "/>

                        <polygon fill="#231F20" points="1052.771,8.441 1048.677,5 1048.125,5 1052.341,8.542     "/>

                        <polygon fill="#231F20" points="1055.19,6.223 1053.735,5 1053.183,5 1054.761,6.324  "/>

                        <polygon fill="#231F20" points="1057.267,5 1048.383,13 1048.925,13 1057.81,5    "/>

                        <polygon fill="#231F20" points="1062.407,5 1053.521,13 1054.065,13 1062.95,5    "/>

                        <polygon fill="#231F20" points="1067.988,5 1067.548,5 1058.661,13 1059.204,13 1068.069,5.018    "/>

                        <polygon fill="#231F20" points="1069.707,7.684 1063.802,13 1064.345,13 1069.707,8.172 1069.707,8.174 1075.452,13 1076.003,13

                            1069.707,7.711  "/>

                        <polygon fill="#231F20" points="1069.707,11.025 1067.513,13 1068.056,13 1069.707,11.514 1069.707,11.547 1071.437,13

                            1071.987,13 1069.707,11.085     "/>

                        <polygon fill="#231F20" points="1071.112,5 1080.636,13 1081.187,13 1071.664,5   "/>

                        <polygon fill="#231F20" points="1076.493,5 1086.019,13 1086.568,13 1077.044,5   "/>

                        <polygon fill="#231F20" points="1081.543,5 1090.879,12.842 1091.311,12.741 1082.095,5   "/>

                        <polygon fill="#231F20" points="1093.833,10.627 1087.136,5 1086.584,5 1093.403,10.728   "/>

                        <polygon fill="#231F20" points="1096.315,8.441 1092.222,5 1091.67,5 1095.886,8.542  "/>

                        <polygon fill="#231F20" points="1098.735,6.223 1097.28,5 1096.728,5 1098.306,6.324  "/>

                        <polygon fill="#231F20" points="1100.812,5 1091.928,13 1092.47,13 1101.354,5    "/>

                        <polygon fill="#231F20" points="1105.952,5 1097.065,13 1097.61,13 1106.495,5    "/>

                        <polygon fill="#231F20" points="1111.533,5 1111.093,5 1102.206,13 1102.749,13 1111.614,5.018    "/>

                        <polygon fill="#231F20" points="1113.252,7.684 1107.347,13 1107.89,13 1113.252,8.172 1113.252,8.174 1118.997,13 1119.548,13

                            1113.252,7.711  "/>

                        <polygon fill="#231F20" points="1113.252,11.025 1111.058,13 1111.601,13 1113.252,11.514 1113.252,11.547 1114.981,13

                            1115.532,13 1113.252,11.085     "/>

                        <polygon fill="#231F20" points="1114.657,5 1124.181,13 1124.731,13 1115.209,5   "/>

                        <polygon fill="#231F20" points="1120.038,5 1129.563,13 1130.113,13 1120.589,5   "/>

                        <polygon fill="#231F20" points="1125.088,5 1134.424,12.842 1134.855,12.741 1125.64,5    "/>

                        <polygon fill="#231F20" points="1137.378,10.627 1130.681,5 1130.129,5 1136.948,10.728   "/>

                        <polygon fill="#231F20" points="1139.86,8.441 1135.767,5 1135.215,5 1139.431,8.542  "/>

                        <polygon fill="#231F20" points="1142.28,6.223 1140.825,5 1140.272,5 1141.851,6.324  "/>

                        <polygon fill="#231F20" points="1144.356,5 1135.473,13 1136.015,13 1144.899,5   "/>

                        <polygon fill="#231F20" points="1149.497,5 1140.61,13 1141.155,13 1150.04,5     "/>

                        <polygon fill="#231F20" points="1155.078,5 1154.638,5 1145.751,13 1146.294,13 1155.159,5.018    "/>

                        <polygon fill="#231F20" points="1156.797,7.684 1150.892,13 1151.435,13 1156.797,8.172 1156.797,8.174 1162.542,13 1163.093,13

                            1156.797,7.711  "/>

                        <polygon fill="#231F20" points="1156.797,11.025 1154.603,13 1155.146,13 1156.797,11.514 1156.797,11.547 1158.526,13

                            1159.077,13 1156.797,11.085     "/>

                        <polygon fill="#231F20" points="1158.202,5 1167.726,13 1168.276,13 1158.754,5   "/>

                        <polygon fill="#231F20" points="1163.583,5 1173.108,13 1173.658,13 1164.134,5   "/>

                        <polygon fill="#231F20" points="1168.633,5 1177.969,12.842 1178.4,12.741 1169.185,5     "/>

                        <polygon fill="#231F20" points="1180.923,10.627 1174.226,5 1173.674,5 1180.493,10.728   "/>

                        <polygon fill="#231F20" points="1183.405,8.441 1179.312,5 1178.76,5 1182.976,8.542  "/>

                        <polygon fill="#231F20" points="1185.825,6.223 1184.37,5 1183.817,5 1185.396,6.324  "/>

                        <polygon fill="#231F20" points="1187.901,5 1179.018,13 1179.56,13 1188.444,5    "/>

                        <polygon fill="#231F20" points="1193.042,5 1184.155,13 1184.7,13 1193.585,5     "/>

                        <polygon fill="#231F20" points="1189.296,13 1189.839,13 1194.629,8.688 1194.629,8.199   "/>

                        <polygon fill="#231F20" points="1194.629,13 1194.629,12.827 1194.437,13     "/>

                    </g>

                  </svg>';

            $html .= '</div>'; // end .df-related-post

        endif;

        wp_reset_postdata();

        print( $html );

    }

    add_action( 'df_post_bottom', 'df_related_post', 40 );

}

if ( !function_exists( 'df_summary_type' ) ) {

    function df_summary_type() {

        $summary_type = get_theme_mod( 'df_summary_type', 'excerpt' );
        $blog_layout  = get_theme_mod( 'df_blog_layout', 'fit_2_col' );
        $arch_layout  = get_theme_mod( 'df_arch_layout', 'fit_2_col' );

        if ( ( ( is_archive() || is_search() ) && $arch_layout == 'standard' ) || ( ( is_home() || is_front_page() ) && $blog_layout == 'standard' ) ) {

            switch ( $summary_type ) {

                case 'excerpt':

                    $html = the_excerpt();

                    break;

                default:

                    $html = the_content( esc_attr__( 'Continue Reading', 'applique' ) );

                    break;

            }

        } else {

            $html = the_excerpt();

        }

        return $html;

    }

}



if ( !function_exists('df_post_icons') ) {

    function df_post_icons() {

        global $post;

        $html     = '';

        $blog_std = ( get_theme_mod( 'df_blog_layout', 'fit_2_col' ) == 'standard' ); // Blog Layout
        $arch_std = ( get_theme_mod( 'df_arch_layout', 'fit_2_col' ) == 'standard' ); // Archive Layout
        $blog_pg  = ( is_home() || is_front_page() ); // Blog Page
        $arch_pg  = ( is_archive() ); // Archive Page
        $format   = get_post_format();

        if ( $blog_std != 'standard' || $arch_std != 'standard' ) {

            if ( $format == 'audio' ) {

                $html .= '<span class="posts-icon">';

                $html .= '<i class="ion-ios-musical-notes"></i>';

                $html .= '</span>';

            } elseif ( $format == 'gallery'  ) {

                $html .= '<span class="posts-icon">';

                $html .= '<i class="ion-ios-camera"></i>';

                $html .= '</span>';

            } elseif ( $format == 'video' ) {

                $html .= '<span class="posts-icon">';

                $html .= '<i class="ion-ios-play"></i>';

                $html .= '</span>';

            }



            return $html;

        }

    }

}