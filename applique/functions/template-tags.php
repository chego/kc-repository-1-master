<?php

if ( !defined( 'ABSPATH' ) ) { exit; }


if ( !function_exists( 'df_posted_author' ) ) {

    /**
     * Prints HTML with meta information for the current post-author.
     */
    function df_posted_author() {
        return sprintf(
			'<span ' . dahz_get_attr( 'entry-author' ) . '><a href="%1$s" itemprop="url"><span itemprop="name">%2$s</span></a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			get_the_author()
		);

    }

}

if ( !function_exists( 'df_posted_on' ) ) {

    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function df_posted_on() {
        if ( get_theme_mod( 'df_hide_date', 0 ) == 1 ) return;

    	$post_date = sprintf( '<meta itemprop="datePublished" content="%1$s">%1$s', get_the_date() );

		$post_date = sprintf(
			'<time ' . dahz_get_attr( 'entry-published' ) . '><a href="%1$s">%2$s</a></time>',
			get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ),
			$post_date
		);

    	return $post_date;
    }

}

if ( !function_exists( 'df_posted_comment' ) ) {

    /**
     * Prints HTML with meta information for the current post-comment.
     */
    function df_posted_comment() {
        if ( get_theme_mod( 'df_hide_comment_link', 0 ) == 1 ) return;

        global $post;

        if ( !function_exists( 'dsq_options' ) ) {

            if ( get_comments_number( $post->ID ) == 0 ) {
                $comments = esc_attr__( 'No Comments', 'applique' );
            } elseif ( get_comments_number( $post->ID ) > 1 ) {
                $comments = sprintf( '<span class="num-big">%1$s</span><span class="text-com">%2$s</span>', get_comments_number( $post->ID ), esc_attr__( ' Comments', 'applique' ) );
            } else {
                $comments = sprintf( '<span class="num-big">%1$s</span><span class="text-com">%2$s</span>', esc_attr__( '1', 'applique' ), esc_attr__( ' Comment', 'applique' ) );
            }

            if ( comments_open() ) :
                return sprintf( '<span itemtype="http://schema.org/Comment" itemscope="itemscope" itemprop="comment"><a %1$s>%2$s</a></span>',
                                 dahz_get_attr( 'comment-permalink' ),
                                 $comments
                       );
            endif;

        } else {
            if ( comments_open() ) {

            $comments = esc_attr__( '0 Comments', 'applique' );
            return sprintf( '<span itemtype="http://schema.org/Comment" itemscope="itemscope" itemprop="comment" class="disqus-comment-count"><a href="%1$s#disqus_thread">%2$s</a></span>', get_the_permalink( get_the_ID() ), $comments );
            }
        }

    }

}

if ( !function_exists( 'df_blog_tags' ) ) {

	/**
     * Prints HTML with meta information for the current post-tags.
     */
    function df_blog_tags() {

        if ( get_theme_mod( 'df_hide_tags', 0 ) == 1 ) return;

        $tags = get_the_tag_list( '<span ' . dahz_get_attr( 'entry-terms', 'post_tag' ) . '>', '', '</span>' );

        if ( $tags != '' )
            return $tags;

    }

}

if ( !function_exists( 'df_category_blog' ) ) {

	/**
     * Prints HTML with meta information for the current post-category.
     */
	function df_category_blog() {
        if ( get_theme_mod( 'df_hide_category', 0 ) == 1 ) return;

        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list( ', ' );

        // if ( df_categorized_blog() && $categories_list ) {
            return sprintf( '<span %1$s>%2$s</span>', dahz_get_attr( 'entry-terms', 'category' ), $categories_list );
        // }

	}

}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function df_categorized_blog() {

    if ( false === ( $all_the_cool_cats = get_transient( 'df_categories' ) ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
            'fields'     => 'ids',
            'hide_empty' => 1,
            // We only need to know if there is more than one category.
            'number'     => 2,
        ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'df_categories', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so prototype_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so prototype_categorized_blog should return false.
        return false;
    }
}

/**
 * Flush out the transients used in df_categorized_blog
 */
function df_category_transient_flusher() {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient( 'df_categories' );
}

if ( !function_exists( 'df_share' ) ) {

    /**
     * Build html share for post/page
     *
     * @return string
     */
    function df_share() {

        $post_type = get_post_type();
        $hide_post = get_theme_mod( 'df_hide_share', 0 ) == 1;
        $hide_page = get_theme_mod( 'df_share_page', 0 ) == 1;

        if ( ( $post_type == 'page' && $hide_page ) || ( $post_type == 'post' && $hide_post ) ) return;

        if ( class_exists( 'Sharing_Service' ) ) {
            $html  = sharing_display();
        } else {
            $pin_img = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );

            $html  = '<ul class="df-share">';
            $html .= sprintf( '<li><span>%s</span></li>', esc_attr__( 'Share', 'applique' ) );
            $html .= '<li><a class="df-facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '"><i class="fa fa-facebook"></i><i class="fa fa-facebook"></i></a></li>';
            $html .= '<li><a class="df-twitter" target="_blank" href="https://twitter.com/home?status=Check%20out%20this%20article:%20' . urlencode( get_the_title() ) . '%20-%20' . get_the_permalink() . '"><i class="fa fa-twitter"></i><i class="fa fa-twitter"></i></a></li>';
            $html .= '<li><a class="df-google" target="_blank" href="https://plus.google.com/share?url=' . get_the_permalink() . '"><i class="fa fa-google-plus"></i><i class="fa fa-google-plus"></i></a></li>';
            $html .= '<li><a class="df-pinterest" target="_blank" href="https://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '&amp;media=' . $pin_img . '&amp;description=' . urlencode( get_the_title() ) . '"><i class="fa fa-pinterest"></i><i class="fa fa-pinterest"></i></a></li>';
            $html .= '</ul>';

        }
        return $html;
    }

    function relocating_sharedaddy() {
        remove_filter( 'the_content', 'sharing_display', 19 );
        remove_filter( 'the_excerpt', 'sharing_display', 19 );
    }
    add_action( 'init', 'relocating_sharedaddy' );

}

if ( !function_exists( 'df_add_contact_user' ) ) {

    /**
     * Added new field in user page, such as `twitter`, `facebook`, and `instagram`.
     * This function hooked to `user_contactmethods`.
     *
     * @return void
     */
    function df_add_contact_user() {

        $contactmethods['twitter']   = esc_attr__( 'Twitter Username', 'applique' );
        $contactmethods['facebook']  = esc_attr__( 'Facebook Username', 'applique' );
        $contactmethods['instagram'] = esc_attr__( 'Instagram Username', 'applique' );

        return $contactmethods;
    }
    add_filter( 'user_contactmethods', 'df_add_contact_user', 10, 1 );

}

if ( !function_exists( 'df_excerpt_length' ) ) {

    /**
     * Define excerpt word number.
     *
     * @return integer
     */
    function df_excerpt_length( $length ) {
        if ( is_sticky() ) {
            if ( get_theme_mod( 'disable_sidebar_blog', 1 ) == 1 ) {
                return 150;
            } else {
                return 25;
            }
        } else {
            if ( get_theme_mod( 'df_skin', 'df-skin-boxed' ) == 'df-skin-boxed' && ( get_theme_mod( 'df_blog_layout', 'standard' ) == 'fit_2_col' || get_theme_mod( 'df_blog_layout', 'standard' ) == 'fit_3_col' ) ) {
                return 10;
            } elseif ( get_theme_mod( 'df_skin', 'df-skin-boxed' ) == 'df-skin-boxed' && ( get_theme_mod( 'df_blog_layout', 'standard' ) == 'list' || get_theme_mod( 'df_blog_layout', 'standard' ) == 'list_full' || get_theme_mod( 'df_arch_layout', 'standard' ) == 'list_full' ) ) {
                return 20;
            } else {
                return 55;
            }
        }
    }
    add_filter( 'excerpt_length', 'df_excerpt_length', 10, 1 );

}

if ( !function_exists( 'df_excerpt_more' ) ) {

    /**
     * Additional link to `the_excerpt` functions.
     *
     * @return string
     */
    function df_excerpt_more( $more ) {
        return ' &hellip; <a class="more-link" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">' . esc_attr__( 'Continue Reading', 'applique' ) . '<i class="ion-ios-arrow-thin-right"></i></a>';
    }

    add_filter( 'excerpt_more', 'df_excerpt_more' );

}

if ( !function_exists( 'df_social_account' ) ) {

    /**
     * Build floating social account.
     *
     * @param $echo outputing html use echo or return.
     */

    function df_social_account() {

        $facebook   = get_theme_mod( 'df_facebook', '#' );
        $twitter    = get_theme_mod( 'df_twitter', '#' );
        $instagram  = get_theme_mod( 'df_instagram', '#' );
        $pinterest  = get_theme_mod( 'df_pinterest', '#' );
        $bloglovin  = get_theme_mod( 'df_bloglovin', '#' );
        $gplus      = get_theme_mod( 'df_google_plus' );
        $tumblr     = get_theme_mod( 'df_tumblr' );
        $youtube    = get_theme_mod( 'df_youtube' );
        $dribble    = get_theme_mod( 'df_dribble' );
        $soundcloud = get_theme_mod( 'df_soundcloud' );
        $vimeo      = get_theme_mod( 'df_vimeo' );
        $linkedln   = get_theme_mod( 'df_linkedln' );
        $rss        = get_theme_mod( 'df_rss' );

        /* Print HTML Social Connect */
        $html  = '<div class="df-social-connect">';

        /* facebook */
        if ( $facebook != '' ) {
            $html .= '<a class="df-facebook" href="' . esc_url( $facebook ) . '" target="_blank"><i class="fa fa-facebook"></i><span class="social-text">Facebook</span></a>';
        }
        /* twitter */
        if ( $twitter != '' ) {
            $html .= '<a class="df-twitter" href="' . esc_url( $twitter ) . '" target="_blank"><i class="fa fa-twitter"></i><span class="social-text">Twitter</span></a>';
        }

        /* instagram */
        if ( $instagram != '' ) {
            $html .= '<a class="df-instagram" href="' . esc_url( $instagram ) . '" target="_blank"><i class="fa fa-instagram"></i><span class="social-text">Instagram</span></a>';
        }

        /* pinterest */
        if ( $pinterest != '' ) {
            $html .= '<a class="df-pinterest" href="' . esc_url( $pinterest ) . '" target="_blank"><i class="fa fa-pinterest"></i><span class="social-text">pinterest</span></a>';
        }

        /* bloglovin */
        if ( $bloglovin != '' ) {
            $html .= '<a class="df-bloglovin" href="' . esc_url( $bloglovin ) . '" target="_blank"><i class="fa fa-heart"></i><span class="social-text">Bloglovin</span></a>';
        }

        /* gplus */
        if ( $gplus != '' ) {
            $html .= '<a class="df-gplus" href="' . esc_url( $gplus ) . '" target="_blank"><i class="fa fa-google-plus"></i><span class="social-text">Google+</span></a>';
        }

        /* tumblr */
        if ( $tumblr != '' ) {
            $html .= '<a class="df-tumblr" href="' . esc_url( $tumblr ) . '" target="_blank"><i class="fa fa-tumblr"></i><span class="social-text">Tumblr</span></a>';
        }

        /* youtube */
        if ( $youtube != '' ) {
            $html .= '<a class="df-youtube" href="' . esc_url( $youtube ) . '" target="_blank"><i class="fa fa-youtube"></i><span class="social-text">Youtube</span></a>';
        }

        /* dribble */
        if ( $dribble != '' ) {
            $html .= '<a class="df-dribble" href="' . esc_url( $dribble ) . '" target="_blank"><i class="fa fa-dribbble"></i><span class="social-text">Dribble</span></a>';
        }

        /* soundcloud */
        if ( $soundcloud != '' ) {
            $html .= '<a class="df-soundcloud" href="' . esc_url( $soundcloud ) . '" target="_blank"><i class="fa fa-soundcloud"></i><span class="social-text">Soundcloud</span></a>';
        }

        /* vimeo */
        if ( $vimeo != '' ) {
            $html .= '<a class="df-vimeo" href="' . esc_url( $vimeo ) . '" target="_blank"><i class="fa fa-vimeo"></i><span class="social-text">Vimeo</span></a>';
        }

        /* linkedln */
        if ( $linkedln != '' ) {
            $html .= '<a class="df-linkedln" href="' . esc_url( $linkedln ) . '" target="_blank"><i class="fa fa-linkedin"></i><span class="social-text">Linkedin</span></a>';
        }

        /* rss */
        if ( $rss != '' ) {
            $html .= '<a class="df-rss" href="' . esc_url( $rss ) . '" target="_blank"><i class="fa fa-rss"></i><span class="social-text">RSS</span></a>';
        }

        $html .= '</div>'; // end .df-social-connect

        return $html;

    }

}

if ( !function_exists( 'df_affiliate' ) ) {
    function df_affiliate() {
        global $post;

        $affliate_title = get_post_meta( $post->ID, 'df_affiliate_title', true );
        $affliate_embed = get_post_meta( $post->ID, 'df_affiliate_embed', true );

        if ( $affliate_embed == '' ) return;

        /* Filter the output */
        $allowed1 = array(
            'em'     => array(),
            'strong' => array()
        );

        $allowed2 = array(
            'iframe' => array(
                'src'       => array(),
                'height'    => array(),
                'width'     => array(),
                'seamless'  => array(),
                'style'     => array(),
            ),
            'div'    => array(
                'class'         => array(),
                'data-options'  => array(),
                'data-widget-id' => array(),
            ),
            'script' => array(),
            'content'   => do_shortcode( get_the_content() ),
        );
        
        $val = '';
        if ( function_exists( 'shopthepost_show_widget' ) ) {
            $val = do_shortcode( $affliate_embed );
        } else {
            $val = wp_kses( $affliate_embed, $allowed2 );
        }

        $html  = '<div class="df-affiliate">';
        $html .= sprintf( '<h4 class="df-affiliate-title aligncenter"><span>%1$s</span></h4>', wp_kses( $affliate_title, $allowed1 ) );
        $html .= sprintf( '<div class="df-affiliate-content">%1$s</div>', $val );
        $html .= '</div>';

        return $html;

    }
}

if ( !function_exists( 'df_resize_tag_cloud_font' ) ) {
    /**
     * Resize the font of tag cloud widget.
     *
     * @return string
     */
    function df_resize_tag_cloud_font( $args ) {
        $args['smallest'] = .65;
        $args['largest']  = .65;
        $args['unit']     = 'em';

        return $args;
    }

    add_filter( 'widget_tag_cloud_args', 'df_resize_tag_cloud_font' );

}

if ( !function_exists( 'df_archives_add_span_cat_count' ) ) {
    /**
     * Add new css class to archive widget.
     *
     * @return string
     */
    function df_archives_add_span_cat_count( $link_html ) {
        $link_html = str_replace( '</a>&nbsp;(', '</a><span class="post-count">', $link_html );
        $link_html = str_replace( ')</li>', '</span></li>', $link_html );
        return $link_html;
    }

}
add_filter( 'get_archives_link', 'df_archives_add_span_cat_count' );

if ( !function_exists( 'df_category_add_span_cat_count' ) ) {
    /**
     * Add new css class to Category widget.
     *
     * @return string
     */
    function df_category_add_span_cat_count( $link_html ) {
        $link_html = str_replace( '(', ' <span class="post-count">', $link_html );
        $link_html = str_replace( ')', '</span>', $link_html );
        return $link_html;
    }

}
add_filter( 'wp_list_categories', 'df_category_add_span_cat_count' );

if ( ! function_exists('df_miscellaneous') ) {

    function df_miscellaneous() {
        $archive = get_theme_mod( 'df_archive_link', 'http://dahz.daffyhazan.com/applique/outfit/archives/' );
        $subcrip = get_theme_mod( 'df_subscription', '[mc4wp_form id=&quot;65&quot;]' );
        $subcrip = do_shortcode( $subcrip );

        $html = '<div class="df-misc-section">';
        // Search
        $html .= sprintf( '<a class="df-misc-search"><span class="df-misc-text">%s</span><i class="ion-ios-search-strong"></i></a>', esc_attr__( 'Search', 'applique' ) );

        // Subscription
        if ( $subcrip != '' )
            $html .= sprintf( '<a class="df-misc-mail"><span class="df-misc-text">%s</span><i class="ion-android-remove"></i></a>', esc_attr__( 'Subscribe', 'applique' ) );

        // Archive
        if ( $archive != '' )
            $html .= sprintf( '<a class="df-misc-archive" href="%1$s"><span class="df-misc-text">%2$s</span><i class="ion-android-remove"></i></a>', esc_url( $archive ), esc_attr__( 'Archive', 'applique' ) );

        $html .= '</div>'; // End Of Misc Section

        return $html;

    }

}

if ( function_exists( 'dsq_options' ) ) {
    function deregister_script_when_customizer_page() {
        if ( is_customize_preview() ) {
            wp_deregister_script( 'pointer_script' );
            wp_dequeue_script( 'pointer_script' );
        }
    }
    add_action( 'admin_print_footer_scripts', 'deregister_script_when_customizer_page', 999 );
}

/**
 * Validate the given data, assuming it is from a textarea field.
 *
 * @return  void
 * @since   1.5.0
 */
function dahz_sanitize_textarea ( $value, $key ) {
    // Allow iframe, object, embed, a, p, em, strong and img tags in textarea fields.
    $allowed = wp_kses_allowed_html( 'post' );
    $allowed['iframe'] = array('src' => true, 'width' => true, 'height' => true, 'id' => true, 'class' => true, 'name' => true );
    $allowed['object'] = array('src' => true, 'width' => true, 'height' => true, 'id' => true, 'class' => true, 'name' => true );
    $allowed['embed'] = array('src' => true, 'width' => true, 'height' => true, 'id' => true, 'class' => true, 'name' => true );
    $allowed['a'] = array('href' => true, 'class' => true, 'target' => true );
    $allowed['p'] = array('style' => true, 'class' => true );
    $allowed['img'] = array('src'   => true, 'alt'  => true );
    $allowed['em'] = array('class' => true );
    $allowed['strong'] = array();
    $allowed['script'] = array( 'type' => true, 'src' => true );
    return wp_kses( $value, $allowed );
}


if ( !function_exists( 'df_sponsored_textarea' ) ) {

    function df_sponsored_textarea() {
        global $post;

        $sponsored_text_embed = get_post_meta( $post->ID, 'df_sponsored_area', true );

        if ( $sponsored_text_embed == '' ) return;

        /* Filter the output */
        $allowed = array(
            'strong'    => array(
                'style' => array(
                    'text-decoration'   => array(),
                    'color'             => array()
                ),

            ),
            'em'    => array(
                'style' => array(
                    'text-decoration'   => array(),
                    'color'             => array()
                ),

            ),
            'del'    => array(
                'style' => array(
                    'text-decoration'   => array(),
                    'color'             => array()
                ),

            ),
            'span'    => array(
                'style' => array(
                    'text-decoration'   => array(),
                    'color'             => array()
                ),

            ),
            'a'    => array(
                'href'  => array(),
                'style' => array(
                    'text-decoration'   => array(),
                    'color'             => array()
                ),

            ),

        );

        $html  = '<div class="df-sponsored-text">';
        $html .= sprintf( '<div class="df-affiliate-content">%1$s</div>', wp_kses( $sponsored_text_embed, $allowed ) );
        $html .= '</div>';

        return $html;

    }
}

if ( !function_exists('df_jsonld_head') ) {

    add_action( 'wp_head', 'df_jsonld_head', 1 );
    function df_jsonld_head() {

        // Require Once file json to be regenerated on header
        foreach ( glob( get_template_directory() . "/libraries/jsonld/*.php" ) as $filename ) {
            require_once $filename;
        }

        ?>
        <script type="application/ld+json"><?php echo json_encode($ldWPhead); ?></script>
        <script type="application/ld+json"><?php echo json_encode($ldnewsArtc); ?></script>
        <?php
        if ( get_theme_mod( 'disable_sidebar_singular', 0 ) == 0 ) {
            ?>
            <script type="application/ld+json"><?php echo json_encode($ldWPside); ?></script>
            <?php
        }
        ?>
        <script type="application/ld+json"><?php echo json_encode($ldWPfoot); ?></script>
        <?php
    }

}