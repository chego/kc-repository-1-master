<?php

if ( !defined( 'ABSPATH' ) ) { exit; }

if ( !function_exists( 'dahz_comment' ) ) {

    function dahz_comment( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;
        ?>

        <div <?php dahz_attr( 'comment' ); ?>>

            <div id="comment-<?php comment_ID() ?>" class="comment-container border-bottom">

                <?php if ( get_comment_type() == 'comment' ) : ?>

                    <div class="avatar-picture">

                        <?php the_commenter_avatar( $args ); ?>

                    </div>

                <?php endif; ?>

                <div class="comment-content">

                    <div class="comment-head">

                        <h5 <?php dahz_attr( 'comment-author' ); ?>>

                            <span itemprop="name">

                            	<?php comment_author_link(); ?>

                            </span>

                        </h5>

                        <div class="sep">&#8226;</div>

                        <div class="comments-date">

                            <time <?php dahz_attr( 'comment-published' ); ?>>

                            	<?php echo get_comment_date( get_option( 'date_format' ) ) ?>

                            	<?php esc_attr_e( 'at', 'applique' ); ?>

                            	<?php echo get_comment_time( get_option( 'time_format' ) ); ?>

                            </time>

                        </div>

                        <span class="reply">

                            <?php
                                comment_reply_link( array_merge( $args, array(
                                    'before'     => '<div class="sep">&#8226;</div>',
                                    'depth'      => $depth,
                                    'max_depth'  => $args['max_depth'],
                                    'reply_text' => esc_attr__( 'Reply', 'applique' )
                                ) ) );
                            ?>

                        </span><!-- /.reply -->

                        <span class="edit">
                            <?php edit_comment_link( esc_attr__( 'Edit', 'applique' ), '<div class="sep">&#8226;</div>', '' ); ?>
                        </span>

                    </div><!-- /.comment-head -->

                    <div <?php dahz_attr( 'comment-content' ); ?>>

                        <?php comment_text() ?>

                        <?php if ( $comment->comment_approved == '0' ) : ?>

                            <p class='unapproved'>
                            	<?php esc_attr_e( 'Your comment is awaiting moderation.', 'applique' ); ?>
                            </p>

                        <?php endif; ?>

                    </div><!-- /comment-entry -->

                </div><!-- /.comment-container -->

            </div><!-- /.comment-container -->

            <div class="clear"></div>

        <?php
    }

}

/**
 * PINGBACK / TRACKBACK OUTPUT
 */
if ( !function_exists( 'list_pings' ) ) {

    function list_pings( $comment, $args, $depth ) {

        $GLOBALS['comment'] = $comment; ?>

    	<div id="comment-<?php comment_ID(); ?>">
            <span class="author"><?php comment_author_link(); ?></span> -
            <span class="date"><?php echo get_comment_date( get_option( 'date_format' ) ); ?></span>
            <span class="pingcontent"><?php comment_text(); ?></span>
        <?php
    }

}

/**
 * Commenter Avatar
 */
if ( !function_exists( 'the_commenter_avatar' ) ) {

    function the_commenter_avatar() {
        global $comment;
        $avatar = get_avatar( $comment, 60, '', false, array( 'extra_attr' => 'itemprop="image"' ) );
        print $avatar;
    }

}