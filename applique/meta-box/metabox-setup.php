<?php

if ( !defined( 'ABSPATH' ) ) { exit; }

/**
 * Register metabox used in whole theme.
 * This function was hooked to `add_meta_boxes`.
 *
 * @since  1.0.0
 * @return void
 */
function dahz_metabox_setup() {

    add_meta_box( 'df_metaboxed_subtitle', 'Page Settings', 'dahz_build_subtitle_page', 'page', 'normal', 'high' );
    add_meta_box( 'df_metaboxed_cstm_archive', 'Post Settings', 'dahz_build_custom_archive', 'page', 'normal', 'high' );

    foreach ( array( 'post', 'page' ) as $post_type ) {
        add_meta_box( 'df_metaboxed_affiliate', 'Affiliate', 'dahz_build_affiliate', $post_type, 'normal', 'high' );
    }

    add_meta_box( 'df_metaboxed_sponsored', 'Sponsored Text Area', 'dahz_build_sponsored', 'post', 'normal', 'high' );

}
add_action( 'add_meta_boxes', 'dahz_metabox_setup' );

/**
 * Function to save metabox to database.
 *
 * @return void
 */
function dahz_metabox_save( $post_id ) {
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }

    // if our nonce isn't there, or we can't verify it, bail
    if ( 'page' == get_post_type() ) {
        if( !isset( $_POST['df_subtitle_nonce'] ) || !wp_verify_nonce( $_POST['df_subtitle_nonce'], 'df_subtitle_nonce' ) ) { return; }
        if( !isset( $_POST['df_affiliate_nonce'] ) || !wp_verify_nonce( $_POST['df_affiliate_nonce'], 'df_affiliate_nonce' ) ) { return; }
        if( !isset( $_POST['df_custom_archive_nonce'] ) || !wp_verify_nonce( $_POST['df_custom_archive_nonce'], 'df_custom_archive_nonce' ) ) { return; }
    } elseif ( 'post' == get_post_type() ) {
        if( !isset( $_POST['df_affiliate_nonce'] ) || !wp_verify_nonce( $_POST['df_affiliate_nonce'], 'df_affiliate_nonce' ) ) { return; }
        if( !isset( $_POST['df_sponsored_area_nonce'] ) || !wp_verify_nonce( $_POST['df_sponsored_area_nonce'], 'df_sponsored_area_nonce' ) ) { return; }
    }

    // if our current user can't edit this post, bail
    if ( 'page' == get_post_type() ) {
        if ( !current_user_can( 'edit_page', $post_id ) ) { return $post_id; }
    } elseif ( 'post' == get_post_type() ) {
        if ( !current_user_can( 'edit_post', $post_id ) ) { return $post_id; }
    }

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
        ),
        'script' => array()
    );

    $allowed3 = array(
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

    // Make sure your data is set before trying to save it
    if( isset( $_POST['df_affiliate_title'] ) ) {
        update_post_meta( $post_id, 'df_affiliate_title', wp_kses( $_POST['df_affiliate_title'], $allowed1 ) );
    }
    if( isset( $_POST['df_affiliate_embed'] ) ) {
        update_post_meta( $post_id, 'df_affiliate_embed', wp_kses( $_POST['df_affiliate_embed'], $allowed2 ) );
    }
    if( isset( $_POST['df_subtitle'] ) ) {
        update_post_meta( $post_id, 'df_subtitle', wp_kses( $_POST['df_subtitle'], $allowed1 ) );
    }
    if( isset( $_POST['df_custom_archive'] ) ) {
        update_post_meta( $post_id, 'df_custom_archive', esc_attr( $_POST['df_custom_archive'] ) );
    }
    if ( isset( $_POST['df_sponsored_area'] ) ) {
        update_post_meta( $post_id, 'df_sponsored_area', wp_kses( $_POST['df_sponsored_area'], $allowed3 ) );
    }


}
add_action( 'save_post', 'dahz_metabox_save' );

/**
 * Build field subtitle to show in page editor.
 *
 * @return string
 */
function dahz_build_subtitle_page() {

	global $post;

	$values = get_post_custom( $post->ID );
	$text 	= isset( $values['df_subtitle'] ) ? $values['df_subtitle'][0] : '';

	// We'll use this nonce field later on when saving.
    wp_nonce_field( 'df_subtitle_nonce', 'df_subtitle_nonce' );

	echo '<label for="df_subtitle">' . esc_attr__( 'Subtitle', 'applique' ) . '</label>';
    echo '<input type="text" name="df_subtitle" id="df_subtitle" value="' . esc_attr( $text ) . '" />';

}

/**
 * Build field affiliate to show in page editor.
 *
 * @return string
 */
function dahz_build_affiliate() {

    global $post;

    $values = get_post_custom( $post->ID );
    $title  = isset( $values['df_affiliate_title'] ) ? $values['df_affiliate_title'][0] : '';
    $embed  = isset( $values['df_affiliate_embed'] ) ? $values['df_affiliate_embed'][0] : '';

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

    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'df_affiliate_nonce', 'df_affiliate_nonce' );

    echo '<div class="first"><label for="df_affiliate_title">' . esc_attr__( 'Widget Title', 'applique' ) . '</label>';
    echo '<input type="text" name="df_affiliate_title" id="df_affiliate_title" value="' . wp_kses( $title, $allowed1 ) . '" /></div>';
    echo '<div class="second"><label for="df_affiliate_embed">' . esc_attr__( 'Embed Code', 'applique' ) . '</label>';
    echo '<textarea name="df_affiliate_embed" id="df_affiliate_embed" />' . wp_kses( $embed, $allowed2 ) . '</textarea></div>';

}

/**
 * Build field post count to show in custom template page editor.
 *
 * @return string
 */
function dahz_build_custom_archive() {

    global $post;

    $values = get_post_custom( $post->ID );
    $count  = isset( $values['df_custom_archive'] ) ? $values['df_custom_archive'][0] : '10';

    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'df_custom_archive_nonce', 'df_custom_archive_nonce' );

    echo '<div class="first"><label for="df_custom_archive">' . esc_attr__( 'Post Count', 'applique' ) . '</label>';
    echo '<input type="number" min="1" name="df_custom_archive" id="df_custom_archive" value="' . esc_attr( $count ) . '" /></div>';

}

if ( !function_exists('dahz_build_sponsored') ) {
    /**
     * Sponsored Text Area
     *
     * @since 1.4.1
     * @author N. Ramadani
     * @return string|null The label's text or null if none provided.
     */
    function dahz_build_sponsored() {

        global $post;

        $values = get_post_custom( $post->ID );
        $embed  = isset( $values['df_sponsored_area'] ) ? $values['df_sponsored_area'][0] : '';

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

        // We'll use this nonce field later on when saving.
        wp_nonce_field( 'df_sponsored_area_nonce', 'df_sponsored_area_nonce' );

        echo '<div class="second"><label for="df_sponsored_area">' . esc_attr__( 'Insert Your Sponsored Text', 'applique' ) . '</label>';
        echo '<textarea name="df_sponsored_area" id="df_sponsored_area" />' . wp_kses( $embed, $allowed ) . '</textarea></div>';

    }

}