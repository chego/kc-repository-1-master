<?php
if ( !defined( 'ABSPATH' ) ) { exit; }

add_action( 'wp_head', 'df_ajax_custom_head' );

function df_ajax_custom_head() {
    echo '<script type="text/javascript">var ajaxurl = \'' . admin_url( 'admin-ajax.php' ) . '\';</script>';
}

if ( !function_exists( 'df_custom_top_element' ) ) {
    /**
     * Build top element in custom archive
     */
    function df_custom_top_element() {

        $args_category = array(
            'show_option_all' => esc_attr__( 'Select Category','applique' ),
            'hide_empty'      => 1,
            'taxonomy'        => 'category',
            'name'            => 'cat_select',
            'hide_if_empty'   => true,
            'echo'            => 0,
        );

        $args_archive = array(
            'echo'   => 0,
            'format' => 'option',
            'type'   => 'monthly',
            'order'  => 'DESC'
        );

        $rtl = is_rtl() ? 'rtl' : 'ltr';

        $html  = '<div class="custom-archive-top-element row">';
        $html .= '<div class="col-left col-md-4">';
        $html .= sprintf( '<h4>%1$s<span>%2$s</span></h4>', esc_attr__( 'You are viewing: ', 'applique' ), esc_attr__( 'All', 'applique' ) );
        $html .= '</div>'; // end .col-left
        $html .= '<div class="col-right col-md-8">';
        $html .= '<div class="row">';

        $html .= '<div class="col-md-4">';
        $html .= '<select name="cal_select" id="cal_select">';
        $html .= sprintf( '<option value="0">%s</option>', esc_attr__( 'Select Date', 'applique' ) );
        $html .= wp_get_archives( $args_archive );
        $html .= '</select>';
        $html .= '</div>';

        $html .= '<div class="col-md-4">';
        $html .= wp_dropdown_categories( $args_category );
        $html .= '</div>';

        $html .= '<div class="col-md-4">';
        $html .= sprintf( '<input type="text" id="searchfrm" name="search" placeholder="%1$s" value="" autocomplete="off" spellcheck="false" dir="%2$s">', esc_attr__( 'Search', 'applique' ), esc_attr( $rtl ) );
        $html .= '</div>';

        $html .= '</div>'; // end .row
        $html .= '</div>'; // end .col-right
        $html .= '</div>'; // end .custom-archive-top-element

        printf( $html );

    }

    add_action( 'top_element', 'df_custom_top_element' );
}

add_action( 'wp_ajax_df_post_custom_archive', 'df_post_custom_archive' );
add_action( 'wp_ajax_nopriv_df_post_custom_archive', 'df_post_custom_archive' );

if ( !function_exists( 'df_post_custom_archive' ) ) {

    /**
     * Print output post
     */
    function df_post_custom_archive() {
        global $post;

        $cal_select       = str_replace( "=", "", str_replace( " ", "", str_replace( "/", "", ltrim( $_POST['calendar_select'], home_url() . "?marchivesdate" ) ) ) );
        $cal_select_month = substr( $cal_select, -2 );
        $cal_select_year  = substr( $cal_select, 0, 4 );
        $post_show        = get_post_meta( get_the_ID(), 'df_custom_archive', true );

        $args = array(
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            's'                   => $_POST['s'],
            'cat'                 => $_POST['cat_select'],
            'showposts'           => -1,
            'suppress_filters'    => 0,
            'ignore_sticky_posts' => 1,
            'posts_per_page'      => esc_attr( $post_show ),
            'paged'               => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1,
        );

        if ( $cal_select != '0' ) {
            $args['date_query'][] = array(
                'year'  => $cal_select_year,
                'month' => $cal_select_month,
            );
        }

        $archive = new WP_Query( $args );

        if ( $archive->have_posts() ) :

            while ( $archive->have_posts()) : $archive->the_post(); ?>

                <div id="post-<?php the_ID() ?>" <?php post_class( 'col-md-3 custom-archive aligncenter' ); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost" role="article">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="featured-media">
                            <?php the_post_thumbnail( 'template-archive' ); ?>
                        </div>
                    <?php else : ?>
                        <div class="no-media" style="background-image: url( <?php echo get_template_directory_uri() . '/assets/images/placeholder.png'; ?> );"></div>
                    <?php endif; ?>

                    <div class="wrapper">

                        <div class="inner">
                            <div class="df-single-category">
                                <div <?php dahz_attr( 'entry-terms', 'category' ) ?>>
                                    <?php echo df_category( ',' ); ?>
                                </div>
                            </div>

                            <?php the_title( '<h4 class="entry-title" itemprop="headline"><a href="' . get_the_permalink() . '">', '</a></h4>' ); ?>

                            <a href="<?php the_permalink( get_the_ID() ); ?>" class="more-link outline small button">
                                <?php esc_html_e( 'Read More', 'applique' ); ?>
                                <i class="ion-ios-arrow-thin-right"></i>
                            </a>

                        </div>

                    </div>
                </div>

      <?php endwhile;
            wp_reset_query();

        else: ?>

            <div class="col-md-12">
                <?php get_template_part( 'templates/contents/content', 'empty' ); ?>
            </div>

        <?php endif;

        die();

    }

}